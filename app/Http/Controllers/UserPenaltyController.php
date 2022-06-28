<?php

namespace App\Http\Controllers;

use App\Models\UserPenalty;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Exports\UserPenaltyExport;
use Maatwebsite\Excel\Facades\Excel;

class UserPenaltyController extends Controller
{
    private $title;
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Denda Acara';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $data['title'] = $this->title;
        $data['total_penalty'] = UserPenalty::where('event_id', $event->id)->sum('fee');
        $data['total_members'] = UserPenalty::where('event_id', $event->id)->count('id');
        $data['total_penalty_not_paid'] = UserPenalty::where('event_id', $event->id)->where('is_paid', false)->sum('fee');
        $data['total_members_not_paid'] = UserPenalty::where('event_id', $event->id)->where('is_paid', false)->count('id');
        $data['penalties'] = UserPenalty::where('event_id', $event->id)->with('user')->with('event')->get();
        // return $data;
        return view('user_penalty.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPenalty  $userPenalty
     * @return \Illuminate\Http\Response
     */
    public function show(UserPenalty $userPenalty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPenalty  $userPenalty
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPenalty $userPenalty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserPenalty  $userPenalty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPenalty $userPenalty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPenalty  $userPenalty
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPenalty $userPenalty)
    {
        //
    }

    public function paid(UserPenalty $userPenalty)
    {
        $userPenalty->update(['is_paid'=>true]);
        return redirect()->back()->with('success', 'Berhasil tandai sebagai bayar');
    }

    public function export()
    {
        return Excel::download(new UserPenaltyExport, 'anggota-denda.xlsx');
    }
}
