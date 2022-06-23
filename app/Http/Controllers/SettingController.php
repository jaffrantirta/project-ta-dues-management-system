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
        $this->title = 'Biaya denda';
    }
    public function penalty_fee()
    {
        $data['title'] = $this->title;
        $data['penalty_fee'] = Setting::where('key', 'penalty_fee')->first()->content;
        return view('penalty_fee.index')->with($data); // tampilkan view index user
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
}
