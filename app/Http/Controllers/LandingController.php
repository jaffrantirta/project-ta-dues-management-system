<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class LandingController extends Controller
{
    public function index()
    {
        $data['title'] = 'Selamat Datang di '.env('APP_NAME');
        $data['subtitle'] = 'Website resmi '.env('APP_NAME');
        $data['picture'] = 'https://www.w3schools.com/howto/img_avatar.png';
        $data['quotes'] = 'Life, religion, and art all converge in Bali. They have no word in their language for artist or art. Everyone is an artist';
        $data['events'] = Event::whereDate('date_time', '>=', date('Y-m-d'))->limit(4)->orderBy('date_time', 'asc')->get();
        $data['title2'] = 'STT bla bla bla';
        $data['subtitle2'] = 'STT bla bla bla merupakan bla bla bla';
        $data['picture2'] = 'https://www.w3schools.com/howto/img_avatar.png';
        // return $data;
        return view('landing.index', $data);
    }
    public function users()
    {
        $data['users'] = \App\Models\User::where('is_active', true)->role(['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Member'])->get();
        return view('landing.user', $data);
    }
}
