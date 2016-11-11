<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Article;
use App\User;
use App\Pocket;

class BlogActions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pocket = Pocket::create();

        $user = User::create([
            'name'=>'Admin',
            'email'=>'admin@admin.admin',
            'password'=>bcrypt('password'),
            'pocket_id'=>$pocket->id
        ]);

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
                'author'=>$user->id,
                'status'=>random_int(0,2)
            ]);

            $article->cat()->attach($category->id);
            $article->cat()->attach($category2->id);
        }

    }
}
