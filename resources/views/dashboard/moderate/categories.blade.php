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
                    <a href="{{action('ArticleController@moderate')}}" class="">Payments</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="category moderate">
                <form action="{{action('CategoriesController@create')}}" method="post" style="width: 100%;">
                    {{ csrf_field() }}
                    <h4 class="reset-margin"><strong>Create new category</strong></h4>
                    <div class="form-group flex" style="margin-top: 10px; margin-bottom: 0;">
                        <input class="form-control" type="text" name="name" placeholder="category name">
                        <button style="margin-left: 10px;" class="btn btn-primary" type="submit">Create</button>
                    </div>
                </form>
            </div>
            @foreach(\App\Category::all() as $category)
                <div class="category moderate">
                    <h3 class="reset-margin"><strong>{{$category->name}}</strong></h3>
                    <div class="buttons">
                        <button class="btn btn-default" data-toggle="modal" data-target="#edit" onclick="document.getElementById('edit').action = '/dashboard/moderate/categories/edit/{{$category->id}}'">Edit</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <form id="edit" method="post" class="modal fade" role="dialog" action="">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <label for="new_cat_name">
                        New category name
                    </label>
                    <input type="text" id="new_cat_name" class="form-control" name="name" placeholder="New name">
                    <div class="clearfix"></div>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Save</button>
                        <button class="btn btn-danger" data-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection