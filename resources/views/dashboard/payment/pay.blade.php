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
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h3 class="reset-margin">Your balance now: <strong>{{$user->pocket->value+$user->pocket->frizzed_value}} PGC</strong></h3>
                        <span class="article-head-author" style="margin-bottom: 0; margin-top: 10px; display: inline-block;">1 PGC = 1 $</span>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <img src="http://perfectmoney.is/img/logo3.png" alt=""><br>
                        <small class="" style="margin-bottom: 20px; margin-top: 5px; display: inline-block;">Powered by Perfect Money</small>
                        <form role="form" method="POST" action="https://perfectmoney.is/api/step1.asp">

                            <input type="hidden" name="PAYEE_ACCOUNT" value="{{$config['PAYEE_ACCOUNT']}}">
                            <input type="hidden" name="PAYEE_NAME" value="{{$config['PAYEE_NAME']}}">
                            <input type="hidden" name="PAYMENT_ID" value="{{$config['PAYMENT_ID']}}">
                            <input type="hidden" name="PAYMENT_UNITS" value="{{$config['PAYMENT_UNITS']}}">
                            <input type="hidden" name="STATUS_URL" value="{{$config['STATUS_URL']}}">
                            <input type="hidden" name="PAYMENT_URL" value="{{$config['PAYMENT_URL']}}">
                            <input type="hidden" name="PAYMENT_URL_METHOD" value="{{$config['PAYMENT_URL_METHOD']}}">
                            <input type="hidden" name="NOPAYMENT_URL" value="{{$config['NOPAYMENT_URL']}}">
                            <input type="hidden" name="NOPAYMENT_URL_METHOD" value="{{$config['NOPAYMENT_URL_METHOD']}}">
                            <input type="hidden" name="SUGGESTED_MEMO" value="{{$config['SUGGESTED_MEMO']}}">
                            <input type="hidden" name="HASH" value="{{Auth::user()->get_payment_hash()}}">
                            <input type="hidden" name="POC" value="{{Auth::user()->pocket->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="BAGGAGE_FIELDS" value="HASH POC _token">

                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-addon">Amount in USD</div>
                                    <input id="payment" type="text" class="form-control" name="PAYMENT_AMOUNT" min="{{$config['PAYMENT_AMOUNT']}}" value="{{ old('amount') }}" required autofocus>
                                </div>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group text-center">
                                <input type="submit" name="PAYMENT_METHOD" value="Pay Now!" class="btn btn-primary">
                            </div>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
