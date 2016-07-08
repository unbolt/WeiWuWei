<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';

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
    //public function __construct()
    //{
    //    parent::__construct();
    //}

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
        // Import users from the old database
        $this->info('Importing users...');

        $users = DB::connection('old_site')->select('SELECT user_id, from_unixtime(user_regdate) as user_regdate, username_clean, user_email FROM phpbb_users');

        foreach($users as $user) {
            $this->info($user->username_clean);

            if($user->user_email != null) {
                // They are probably a real user and not one of the stupid bot accounts, let's import it
                $import = new \App\Models\Access\User\User;

                $import->id = $user->user_id;
                $import->name = $user->username_clean;
                $import->email = $user->user_email;
                $import->created_at = $user->user_regdate;
                $import->updated_at = $user->user_regdate;

                $import->save();
            }
        }
    }
}
