<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    //
    public function session() {
        
    }
    public function succes() {
        return back();
    }
}
