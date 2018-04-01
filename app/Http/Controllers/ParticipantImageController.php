<?php

namespace App\Http\Controllers;

use App\Capability;
use App\Participant;
use Illuminate\Support\Facades\Storage;

class ParticipantImageController extends Controller
{
    public function index()
    {
        $participants = [];
        $db_participants = Participant::all();
        foreach ($db_participants as $participant) {

            $images = [];
            $pimgs = $participant->images()->get();
            foreach ($pimgs as $image) {
                $images[] = Storage::disk('images')->url($image->id . '.jpg');
            }
            $participants[] = [
                'id' => $participant->id,
                'name' => $participant->getName(),
                'images' => $images
            ];
        }

        return view('images.index', [
            "participants" => $participants
        ]);
    }

}