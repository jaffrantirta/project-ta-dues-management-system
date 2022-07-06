<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $title;
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Pengaturan';
    }
    public function penalty_fee()
    {
        $data['title'] = $this->title;
        $data['penalty_fee'] = Setting::where('key', 'penalty_fee')->first()->content;
        return view('penalty_fee.index')->with($data); // tampilkan view index user
    }
    public function picture(Request $request)
    {
        $data['title'] = $this->title;
        (Setting::where('key', 'picture1')->exists()) ? $data['picture1'] = Setting::where('key', 'picture1')->first()->content : $data['picture1'] = null;
        (Setting::where('key', 'picture2')->exists()) ? $data['picture2'] = Setting::where('key', 'picture2')->first()->content : $data['picture2'] = null;
        return view('setting.picture')->with($data); // tampilkan view index
    }
    public function penalty_fee_store(Request $request)
    {
        // data di cek apakah sudah sesuai kriteria
        $validated = $request->validate([
            'penalty_fee' => 'required|numeric', //harus diisi dan harus angka
        ]);

        Setting::updateOrCreate(
            [
                'key'=>'penalty_fee',
            ],
            [
                'content'=>$request->penalty_fee,
            ]
        );
        return redirect()->back()->with('success', 'Biaya berhasil di set.');
    }
    public function index()
    {
        $data['title'] = $this->title;
        (Setting::where('key', 'title1')->exists()) ? $data['title1'] = Setting::where('key', 'title1')->first()->content : $data['title1'] = null;
        (Setting::where('key', 'subtitle1')->exists()) ? $data['subtitle1'] = Setting::where('key', 'subtitle1')->first()->content : $data['subtitle1'] = null;
        (Setting::where('key', 'quotes')->exists()) ? $data['quotes'] = Setting::where('key', 'quotes')->first()->content : $data['quotes'] = null;
        (setting::where('key', 'title2')->exists()) ? $data['title2'] = Setting::where('key', 'title2')->first()->content : $data['title2'] = null;
        (Setting::where('key', 'subtitle2')->exists()) ? $data['subtitle2'] = Setting::where('key', 'subtitle2')->first()->content : $data['subtitle2'] = null;
        return view('setting.index')->with($data);
    }
    public function store(Request $request)
    {
        if(isset($request->is_pict)){
            $validated = $request->validate([
                'picture1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'picture2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $picture1 = 'storage/'.$request->file('picture1')->store('landing', 'public');
            $picture2 = 'storage/'.$request->file('picture2')->store('landing', 'public');

            Setting::updateOrCreate(
                [
                    'key'=>'picture1',
                ],
                [
                    'content'=>$picture1,
                ]
            );
            Setting::updateOrCreate(
                [
                    'key'=>'picture2',
                ],
                [
                    'content'=>$picture2,
                ]
            );
        }else{
            // data di cek apakah sudah sesuai kriteria
            $validated = $request->validate([
                'title1' => 'required', //harus diisi dan harus angka
                'subtitle1' => 'required', //harus diisi dan max 255 karakter
                'title2' => 'required', //harus diisi dan tidak boleh sama dengan user yang lain
                'subtitle2' => 'required', //harus diisi dan tidak boleh sama dengan user yang lain
                'quotes' => 'required', //harus diisi dan tanggal tidak boleh lebih dari hari ini
            ]);

            Setting::updateOrCreate(
                [
                    'key'=>'title1',
                ],
                [
                    'content'=>$request->title1,
                ]
            );
            Setting::updateOrCreate(
                [
                    'key'=>'subtitle1',
                ],
                [
                    'content'=>$request->subtitle1,
                ]
            );
            Setting::updateOrCreate(
                [
                    'key'=>'title2',
                ],
                [
                    'content'=>$request->title2,
                ]
            );
            Setting::updateOrCreate(
                [
                    'key'=>'subtitle2',
                ],
                [
                    'content'=>$request->subtitle2,
                ]
            );
            Setting::updateOrCreate(
                [
                    'key'=>'quotes',
                ],
                [
                    'content'=>$request->quotes,
                ]
            );
        }

        return redirect()->back()->with('success', 'Berhasil.'); //tampilkan view yang sebelumnya
    }
}
