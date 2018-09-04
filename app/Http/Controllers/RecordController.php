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
    	$records = DB::select('select * from records');

    	return view('record', ['records'=>$records]);
    }
}
