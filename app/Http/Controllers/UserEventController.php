<?php

namespace App\Http\Controllers;

use App\Models\UserEvent;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class UserEventController extends Controller
{
    private $title;
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Peserta Acara';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $data['title'] = $this->title;
        $data['event'] = $event;
        $data['users'] = User::role(['Admin', 'Member'])->where('is_active', true)->with(['user_event'=> fn($query) => $query->where('event_id',$event->id)])->get();
        // return $data;
        return view('user_event.index', $data);

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
    public function store(Request $request, Event $event)
    {
        UserEvent::create(['user_id' => $request->user_id, 'event_id'=>$event->id]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserEvent  $userEvent
     * @return \Illuminate\Http\Response
     */
    public function show(UserEvent $userEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserEvent  $userEvent
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEvent $userEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEvent  $userEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEvent $userEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEvent  $userEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEvent $userEvent)
    {
        //
    }
}
