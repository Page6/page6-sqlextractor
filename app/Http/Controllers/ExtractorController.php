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
      
      /**
      * 按科室（按临床考核细分）统计：
      * 挂号人次 | 总费用 | 次均费用 | 次均药费 | 次均材料费 | 药占比 | 材料占比
      */
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
      $results_drug = \DB::connection('mysql_page6')->select("SELECT b.name 科室, SUM(a.charge_price) 药费用
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

      $results = $results_visit;
      $size_fee = sizeof($results_fee)-1; 
      $size_drug = sizeof($results_drug)-1; 
      $size_material = sizeof($results_material)-1;
      $key_fee = 0; 
      $key_drug = 0; 
      $key_material = 0;
      foreach ($results as $key => $value) {
        # code...
        while ($key_fee < $size_fee && $value->科室 <> $results_fee[$key_fee]->科室) {
          $key_fee++;
        }
        while ($key_drug < $size_drug && $value->科室 <> $results_drug[$key_drug]->科室) {
          $key_drug++;
        }
        while ($key_material < $size_material && $value->科室 <> $results_material[$key_material]->科室) {
          $key_material++;
        }
        $value->总费用 = round($results_fee[$key_fee]->总费用, 2);
        $value->次均费用 = round($results_fee[$key_fee]->总费用 / $value->挂号人次, 2);
        if ($value->科室 == $results_drug[$key_drug]->科室) {
          // $value->药费用 = $results_drug[$key_drug]->药费用;
          $value->次均药费 = round($results_drug[$key_drug]->药费用 / $value->挂号人次, 2);
          $value->药占比 = round($results_drug[$key_drug]->药费用 / $value->总费用, 2);
        }
        else {
          // $value->药费用 = 0;
          $value->次均药费 = 0;
          $value->药占比 = 0;
        }
        if ($value->科室 == $results_material[$key_material]->科室) {
          // $value->材料费用 = $results_material[$key_material]->材料费用;
          $value->次均材料费 = round($results_material[$key_material]->材料费用 / $value->挂号人次, 2);
          $value->材料占比 = round($results_material[$key_material]->材料费用 / $value->总费用, 2);
        }
        else {
          // $value->材料费用 = 0;
          $value->次均材料费 = 0;
          $value->材料占比 = 0;
        }
      }
      // dd($results);

      //$log = \DB::getQueryLog()[0]['query'];
      $record=array('user'=>Auth::user()->name,'sql'=>'extract-select','extracted_at'=>date('Y-m-d H:i:s',time()));
      $records = \DB::table('records')->insert($record);

    	return view('extractor', ['results'=>$results]);
    }
}
