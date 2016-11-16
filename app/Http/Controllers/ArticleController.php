<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

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
            $root = $_SERVER['DOCUMENT_ROOT']."/images/articles/";
            if(!file_exists($root.$date)) File::makeDirectory($root.$date, 0777, true);

            $f_name = $request->file('preview')->getClientOriginalName();
            $server_filename = Carbon::now()->timestamp.rand(1,10).'.'.$request->file('preview')->getClientOriginalExtension();

            $request->file('preview')->move($root.$date,$server_filename);
            $all['preview'] = '/images/articles/'.$date.'/'.$server_filename;
        }

        $all['author'] = Auth::user()->id;
        $all['status'] = 2;

        if($all['category'] != 1 && Category::check($all['category'])) {
            $article = Article::create($all);
            $article->cat()->attach(1);
            $article->cat()->attach($all['category']);
        } else {
            return back()->with(['message'=>'Такой категории не существует!!']);
        }

        return redirect('/blog')->with(['message'=>'article created']);
        //return view('dashboard.blog.main', ['cat'=>1,'page'=>'1']);
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
        return view('dashboard.blog.article.show', [
            'article' => $article,
            'user'=>Auth::user()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(empty(Auth::user()->articles()->find($id)) || Auth::user()->id != 1) return back()->with(['message'=>'Undefined error']);

        return view('dashboard.blog.article.edit', [
            'article'=>Article::where('id','=',$id)->first()
        ]);
    }

    public function moderate() {
        return view('dashboard.moderate.article')->with([
            'articles'=>Article::where('status','=','2')->get()
        ]);
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
        if(empty(Auth::user()->articles()->find($id)) || Auth::user()->id != 1) return back()->with(['message'=>'Undefined error']);

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
            $root = $_SERVER['DOCUMENT_ROOT']."/images/articles/";
            if(!file_exists($root.$date)) File::makeDirectory($root.$date, 0777, true);

            $f_name = $request->file('preview')->getClientOriginalName();
            $server_filename = Carbon::now()->timestamp.rand(1,10).'.'.$request->file('preview')->getClientOriginalExtension();

            $request->file('preview')->move($root.$date,$server_filename);
            $all['preview'] = '/images/articles/'.$date.'/'.$server_filename;
        }

        $article = Article::find($id);
        $article->fill($all);
        $article->status = 2;
        $article->save();

        return redirect('/blog/my-articles');
    }

    public function activate($id) {
        if(Auth::user()->id != 1) return back()->with(['message'=>'Undefined error']);

        $article = Article::find($id);
        if(!$article) return back()->with(['message'=>'Article not defined']);
        $article->status = 1;
        $article->save();
        return back()->with(['message'=>'Article allowed']);
    }

    public function decline(Request $request, $id) {
        if(Auth::user()->id != 1) return back()->with(['message'=>'Undefined error']);

        $all = $request->all();

        Validator::make($all, [
            'decline_comment' => 'string'
        ])->validate();

        $article = Article::find($id);
        if(!$article) return back()->with(['message'=>'Article not defined']);
        $article->status = 0;
        $article->decline_comment = $all['decline_comment'] ;
        $article->save();

        return back()->with(['message'=>'Article declined']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $article = Article::findOrFail($id);

        if($article->author == $user->id || $user->id == 1) {
            $article->delete();
        } else {
            return back()->with(['message'=>'Undefined error']);
        }
        return back()->with(['message'=>'Deleted']);
    }


    public function addLike($article_id) {
        $user = Auth::user();
        $article = Article::find($article_id);
        $article->addLike($user);
        return back();
    }
    public function addDislike($article_id) {
        $user = Auth::user();
        $article = Article::find($article_id);
        $article->addDislike($user);
        return back();
    }
}
