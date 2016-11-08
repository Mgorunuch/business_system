<?php

namespace App\Http\Controllers;

use App\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.blog.article.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:1|max:100', // TODO: make min 10
            'preview' => 'image|dimensions:min_width=300,min_height=100',
            'short' => 'required|min:1|max:1000', // TODO: make min 10
            'text' => 'required|max:20000|min:1', // TODO: make min 1000
            'category' => 'required|isset_in_categories'
        ]);

        $all = $request->all();

        if($request->hasFile('preview')) {
            $date = date('d.m.y');
            $root = $_SERVER['DOCUMENT_ROOT']."/images/";
            if(!file_exists($root.$date)) File::makeDirectory($root.$date, 0700, true);

            $f_name = $request->file('preview')->getClientOriginalName();
            $server_filename = Carbon::now()->timestamp.rand(1,10).'.'.$request->file('preview')->getClientOriginalExtension();

            $request->file('preview')->move($root.$date,$server_filename);
            $all['preview'] = '/images/'.$date.'/'.$server_filename;
        }

        if(isset($all['allow_comments']) && $all['allow_comments'] == "on")
            $all['comments'] = 1;
        else
            $all['comments'] = 0;

        $all['author'] = '1';
        $all['status'] = 1;

        Article::create($all);

        return view('dashboard.blog.main', ['cat'=>0,'page'=>'1']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::where('id','=',$id)->first();
        return view('dashboard.blog.article.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:1|max:100', // TODO: make min 10
            'preview' => 'image|dimensions:min_width=300,min_height=100',
            'short' => 'required|min:1|max:1000', // TODO: make min 10
            'text' => 'required|max:20000|min:1', // TODO: make min 1000
            'category' => 'required|isset_in_categories'
        ]);

        $all = $request->all();

        $article = Article::find($id)->get();
        $article->fill($all);
        $article->status = 0;
        $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
