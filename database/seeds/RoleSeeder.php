<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            array(
                "slug" => "admin",
                "name" => "admin",
            ),
        ];
        foreach ($roles as $role) {
            Role::updateOrCreate($role,
            ['slug' => $role['slug']]
            );
        }


    }
}
