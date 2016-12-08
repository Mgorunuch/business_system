@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container">
            <div class="icon">
                <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <div class="title">
                Referral program
            </div>
        </div>
        <div class="container">
            <div class="more_info">
                <span>On this page you can see a lot information about your referals</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container referal-container flex-row-2">
        <div class="col-md-6 referal-column">
            <div class="row">
                @if($left_time_lucky != false)
                    <div class="referal-block">
                        <div class="modal-header text-center">
                            <strong>{{'Step '.$left_time_lucky['step'].'. '}}Additional {{\Illuminate\Support\Facades\Config::get('const.month_price')/100*$left_time_lucky['mult'].' '.config('const.points_short_name').' for every user is allowed:'}}</strong>
                        </div>
                        <div class="modal-body text-center">
                            <div id="timer_lucky" style="width: 100%; font-size: 200%" class="flex-center timer">
                                <div class="days" id="timer_lucky_days">00</div>:
                                <div class="hours" id="timer_lucky_hours">00</div>:
                                <div class="minutes" id="timer_lucky_minutes">00</div>:
                                <div class="seconds" id="timer_lucky_seconds">00</div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="flex-row-2">
                    <div class="referal-block gained-money" id="ballanceContainer">
                        <div class="modal-header text-center"><strong>Your balance now</strong><div class="actions pull-right"><i class="fa fa-refresh" aria-hidden="true" onclick="updateBallance();" style="cursor: pointer;"></i></div></div>
                        <div class="modal-body text-center">
                            <h1><strong><span id="ballance_span">{{$user->pocket->value+$user->pocket->frizzed_value}}</span>&nbsp;{{config('const.points_short_name')}}</strong></h1>
                        </div>
                    </div>
                    <div class="referal-block gained-money" id="GainedAllTimeContainer">
                        <div class="modal-header text-center"><strong>Gained all time</strong><div class="actions pull-right"><i class="fa fa-refresh" aria-hidden="true" onclick="updateGainedBallance();" style="cursor: pointer;"></i></div></div>
                        <div class="modal-body text-center">
                            <h1><strong><span id="gained_all_time_ballance_span">{{$user->pocket->earned_all_time}}</span>&nbsp;{{config('const.points_short_name')}}</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="invited-users referal-block">
                    <ul class="nav nav-tabs">
                        <li class="nav active"><a href="#tab_user_invites" data-toggle="tab">Your referal invited</a></li>
                        @if(false)<li class="nav"><a href="#tab_user_tree" data-toggle="tab">Your tree invites</a></li>@endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active chart" id="tab_user_invites">
                            <div id="myChart" style="width: 100%; height: 300px;"></div>
                        </div>
                        @if(false)<div class="tab-pane fade chart" id="tab_user_tree">
                            <div id="myChart2" style="width: 100%; height: 300px;"></div>
                        </div>@endif
                    </div>
                </div>
                <div class="referal-block withdraw">
                    <ul class="nav nav-tabs">
                        <li class="nav"><a href="#tab_internal_transaction" data-toggle="tab">Internal Transaction</a></li>
                        <li class="nav active"><a href="#tab_withdaw_money" data-toggle="tab">Withdraw Money</a></li>
                        <li class="nav"><a href="#tab_pay_money" data-toggle="tab">Pay money</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab_internal_transaction">
                            <div class="modal-header">
                                <div class="logo-first-slide"><img src="/images/logo.png" alt="" height="100%"><span class="logo-text">{{ config('app.name', 'Laravel') }}</span></div>
                            </div>
                            <div class="modal-body text-center">
                                @if( \App\InternalTransaction::checkAllowed(true) )
                                <form action="{{ url('/payments/internal_transaction') }}" method="POST" role="form" class="text-left">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('to_username') ? ' has-error' : '' }}">
                                        <div class="input-group">
                                            <div class="input-group-addon">Username</div>
                                            <input id="to_username" type="text" class="form-control" name="to_username" value="{{ old('to_username') }}" required autofocus>
                                        </div>
                                        @if ($errors->has('to_username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('to_username') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('internal_amount') ? ' has-error' : '' }}">
                                        <div class="input-group">
                                            <div class="input-group-addon">{{'Amount '.config('const.points_short_name')}}</div>
                                            <input id="internal_amount" type="text" class="form-control" name="internal_amount" value="{{ old('internal_amount') }}" required>
                                        </div>
                                        @if ($errors->has('internal_amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('internal_amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group text-center">
                                        <input type="submit" name="PAYMENT_METHOD" value="Send Money!" class="btn btn-primary">
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                                @else
                                    <span>You must invite 3 users</span>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade in active" id="tab_withdaw_money">
                            <div class="modal-header text-center">
                                <img src="http://perfectmoney.is/img/logo3.png" alt=""><br>
                                <small class="" style="margin-bottom: 20px; margin-top: 5px; display: inline-block;">Powered by Perfect Money</small></div>
                            <div class="modal-body text-center">
                                <form action="{{ url('/payments/withdraw') }}" method="POST" role="form" class="text-left">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('account_to') ? ' has-error' : '' }}">
                                        <label for="account_to" class="control-label">PM account</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">PM USD</div>
                                            <input id="account_to" type="text" class="form-control" name="account_to" value="{{ old('account_to') }}" required autofocus>
                                        </div>
                                        @if ($errors->has('account_to'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('account_to') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('withdraw_amount') ? ' has-error' : '' }}">
                                        <label for="withdraw_amount" class="control-label">Amount</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">{{config('const.points_short_name')}}</div>
                                            <input id="withdraw_amount" type="text" class="form-control" name="withdraw_amount" value="{{ old('withdraw_amount') }}" required autofocus>
                                        </div>
                                        @if ($errors->has('withdraw_amount'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('withdraw_amount') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group text-center">
                                        <input type="submit" name="PAYMENT_METHOD" value="Withdraw!" class="btn btn-primary">
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_pay_money">
                            <div class="modal-header text-center">
                                <img src="http://perfectmoney.is/img/logo3.png" alt=""><br>
                                <small class="" style="margin-bottom: 20px; margin-top: 5px; display: inline-block;">Powered by Perfect Money</small></div>
                            <div class="modal-body text-center">
                                <form role="form" method="POST" action="https://perfectmoney.is/api/step1.asp">

                                    <input type="hidden" name="PAYEE_ACCOUNT" value="{{$config['PAYEE_ACCOUNT']}}">
                                    <input type="hidden" name="PAYEE_NAME" value="{{$config['PAYEE_NAME']}}">
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
                <div class="referal-block withdraw">
                    <div class="modal-header text-center"><strong>Processing applications</strong></div>
                    <div class="modal-body text-center">
                        @if(!isset($withdraw_processing) || empty($withdraw_processing))
                            No applications found
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" style="background-color: #fff">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Created</th>
                                        <th class="text-center">Value</th>
                                        <th class="text-center">PM USD</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($withdraw_processing as $ext)
                                        <tr>
                                            <td class="text-center">{{$ext['created_at']}}</td>
                                            <td class="text-center"><strong>{{$ext['value']}}</strong>{{' '.config('const.points_short_name')}}</td>
                                            <td class="text-center">{{$ext['vallet_to']}}</td>
                                            <td class="text-center">
                                                @if($ext['status'] == 'failed')
                                                    <span class="text-danger">{{$ext['status']}}
                                                        @elseif($ext['status'] == 'success')
                                                            <span class="text-success">{{$ext['status']}}
                                                                @elseif($ext['status'] == 'waiting')
                                                                    <span class="text-primary">{{$ext['status']}}
                                                                        @endif
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="referal-block">
                    <div class="modal-header text-center">
                        <strong>Till next payment:</strong>
                    </div>
                    <div class="modal-body text-center">
                        <div id="payment" style="width: 100%; font-size: 200%" class="flex-center timer">
                            <div class="days" id="payment_days">00</div>:
                            <div class="hours" id="payment_hours">00</div>:
                            <div class="minutes" id="payment_minutes">00</div>:
                            <div class="seconds" id="payment_seconds">00</div>
                        </div>
                    </div>
                </div>
                <div class="referal-block withdraw">
                    <div class="modal-header text-center"><strong>Invited Users</strong></div>
                    <div class="modal-body text-center">
                        <table class="table table-bordered table-hover table-striped" style="background-color: #fff">
                            <tbody>
                            <tr>
                                <td class="text-center">
                                    All<br><span class="text-default">{{$referal_counts['all']}}</span>
                                <td class="text-center">
                                    Working<br><span class="text-success">{{$referal_counts['working']}}</span>
                                <td class="text-center">
                                    Frozen<br><span class="text-primary">{{$referal_counts['frizzed']}}</span>
                                <td class="text-center">
                                    Banned<br><span class="text-danger">{{$referal_counts['banned']}}</span>
                            </tr>
                            </tbody>
                        </table>
                        @if(!isset($referals) || empty($referals))
                            You don`t have reffers
                        @else
                            <div class="table-responsive" id="ReffersTable" style="display: none;">
                                <table class="table table-bordered table-hover table-striped" style="background-color: #fff">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Invites</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody id="referals">
                                    </tbody>
                                </table>
                            </div>
                            <div id="ReffersSpinner" class="loading full-width">
                                <div class="spinner_def">
                                    <div class="double-bounce1"></div>
                                    <div class="double-bounce2"></div>
                                </div>
                            </div>
                            <div class="buttons text-right form-inline">
                                <div class="form-group">
                                    <label for="reffersoffset">
                                        Select offset:
                                    </label>
                                    <select name="refersCounter" id="reffersoffset" onchange="reffersFrom = this.value; getRefersFrom();" class="form-control">
                                        @for($k = 0; ($referal_counts['all']/10) > $k; $k++)
                                            <option value="{{$k*10}}">{{$k*10+1}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="referal-block withdraw">
                    <div class="modal-header text-center"><strong>Users levels count</strong></div>
                    <div class="modal-body text-center">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" style="background-color: #fff">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Fill status</th>
                                    <th class="text-center" width="100">Users count</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($levels as $level)
                                    @if($level['count'] > 0)
                                        <tr>
                                            <td class="text-center">{{$level['id']}}</td>
                                            <td class="text-center" style="position: relative;">
                                                {{round( (100 / pow(3, $level['id']) * $level['count']), 2).'%'}}
                                                <div class="fillstatus" style="position: absolute; background: #a3cbe6; left: 0; width: {{round( (100 / pow(3, $level['id']) * $level['count']), 2).'%'}}; bottom: 0; height: 2px;"></div>
                                            </td>
                                            <td class="text-center">{{$level['count']}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="text-center">{{$level['id']}}</td>
                                            <td class="text-center">{{$level['count'].'%'}}</td>
                                            <td class="text-center">{{$level['count']}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="referal-block ref-link">
                    <div class="modal-header text-center"><strong>Your referal link</strong></div>
                    <div class="modal-body text-center">
                        <div class="form-group flex-center">
                            <input class="form-control" id="copy-ref-link" value="http://piligrim-group.com/register/?ref={{$user->name}}">
                            <button class="btn btn-default" style="margin-left: 15px;" id="copy-ref-btn">Copy link  <i class="fa fa-files-o" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var days = ['Son','Mon','Tue','Wed','Thu','Fri','Sat'],
                date = new Date(),
                daysWeek = [],
                dayNow = date.getUTCDay(),
                i = dayNow,
                start = false;
        while(true) {
            if(i == dayNow && start) break;
            if(i < 0) {
                i = 6;
                start = true;
            }
            daysWeek.push(days[i]);
            i--;
        }
        daysWeek.reverse();
        var data = [{{implode(",",$referal_week)}}];
        data.reverse();

        var data2 = [{{implode(",",$referal_tree_week)}}];
        data2.reverse();

        $(document).ready(function(){
            google.charts.load('current', {packages: ['corechart', 'line']});
            google.charts.setOnLoadCallback(drawCharts);
        });
        function drawCharts() {
            drawChartTree();
            drawChartTree2();
        }
        function drawChartTree() {

            var chartdata = google.visualization.arrayToDataTable([
                ['Day', 'Users Count'],
                [days[0],  data[0]],
                [days[1],  data[1]],
                [days[2],  data[2]],
                [days[3],  data[3]],
                [days[4],  data[4]],
                [days[5],  data[5]],
                [days[6],  data[6]]
            ]);

            console.log(chartdata);

            var options = {
                hAxis: {
                    title: null
                },
                vAxis: {
                    title: null
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('myChart'));

            chart.draw(chartdata, options);
        }
        function drawChartTree2() {

            var chartdata = google.visualization.arrayToDataTable([
                ['Day', 'Users Count'],
                [days[0],  data2[0]],
                [days[1],  data2[1]],
                [days[2],  data2[2]],
                [days[3],  data2[3]],
                [days[4],  data2[4]],
                [days[5],  data2[5]],
                [days[6],  data2[6]]
            ]);

            console.log(chartdata);

            var options = {
                hAxis: {
                    title: null
                },
                vAxis: {
                    title: null
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('myChart2'));

            chart.draw(chartdata, options);
        }
    </script>
    <script type="text/javascript">
        function getCookie(name) {
          var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
          ));
          return matches ? decodeURIComponent(matches[1]) : undefined;
        }
        function deleteCookie(name) {
          setCookie(name, "", {
            expires: -1
          })
        }
        function setCookie(name, value, options) {
          options = options || {};

          var expires = options.expires;

          if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
          }
          if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
          }

          value = encodeURIComponent(value);

          var updatedCookie = name + "=" + value;

          for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
              updatedCookie += "=" + propValue;
            }
          }

          document.cookie = updatedCookie;
        }

        $(document).ready(function() {
            if(getCookie('testpopup') == undefined) {
                $('#test-week-popup').modal('show');
                var date = new Date('8.12.2016');
                setCookie('testpopup','1',date);
            }

            var copyRefBtn = document.getElementById('copy-ref-btn');
            copyRefBtn.addEventListener('click', function(event) {
                var copyLink = document.getElementById('copy-ref-link');
                copyLink.select();

                try {
                    var successful = document.execCommand('copy');
                    var msg = successful ? 'successful' : 'unsuccessful';
                    console.log('Copying text command was ' + msg);
                } catch (err) {
                    console.log('Oops, unable to copy');
                }
            });
        });
    </script>
    <script>
        function CountDownTimer(duration, granularity) {
            this.duration = duration;
            this.granularity = granularity || 1000;
            this.tickFtns = [];
            this.running = false;
        }

        CountDownTimer.prototype.start = function() {
            if (this.running) {
                return;
            }
            this.running = true;
            var start = Date.now(),
                    that = this,
                    diff, obj;

            (function timer() {
                diff = that.duration - (((Date.now() - start) / 1000) | 0);

                if (diff > 0) {
                    setTimeout(timer, that.granularity);
                } else {
                    diff = 0;
                    that.running = false;
                }

                obj = CountDownTimer.parse(diff);
                that.tickFtns.forEach(function(ftn) {
                    ftn.call(this, obj.days, obj.hours, obj.minutes, obj.seconds);
                }, that);
            }());
        };

        CountDownTimer.prototype.onTick = function(ftn) {
            if (typeof ftn === 'function') {
                this.tickFtns.push(ftn);
            }
            return this;
        };

        CountDownTimer.prototype.expired = function() {
            return !this.running;
        };

        CountDownTimer.parse = function(seconds) {
            return {
                'days':     (Math.floor(seconds / (60 * 60 * 24))) | 0,
                'hours':    (Math.floor((seconds % (60 * 60 * 24)) / (60 * 60))) | 0,
                'minutes':  (Math.floor((seconds % (60 * 60)) / 60)) | 0,
                'seconds':  (seconds % 60) | 0
            }
        };

        var timer1 = new CountDownTimer({{$left_time_lucky['left_time']}}, 1000);
        timer1.onTick(function(days, hours, minutes, seconds) {
            if(days < 10) days = '0'+days;
            if(hours < 10) hours = '0'+hours;
            if(minutes < 10) minutes = '0'+minutes;
            if(seconds < 10) seconds = '0'+seconds;

            document.getElementById('timer_lucky_days').innerHTML = days;
            document.getElementById('timer_lucky_hours').innerHTML = hours;
            document.getElementById('timer_lucky_minutes').innerHTML = minutes;
            document.getElementById('timer_lucky_seconds').innerHTML = seconds;
        });
        timer1.start();

        var timer2 = new CountDownTimer({{$payment_left_time}}, 1000);
        timer2.onTick(function(days, hours, minutes, seconds) {
            if(days < 10) days = '0'+days;
            if(hours < 10) hours = '0'+hours;
            if(minutes < 10) minutes = '0'+minutes;
            if(seconds < 10) seconds = '0'+seconds;

            document.getElementById('payment_days').innerHTML = days;
            document.getElementById('payment_hours').innerHTML = hours;
            document.getElementById('payment_minutes').innerHTML = minutes;
            document.getElementById('payment_seconds').innerHTML = seconds;
        });
        timer2.start();
    </script>




    <script>
        var reffersFrom = 0;
        var reffersCounter = 0;

        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            getRefersFrom();
        });
        function updateBallance() {
            $('#ballanceContainer').find('.fa-refresh').addClass('fa-spin');
            $.ajax({
                type: "POST",
                url: '/ajax/getBallance',
                data: {},
                success: function( msg ) {
                    $('#ballance_span').html(msg);
                    $('#ballanceContainer').find('.fa-refresh').removeClass('fa-spin');
                }
            });
        }
        function updateGainedBallance() {
            $('#GainedAllTimeContainer').find('.fa-refresh').addClass('fa-spin');
            $.ajax({
                type: "POST",
                url: '/ajax/gainedAllTime',
                data: {},
                success: function( msg ) {
                    $('#gained_all_time_ballance_span').html(msg);
                    $('#GainedAllTimeContainer').find('.fa-refresh').removeClass('fa-spin');
                }
            });
        }
        function getRefersFrom() {
            $('#ReffersTable').hide(0);
            $('#ReffersSpinner').show(0);
            $.ajax({
                type: "POST",
                url: '/ajax/reffersAjax',
                data: {from:reffersFrom},
                success: function( msg ) {
                    manageRow(msg);
                }
            });
        }
        function manageRow(data) {
            var	rows = '';
            reffersCounter = 0;
            $.each( data, function( key, value ) {
                var local_counter = parseInt(reffersFrom) + parseInt(reffersCounter);
                rows = rows + '<tr>';
                rows = rows + '<td>'+(local_counter+1)+'</td>';
                rows = rows + '<td>'+value.name+'</td>';
                rows = rows + '<td>'+value.reffers_invited+'</td>';
                rows = rows + '<td>'+value.email+'</td>';
                rows = rows + '<td>'+generateReffStatus(value.status)+'</td>';
                rows = rows + '</tr>';
                reffersCounter++;
            });

            $("#referals").html(rows);
            $('#ReffersTable').show(0);
            $('#ReffersSpinner').hide(0);
        }
        function generateReffStatus(status) {
            var ret = '';
            if(status == 0)
                ret += '<span class="text-danger">Banned';
            else if(status == 1)
                ret += '<span class="text-success">Working';
            else if(status == 2)
                ret += '<span class="text-primary">Frozen';
            ret += '</span>';
            return ret;
        }
    </script>
@endsection
