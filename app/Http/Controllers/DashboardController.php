<?php

namespace App\Http\Controllers;

/**
 * Class DashboardController
 *
 * An admin class to show dashboard
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("dashboard.index");
    }

}
