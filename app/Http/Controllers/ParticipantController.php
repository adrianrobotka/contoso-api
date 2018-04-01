<?php

namespace App\Http\Controllers;

use App\Capability;
use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = Participant::all();
        return view('participants.index', ["participants" => $participants]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Participant $participant)
    {
        return view("participants.show", ["participant" => $participant]);
    }

    public function edit(Participant $participant)
    {
        return view("participants.edit", ["participant" => $participant]);
    }

    public function update(Request $request, Participant $participant)
    {
        $participant->name = $request->input('name');
        $participant->email = $request->input('email');
        $participant->save();
        return response()->json("ok");
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return response()->json("ok");
    }
}