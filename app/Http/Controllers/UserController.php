<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    private $title;
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Anggota Aktif';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['users'] = User::role('Member')->where('is_active', true)->latest()->get(); // panggil user yang role member (anggota) dan status nya aktif
        return view('user.index')->with($data); // tampilkan view index user
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = $this->title;
        return view('user.create')->with($data); // tampilkan view tambah user
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // data di cek apakah sudah sesuai kriteria
        $validated = $request->validate([
            'id_number' => 'required|numeric', //harus diisi dan harus angka
            'name' => 'required|max:255', //harus diisi dan max 255 karakter
            'email' => 'required|unique:users', //harus diisi dan tidak boleh sama dengan user yang lain
            'phone' => 'required|unique:users', //harus diisi dan tidak boleh sama dengan user yang lain
            'date_of_birth' => 'required|before:today', //harus diisi dan tanggal tidak boleh lebih dari hari ini
        ]);

        $user = User::create(array_merge($request->all(), ['password'=>Hash::make('1234567890')])); //simpan ke db data yang diiputkan
        $user->assignRole('Member');

        return redirect()->back()->with('success', $request->name.' berhasil ditambahkan.'); //tampilkan view yang sebelumnya
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
