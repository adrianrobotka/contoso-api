<?php

namespace App\Http\Controllers\Api;

use App\Events\IdentifyEvent;
use App\Http\Controllers\Controller;
use App\Log;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FaceController extends Controller
{
    public function detect(Request $request)
    {
        try {
            $image = $request->file("image");
            $fileName = $image->getPathname();
            $image = file_get_contents($fileName);

            $response = APIClient::detect($image);

            return response()->json(["results" => $response]);
        } catch (\Throwable $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }

    public function identify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'faceId' => 'required|string|size:36',
            'maxNumOfCandidatesReturned' => 'required|numeric',
            'confidenceThreshold' => 'required|numeric',
            'gate' => 'required|string|min:3|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        try {
            $faceId = $request->get('faceId');
            $maxCandidates = $request->get('maxNumOfCandidatesReturned');
            $threshold = $request->get('confidenceThreshold');
            $apiResponse = APIClient::identify($faceId, $maxCandidates, $threshold);

            $response = [];
            foreach ($apiResponse[0]->candidates as $candidate) {
                $participant = Participant::find($candidate->personId);

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
                    'confidence' => $candidate->confidence
                ];
            }

            $gate = $request->get('gate');

            $this->makeLogEntry($response, $gate);

            event(new IdentifyEvent($gate, $response));

            return response()->json(["results" => $response]);
        } catch (\Throwable $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }

    public static function makeLogEntry($response, $gate)
    {
        if (sizeof($response) == 1) {
            $participant = $response[0]['participant'];
            $confidence = $response[0]['confidence'];
            $log = new Log();
            $log->event = 'valid-enter';
            $log->gate = $gate;
            $log->participant_id = $participant['id'];
            $log->confidence = $confidence;
            $log->save();
        } else if (sizeof($response) == 0) {
            $log = new Log();
            $log->event = 'no-identity';
            $log->gate = $gate;
            $log->save();
        } else {
            $comment = "";
            foreach ($response as $data) {
                $participant = $data['participant'];
                $confidence = $data['confidence'];
                $comment .= $participant['id'] . ':' . intval($confidence * 100) . ";";
            }

            $log = new Log();
            $log->event = 'indefinite-enter';
            $log->comment = $comment;
            $log->gate = $gate;
            $log->save();
        }


    }

    public function selectCandidate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|string|size:36',
            'confidence' => 'required',
            'gate' => 'required|string|min:3|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        $gate = $request->get('gate');
        $id = $request->get('candidate_id');
        $confidence = $request->get('confidence');


        $log = new Log();
        $log->event = 'selected-enter';
        $log->gate = $gate;
        $log->participant_id = $id;
        $log->confidence = floatval($confidence);
        $log->save();

        $participant = Participant::find($id);

        // TODO no time to handle error
        if ($participant == null)
            return response()->json(["result" => "ok"]);

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
            'selected' => true,
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
            'confidence' => str_replace(",", ".", $confidence)
        ];

        event(new IdentifyEvent($gate, $response));

        return response()->json(["result" => "ok"]);
    }

    public function trainingStatus()
    {
        $response = APIClient::trainingStatus();

        return response()->json($response);
    }

    public function startTraining()
    {
        APIClient::startTraining();

        return response()->json(["status" => "started"]);
    }
}
