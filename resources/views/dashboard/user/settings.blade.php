@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container">
            <div class="icon">
                <i class="fa fa-wrench" aria-hidden="true"></i>

            </div>
            <div class="title">
                Settings
            </div>
        </div>
        <div class="container">
            <div class="more_info">
                <span>On this page you can change information in your profile</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="main-settings-content">
            <ul class="nav nav-tabs">
                <li class="nav active"><a href="#tab_general_information" data-toggle="tab">General information</a></li>
                <li class="nav"><a href="#tab_password" data-toggle="tab">Change password</a></li>
                <li class="nav"><a href="#tab_profile_image" data-toggle="tab">Profile image</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade" id="tab_password">
                    <form action="/user/password_change" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="current_password">Current password:</label>
                            <input class="form-control" id="current_password" name="current_password" type="password">
                            @if ($errors->has('current_password'))
                                <span class="help-block text-danger">
                        <strong>{{ $errors->first('current_password') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">New password:</label>
                            <input class="form-control" id="password" name="password" type="password">
                            @if ($errors->has('password'))
                                <span class="help-block text-danger">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Repeat password:</label>
                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block text-danger">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="buttons">
                            <button class="btn btn-primary">Change password</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade in active" id="tab_general_information">
                    <form action="{{action('UserController@changeInfo')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="status_message">Status message:</label>
                                <textarea name="status_message" id="status_message" class="form-control">{{$user->status_message}}</textarea>
                                @if ($errors->has('country'))
                                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country">Country:</label>
                                <select name="country" id="country" class="form-control">
                                    <option value="0">Unknown</option>
                                    @foreach(\Illuminate\Support\Facades\DB::table('countries')->get() as $country)
                                        <option value="{{$country->code}}" @if($country->code == $user->country_code) selected @endif>{{$country->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">City:</label>
                                <input class="form-control" id="city" name="city" type="text" value="{{($user->city == null)?"":$user->city}}">
                                @if ($errors->has('city'))
                                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">Name:</label>
                                <input class="form-control" id="name" name="name" type="text" value="{{($user->full_name == null)?"":$user->full_name}}">
                                @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sex">Sex:</label>
                                <select name="sex" id="sex" class="form-control">
                                    <option value="0">Unknown</option>
                                    <option value="man" @if($user->sex == "man") selected @endif>Man</option>
                                    <option value="woman" @if($user->sex == "woman") selected @endif>Woman</option>
                                </select>
                                @if ($errors->has('sex'))
                                    <span class="help-block text-danger">
                                <strong>{{ $errors->first('sex') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>
                                <input class="form-control" id="email" name="email" type="text" value="{{$user->email}}" disabled>
                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Username:</label>
                                <input class="form-control" id="username" name="username" type="text" value="{{$user->name}}" disabled>
                                @if ($errors->has('username'))
                                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('username') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="buttons">
                            <button class="btn btn-primary">Change Information</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade text-center" id="tab_profile_image">
                    <form action="{{action('UserController@image_change')}}" style="display: inline-block; text-align: center;" class="text-center" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div style="padding: 15px;">
                            <img src="{{$user->profile_image}}" class="img-circle" height="70px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="profile_image">New profile image:</label>
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" />
                            @if ($errors->has('profile_image'))
                                <span class="help-block text-danger">
                        <strong>{{ $errors->first('profile_image') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="buttons">
                            <button class="btn btn-primary">Change image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
