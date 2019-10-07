<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        	[
        		'name'=>'Bentley Mulsanne',
        		'email'=>'benley2021@manhquan.com'
        	],
        	[
        		'name'=>'rollroye',
        		'email'=>'rollroye2021@manhquan.com'
        	],
        	[
        		'name'=>'BMW',
        		'email'=>'BMW@manhquan.com'
        	],
        	[
        		'name'=>'maybach',
        		'email'=>'may2021@manhquan.com'
        	],
        	[
        		'name'=>'mercedesC300',
        		'email'=>'mercedesC300@manhquan.com'
        	]
        ]);
    }
}
