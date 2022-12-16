<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where([
            'name'       => 'admin',
            'guard_name' => 'sanctum',
        ])->first();

        // CREATE ROLE IF NOT EXIST ROLE
        if (!$role) {
            foreach (['admin','web','api'] as $newRole){
                $role = new Role;
                $role->name = $newRole;
                $role->guard_name = 'sanctum';
                $role->saveQuietly();
            }
        }
    }
}
