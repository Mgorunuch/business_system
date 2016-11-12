<?php

namespace App\Console\Commands;

use App\Http\Controllers\PaymentController;
use App\Pocket;
use App\User;
use Carbon\Carbon;
use Faker\Provider\at_AT\Payment;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MounthPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $now = Carbon::now();
        $reseter = '-'.Config::get('const.payment_period_seconds').' seconds';
        define('NOW',$now);
        define('PAYMENT_BOUNDARY',$now->modify($reseter));

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        print 'Check Payments( '.NOW.' ::: '.PAYMENT_BOUNDARY.' )'."\n";

        $status = DB::table('statuses')
            ->where([
                ['name', '=', 'month_payment'],
                ['status', '=', 1]
            ])->first();

        if( !empty($status) ) {
            print "Status is not Empty \n";
            exit;
        }

        DB::table('statuses')
            ->where('name', 'month_payment')
            ->update(['status' => 1]);


        $users = DB::table('users')
            ->where([
                ['status','=','working']
            ])
            ->leftJoin('pockets','users.pocket_id','pockets.id')
            ->where([
                ['pockets.last_payment','<',PAYMENT_BOUNDARY],
                ['pockets.id','!=',1]
            ])->orWhere([
                ['pockets.last_payment','=',null],
                ['pockets.id','!=',1]
            ])->get();

        if( empty($users) ) {
            print "All users is PAY!";
            exit;
        }

        $month_payment = Config::get('const.month_price');

        foreach ($users as $user) {

            $user = User::find($user->id);

            if($user->pocket->check_balance()) {
                $this->pay($user->id, $month_payment);
            } else {
                print "User {$user->username} frizzed with balance {$user->pocket->value}. \n";
            }
        }

        DB::table('statuses')
            ->where('name', 'month_payment')
            ->update(array('status' => 0));
    }

    private function pay($user_id, $month_payment) {
        if(PaymentController::monthPayment($user_id)) {
            print "User $user_id pay $month_payment successfully\n";
        } else {
            print "Error when pay $user_id => $month_payment \n";
        };
    }
}
