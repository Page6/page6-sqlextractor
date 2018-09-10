<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class RecordController extends Controller
{
    //
    
    /**
     * record sql query
     */
    public function record() {
    	$records = DB::select('select * from records');
    	$perPage = 5;
    	$total = sizeof($records);
    	$pages = new LengthAwarePaginator($records, $total, $perPage);
    	$pages->withpath('record');
    	// dd($pages->currentPage());

    	return view('record', ['pages'=>$pages]);
    }
}
