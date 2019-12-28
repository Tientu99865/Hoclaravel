<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(userSeeder::class);
    }
}
class userSeeder extends Seeder
{
    public function run(){
        DB::table('users')->insert([
            ['name'=>'Tu1','email'=>'tientu2.aug16@gmail.com','password'=>bcrypt('abc123')],
            ['name'=>'Tu2','email'=>'tientu3.aug16@gmail.com','password'=>bcrypt('abc123')]
        ]);
    }
}
