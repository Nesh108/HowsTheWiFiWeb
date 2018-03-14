<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WifiSpeeds;

class WifiSpeedsController extends Controller
{
    public function store() {
    	$wifispeeds = new WifiSpeeds();
    	$wifispeeds->latitude = request();
    }
}
