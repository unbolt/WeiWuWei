<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeiWuWeiRoleSeeder extends Seeder
{
    public function run()
    {
        // Create a member and officer role
        $role_model             = config('access.role');
        $member                 = new $role_model;
        $member->name           = 'Member';
        $member->sort           = 3;
        $member->created_at     = Carbon::now();
        $member->updated_at     = Carbon::now();
        $member->save();

        $role_model             = config('access.role');
        $officer                = new $role_model;
        $officer->name          = 'Officer';
        $officer->sort          = 4;
        $officer->created_at    = Carbon::now();
        $officer->updated_at    = Carbon::now();
        $officer->save();

    }
}
