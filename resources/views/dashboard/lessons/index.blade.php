@extends('layouts.app')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html" style="padding-top: 20px;">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <img src="/images/vk.png" alt="">
                        <!-- <div id="vk_groups"></div> -->
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row posts-container text-center panel" style=" margin-top: 5px; padding: 20px;">
                    <img src="http://ocramius.github.io/presentations/doctrine-orm-and-zend-framework-2/assets/img/waiting-meme.png" alt="" width="40%" style="margin: 0 auto; margin-bottom: 20px;">
                    <h1 class="text-center reset-margin"><strong style="color: #000;">NOW ON DEVELOPMENT</strong></h1>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        VK.Widgets.Group("vk_groups", {mode: 4, wide: 1, width: "100%", height: "400", color3: '7CB5DD'}, 20003922);
    </script>
@endsection

@section('page_info')
    <div class="page_info">
        <div class="container">
            <div class="icon">
                <i class="fa fa-pencil-square" aria-hidden="true"></i>
            </div>
            <div class="title">
                Lessons
            </div>
        </div>
        <div class="container">
            <div class="more_info">
                <span>Your own lessons</span>
            </div>
        </div>
    </div>
@endsection