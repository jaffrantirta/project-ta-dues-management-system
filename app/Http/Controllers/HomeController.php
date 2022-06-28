<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\UserPenalty;

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
        $data['active_users'] = User::where('is_active', true)->count();
        $data['unactive_users'] = User::where('is_active', false)->count();
        $data['penalty'] = UserPenalty::where('is_paid', false)->sum('fee');
        $data['gender'][0]['name'] = 'Laki - laki';
        $data['gender'][0]['value'] = User::where('sex', 'male')->count();
        $data['gender'][1]['name'] = 'Perempuan';
        $data['gender'][1]['value'] = User::where('sex', 'female')->count();
        // return $data;
        return view('dashboard.index', $data);
    }
}
