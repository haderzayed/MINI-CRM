<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::updateOrCreate(
           ['id'=>1],
           [
               'role'=>'super_admin',
               'name'=>'admin',
               'email'=>'admin@admin.com',
               'password'=>'$2y$10$fqU.2H.plxhpfhGxDDPzDu2lKPi8CcbTbwd9AousF2UvI.kOAlxR2', //password

       ]);
    }
}
