<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use App\Exports\UsersActiveExport;
use App\Exports\UsersUnactiveExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

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
            'id_number' => 'required|numeric|unique:users', //harus diisi dan harus angka
            'name' => 'required|max:255', //harus diisi dan max 255 karakter
            'email' => 'required|unique:users', //harus diisi dan tidak boleh sama dengan user yang lain
            'phone' => 'required|unique:users|max:13', //harus diisi dan tidak boleh sama dengan user yang lain
            'date_of_birth' => 'required|before:today', //harus diisi dan tanggal tidak boleh lebih dari hari ini
            'sex' => 'required', //harus diisi
            'join_year' => 'numeric|nullable',
        ]);

        //ambil data tahun sekarang dan tahun lahir calon anggota
        $this_year = date('Y');
        $year_of_birth = Carbon::create($request->date_of_birth)->isoFormat('Y');
        $age = $this_year - $year_of_birth;

        //cek apakan calon anggota cukup umur. jika umur tidak cukup akan ditolak
        if($age < env('MIN_AGE') || $age > env('MAX_AGE')) {
            return redirect()->back()->withErrors(['Maaf, Anda tidak dapat mendaftar sebagai anggota karena usia anda belum '.env('MIN_AGE').' tahun atau sudah lebih dari '.env('MAX_AGE').' tahun']);
        }

        //cek apakah admin memasukan tahun masuk anggota. jika tidak maka tahun masuk anggota akan diisi dengan tahun sekarang
        if($request->join_year == null) {
            $join_year = $this_year;
            $store = array_merge($validated, ['join_year' => $join_year]); //merge array $validated dengan array baru dengan key join_year yang isinya $this_year
        }else{
            $store = $validated;   
        }

        $data = array_merge($store, ['password'=>Hash::make('1234567890')]);

        $user = User::create($data); //simpan ke db data yang diiputkan
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
        $data['title'] = $this->title;
        $data['user'] = $user; // menyimpan data user di variabel array user
        return view('user.show')->with($data); // tampilkan view user yang dipilih
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
         // data di cek apakah sudah sesuai kriteria
         $validated = $request->validate([
            'name' => 'required|max:255', //harus diisi dan max 255 karakter
            'email' => 'required|unique:users,email,'.$user->id, //harus diisi dan tidak boleh sama dengan user yang lain
            'phone' => 'required|unique:users,phone,'.$user->id.'|max:13', //harus diisi dan tidak boleh sama dengan user yang lain
            'date_of_birth' => 'nullable|before:today', //harus diisi dan tanggal tidak boleh lebih dari hari ini
            'sex' => 'required', //harus diisi
        ]);

        if($request->date_of_birth == null){
            $data['date_of_birth'] = $user->date_of_birth;
        }else{
            $data['date_of_birth'] = $request->date_of_birth;
        }

        $user->update(array_merge($request->only(['name', 'email', 'phone', 'sex']), $data)); //simpan perubahan ke db

        return redirect()->back()->with('success', 'perubahan data '.$request->name.' berhasil.'); //tampilkan view yang sebelumnya
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        $user->update(['is_active' => false, 'note' => $request->note]); //user dipilih diubah jadi tidak aktif
        return redirect()->back()->with('success', $user->name.' berhasil di non-aktifkan.'); //tampilkan view yang sebelumnya
    }

    public function export_active()
    {
        return Excel::download(new UsersActiveExport, 'anggota-aktif.xlsx');
    }

    public function export_unactive()
    {
        return Excel::download(new UsersUnactiveExport, 'anggota-tidak-aktif.xlsx');
    }
}
