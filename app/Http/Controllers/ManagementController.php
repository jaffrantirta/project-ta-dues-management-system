<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    private $title;
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Pengurus';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['users'] = User::role(['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'])->where('is_active', true)->latest()->get(); // panggil user yang role ketua, wakil, sekre dan bendahara dan status nya aktif
        return view('management.index')->with($data); // tampilkan view index user
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = $this->title;
        $data['users'] = User::role('Member')->where('is_active', true)->latest()->get();
        return view('management.create')->with($data); // tampilkan view tambah user
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
            'user_id' => 'required', //harus diisi 
            'role' => 'required', //harus diisi
        ]);

        $limit = '';
        switch ($request->role) {
            case 'Ketua':
                $limit = env('KETUA');
                break;
            case 'Wakil Ketua':
                $limit = env('WAKIL_KETUA');
                break;
            case 'Sekretaris':
                $limit = env('SEKRETARIS');
                break;
            case 'Bendahara':
                $limit = env('BENDAHARA');
                break;
        }
        $u = User::role($request->role)->get()->count();

        if($u < $limit){
            $user = User::find($request->user_id);
            $user->removeRole('Member');
            $user->assignRole($request->role);
            return redirect()->back()->with('success', 'Berhasil menjadi pengurus');
        }
        return redirect()->back()->withErrors(['Jabatan sudah diisi']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $management)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $management)
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
    public function update(Request $request, User $management)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $management)
    {
        $management->removeRole($management->roles[0]->name);
        $management->assignRole('Member');
        return redirect()->back()->with('success', 'Berhasil di hapus dari pengurus');
    }
}
