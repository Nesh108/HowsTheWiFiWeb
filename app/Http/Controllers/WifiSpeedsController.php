<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WifiSpeeds;

class WifiSpeedsController extends Controller
{
    public function index(Request $request) {
    	$validator = \Validator::make($request->all(), [
    		'min_latitude' => 'required|numeric|min:-90|max:90',
    		'max_latitude' => 'required|numeric|min:-90|max:90',
    		'min_longitude' => 'required|numeric|min:-180|max:180',
    		'max_longitude' => 'required|numeric|min:-180|max:180',
    	]);

    	if($validator->fails()) {
    		return response()->json(["message" => "NOKIEDOKIE-GET"]);
    	}

    	return WifiSpeeds::where('latitude', ">=", $request->min_latitude)
    	->where('latitude', "<=", $request->max_latitude)
    	->where('longitude', ">=", $request->min_longitude)
    	->where('longitude', "<=", $request->max_longitude)
    	->get();
    }

    public function store(Request $request) {
    	$validator = \Validator::make($request->all(), [
    		'latitude' => 'required|numeric|min:-90|max:90',
    		'longitude' => 'required|numeric|min:-180|max:180',
			'accuracy' => 'required|numeric|min:0',
			'download' => 'required|numeric|min:0',
			'upload' => 'required|numeric|min:0',
			'ping' => 'required|numeric|min:0',
			'packet_loss' => 'required|numeric|min:0|max:100',
			'name' => 'required|string',
			'comments' => 'required|string',
    	]);

    	if($validator->fails()) {
    		return response()->json(["message" => "NOKIEDOKIE-POST"]);
    	}

    	$wifiSpeed = new WifiSpeeds();
		$wifiSpeed->latitude = $request->latitude;
		$wifiSpeed->longitude = $request->longitude;
		$wifiSpeed->accuracy = $request->accuracy;
		$wifiSpeed->download = $request->download;
		$wifiSpeed->upload = $request->upload;
		$wifiSpeed->ping = $request->ping;
		$wifiSpeed->packet_loss = $request->packet_loss;
		$wifiSpeed->name = $request->name;
		$wifiSpeed->comments = $request->comments;
		$wifiSpeed->save();

    	return response()->json(["wifispeed" => $wifiSpeed]);
    }
}
