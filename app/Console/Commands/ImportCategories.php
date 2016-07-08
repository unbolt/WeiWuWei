<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Import the categories
        $this->info('Importing categories...');

        $forums = DB::connection('old_site')->select('SELECT forum_id, parent_id, forum_name, forum_desc  FROM phpbb_forums');

        foreach($forums as $forum) {
            $import = new \Riari\Forum\Models\Category;

            $import->id = $forum->forum_id;
            $import->category_id = $forum->parent_id;
            $import->title = $forum->forum_name;
            $import->description = $forum->forum_desc;
            $import->enable_threads = '1';
            $import->private = '0';

            $import->save();

        }

    }
}
