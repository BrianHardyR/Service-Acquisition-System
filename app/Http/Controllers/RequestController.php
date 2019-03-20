<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Feedback;
use App\Message;
use Netshell\Paypal\Facades\Paypal;

class RequestController extends Controller
{
    private $_apiContext;
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));


        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }

    public function index(){
        $requests=auth()->user()->requests->take(10);
        return view('request.index',compact('requests'));
    }

    public function store(Service $service){


        $request = new \App\Request;
        $request->user_id=auth()->user()->id;
        $request->service_id=$service->id;
        $request->status='pending';
        $request->finish_price=0;
        //dd($request);
        $request->save();

        return back();

    }

    public function destroy(\App\Request $request){

        $request->delete();

        return back();
    }

    public function patch(){
        $this->validate(request(),[
            'finish_price'=>'required|integer'
        ]);

        $request= \App\Request::find(request('id'));
        $service=$request->service;
        $request->finish_price=request('finish_price');
        $request->status='complete';
        $request->save();


        $payer = PayPal::Payer();
	    $payer->setPaymentMethod('paypal');


	    $amount = PayPal:: Amount();
	    $amount->setCurrency('USD');
	    $amount->setTotal(request('finish_price'));


	    $transaction = PayPal::Transaction();
	    $transaction->setAmount($amount);
        $transaction->setDescription('Pay for service');


	    $redirectUrls = PayPal:: RedirectUrls();
	    $redirectUrls->setReturnUrl(route('getDone'));
	    $redirectUrls->setCancelUrl(route('getCancel'));


	    $payment = PayPal::Payment();
	    $payment->setIntent('sale');
	    $payment->setPayer($payer);
	    $payment->setRedirectUrls($redirectUrls);
	    $payment->setTransactions(array($transaction));

        // dd($this->_apiContext);
	    $response = $payment->create($this->_apiContext);
	    $redirectUrl = $response->links[1]->href;

        if (request('feedback')!=null){
            $feedback= new Feedback;
            $feedback->user_id=auth()->user()->id;
            $feedback->request_id=$request->id;
            $feedback->service_id=$service->id;
            $feedback->comment=request('feedback');
            $feedback->save();
        }

	    return redirect()->to( $redirectUrl );

        // return back();
    }
    public function getCheckout(Request $request)
	{

	}

    public function a_patch(){
        $request= \App\Request::find(request('id'));
        $request->status='accept';
        $request->save();
        $msg = new Message;
        $msg->user_id=auth()->user()->id;
        $msg->reciever_user_id=$request->user->id;
        $msg->message=auth()->user()->name.' accepted the '.$request->service->name.' request';
        $msg->read='false';
        $msg->save();
        return back();
    }

    public function c_patch(){
        $request= \App\Request::find(request('id'));
        $msg = new Message;
        $msg->user_id=auth()->user()->id;
        $msg->reciever_user_id=$request->user->id;
        $msg->message=auth()->user()->name.' canceled the '.$request->service->name.' request';
        $msg->read='false';
        $msg->save();
        $request->delete();
        return back();
    }



    public function show( $request){
        $request = \App\Request::find($request);
        $service=$request->service;

        $provider=$service->provider();

        return view('request.edit',compact('service','request','provider'));
    }

}
