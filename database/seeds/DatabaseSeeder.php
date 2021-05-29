<?php


use App\Role;
use App\Role_user;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create(array('first_name' => 'George', 'last_name' => 'Petrou', 'avatar' => 'default.jpg', 'email' => 'admin@admin.com', 'password' => Hash::make('password')));
        User::create(array('first_name' => 'Nick', 'last_name' => 'Jones', 'avatar' => 'default.jpg', 'email' => 'nick@gmail.com', 'password' => Hash::make('1235')));
        User::create(array('first_name' => 'Ryan', 'last_name' => 'Giggs', 'avatar' => 'default.jpg', 'email' => 'giggs@gmail.com', 'password' => Hash::make('1236')));
        Role::create(array('name' => 'admin'));
        Role::create(array('name' => 'user'));
        Role_user::create(array('user_id' => 1, 'role_id' => 1));
        Role_user::create(array('user_id' => 2, 'role_id' => 2));
        Role_user::create(array('user_id' => 3, 'role_id' => 2));
    }
}
