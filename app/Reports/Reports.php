<?php

namespace App\Reports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class Reports
{
	public function report1(Requests\ExtractorRequest $request) {
		/**
		 *  report type : 1
		 *  num of input : 1
		 *  paraments : text
		 */
		$reports = DB::select("
			SELECT report_sql report_sql
			FROM reports
			WHERE id = ?
			", [$request->input('report_id')]);

		$input = $request->input('input_text');
		$inputs = [$input];
		$paraments = $input.';';
		$results = DB::select(str_replace('"', '\'', $reports[0]->report_sql), $inputs);

		return array('results' => $results, 'paraments' => $paraments);
	}

	public function report2(Requests\ExtractorRequest $request) {
		/**
		 *  report type : 2
		 *  num of input : 1
		 *  paraments : sex
		 */
		$reports = DB::select("
			SELECT report_sql report_sql
			FROM reports
			WHERE id = ?
			", [$request->input('report_id')]);

		$input = $request->input('sex');
		$inputs = [$input];
		$paraments = $input.';';
		$results = DB::select(str_replace('"', '\'', $reports[0]->report_sql), $inputs);

		return array('results' => $results, 'paraments' => $paraments);
	}

	public function report3(Requests\ExtractorRequest $request) {
		/**
		 *  report type : 3
		 *  num of input : 2
		 *  paraments : start_date, end_date
		 */
		$reports = DB::select("
			SELECT report_sql report_sql
			FROM reports
			WHERE id = ?
			", [$request->input('report_id')]);

		$start = $request->input('start_date');
		$end = $request->input('end_date');
		$inputs = [$start,$end];
		$paraments = $start.';'.$end.';';
		$results = DB::select(str_replace('"', '\'', $reports[0]->report_sql), $inputs);

		return array('results' => $results, 'paraments' => $paraments);
	}
}