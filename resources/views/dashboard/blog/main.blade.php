@extends('layouts.app')

@section('content')
    <nav class="navbar top-navbar navbar-default navbar-static-top">
        <div class="container">
            <ul class="nav navbar-nav navbar-left navbar-blog">
                <li class="@if(\Illuminate\Support\Facades\Request::is('*my-articles*')) active @endif">
                    <a href="/blog/my-articles">My Articles</a>
                </li>
                @foreach(\App\Category::all() as $category)

                    <li class="@if($articles['cat'] == $category->id) active @endif"><a href="/blog/{{$category->id}}">{{$category->name}}</a></li>

                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right navbar-blog">
                <li class="">
                    <a href="{{action('ArticleController@create')}}" class="">Create new article</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <img src="/images/vk.png" alt="">
                        <!-- <div id="vk_groups"></div> -->
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row flex-wrap posts-container">
                    @foreach($articles['pool'] as $article)
                        @if(($loop->index % 2) == 0 && $loop->index != 0) </div> @endif
                        @if(($loop->index % 2) == 0) <div class="flex-row-2 full-width"> @endif
                        <div @if(\Illuminate\Support\Facades\Request::is('*my-articles*')) @else onclick="window.location='{{action('ArticleController@show', ['id'=>$article->id])}}'" @endif class="post" style="background-color: #fff; margin-bottom: 20px;">
                            @if($article->preview != null)
                                <div class="image-preview" style="background-image: url({{$article->preview}});"></div>
                            @endif
                            <div class="modal-header">
                                <h4 style="margin: 0"><strong>{{$article->title}}</strong></h4>
                            </div>
                            <div class="modal-body">
                                {!! html_entity_decode($article->short) !!}
                                <div class="clearfix"></div>
                                <a href="{{action('ArticleController@show', ['id'=>$article->id])}}" class="more_info">Read More...</a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="modal-footer text-right">
                                <div class="buttons">
                                    @if(\Illuminate\Support\Facades\Request::is('*my-articles*'))
                                        @if(\App\Article::user_articles()->find($article->id))
                                            <a href="{{"/blog/article/edit/".$article->id}}" class="btn btn-default">Change</a>
                                            <a href="#" class="btn btn-danger"
                                               onclick="event.preventDefault(); document.getElementById('delete-article-{{$article->id}}').submit();">Delete</a>
                                            <form style="display: none;" id="delete-article-{{$article->id}}" action="{{action('ArticleController@destroy', ['id'=>$article->id])}}" method="post">
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                    @else
                                        <span class="author">
                                        {{'By '.$article->authorModel->name}}
                                    </span>
                                    @endif
                                </div>

                                <div style="">Rating:
                                    @if($article->rating < 0) <span style="color: red;">{{$article->rating}}</span>
                                    @elseif($article->rating > 0) <span style="color: green;">{{$article->rating}}</span>
                                    @else {{$article->rating}}
                                    @endif
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Request::is('*my-articles*'))
                                @if(\App\Article::user_articles()->find($article->id))
                                    <div class="modal-footer">
                                        Status:
                                        @if($article->status == 2)
                                            <span style="color: orange">On review</span>
                                        @elseif($article->status == 1)
                                            <span style="color: green">Published</span>
                                        @else
                                            @if(empty($article->decline_comment) || $article->decline_comment == null)
                                                <span style="color: red">Declined without comment</span>
                                            @else
                                                <span style="color: red">Declined ({{$article->decline_comment}})</span>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if($loop->last) </div> @endif
                    @endforeach
                </div>
                <div class="flex-center">
                    <div class="pagination">
                        @if($articles['page'] != 1)
                            <a class="prev" href="{{"/blog/".$articles['cat']."/".($articles['page']-1)."/"}}">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @else
                            <a class="prev disabled" href="#}}">
                                <i class="fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @endif
                        @for($i = 1; $i <= $articles['pages']; $i++)
                            <a class="@if($i == $articles['page']) active @endif " href="{{"/blog/".$articles['cat']."/".$i."/"}}">{{$i}}</a>
                        @endfor
                        @if($articles['page'] != 1)
                            <a class="next" href="{{"/blog/".$articles['cat']."/".($articles['page']+1)."/"}}">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        @else
                            <a class="prev disabled" href="#">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        VK.Widgets.Group("vk_groups", {mode: 4, wide: 1, width: "100%", height: "400", color3: '7CB5DD'}, 20003922);
    </script>
@endsection

@section('page_info')
    <div class="page_info">
        <div class="container">
            <div class="icon">
                <i class="fa fa-pencil-square" aria-hidden="true"></i>
            </div>
            <div class="title">
                Blog
            </div>
        </div>
        <div class="container">
            <div class="more_info">
                <span>On this page you can find a lot of cool articles</span>
            </div>
        </div>
    </div>
@endsection