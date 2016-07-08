<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function convertBBCodeToHTML($bbcode)
    {
    	$bbcode = preg_replace('#\[b](.+)\[\/b]#', "<b>$1</b>", $bbcode);
    	$bbcode = preg_replace('#\[i](.+)\[\/i]#', "<i>$1</i>", $bbcode);
    	$bbcode = preg_replace('#\[u](.+)\[\/u]#', "<u>$1</u>", $bbcode);
    	$bbcode = preg_replace('#\[img](.+?)\[\/img]#is', "<img src='$1'\>", $bbcode);
    	$bbcode = preg_replace('#\[quote=(.+?)](.+?)\[\/quote]#is', "<QUOTE><i>&gt;</i>$2</QUOTE>", $bbcode);
    	$bbcode = preg_replace('#\[code:\w+](.+?)\[\/code:\w+]#is', "<CODE class='hljs'>$1<CODE>", $bbcode);
    	$bbcode = preg_replace('#\[pre](.+?)\[\/pre]#is', "<code>$1<code>", $bbcode);
    	$bbcode = preg_replace('#\[u](.+)\[\/u]#', "<u>$1</u>", $bbcode);
    	$bbcode = preg_replace('#\[\*](.+?)\[\/\*]#is', "<li>$1</li>", $bbcode);
    	$bbcode = preg_replace('#\[color=\#\w+](.+?)\[\/color]#is', "$1", $bbcode);
    	$bbcode = preg_replace('#\[url=(.+?)](.+?)\[\/url]#is', "<a href='$1'>$2</a>", $bbcode);
    	$bbcode = preg_replace('#\[url](.+?)\[\/url]#is', "<a href='$1'>$1</a>", $bbcode);
    	$bbcode = preg_replace('#\[list](.+?)\[\/list]#is', "<ul>$1</ul>", $bbcode);
    	$bbcode = preg_replace('#\[size=200](.+?)\[\/size]#is', "<h1>$1</h1>", $bbcode);
    	$bbcode = preg_replace('#\[size=170](.+?)\[\/size]#is', "<h2>$1</h2>", $bbcode);
    	$bbcode = preg_replace('#\[size=150](.+?)\[\/size]#is', "<h3>$1</h3>", $bbcode);
    	$bbcode = preg_replace('#\[size=120](.+?)\[\/size]#is', "<h4>$1</h4>", $bbcode);
    	$bbcode = preg_replace('#\[size=85](.+?)\[\/size]#is', "<h5>$1</h5>", $bbcode);
    	return $bbcode;
    }

    private function trimSmilies($postText)
    {
    	$startStr = "<!--";
    	$endStr = 'alt="';
    	$startStr1 = '" title';
    	$endStr1 = " -->";
    	$emoticonsCount = substr_count($postText, '<img src="{SMILIES_PATH}');
    	for ($i=0; $i < $emoticonsCount; $i++)
    	{
    		$startPos = strpos($postText, $startStr);
    		$endPos = strpos($postText, $endStr);
    		$postText = substr_replace($postText, NULL, $startPos, $endPos-$startPos+strlen($endStr));
    		$startPos1 = strpos($postText, $startStr1);
    		$endPos1 = strpos($postText, $endStr1);
    		$postText = substr_replace($postText, NULL, $startPos1, $endPos1-$startPos1+strlen($endStr1));
    	}
    	return $postText;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // BEAST MODE ENABLED.
        // This shit gonna get wild, hold on to yer tits.
        $this->info('Import posts...');

        // First we need all the threads.
        $threads = DB::connection('old_site')->select('SELECT topic_id, topic_poster, forum_id, topic_title, topic_time FROM phpbb_topics ORDER BY topic_id DESC;');

        $bar = $this->output->createProgressBar(count($threads));

        foreach($threads as $thread) {
            $this->info(' Importing: '.$thread->topic_title);

            // Save the thread
            $import_thread = new \Riari\Forum\Models\Thread;

            $import_thread->id = $thread->topic_id;
            $import_thread->author_id = $thread->topic_poster;
            $import_thread->category_id = $thread->forum_id;
            $import_thread->title = $thread->topic_title;
            $import_thread->created_at = $thread->topic_time;
            $import_thread->updated_at = $thread->topic_time;

            $import_thread->save();

            // Get all the posts for this thread
            $posts = DB::connection('old_site')->select('SELECT * FROM phpbb_posts WHERE topic_id = '.$thread->topic_id);

            $posts_bar = $this->output->createProgressBar(count($posts));

            foreach($posts as $post) {
                $import_post = new \Riari\Forum\Models\Post;

                // Clean the shit out of the post content
                $post_content = $post->post_text;
                $post_content = preg_replace('#\:\w+#', '', $post_content);
                $post_content = $this->convertBBCodeToHTML($post_content);
                $post_content = str_replace("&quot;","\"", $post_content);
                $post_content = preg_replace('|[[\/\!]*?[^\[\]]*?]|si', '', $post_content);
                $post_content = $this->trimSmilies($post_content);

                // Format the fucking date - WHY IS IT LIKE THIS?!
        		$post_date = Carbon::createFromTimestamp($post->post_time)->toDateTimeString();;

                $import_post->id = $post->post_id;
                $import_post->thread_id = $post->topic_id;
                $import_post->author_id = $post->poster_id;
                $import_post->content = $post_content;
                $import_post->created_at = $post_date;
                $import_post->updated_at = $post_date;
                $import_post->post_id = '0';
                $import_post->legacy_post = '1';

                $import_post->save();

                $posts_bar->advance();
            }

            $posts_bar->finish();

            $bar->advance();
        }

        $bar->finish();

    }
}
