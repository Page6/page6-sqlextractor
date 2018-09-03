<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ExtractorController extends Controller
{
    //
    
    /**
     * extract data from database.
     */
    public function extract() {
    	//DB::connection()->enableQueryLog();
    	$employees = DB::select('select * from employee');
    	//DB::listen(function($query) { Log::info($query); });
    	//dd(DB::getQueryLog());

    	return view('extractor', ['employees'=>$employees]);
    }
}
