<?php

use Illuminate\Database\Seeder;
use App\Nouser;
class NousersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [0,1,2,3,4,5,6,7,8,9,10];
        foreach($users as $user){
            $nouser_tech = new Nouser();
            $nouser_tech->users = $user;
            $nouser_tech->save();
        }
    }
}
