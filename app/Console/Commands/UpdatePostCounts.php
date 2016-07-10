<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Riari\Forum\Models\Category;
use Riari\Forum\Models\Post;
use Riari\Forum\Models\Thread;

class UpdatePostCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forum:refreshcount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates counts for threads and posts.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Loop through categories
        $categories = \Riari\Forum\Models\Category::all();

        foreach($categories as $category) {
            // Loop through the categories and check for threads
            $threads = \Riari\Forum\Models\Thread::where('category_id', '=', $category->id)->get();

            $thread_count = count($threads);
            $this->info($thread_count);

            $forum_posts = 0;

            foreach($threads as $thread) {

                $posts = \Riari\Forum\Models\Post::where('thread_id', '=', $thread->id)->get();

                $post_count = count($posts);
                $post_count = $post_count - 1; // Remove one to account for the initial thread opener

                $forum_posts = $forum_posts + $post_count;

                $thread->reply_count = $post_count;
                $thread->timestamps = false;
                $thread->save();

            }

            $category->timestamps = false;

            $category->thread_count = $thread_count;
            $category->post_count = $forum_posts;;

            $category->save();
        }
    }
}
