<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Selector extends Controller
{
    //
    public function select(int $id) {

    	$reports = DB::select("
            SELECT *
            FROM reports
            WHERE id = ?",
            [$id]);

    	if ($reports[0]->name <> Auth::user()->name) {
    		$message = 'Sorry, you have no right to select.';
            return view('message', ['message'=>$message]);
    	}
    	
    	return view('Selector', ['report'=>$reports[0]]);
    }
}