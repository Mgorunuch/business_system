@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container">
            <div class="icon">
                <i class="fa fa-star" aria-hidden="true"></i>

            </div>
            <div class="title">
                Achievements
            </div>
        </div>
        <div class="container">
            <div class="more_info">
                <span>On this page you can see your achievements</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="modal-body col-md-12 ">
            @foreach(\App\Achievement::all() as $achievement)
                @if(($loop->index % 2) == 0 && $loop->index != 0) </div> @endif
                @if(($loop->index % 2) == 0) <div class="flex-row-2 full-width"> @endif
                <div class="col-lg-3 text-center achievement">
                    <div class="modal-header">
                        <strong>{{$achievement->name}}</strong>
                    </div>
                    <div class="achievement-body @if($user->achievements()->find($achievement->id)) gained level-{{$user->achievements()->find($achievement->id)->getAchievementLevel($user->id)}} @endif modal-body">
                        <div class="achievement-images">
                            <div class="image"></div>
                            <div class="image"></div>
                            <div class="image"></div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        {{$achievement->description}}
                    </div>
                </div>
                @if($loop->last) </div> @endif
            @endforeach
        </div>
    </div>
@endsection