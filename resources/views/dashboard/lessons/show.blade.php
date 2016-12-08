@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container flex-center">
            <div class="text-center">
                <div class="title text-center">
                    {{$lesson->title}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1 article full-post" style="background-color: #fff;">
        <div class="row">
            @if($lesson->preview != null)
                <div class="article-image" style="background-image: url('{{$lesson->preview}}');">
                </div>
            @endif
            <div class="modal-body">
                {!! html_entity_decode($lesson->main_text) !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection