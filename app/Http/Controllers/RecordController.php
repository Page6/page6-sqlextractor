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
            SELECT a.user 用户, a.type 查询类型, a.extracted_at 查询时间, a.start_at 开始日期, a.end_at 结束日期
            FROM records a
            WHERE extracted_at >= ?
            AND extracted_at < ?", 
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
