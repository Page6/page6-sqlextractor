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
        $records = DB::connection('mysql_page6')->select("
            SELECT a.name 用户, a.extract_type 查询类型, a.extract_at 查询时间, a.paraments 查询参数
            FROM records a
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
            return view('message', ['message'=>$message]);
        }
        return view('record', ['records'=>$records]);
    }
}
