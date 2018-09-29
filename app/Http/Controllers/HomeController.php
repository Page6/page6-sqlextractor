<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = Auth::user()->name;
        $reports = DB::select("
            SELECT a.id report_id, a.report_name report_name
            FROM reports a, report_auth b
            WHERE a.id = b.report_id
            AND b.user_name = ?",
            [$name]);
        return view('home', ['reports'=>$reports]);
    }
}
