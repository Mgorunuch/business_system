@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container flex-center">
            <div class="text-center">
                <div class="title text-center">
                    Activation page
                </div>
                <span class="article-head-author">To activate account your balance must be more then 10$</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                {{$user->pocket->value+$user->pocket->frizzed_value}}

            </div>
        </div>
    </div>
</div>
@endsection
