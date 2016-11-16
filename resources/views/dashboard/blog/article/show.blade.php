@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container flex-center">
            <div class="text-center">
                <div class="title text-center">
                    {{$article->title}}
                </div>
                <span class="article-head-author">By {{$article->authorModel->name}}</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1 article full-post" style="background-color: #fff;">
            <div class="row">
                @if($article->preview != null)
                    <div class="article-image" style="background-image: url('{{$article->preview}}');">
                    </div>
                @endif
                <div class="modal-body">
                    {!! html_entity_decode($article->text) !!}
                </div>
                <div class="modal-footer">
                    <div style="float: left">
                        <a href="#" class="like @if($article->checkRatingAction($user) == '1') active @endif rating-action"
                           onclick="event.preventDefault(); document.getElementById('addLike-article-{{$article->id}}').submit();">
                            <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                        </a>
                        <form style="display: none;" id="addLike-article-{{$article->id}}" action="{{"/blog/article/addLike/".$article->id}}" method="post">
                            {{ csrf_field() }}
                        </form>
                        <div style="display: inline-block; margin: 0 10px;">Rating:
                            @if($article->rating < 0) <span style="color: red;">{{$article->rating}}</span>
                            @elseif($article->rating > 0) <span style="color: green;">{{$article->rating}}</span>
                            @else {{$article->rating}}
                            @endif
                        </div>
                        <a href="#" class="dislike @if($article->checkRatingAction($user) == '2') active @endif rating-action"
                           onclick="event.preventDefault(); document.getElementById('addDislike-article-{{$article->id}}').submit();">
                            <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                        </a>
                        <form style="display: none;" id="addDislike-article-{{$article->id}}" action="{{"/blog/article/addDislike/".$article->id}}" method="post">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection