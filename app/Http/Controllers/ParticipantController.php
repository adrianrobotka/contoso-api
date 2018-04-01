<?php

namespace App\Http\Controllers;

use App\Capability;
use App\Http\Controllers\Api\APIClient;
use App\Participant;
use App\ParticipantView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{
    public function index()
    {
        $participants = ParticipantView::all();
        return view('participants.index', ["participants" => $participants]);
    }

    public function show(Participant $participant)
    {
        $images = [];
        $pimgs = $participant->images()->get();
        foreach ($pimgs as $image) {
            $images[] = Storage::disk('images')->url($image->id . '.jpg');
        }

        return view("participants.show", [
            "participant" => $participant,
            "images" => $images
        ]);
    }

    public function edit(Participant $participant)
    {
        return view("participants.edit", ["participant" => $participant]);
    }

    public function update(Request $request, Participant $participant)
    {
        $emailValidationRule = 'email';
        $changeEmail = false;

        if ($request->has('email')) {
            $email = $request->input('email');

            if ($participant->email != $email) {
                $changeEmail = true;
                $emailValidationRule = 'required|email|unique:participants|max:200';
            }
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => $emailValidationRule,
            'birth' => 'required|date_format:Y-m-d',
            'company' => 'required|max:200',
            'work_title' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return redirect(route('participants.edit', $participant->id))
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $participant->first_name = $request->input('first_name');
        $participant->last_name = $request->input('last_name');

        if ($changeEmail)
            $participant->email = $request->input('email');

        $participant->birth = $request->input('birth');
        $participant->company = $request->input('company');
        $participant->work_title = $request->input('work_title');
        $participant->save();

        return redirect(route('participants.show', $participant->id));
    }

    public function destroy($participant_id)
    {
        $participant = Participant::find($participant_id);

        // delete from API
        APIClient::deletePerson($participant_id);

        $participant->images()->delete();
        $participant->delete();

        return redirect(route('participants.index'));
    }
}