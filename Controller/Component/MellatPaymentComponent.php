<!doctype html>
<html>
<head>
    <script>
        function postRefId(refIdValue) {
            var form = document.createElement("form");
            form.setAttribute("method", "POST");
            form.setAttribute("action", "https://pgw.bpm.bankmellat.ir/pgwchannel/startpay.mellat");
            form.setAttribute("target", "_self");
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("name", "RefId");
            hiddenField.setAttribute("value", refIdValue);
            form.appendChild(hiddenField);

            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    </script>
</head>
<body>

<?php
App::import('Vendor', 'nusoap');
App::uses('Component', 'Controller');
Class MellatPaymentComponent extends Component
{

public function CheckStatus($ecode)
	{
		               $tmess="شرح خطا:";
		               switch ($ecode) 
					     {
						  case 0:
					        $tmess="تراکنش با موفقیت انجام شد";
						    break;
						  case 11:
					        $tmess="شماره کارت معتبر نیست";
						    break;
						  case 12:
					        $tmess= "موجودی کافی نیست";
						    break;
						  case 13:
					        $tmess= "رمز دوم شما صحیح نیست";
						    break;
						  case 14:
					        $tmess= "دفعات مجاز ورود رمز بیش از حد است";
						    break;
						  case 15:
					        $tmess= "کارت معتبر نیست";
						    break;
						  case 16:
					        $tmess= "دفعات برداشت وجه بیش از حد مجاز است";
						    break;
						  case 17:
					        $tmess= "کاربر از انجام تراکنش منصرف شده است";
						    break;
						  case 18:
					        $tmess= "تاریخ انقضای کارت گذشته است";
						    break;
						  case 19:
					        $tmess= "مبلغ برداشت وجه بیش از حد مجاز است";
						    break;
						  case 111:
					        $tmess= "صادر کننده کارت نامعتبر است";
						    break;
						  case 112:
					        $tmess= "خطای سوییچ صادر کننده کارت";
						    break;
						  case 113:
					        $tmess= "پاسخی از صادر کننده کارت دریافت نشد";
						    break;
						  case 114:
					        $tmess= "دارنده کارت مجاز به انجام این تراکنش نمی باشد";
						    break;
						  case 21:
					        $tmess= "پذیرنده معتبر نیست";
						    break;
						  case 23:
					        $tmess= "خطای امنیتی رخ داده است";
						    break;
						  case 24:
					        $tmess= "اطلاعات کاربری پذیرنده معتبر نیست";
						    break;
						  case 25:
					        $tmess= "مبلغ نامعتبر است";
						    break;
						  case 31:
					        $tmess= "پاسخ نامعتبر است";
						    break;
						  case 32:
					        $tmess= "فرمت اطلاعات وارد شده صحیح نیست";
						    break;
						  case 33:
					        $tmess="حساب نامعتبر است";
						    break;
						  case 34:
					        $tmess= "خطای سیستمی";
						    break;
						  case 35:
					        $tmess= "تاریخ نامعتبر است";
						    break;
						  case 41:
					        $tmess= "شماره درخواست تکراری است";
						    break;
						  case 42:
					        $tmess= "تراکنش Sale یافت نشد";
						    break;
						  case 43:
					        $tmess= "قبلا درخواست Verify داده شده است";
						    break;
						  case 44:
					        $tmess= "درخواست Verify یافت نشد";
						    break;
						  case 45:
					        $tmess= "تراکنش Settle شده است";
						    break;
						  case 46:
					        $tmess= "تراکنش Settle نشده است";
						    break;
						  case 47:
					        $tmess= "تراکنش Settle یافت نشد";
						    break;
						  case 48:
					        $tmess= "تراکنش Reverse شده است";
						    break;
						  case 49:
					        $tmess= "تراکنش Refund یافت نشد";
						    break;
						  case 412:
					        $tmess= "شناسه قبض نادرست است";
						    break;
						  case 413:
					        $tmess= "شناسه پرداخت نادرست است";
						    break;
						  case 414:
					        $tmess= "سازمان صادر کننده قبض معتبر نیست";
						    break;
						  case 415:
					        $tmess= "زمان جلسه کاری به پایان رسیده است";
						    break;
						  case 416:
					        $tmess= "خطا در ثبت اطلاعات";
						    break;
						  case 417:
					        $tmess= "شناسه پرداخت کننده نامعتبر است";
						    break;
						  case 418:
					        $tmess= "اشکال در تعریف اطلاعات مشتری";
						    break;
						  case 419:
					        $tmess= "تعداد دفعات ورود اطلاعات بیش از حد مجاز است";
						    break;
						  case 421:
					        $tmess= "IP معتبر نیست";
						    break;
						  case 51:
					        $tmess= "تراکنش تکراری است";
						    break;
						  case 54:
					        $tmess= "تراکنش مرجع موجود نیست";
						    break;
						  case 55:
					        $tmess= "تراکنش نامعتبر است";
						    break;
						  case 61:
					        $tmess= "خطا در واریز";
						    break;
						 }	
    return $ecode.':'.$tmess;
	}

    function startup(Controller $controller)
    {
        $this->controller = $controller;
    }

    private function getResRef($amount = 0, $url)
    {
        $orderID    = rand();
        $date       = date("Ymd");
        $time       = date("His");
        $parameters = array(
            'terminalId'     => Configure::read('Settings.pay.terminalId'),
            'userName'       => Configure::read('Settings.pay.userName'),
            'userPassword'   => Configure::read('Settings.pay.password'),
            'orderId'        => $orderID,
            'amount'         => $amount,
            'localDate'      => $date,
            'localTime'      => $time,
            'additionalData' => '',
            'callBackUrl'    => $url,
            'payerId'        => "0"
        );
        $client     = new nusoap_client('https://pgwsf.bpm.bankmellat.ir:443/pgwchannel/services/pgw?wsdl');
        $namespace  = 'http://interfaces.core.sw.bps.com/';

        return $client->call('bpPayRequest', $parameters, $namespace);
    }

    public function paymentRequest($amount = 0, $url)
    {
        $ResRef = $this->getResRef($amount, $url);
        $ResRef = explode(',', $ResRef);

        $ResCode = $ResRef[0];
        settype($ResCode, "string");
        if (!empty($ResRef[1])) {
            $RefId = $ResRef[1];
            settype($RefId, "string");
        }

        if (isset($RefId))
            echo "<script>postRefId('" . $RefId . "');</script>";
        else
            echo "<script>alert('امکان اتصال وجود ندارد ، لطفاً دوباره تلاش کنید.');</script>";
    }
}

?>
</body>
</html>
