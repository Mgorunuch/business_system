@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container">
            <div class="icon">
                <i class="fa fa-pencil-square" aria-hidden="true"></i>
            </div>
            <div class="title">
                Moderating
            </div>
        </div>
        <div class="container">
            <div class="more_info">
                <span>On this you can moderate (Only admin)</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <nav class="navbar top-navbar navbar-default navbar-static-top">
        <div class="container">
            <ul class="nav navbar-nav navbar-left navbar-blog">
                <li class="@if(\Illuminate\Support\Facades\Request::is('*moderate/articles*')) active @endif">
                    <a href="{{action('ArticleController@moderate')}}" class="">Articles</a>
                </li>
                <li class="@if(\Illuminate\Support\Facades\Request::is('*moderate/categories*')) active @endif">
                    <a href="{{action('CategoriesController@moderate')}}" class="">Categories</a>
                </li>
                <li class="@if(\Illuminate\Support\Facades\Request::is('*moderate/payments*')) active @endif">
                    <a href="{{action('PaymentController@moderate')}}" class="">Payments</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            @foreach($articles as $article)
                <div class="post moderate">
                    <div class="modal-header">
                        {{$article->title}}
                    </div>
                    <div class="modal-body" style="overflow: hidden;">
                        @if($article->preview != null)
                            <img src="{{$article->preview}}" width="200px" style="max-width:20%; float: left; margin-right: 10px;" alt="">
                        @endif
                        <p class="text">
                            {!! html_entity_decode($article->short) !!}
                            <a href="{{action('ArticleController@show', ['id'=>$article->id])}}" class="more_info">Read More...</a>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <span class="user">
                            <div style="float: left;">
                                <img src="{{$article->authorModel->profile_image}}" class="img-circle" height="20" alt=""> {{$article->authorModel->name}}
                            </div>
                        </span>
                        <div>
                            <a href="/dashboard/moderate/articles/allow/{{$article->id}}" class="btn btn-success">Allow</a>
                            <span style="display: inline-block; width: 20px;"></span>
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#decline" onclick="document.getElementById('decline').action = '/dashboard/moderate/articles/decline/{{$article->id}}'">Decline</a>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <form id="decline" class="modal fade" method="post" role="dialog" action="">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label for="decline_comment">
                        Decline article comment. This one user can see
                    </label>
                    <input type="text" id="decline_comment" class="form-control" name="decline_comment" placeholder="decline comment">
                    <div class="clearfix"></div>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Send</button>
                        <button class="btn btn-danger" data-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection