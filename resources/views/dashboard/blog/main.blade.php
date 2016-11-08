@extends('layouts.app')

@section('content')
    <?php if(!isset($page) || !$page) $page = 1; ?>

    <div class="container">
        @if(Session::has('message'))
        <div class="col-xs-12" style="margin-bottom: 20px;">
            <div class="modal-body bg-info">
                {{Session::get('message')}}
            </div>
        </div>
        @endif
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">

                <li style="background-color: #fff" class="@if($articles['cat'] == 'my_articles') btn-primary @endif"><a href="/blog/my-articles">My articles</a></li>

                @foreach(\App\Category::all() as $category)

                    <li class="@if($articles['cat'] == $category->id) btn-primary @endif" style="background-color: #fff"><a href="/blog/{{$category->id}}">{{$category->name}}</a></li>

                @endforeach

                <li style="background-color: #fff; margin-top: 20px;">
                    <form action="{{action('CategoriesController@create')}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <strong>Create new category</strong>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input class="form-control" type="text" name="name" placeholder="category name">
                            </div>
                            <button class="btn btn-primary" type="submit">Create</button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
        <div class="col-md-8 col-md-offset-1">
            <div class="settings modal-body" style="background-color: #fff; margin-bottom: 20px;">
                <a href="{{action('ArticleController@create')}}" class="btn btn-primary">Create new article</a>
                <a href="{{action('ArticleController@moderate')}}" class="btn btn-primary">Moderate</a>
            </div>
            @foreach($articles['pool'] as $article)
                <div class="post" style="background-color: #fff; margin-bottom: 20px;">
                    <div class="modal-header">
                        <h3 style="margin: 0"><strong>{{$article->title}}</strong></h3>
                    </div>
                    @if($article->preview != null)
                    <div class="modal-body">
                        <div class="">
                            <img src="{{$article->preview}}" width="100%" alt="">
                        </div>
                    </div>
                    @endif
                    <div class="modal-body">
                        {!! html_entity_decode($article->short) !!}
                    </div>
                    <div class="modal-footer text-right">
                        @if(\App\Article::user_articles()->find($article->id))
                            <a href="{{"/blog/article/edit/".$article->id}}" class="btn btn-default">Изменить</a>
                        @endif

                        <a href="{{"/blog/article/".$article->id}}" class="btn btn-default">Подробнее...</a>
                    </div>
                </div>
            @endforeach
            <div class="text-center">
                @for($i = 1; $i <= $articles['pages']; $i++)
                    <a class="btn @if($i == $articles['page']) btn-primary @endif " href="{{"/blog/".$articles['cat']."/".$i."/"}}">{{$i}}</a>
                @endfor
            </div>
        </div>
    </div>
@endsection