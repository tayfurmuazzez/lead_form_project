<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ADMIN USER CONTROL
        $adminUserMail = env('ADMIN_USER_MAIL','admin@admin.com');
        $adminUserPassword = env('ADMIN_USER_PASSWORD','123');
        $adminUserName = env('ADMIN_USER_NAME','Admin User');

        $user = User::where(['email'=>$adminUserMail])->first();
        if (!$user) {
            $user = new User;
            $user->email = $adminUserMail;
            $user->name = $adminUserName;
            $user->password = bcrypt($adminUserPassword);
            $user->saveQuietly();

            //CREATE FAKE USERS
            User::factory(10)->create();
        }

        //ASSIGNED ROLE FOR ADMIN
        $user->assignRole('admin');
    }
}
