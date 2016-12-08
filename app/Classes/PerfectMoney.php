<?php

namespace App\Classes;


class PerfectMoney
{
    private $PM_MEMBER_ID = '1466233'; // Perfect Money member ID
    private $PM_PASSWORD = 'rfhnjntrf31as01'; // Password you use to login your account
    private $PATH_TO_LOG = '/var/www/html/piligrim-group.com/storage/PM/';
    private $ALTERNATE_PHRASE_HASH = '9W5mwt8F1J3JaIklzxHoFqxaW';
    private $pocket_to = 'U7312930';
    private $status = '';
    private $POST = [];

    public function __construct($post_data) {
        $this->POST = $post_data;
        $this->ALTERNATE_PHRASE_HASH = strtoupper(md5($this->ALTERNATE_PHRASE_HASH));

        $string=
            $this->POST['PAYMENT_ID'].':'.$this->POST['PAYEE_ACCOUNT'].':'.
            $this->POST['PAYMENT_AMOUNT'].':'.$this->POST['PAYMENT_UNITS'].':'.
            $this->POST['PAYMENT_BATCH_NUM'].':'.
            $this->POST['PAYER_ACCOUNT'].':'.$this->ALTERNATE_PHRASE_HASH.':'.
            $this->POST['TIMESTAMPGMT'];

        $hash=strtoupper(md5($string));

        if($hash==$this->POST['V2_HASH']){ // proccessing payment if only hash is valid

            if($this->POST['PAYEE_ACCOUNT'] == $this->pocket_to && $this->POST['PAYMENT_UNITS']=='USD'){

                $apcua = $this->additionlPaymentCheckingUsingAPI();
                if($apcua=='OK'){

                    $f=fopen($this->PATH_TO_LOG."good.log", "ab+");
                    fwrite($f, date("d.m.Y H:i")."; POST: ".serialize($this->POST)."; STRING: $string; HASH: $hash\n");
                    fflush($f);
                    fclose($f);

                    return 'OK';

                }else{	// you can also save invalid payments for debug purposes

                    $f=fopen($this->PATH_TO_LOG."bad.log", "ab+");
                    fwrite($f, date("d.m.Y H:i")."; REASON: additional checking failed with error(s): ".$apcua."; POST: ".serialize($this->POST)."; STRING: $string; HASH: $hash\n");
                    fflush($f);
                    fclose($f);

                    return false;

                }

            }else{ // you can also save invalid payments for debug purposes

                $this->status = "REASON: bad hash; POST: ".serialize($this->POST)."; STRING: $string; HASH: $hash";
                $f=fopen($this->PATH_TO_LOG."bad.log", "ab+");
                fwrite($f, date("d.m.Y H:i")."; REASON: fake data; POST: ".serialize($this->POST)."; STRING: $string; HASH: $hash\n");
                fflush($f);
                fclose($f);

                return false;

            }


        }else{ // you can also save invalid payments for debug purposes

            $this->status = "REASON: bad hash; POST: ".serialize($this->POST)."; STRING: $string; HASH: $hash";
            $f=fopen($this->PATH_TO_LOG."bad.log", "ab+");
            fwrite($f, date("d.m.Y H:i")."; REASON: bad hash; POST: ".serialize($this->POST)."; STRING: $string; HASH: $hash\n");
            fflush($f);
            fclose($f);

            return false;

        }
    }

    public function additionlPaymentCheckingUsingAPI() {

        $f=fopen('https://perfectmoney.is/acct/historycsv.asp?AccountID='.$this->PM_MEMBER_ID.'&PassPhrase='.$this->PM_PASSWORD.'&startmonth='.date("m", $this->POST['TIMESTAMPGMT']).'&startday='.date("d", $this->POST['TIMESTAMPGMT']).'&startyear='.date("Y", $this->POST['TIMESTAMPGMT']).'&endmonth='.date("m", $this->POST['TIMESTAMPGMT']).'&endday='.date("d", $this->POST['TIMESTAMPGMT']).'&endyear='.date("Y", $this->POST['TIMESTAMPGMT']).'&paymentsreceived=1&batchfilter='.$this->POST['PAYMENT_BATCH_NUM'], 'rb');
        if($f===false) return 'error openning url';

        $lines = array();
        while(!feof($f)) array_push($lines, trim(fgets($f)));

        fclose($f);

        if($lines[0]!='Time,Type,Batch,Currency,Amount,Fee,Payer Account,Payee Account,Payment ID,Memo'){
            return $lines[0];
        }else{

            $ar=array();
            $n=count($lines);
            if($n!=2) return 'payment not found';

            $item=explode(",", $lines[1], 10);

            if(count($item)!=10) return 'invalid API output';

            $item_named['Time']=$item[0];
            $item_named['Type']=$item[1];
            $item_named['Batch']=$item[2];
            $item_named['Currency']=$item[3];
            $item_named['Amount']=$item[4];
            $item_named['Fee']=$item[5];
            $item_named['Payee Account']=$item[6];
            $item_named['Payer Account']=$item[7];
            $item_named['Payment ID']=$item[8];
            $item_named['Memo']=$item[9];

            if($item_named['Batch']==$this->POST['PAYMENT_BATCH_NUM'] && $this->POST['PAYMENT_ID']==$item_named['Payment ID'] && $item_named['Type']=='Income' && $this->POST['PAYEE_ACCOUNT']==$item_named['Payee Account'] && $this->POST['PAYMENT_AMOUNT']==$item_named['Amount'] && $this->POST['PAYMENT_UNITS']==$item_named['Currency'] && $this->POST['PAYER_ACCOUNT']==$item_named['Payer Account']){
                return 'OK';
            }else{
                return "Some payment data not match: 
                batch:  {$this->POST['PAYMENT_BATCH_NUM']} vs. {$item_named['Batch']} = ".(($item_named['Batch']==$this->POST['PAYMENT_BATCH_NUM']) ? 'OK' : '!!!NOT MATCH!!!')."
                payment_id:  {$this->POST['PAYMENT_ID']} vs. {$item_named['Payment ID']} = ".(($item_named['Payment ID']==$this->POST['PAYMENT_ID']) ? 'OK' : '!!!NOT MATCH!!!')."
                type:  Income vs. {$item_named['Type']} = ".(('Income'==$item_named['Type']) ? 'OK' : '!!!NOT MATCH!!!')."
                payee_account:  {$this->POST['PAYEE_ACCOUNT']} vs. {$item_named['Payee Account']} = ".(($item_named['Payee Account']==$this->POST['PAYEE_ACCOUNT']) ? 'OK' : '!!!NOT MATCH!!!')."
                amount:  {$this->POST['PAYMENT_AMOUNT']} vs. {$item_named['Amount']} = ".(($item_named['Amount']==$this->POST['PAYMENT_AMOUNT']) ? 'OK' : '!!!NOT MATCH!!!')."
                currency:  {$this->POST['PAYMENT_UNITS']} vs. {$item_named['Currency']} = ".(($item_named['Currency']==$this->POST['PAYMENT_UNITS']) ? 'OK' : '!!!NOT MATCH!!!')."
                payer account:  {$this->POST['PAYER_ACCOUNT']} vs. {$item_named['Payer Account']} = ".(($item_named['Payer Account']==$this->POST['PAYER_ACCOUNT']) ? 'OK' : '!!!NOT MATCH!!!');
            }

        }

    }

}