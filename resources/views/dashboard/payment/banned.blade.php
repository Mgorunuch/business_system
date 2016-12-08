@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container flex-center">
            <div class="text-center">
                <div class="title text-center">
                    Activation page
                </div>
                <span class="article-head-author">To activate account your balance must be 10{{' '.config('const.points_short_name')}}</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h1 class="reset-margin">Your <strong class="text-danger">banned</strong></h1>
                        <span class="article-head-author" style="margin-bottom: 0; margin-top: 10px; display: inline-block;">You can do nothing. If you need deban contact Support.</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default" style="padding: 20px 0;">
                    <form action="" class="form">
                        <div class="form-group  col-md-6">
                            <label for="contact-email">Email</label>
                            <input type="text" name="email" id="contact-email" class="form-control" value="{{Auth::user()->email}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contact-name">Your name</label>
                            <input type="text" name="name" id="contact-name" class="form-control" @if(!is_null(Auth::user()->full_name)) value="{{Auth::user()->full_name}}" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="contact-message">Message</label>
                            <textarea name="message" class="form-control" id="contact-message" cols="30" rows="5"></textarea>
                        </div>
                        <div class="buttons col-md-12 text-left">
                            <button class="btn btn-default">Send</button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function changePaymentType(to) {
            document.getElementById('pm').style.display = 'none';
            document.getElementById('piligrim').style.display = 'none';
            document.getElementById(to).style.display = 'block';
        }
    </script>
@endsection
