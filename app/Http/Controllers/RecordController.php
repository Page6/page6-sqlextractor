<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    //
    
    /**
     * record sql query
     */
    public function record() {
    	//dd(DB::getQueryLog());
    	dd(Auth::user()->name);
    }
}
