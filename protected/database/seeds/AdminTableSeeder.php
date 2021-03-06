<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('admins')->delete();
        \DB::table('admins')->insert([
        	'email' => 'admin@demo.com',
        	'password' => \Hash::make(123456),
        	'name' => 'admin'
        ]);
    }
}
