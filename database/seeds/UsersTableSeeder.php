<?php

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
    	$data = [
    			'name'     => 'Admin',
    			'email'    => 'admin@gmail.com',
    			'address'  => 'Ha Noi',
    			'phone'    => '0936259429',
    			'password' => bcrypt('123456'),
    			'level'    => 1
    			];
        DB::table('users')->insert($data);
    }
}
