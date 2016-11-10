@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2" style="background-color: #fff;">
            <div class="modal-header">
                <strong>{{$article->title}}</strong>
            </div>
            @if($article != null)
                <div class="modal-body">
                    <img src="{{$article->preview}}" width="100%" alt="">
                </div>
            @endif
            <div class="modal-body">
                {!! html_entity_decode($article->text) !!}
            </div>
            <div class="modal-footer">
                <div style="float: left">
                    <a href="#" class="btn btn-success"
                       onclick="event.preventDefault(); document.getElementById('addLike-article-{{$article->id}}').submit();">Like</a>
                    <form style="display: none;" id="addLike-article-{{$article->id}}" action="{{"/blog/article/addLike/".$article->id}}" method="post">
                        {{ csrf_field() }}
                    </form>
                    <div style="display: inline-block; margin: 0 10px;">Rating:
                        @if($article->rating < 0) <span style="color: red;">{{$article->rating}}</span>
                        @elseif($article->rating > 0) <span style="color: green;">{{$article->rating}}</span>
                        @else {{$article->rating}}
                        @endif
                    </div>
                    <a href="#" class="btn btn-danger"
                       onclick="event.preventDefault(); document.getElementById('addDislike-article-{{$article->id}}').submit();">Dislike</a>
                    <form style="display: none;" id="addDislike-article-{{$article->id}}" action="{{"/blog/article/addDislike/".$article->id}}" method="post">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection