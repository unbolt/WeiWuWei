<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $group_model        = config('access.group');
        $access             = new $group_model;
        $access->name       = 'News';
        $access->sort       = 1;
        $access->created_at = Carbon::now();
        $access->updated_at = Carbon::now();
        $access->save();

        $permission_model           = config('access.permission');
        $createNews                 = new $permission_model;
        $createNews->name           = 'create-news';
        $createNews->display_name   = 'Create News';
        $createNews->system         = true;
        $createNews->group_id       = 5;
        $createNews->sort           = 1;
        $createNews->created_at     = Carbon::now();
        $createNews->updated_at     = Carbon::now();
        $createNews->save();
    }
}
