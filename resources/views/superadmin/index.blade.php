@extends('layouts.app')

@section('content')
    @php
        use Illuminate\Support\Facades\Auth;
        use App\User;
        use App\Pocket;
    @endphp
    <div class="container referal-container flex-row-2">
        <div class="col-md-6 referal-column">
            <div class="row">
                <div class="flex-row-2">
                    <div class="referal-block">
                        <div class="modal-header text-center">
                            <strong>Frizz user:</strong>
                        </div>
                        <div class="modal-body text-left">
                            <form action="/superadmin/user/frizz" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="frizz_username">Username:&nbsp;</label>
                                    <input type="text" id="frizz_username" name="username" class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary full-width">Frizz</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="referal-block">
                        <div class="modal-header text-center">
                            <strong>Activate user:</strong>
                        </div>
                        <div class="modal-body text-left">
                            <form action="/superadmin/user/activate" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="money_spend_username">Username:&nbsp;</label>
                                    <input type="text" id="money_spend_username" name="username" class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success full-width">Activate</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="flex-row-2">
                    <div class="referal-block">
                        <div class="modal-header text-center">
                            <strong>Delete banned user:</strong>
                        </div>
                        <div class="modal-body text-left">
                            <div>
                                <div class="form-group">
                                    <label for="delete_username">Username:&nbsp;</label>
                                    <input type="text" id="delete_username" name="username" class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button id="delete_user_btn" type="button" class="btn btn-danger full-width">Delete user</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="referal-block">
                        <div class="modal-header text-center">
                            <strong>Last payment NOW:</strong>
                        </div>
                        <div class="modal-body text-left">
                            <form action="/superadmin/user/set_last_payment" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="money_spend_username">Username:&nbsp;</label>
                                    <input type="text" id="last_payment_username" name="username" class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-default full-width">Set</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="referal-block">
                        <div class="modal-header text-center">
                            <strong>Reset Lucky week:</strong>
                        </div>
                        <div class="modal-body text-left">
                            <form action="/superadmin/user/reset_lucky_week" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="money_spend_username">Username:&nbsp;</label>
                                    <input type="text" id="reset_lucky_username" name="username" class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-default full-width">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="referal-block">
                    <div class="modal-header text-center">
                        <strong>All users:</strong>
                    </div>
                    <div class="modal-body text-center">
                        <h1><strong><span id="ballance_span" class="color-black">{{User::all()->count()}}</span></strong></h1>
                    </div>
                </div>
                <div class="flex-row-2">
                    <div class="referal-block gained-money" id="ballanceContainer">
                        <div class="modal-header text-center"><strong>Activated users</strong></div>
                        <div class="modal-body text-center">
                            <h1><strong><span id="ballance_span" class="text-success">{{User::where('status',1)->count()}}</span></strong></h1>
                        </div>
                    </div>
                    <div class="referal-block gained-money" id="ballanceContainer">
                        <div class="modal-header text-center"><strong>Frizzed users</strong></div>
                        <div class="modal-body text-center">
                            <h1><strong><span id="ballance_span" class="text-primary">{{User::where('status',2)->count()}}</span></strong></h1>
                        </div>
                    </div>
                    <div class="referal-block gained-money" id="ballanceContainer">
                        <div class="modal-header text-center"><strong>Banned users</strong></div>
                        <div class="modal-body text-center">
                            <h1><strong><span id="ballance_span" class="text-danger">{{User::where('status',0)->count()}}</span></strong></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="flex-row-2">
                    <div class="referal-block">
                        <div class="modal-header text-center">
                            <strong>Get user info:</strong>
                        </div>
                        <div class="modal-body text-left">
                            <div>
                                <div class="form-group">
                                    <label for="get_info_username">Username:&nbsp;</label>
                                    <input type="text" id="get_info_username" name="username" class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button id="get_user_info" class="btn btn-default full-width">Get info</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="referal-block">
                        <div class="modal-header text-center">
                            <strong>Ban user:</strong>
                        </div>
                        <div class="modal-body text-left">
                            <form action="/superadmin/user/ban" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="ban_username">Username:&nbsp;</label>
                                    <input type="text" id="ban_username" name="username" class="form-control">
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-danger full-width">Ban</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="referal-block">
                    <div class="modal-header text-center">
                        <strong>Send money for user:</strong>
                    </div>
                    <div class="modal-body text-left">
                        <form action="/superadmin/money/send" method="post" class="form-inline flex-row-2 flex-abs-center">
                            {{ csrf_field() }}
                            <div class="form-group" style="margin-right: 20px;">
                                <label for="money_send_amount">Amount (PGC):&nbsp;</label>
                                <input type="text" id="money_send_amount" name="amount" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="money_send_username">Username:&nbsp;</label>
                                <input type="text" id="money_send_username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="money_send_username" style="color: white;">some&nbsp;</label>
                                <button type="submit" class="btn btn-default">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="referal-block">
                    <div class="modal-header text-center">
                        <strong>Spend user money:</strong>
                    </div>
                    <div class="modal-body text-left">
                        <form action="/superadmin/money/spend" method="post" class="form-inline flex-row-2 flex-abs-center">
                            {{ csrf_field() }}
                            <div class="form-group" style="margin-right: 20px;">
                                <label for="money_spend_amount">Amount (PGC):&nbsp;</label>
                                <input type="text" id="money_spend_amount" name="amount" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="money_spend_username">Username:&nbsp;</label>
                                <input type="text" id="money_spend_username" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="money_spend_username" style="color: white;">some&nbsp;</label>
                                <button type="submit" class="btn btn-default">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <div class="modal fade" id="message_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="background-image: url(/images/logo.png);background-size: 200px;background-repeat: no-repeat;background-position: 200px 60px;background-color: #fff;border: solid 2px #74c5dd;border-radius: 10px;overflow: hidden;">
            <div class="modal-content" style="background: rgba(255,255,255,.8;">
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;top: 4px;right: 10px;color: #282828;opacity: 0.4;">&times;</button>
                <div class="text-center col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
                    <span id="modal-error" class="text-danger"></span>
                    <span id="modal-message"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="user_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="background-image: url(/images/logo.png);background-size: 200px;background-repeat: no-repeat;background-position: 200px 60px;background-color: #fff;border: solid 2px #74c5dd;border-radius: 10px;overflow: hidden;">
            <div class="modal-content" style="background: rgba(255,255,255,.8;">
                <button type="button" class="close" data-dismiss="modal" style="position: absolute;top: 4px;right: 10px;color: #282828;opacity: 0.4;">&times;</button>
                <div class="text-center col-md-12" style="margin-top: 25px;"><h3 class="reset-margin"><strong>User information</strong></h3></div>
                <div class="text-left col-md-12" style="margin-top: 20px;">
                    <table class="table-bordered table-striped full-width info_user_table" style="margin-bottom: 20px;">
                        <tr>
                            <th>Username</th>
                            <th id="popup_username"></th>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th id="popup_email"></th>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th id="popup_status"></th>
                        </tr>
                        <tr>
                            <th>Next payment</th>
                            <th id="popup_next_payment"></th>
                        </tr>
                        <tr>
                            <th>Balance</th>
                            <th id="popup_balance"></th>
                        </tr>
                        <tr>
                            <th>Tree users</th>
                            <th id="popup_tree"></th>
                        </tr>
                        <tr>
                            <th>Refers</th>
                            <th id="popup_refers"></th>
                        </tr>
                        <tr>
                            <th>Refers active</th>
                            <th id="popup_refers_active"></th>
                        </tr>
                        <tr>
                            <th>Refers frizzed</th>
                            <th id="popup_refers_frizzed"></th>
                        </tr>
                        <tr>
                            <th>Refers banned</th>
                            <th id="popup_refers_banned"></th>
                        </tr>
                    </table>
                    <style>
                        .info_user_table tr td, .info_user_table tr th {
                            padding: 15px;
                        }
                    </style>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#get_user_info').click(function(){
                var user = $('#get_info_username')[0].value;
                var data = {
                    username: user
                };
                $.ajax({
                    type: "POST",
                    url: '/superadmin/user/get_info',
                    data: data,
                    dataType: 'json',
                    success: function( msg ) {
                        manageUserInfo( msg );
                    }
                });
            });
            $('#delete_user_btn').click(function(){
                var user = $('#delete_username')[0].value;
                var data = {
                    username: user
                };
                $.ajax({
                    type: "POST",
                    url: '/superadmin/user/delete_banned_user',
                    data: data,
                    dataType: 'json',
                    success: function( msg ) {
                        manageInfoPopup( msg );
                    }
                });
            });
            function manageInfoPopup( msg ) {
                var message = msg.message;
                var error = msg.error;
                if(message != undefined) {
                    $('#modal-message').text(message);
                } else if(error != undefined) {
                    $('#modal-error').text(error);
                }
                $('#message_popup').modal('show');
            }
            function manageUserInfo(msg) {
                var status;
                if(msg.status == 0) status = '<span class="text-danger">Banned</span>';
                else if(msg.status == 1) status = '<span class="text-success">Working</span>';
                else if(msg.status == 2) status = '<span class="text-primary">Frizzed</span>';
                $('#popup_username').text(msg.username);
                $('#popup_email').text(msg.email);
                $('#popup_status').html(status);
                $('#popup_balance').html(msg.balance);
                $('#popup_email').text(msg.email);
                $('#popup_tree').text(msg.tree);
                $('#popup_next_payment').text(msg.next_payment);
                $('#popup_refers').text(msg.refers.all);
                $('#popup_refers_frizzed').text(msg.refers.frizzed);
                $('#popup_refers_banned').text(msg.refers.banned);
                $('#popup_refers_active').text(msg.refers.working);
                $('#user_info').modal('show');
            }
        });
    </script>
@endsection
