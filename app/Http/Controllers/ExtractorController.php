<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Exports\ExtractExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Reports\Reports;

class ExtractorController extends Controller implements FromView
{
    //
    public $results, $paraments;
    /**
     * extract data from database.
     */
    public function view(): View
    {
        // $results = "xxx";
        return view('extract', [
            'results' => $this->results
        ]);
    }

    public function extract(Requests\ExtractorRequest $request) {
      	// \DB::connection('mysql_page6')->enableQueryLog();
      	// $employees = \DB::select('select * from employees');
        //$employees = \DB::connection('mysql_page6')->table('employees')->get();
        
        $reports = DB::select("
            SELECT a.id report_id,a.report_type report_type
            FROM reports a, report_auth b
            WHERE a.id = b.report_id
            AND a.id = ?",
            [$request->input('report_id')]);

        $report_func = new Reports;
        $report_array = call_user_func(array($report_func, 'report'.$reports[0]->report_type), $request);
        $this->results = $report_array['results'];
        $this->paraments = $report_array['paraments'];

        //$log = \DB::getQueryLog()[0]['query'];
        $record=array('name'=>Auth::user()->name,
                  'report_id'=>$reports[0]->report_id,
                  'extract_type'=>$request->input('submit_type'),
                  'extract_at'=>date('Y-m-d H:i:s',time()),
                  'paraments'=>$this->paraments);
        $records = DB::table('records')->insert($record);
        
        if($request->input('submit_type') == 'export') {
            if ($this->results == null) {
                $message = 'Sorry, the result is NULL.';
                return view('message', ['type'=>'warning','message'=>$message]);
            }
            view('extract', [
                'results' => $this->results
            ]); 
            return Excel::download($this, 'export.xlsx');
        }
        else {
            if ($this->results == null) {
                $message = 'Sorry, the result is NULL.';
                return view('message', ['type'=>'warning','message'=>$message]);
            }
            return view('extractor', ['results'=>$this->results]);
        }
    }
}
