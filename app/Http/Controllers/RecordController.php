<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    //
    
    /**
     * record sql query
     */
    public function record() {
    	dd(DB::getQueryLog());
    }
}
