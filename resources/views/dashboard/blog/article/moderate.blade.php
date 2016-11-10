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
                            <div style="float: left;">
                                <img src="{{$article->author()->profile_image}}" class="img-circle" height="20" alt=""> {{$article->author()->name}}
                            </div>
                        </span>
                        <span style="display: inline-block; width: 20px;"></span>
                        <a href="/blog/moderate/allow/{{$article->id}}" class="btn btn-success">Allow</a>
                        <span style="display: inline-block; width: 20px;"></span>
                        <a href="#" class="btn btn-danger"
                           onclick="event.preventDefault(); document.getElementById('decline-form').submit();">Decline</a>
                        <span style="display: inline-block; width: 20px;"></span>
                        <form id="decline-form" style="width: 200px; display: inline-block; vertical-align: middle;" action="/blog/moderate/decline/{{$article->id}}">
                            {{ csrf_field() }}
                            <input type="text" class="form-control" name="decline_comment" placeholder="decline comment">
                        </form>
                        <span style="display: inline-block; width: 20px;"></span>
                        <a href="{{"/blog/article/".$article->id}}" class="btn btn-default">More...</a>
                    </div>
                    <div class="row">

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection