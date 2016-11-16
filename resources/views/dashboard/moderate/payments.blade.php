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
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="background-color: #fff">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Now on Balance</th>
                            <th class="text-center">To Valet</th>
                            <th class="text-center">From</th>
                            <th class="text-center">Value</th>
                            <th class="text-center">Buttons</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($external as $ext)
                            <tr>
                                <td class="text-center">{{$ext['id']}}</td>
                                <td class="text-center">{{$pockets[$loop->index]->user->name}}</td>
                                <td class="text-center">{{$pockets[$loop->index]->value + $pockets[$loop->index]->frizzed_value}}</td>
                                <td class="text-center">{{$ext->vallet_to}}</td>
                                <td class="text-center">
                                    <select name="fr_id" class="form-control" onchange="document.getElementById('from_id_{{$ext['id']}}').value = this.value" id="">
                                        <option value="1">1</option>
                                    </select>
                                </td>
                                <td class="text-center">{{$ext['value']}}</td>
                                <td class="text-center">
                                    <form action="{{url('/dashboard/moderate/payments/change_status')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{$ext['id']}}">
                                        <input type="hidden" name="value" value="{{$ext['value']}}">
                                        <input type="hidden" name="from_id" id="from_id_{{$ext['id']}}" value="1">
                                        <select name="status" class="form-control">
                                            <option value="accept">Accept</option>
                                            <option value="decline">Decline</option>
                                        </select>
                                        <button class="btn btn-success" style="margin-top: 5px;" type="submit">Process</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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