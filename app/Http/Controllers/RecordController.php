<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class RecordController extends Controller
{
    //
    
    /**
     * record sql query
     */
    public function record(Requests\RecordRequest $request) {
    	// $records = DB::select('select * from records');
        $records = DB::select("
            SELECT name, report_id, extract_type, extract_at, paraments
            FROM records
            WHERE extract_at >= ?
            AND extract_at < ?", 
            [$request['start_record'], $request['end_record']]);
    	// $perPage = 5;
    	// $total = sizeof($records);
    	// $pages = new LengthAwarePaginator($records, $total, $perPage);
    	// $pages->withpath('record');
    	// dd($pages->currentPage());

    	// return view('record', ['pages'=>$pages]);
        if ($records == null) {
            $message = 'Sorry, the record is NULL.';
            return view('message', ['type'=>'warning','message'=>$message]);
        }
        return view('record', ['records'=>$records]);
    }
}
