<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\UserPenalty;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class EventController extends Controller
{
    private $title;
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Acara';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = $this->title;
        $data['events'] = Event::all(); // panggil event yang tanggal nya belum lewat dari hari ini
        return view('event.index')->with($data); // tampilkan view index event
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = $this->title;
        return view('event.create')->with($data); // tampilkan view tambah event
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
            'name' => 'required|max:50', //harus diisi dan max 50 karakter
            'description' => 'required', //harus diisi
            'date_time' => 'required|after:today', //harus diisi dan harus setelah hari ini
        ]);

        Event::create($request->all()); //simpan ke db data yang diiputkan

        return redirect()->back()->with('success', $request->name.' berhasil ditambahkan.'); //tampilkan view yang sebelumnya
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $data['title'] = $this->title;
        $data['event'] = $event; // menyimpan data event di variabel array event
        return view('event.show')->with($data); // tampilkan view event yang dipilih
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // data di cek apakah sudah sesuai kriteria
        $validated = $request->validate([
            'name' => 'required|max:50', //harus diisi dan max 50 karakter
            'description' => 'required', //harus diisi
            'date_time' => 'nullable|after:today', //harus diisi dan harus setelah hari ini
        ]);

        if($request->date_time == null){
            $data['date_time'] = $event->date_time;
        }else{
            $data['date_time'] = $request->date_time;
        }

        $event->update(array_merge($request->only(['name', 'description']), $data)); //simpan perubahan ke db

        return redirect()->back()->with('success', 'perubahan acara '.$request->name.' berhasil.'); //tampilkan view yang sebelumnya
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if( UserEvent::whereBelongsTo($event)->exists() || UserPenalty::whereBelongsTo($event)->exists() ){
            return redirect()->back()->withErrors(['Acara tidak dapat dihapus']);
        }
        $event->delete();
        return redirect()->back()->with('success', 'Acara berhasil dihapus.'); //tampilkan view yang sebelumnya
    }
    public function done(Event $event)
    {
        // return User::leftJoin('user_events', 'user_events.user_id', '=', 'users.id')->whereNull('user_events.user_id')->where('user_events.event_id', $event->id)->role(['Admin', 'Member'])->toSql();
        $fee = Setting::where('key', 'penalty_fee')->first()->content;
        $users = User::role(['Admin', 'Member'])->get();
        DB::beginTransaction();
        try {
            foreach ($users as $key => $user) {
                if(!UserEvent::where('user_id', $user->id)->where('event_id', $event->id)->exists()){
                    UserPenalty::create(['user_id'=>$user->id, 'event_id'=>$event->id, 'fee'=>$fee]);
                }
            }
            $event->update(['is_done'=>true]); //ubah acara menjadi "selesai"
            DB::commit();
            return redirect()->back()->with('success', 'Acara '.$event->name.' ditandai selesai.'); //tampilkan view yang sebelumnya
        } catch (\Throwable $th) {
            DB::rollBack();
            // throw $th;
            return redirect()->back()->withErrors(['Oops! ada yang tidak beres.']);
        }
    }
}
