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
    	$employees = DB::select('select * from employee');

    	return view('extractor', ['employees'=>$employees]);
    }
}
