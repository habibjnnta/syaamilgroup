<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = [
            "dashboard" => ["view"],
        ];
        $lists = [
            array(
                "slug" => "guru-view-any",
                "name" => "Guru View List"
            ),
            array(
                "slug" => "guru-view",
                "name" => "Guru View Detail"
            ),
            array(
                "slug" => "guru-add",
                "name" => "Guru Add",
            ),
            array(
                "slug" => "guru-edit",
                "name" => "Guru Edit",
            ),
            array(
                "slug" => "guru-delete",
                "name" => "Guru Delete",
            ),
        ];
        foreach ($lists as $key => $permission) {
            foreach ($permission as $value) {
                $data = 
                array(
                    "slug" => "{$key}-{$value}",
                    "name" => "{$key} {$value}",
                );
                Permission::updateOrCreate($data,
                ['slug' => "{$key}-{$value}"]
                );
            }
        }
    }
}
