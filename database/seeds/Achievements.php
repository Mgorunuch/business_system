<?php

use Illuminate\Database\Seeder;

class Achievements extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $achievements = [];
        for($i=0; $i<10; $i++) {
            $achievements[] = [
                'name'=>'Some Achievement '.$i
            ];
        }
        DB::table('achievements')->insert($achievements);
    }
}
