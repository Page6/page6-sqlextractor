<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ExtractorController extends Controller
{
    //
    
    /**
     * extract data from database.
     */
    public function extract() {
    	//\DB::enableQueryLog();
    	//$employees = DB::select('select * from employee');
        $employees = \DB::table('employees')->get();

        //$log = \DB::getQueryLog()[0]['query'];
        $record=array('user'=>Auth::user()->name,'sql'=>'extract-select','extracted_at'=>date('Y-m-d H:i:s',time()));
        $result = \DB::table('records')->insert($record);

    	return view('extractor', ['employees'=>$employees]);
    }
}
