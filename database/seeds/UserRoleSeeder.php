<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_assign = [
            "admin" => [
                1,
            ],
        ];
        $roles = Role::all();
        $date = date("Y-m-d H:i:s");
        foreach ($roles as $role) {
            if (isset($user_assign[$role->slug])) {
                foreach ($user_assign[$role->slug] as $user_id) {
                    try {
                        DB::table('users_roles')->insert([
                            "user_id" => $user_id,
                            "role_id" => $role->id,
                            "created_at" => $date,
                            "updated_at" => $date,
                        ]);
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
            }
        }
    }
}
