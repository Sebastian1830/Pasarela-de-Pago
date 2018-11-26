<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

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
        $this->middleware('auth');
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'],$paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('credit_card','paypal');

        $subtotal = 0;
        $currency = 'USD';
        $quantity = 1;
        $idalumno = 2;
        $idapoderado =  auth()->user()->apoderado_id;
        $idpago = 2;
        $pago = \DB::select('call  up_pagotoPaypal(?,?,?)',array($idapoderado,$idalumno,$idpago));
        $item = new Item();
        foreach($pago as $pago){
            $item ->setName($pago->id)
                  ->setCurrency($currency)
                  ->setDescription($pago->detalle)
                  ->setQuantity($quantity)
                  ->setPrice($pago->monto);

            //$subtotal += $quantity*$pagos->monto;
            $subtotal = 1;
        }

        $item_list = new ItemList();
        $item_list -> setItems($item);

        $total = $subtotal;

        $amount = new Amount();
        $amount ->setCurrency($currency)
                ->setTotal($total);

        $transaction = new Transaction();
        $transaction ->setAmount($amount)
                     ->setItemList($item_list)
                     ->setDescription('Pago de prueba, Integracion Empresarial');
        
        
        $redirectUrls = new RedirectUrls(); 
        $redirectUrls->setReturnUrl(\URL::route('payment.status')) 
                     ->setCancelUrl(\URL::route('payment.status'));

        $payment = new Payment();
        $payment ->setIntent('Sale')
                 ->setPayer($payer)
                 ->setRedirectUrls($redirectUrls)
                 ->setTransactions(array($transaction));
        
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Tiempo agotado de connexion');
                return Redirect::to('/');
            } else {
                \Session::put('error','Hubo un problema');
                return Redirect::to('/');
            }
            
        }



        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        \Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {
			return Redirect::away($redirect_url);
		}
		return Redirect::route('cart-show')->with('message', 'Ups! Error desconocido.');
    }

    public function getPaymentStatus()
	{
		// Get the payment ID before session clear
		$payment_id = \Session::get('paypal_payment_id');

		// clear the session payment ID
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::to('/');
        }

		$payment = Payment::get($payment_id, $this->_api_context);
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));
		
		$result = $payment->execute($execution, $this->_api_context);
		
		if ($result->getState() == 'approved') {
			return \Redirect::route('home')
				->with('message', 'Compra realizada de forma correcta');
		}
		return \Redirect::route('home')
			->with('message', 'La compra fue cancelada');
	}
}
