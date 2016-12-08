<?php

use Illuminate\Database\Seeder;
use App\Achievement;

class Achievements extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Achievement::create([
            'name'=>'Lessons',
            'description'=>'Bronze - look 1 lesson, Silver - look 4 lessons, Gold - look 8 lesson'
        ]);
        Achievement::create([
            'name'=>'Posts',
            'description'=>'Bronze - write 5 posts, Silver - write 10 posts, Gold - write 20 posts'
        ]);
        Achievement::create([
            'name'=>'Comments',
            'description'=>'Bronze - write 20 comments, Silver - write 50 comments, Gold - write 100 comments'
        ]);
        Achievement::create([
            'name'=>'Invites',
            'description'=>'Bronze - invite 3 users, Silver - invite 10 users, Gold - invite 30 users'
        ]);
        Achievement::create([
            'name'=>'Tree',
            'description'=>'Bronze - full 3 lines, Silver - full 5 lines, Gold - full 9 lines'
        ]);
        Achievement::create([
            'name'=>'Cash',
            'description'=>'Bronze - gain 100 PGC, Silver - gain 500 PGC, Gold - gain 2000 PGC'
        ]);
    }
}
