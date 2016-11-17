@extends('layouts.app')

@section('page_info')
    <div class="page_info">
        <div class="container">
            <div class="icon">
                <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <div class="title">
                Referal program
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
                            <strong>Additional {{\Illuminate\Support\Facades\Config::get('const.month_price')/100*$left_time_lucky['mult'].' PG for every user is allowed:'}}</strong>
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
                    <div class="referal-block gained-money">
                        <div class="modal-header text-center"><strong>Your balance now</strong></div>
                        <div class="modal-body text-center">
                            <h1><strong>{{$user->pocket->value+$user->pocket->frizzed_value}} PG</strong></h1>
                        </div>
                    </div>
                    <div class="referal-block gained-money">
                        <div class="modal-header text-center"><strong>Gained all time</strong></div>
                        <div class="modal-body text-center">
                            <h1><strong>{{$user->pocket->earned_all_time}} PG</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="invited-users referal-block">
                    <ul class="nav nav-tabs">
                        <li class="nav active"><a href="#tab_user_invites" data-toggle="tab">Your referal invited</a></li>
                        <li class="nav"><a href="#tab_user_tree" data-toggle="tab">Your tree invites</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade in active chart" id="tab_user_invites">
                            <div>
                                <canvas id="myChart" width="200" height="100"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade chart" id="tab_user_tree">
                            <div>
                                <canvas id="myChart2" width="200" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="referal-block withdraw">
                    <ul class="nav nav-tabs">
                        <li class="nav active"><a href="#tab_withdaw_money" data-toggle="tab">Withdraw Money</a></li>
                        <li class="nav"><a href="#tab_pay_money" data-toggle="tab">Pay money</a></li>
                    </ul>
                    <div class="tab-content">
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
                                            <div class="input-group-addon">Balls</div>
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
                            <div class="modal-body text-left">
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
                                        <th class="text-center">#</th>
                                        <th class="text-center">Value</th>
                                        <th class="text-center">PM USD</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($withdraw_processing as $ext)
                                        <tr>
                                            <td class="text-center">{{$ext['id']}}</td>
                                            <td class="text-center">{{$ext['value']}}</td>
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
                        <strong>To next payment:</strong>
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
                                    Working<br><span class="text-success">{{$referal_counts['working']}}</span>
                                <td class="text-center">
                                    Frizzed<br><span class="text-primary">{{$referal_counts['frizzed']}}</span>
                                <td class="text-center">
                                    Banned<br><span class="text-danger">{{$referal_counts['banned']}}</span>
                            </tr>
                            </tbody>
                        </table>
                        @if(!isset($referals) || empty($referals))
                            Refers
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" style="background-color: #fff">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($referals as $referal)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $referal->name }}</td>
                                            <td class="text-center">{{ $referal->email }}</td>
                                            <td class="text-center">
                                                @if($referal->status == 0)
                                                    <span class="text-danger">Banned
                                                        @elseif($referal->status == 1)
                                                            <span class="text-success">Working
                                                                @elseif($referal->status == 2)
                                                                    <span class="text-primary">Frizzed ({!! html_entity_decode(\App\User::find($referal->id)->getBanTimeDays(true)) !!})
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
                <div class="referal-block withdraw">
                    <div class="modal-header text-center"><strong>Users levels count</strong></div>
                    <div class="modal-body text-center">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" style="background-color: #fff">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Count Users</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($levels as $level)
                                    @if($level['count'] > 0)
                                    <tr>
                                        <td class="text-center">{{$level['id']}}</td>
                                        <td class="text-center">{{round( (100 / pow(3, $level['id']) * $level['count']), 2).'%'}}</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-center">{{$level['id']}}</td>
                                        <td class="text-center">{{$level['count'].'%'}}</td>
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
                            <input class="form-control" id="copy-ref-link" value="http://piligrim.group/register/?ref={{$user->name}}">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
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
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: daysWeek,
                    datasets: [{
                        label: '№ of refers',
                        data: data,
                        tension: 0,
                        backgroundColor: 'rgba(124, 181, 221, .5)',
                        borderColor: 'rgba(0,0,0,.5)',
                        borderWidth: 3,
                        borderCapStyle: 'round',
                        fill: 'bottom',
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(0,0,0,1)',
                        pointRadius: 3
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "Users invited week",
                        fontSize: 15,
                        padding: 15
                    }
                },
                responsive: true,
                maintainAspectRatio: false
            });

            var data2 = [{{implode(",",$referal_tree_week)}}];
            data2.reverse();
            var ctx2 = document.getElementById("myChart2");
            var myChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: daysWeek,
                    datasets: [{
                        label: '№ of refers',
                        data: data2,
                        tension: 0,
                        backgroundColor: 'rgba(124, 181, 221, .5)',
                        borderColor: 'rgba(0,0,0,.5)',
                        borderWidth: 3,
                        borderCapStyle: 'round',
                        fill: 'bottom',
                        pointBorderColor: 'transparent',
                        pointBackgroundColor: 'rgba(0,0,0,1)',
                        pointRadius: 3
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "Refers tree week",
                        fontSize: 15,
                        padding: 15
                    }
                },
                responsive: true,
                maintainAspectRatio: false
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
@endsection