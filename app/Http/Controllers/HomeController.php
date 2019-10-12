<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use LEClient\LEClient;

use LEClient\LEFunctions;

use LEClient\LEOrder;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test(){


dd('fsadasf');
//
//// Listing the contact information in case a new account has to be created.
//        $email = array('info@example.org');
//// Defining the base name for this order
//        $basename = 'example.org';
//// Listing the domains to be included on the certificate
//        $domains = array('example.org', 'test.example.org');
//// Initiating the client instance. In this case using the staging server (argument 2) and outputting all status and debug information (argument 3).
//        $client = new LEClient($email, true, LECLient::LOG_STATUS);
//// Initiating the order instance. The keys and certificate will be stored in /example.org/ (argument 1) and the domains in the array (argument 2) will be on the certificate.
//        $order = $client->getOrCreateOrder($basename, $domains);
//
//
//        dd('asd');
////        dd($client->certificateKeys);
//        $acct = $client->getAccount();  // Retrieves the LetsEncrypt Account instance created by the client.
//
//        dd($acct);
//        LEFunctions::checkHTTPChallenge($domain, $token, $keyAuthorization);        // Checks whether the HTTP challenge is valid. Performing authorizations is described further on.

//        $pending = (new LEOrder('massoudir.najafi@gmail.com',true,''))->getPendingAuthorizations(LEOrder::CHALLENGE_TYPE_HTTP);

    }


    public function authenticate()
    {



    }
}
