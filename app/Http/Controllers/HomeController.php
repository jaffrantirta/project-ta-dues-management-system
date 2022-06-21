<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['events'] = Event::whereDate('date_time', '>=', date('Y-m-d'))->limit(2)->orderBy('date_time', 'asc')->get();
        return view('dashboard.index', $data);
    }
}
