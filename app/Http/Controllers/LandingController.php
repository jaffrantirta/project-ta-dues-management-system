<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Setting;

class LandingController extends Controller
{
    public function index()
    {
        (Setting::where('key', 'title1')->exists()) ? $data['title1'] = Setting::where('key', 'title1')->first()->content : $data['title1'] = 'Title 1';
        (Setting::where('key', 'title2')->exists()) ? $data['title2'] = Setting::where('key', 'title2')->first()->content : $data['title2'] = 'Title 2';
        (Setting::where('key', 'subtitle1')->exists()) ? $data['subtitle1'] = Setting::where('key', 'subtitle1')->first()->content : $data['subtitle1'] = 'Subtitle 1';
        (Setting::where('key', 'subtitle2')->exists()) ? $data['subtitle2'] = Setting::where('key', 'subtitle2')->first()->content : $data['subtitle2'] = 'Subtitle 2';
        (Setting::where('key', 'picture1')->exists()) ? $data['picture1'] = Setting::where('key', 'picture1')->first()->content : $data['picture1'] = 'Picture 1';
        (Setting::where('key', 'picture2')->exists()) ? $data['picture2'] = Setting::where('key', 'picture2')->first()->content : $data['picture2'] = 'Picture 2';
        (Setting::where('key', 'quotes')->exists()) ? $data['quotes'] = Setting::where('key', 'quotes')->first()->content : $data['quotes'] = 'Quotes';
        $data['events'] = Event::whereDate('date_time', '>=', date('Y-m-d'))->limit(4)->orderBy('date_time', 'asc')->get();
        // return $data;
        return view('landing.index', $data);
    }
    public function users()
    {
        $data['users'] = \App\Models\User::where('is_active', true)->role(['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Member'])->get();
        return view('landing.user', $data);
    }
}
