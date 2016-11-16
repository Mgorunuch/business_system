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

        $pocket = ['value' => '100.00','frizzed_value' => '10.00'];
        $pocket = Pocket::create($pocket);
        $user = User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.admin',
            'password'=>bcrypt('password'),
            'pocket_id'=>$pocket->id,
            'status'=>1,
            'reffer_id'=>null
        ]);

        $position = Position::createNewPosition($user->id);
        $user->position_id = $position->id;
        $user->save();

        $pocket2 = ['value' => '100','frizzed_value' => '10'];
        $pocket2 = Pocket::create($pocket2);


        $user2 = [
            'name' => 'user123123',
            'email' => 'testuser123123@gmail.com',
            'password' => bcrypt('123456'),
            'pocket_id' => $pocket2->id
        ];
        $user2 = User::create($user2);

        $position2 = Position::createNewPosition($user2->id);
        $user2->position_id = $position2->id;
        $user2->save();

        $j = 30;
        for($i = 0; $i < $j; $i++) {

            $pocket = ['value' => '100','frizzed_value' => '10'];
            $pocket = Pocket::create($pocket);


            $user = [
                'name' => 'user'.$i,
                'email' => 'test'.$i.'@gmail.com',
                'password' => bcrypt('123456'),
                'pocket_id' => $pocket->id,
                'reffer_id' => 1
            ];
            $user = User::create($user);

            $position = Position::createNewPosition($user->id);
            $user->position_id = $position->id;
            $user->save();

        }

        $category = Category::create([
            'name'=>'All'
        ]);
        $category2 = Category::create([
            'name'=>'Some other'
        ]);

        for ($i = 0; $i < 20; $i++) {
            $article = Article::create([
                'title'=>'Some title '.$i,
                'short'=>'short Description '.$i,
                'preview'=>'/images/08.11.16/14785967486.png',
                'text'=>'Full Article Description '.$i,
                'author'=>random_int(1,15),
                'status'=>random_int(0,2)
            ]);

            $article->cat()->attach($category->id);
            $article->cat()->attach($category2->id);
        }

        DB::table('statuses')->insert(
            array('name' => 'month_payment', 'status' => 0)
        );

    }
}
