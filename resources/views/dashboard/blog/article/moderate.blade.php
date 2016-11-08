@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            @foreach($articles as $article)
                <div class="post" style="background-color: #fff; margin-bottom: 20px;">
                    <div class="modal-header">
                        {{$article->title}}
                    </div>
                    <div class="modal-body" style="overflow: hidden;">
                        @if($article->preview != null)
                        <img src="{{$article->preview}}" width="200px" style="max-width:20%; float: left; margin-right: 10px;" alt="">
                        @endif
                        <p class="text">
                            {!! html_entity_decode($article->short) !!}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <span class="user">
                            <?php $author = \App\User::find($article->author)->first(); ?>
                            {{$author->name}}
                        </span>
                        <span style="display: inline-block; width: 20px;"></span>
                        <a href="/blog/moderate/allow/{{$article->id}}" class="btn btn-success">Allow</a>
                        <span style="display: inline-block; width: 20px;"></span>
                        <a href="/blog/moderate/decline/{{$article->id}}" class="btn btn-danger">Decline</a>
                        <span style="display: inline-block; width: 20px;"></span>
                        <a href="{{"/blog/article/".$article->id}}" class="btn btn-default">Подробнее...</a>
                    </div>
                    <div class="row">

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection