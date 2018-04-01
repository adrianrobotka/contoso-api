<?php

namespace App\Http\Controllers;

use App\Events\IdentifyEvent;
use App\Http\Controllers\Api\FaceController;
use App\Participant;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function test($id)
    {
        $candidates = [];
        $gate = "Teszt kapu";
        if ($id == 2) {
            $candidates[] = "7fc26b0b-a568-4164-9d81-81305d973fb8";
            $candidates[] = "0511d212-47ef-40ea-bdbb-e0573b8e3921";
        } else {
            $candidates[] = "8986ef94-b41f-4996-aaaa-065baa4aca28";
            $gate = "Valami más kapu";
        }

        $this->testIdentify($candidates, $gate);
    }

    public function testIdentify($candidates, $gate = "Teszt kapu")
    {
        foreach ($candidates as $candidate) {
            $participant = Participant::find($candidate);

            if ($participant == null)
                continue;

            $images = $participant->images()->get();
            $faceIds = [];
            foreach ($images as $image) {
                $faceIds[] = [
                    'id' => $image->id,
                    'url' => Storage::disk('images')->url($image->id . '.jpg')
                ];
            }

            $group = $participant->group();

            $response[] = [
                'participant' => [
                    'id' => $participant->id,
                    'groupName' => $group->name,
                    'groupDescription' => $group->description,
                    'firstName' => $participant->first_name,
                    'lastName' => $participant->last_name,
                    'company' => $participant->company,
                    'email' => $participant->email,
                    'birth' => $participant->birth,
                    'workTitle' => $participant->work_title,
                    'faces' => $faceIds
                ],
                'confidence' => rand(50, 90) / 100
            ];
        }

        FaceController::makeLogEntry($response, $gate);

        event(new IdentifyEvent($gate, $response));
    }
}
