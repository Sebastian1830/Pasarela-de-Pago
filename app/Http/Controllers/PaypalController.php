<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        //setup PayPal api context
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'],$paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('credit_card','paypal');

        $items = array();
        $subtotal = 0;
        $currency = 'USD';
        $quantity = 1;
        foreach($pagos as $pagos){
            $item = new Item();
            $item -> setName($pagos->id)
                  -> setCurrency($currency)
                  -> setDescription($pagos->detalle)
                  -> setQuantity($quantity)
                  -> setPrice($pagos->monto);

            $items[] = $item;
            $subtotal += $quantity*$pagos->monto;
        }

        $item_list = new ItemList();
        $item_list -> setItems($items);

        $total = 1;

        $amount = new Amount();
        $amount -> setCurrency($currency)
                -> setTotal($total);

        $transaction = new Transaction();
        $transaction -> setAmount($amount)
                     -> setItemList($item_list)
                     -> setDescription('Pago de prueba, Integracion Empresarial');
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls -> setReturnUrl(\URL::route('payment.status'))
                       -> setCancelUrl(\URL::route('payment.status'));
        
        $payment = new Payment();
        $payment -> setIntent('Sale')
                 -> setRedirectUrls($redirect_urls)
                 -> setTransactions(array($transaction));
        
        try {
            $payment -> create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = \json_decode($ex->getData() , true);
                exit;
            } else {
                die('Hubo un problema no identificado');
            }
            
        }

        foreach ($payment -> getLink() as $link) {
            if($link -> getRel()=='approval_url'){
                $redirect_url -> $link->getHref();
                break;
            }
        }

        \Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {
			return \Redirect::away($redirect_url);
		}
		return \Redirect::route('cart-show')->with('message', 'Ups! Error desconocido.');
    }

    public function getPaymentStatus()
	{
		// Get the payment ID before session clear
		$payment_id = \Session::get('paypal_payment_id');
		// clear the session payment ID
        \Session::forget('paypal_payment_id');
        
		$payerId = \Input::get('PayerID');
		$token = \Input::get('token');
		
		if (empty($payerId) || empty($token)) {
			return \Redirect::url('pagoOnline')
				->with('message', 'Ocurrio un problema al intentar realizar el Pago');
		}
		$payment = Payment::get($payment_id, $this->_api_context);
		
		$execution = new PaymentExecution();
		$execution->setPayerId(\Input::get('PayerID'));
		
		$result = $payment->execute($execution, $this->_api_context);
		
		if ($result->getState() == 'approved') {
			return \Redirect::route('home')
				->with('message', 'Compra realizada de forma correcta');
		}
		return \Redirect::route('home')
			->with('message', 'La compra fue cancelada');
	}
}
