<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SelectorController extends Controller
{
    //
    public function select(int $id) {

    	$reports = DB::select("
            SELECT b.user_name user_name, a.report_name report_name, a.id report_id, a.report_type report_type
            FROM reports a, report_auth b
            WHERE a.id = b.report_id
            AND a.id = ?",
            [$id]);

    	if ($reports[0]->user_name <> Auth::user()->name) {
    		$message = 'Sorry, you have no right to select.';
            return view('message', ['type'=>'danger','message'=>$message]);
    	}
    	
    	return view('selector', ['report'=>$reports[0]]);
    }
}