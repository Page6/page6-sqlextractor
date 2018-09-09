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
    	$employees = \DB::select('select * from employees');
      //$employees = \DB::connection('mysql_page6')->table('employees')->get();
      $results_visit = \DB::connection('mysql_page6')->select("SELECT b.name 科室, COUNT(a.patient_id) 挂号人次
          FROM mz_visit_table a, unit_code b
          WHERE a.visit_date >= '2018-09-02'
            AND a.visit_date < '2018-09-04'
            AND a.visit_flag <> '9'
            AND a.gh_date is not null
            AND a.visit_dept = b.code
          GROUP BY b.name
          ORDER BY b.name");
      $results_fee = \DB::connection('mysql_page6')->select("SELECT b.name 科室, SUM(a.charge_price) 总费用
          FROM mz_detail_charge a, unit_code b
          WHERE a.price_date >= '2018-09-02'
            AND a.price_date < '2018-09-04'
            AND a.charge_status >= 2
            AND a.apply_unit = b.code
          GROUP BY b.name
          ORDER BY b.name");
      $results_drag = \DB::connection('mysql_page6')->select("SELECT b.name 科室, SUM(a.charge_price) 药费用
          FROM mz_detail_charge a, unit_code b
          WHERE a.price_date >= '2018-09-02'
            AND a.price_date < '2018-09-04'
            AND a.charge_status >= 2
            AND a.apply_unit = b.code
            AND a.bill_code in('001','005','006')
          GROUP BY b.name
          ORDER BY b.name");
      $results_material = \DB::connection('mysql_page6')->select("SELECT b.name 科室, SUM(a.charge_price) 材料费用
          FROM mz_detail_charge a, unit_code b
          WHERE a.price_date >= '2018-09-02'
            AND a.price_date < '2018-09-04'
            AND a.charge_status >= 2
            AND a.apply_unit = b.code
            AND a.bill_code = '016'
          GROUP BY b.name
          ORDER BY b.name");

      $key_fee = 0;
      foreach ($results_visit as $key => $value) {
        # code...
        while ($value->科室 <> $results_fee[$key_fee]->科室) {
          $key_fee++;
        }
        $value->总费用 = $results_fee[$key_fee]->总费用;
      }

      $results = $results_visit;
      dd($results);

      //$log = \DB::getQueryLog()[0]['query'];
      $record=array('user'=>Auth::user()->name,'sql'=>'extract-select','extracted_at'=>date('Y-m-d H:i:s',time()));
      $records = \DB::table('records')->insert($record);

    	return view('extractor', ['results'=>$results]);
    }
}
