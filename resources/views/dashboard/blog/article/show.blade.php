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
        </div>
    </div>
@endsection