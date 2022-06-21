<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $title;
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Dashboard';
    }
    public function index()
    {
        $events = Event::limit(1)->latest()->get();
        return $events;
    }
}
