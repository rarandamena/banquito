<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rafa = new User();
        $rafa->name = 'rafa';
        $rafa->email = 'rafa@email.com';
        $rafa->password = bcrypt('password');
        $rafa->save();


        $paty = new User();
        $paty->name = 'paty';
        $paty->email = 'paty@email.com';
        $paty->password = bcrypt('password');
        $paty->save();
    }
}
