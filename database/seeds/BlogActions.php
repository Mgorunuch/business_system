<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Article;
use App\User;
use App\Pocket;
use App\Position;
use Illuminate\Support\Facades\DB;

class BlogActions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pocket = ['value' => '0.00','frizzed_value' => '0.00'];
        $pocket = Pocket::create($pocket);
        $user = User::create([
            'name'=>'piligrimgroup',
            'email'=>'piligrimgroup@piligrim-group.com',
            'password'=>bcrypt('P0g1E1c5'),
            'pocket_id'=>$pocket->id,
            'status'=>1,
            'reffer_id'=>null
        ]);

        $position = Position::createNewPosition($user->id);
        $user->position_id = $position->id;
        $user->save();

        $category = Category::create([
            'name'=>'All'
        ]);

        DB::table('statuses')->insert(
            array('name' => 'month_payment', 'status' => 0)
        );

    }
}
