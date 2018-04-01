<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FaceController extends Controller
{
    public function detect(Request $request)
    {
        try {
            $fileName = $request->file("image")->getPathname();
            $image = file_get_contents($fileName);

            $response = APIClient::detect($image);

            return response()->json(["results" => $response]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
    }

    public function identify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'faceId' => 'required|string|size:36',
            'maxNumOfCandidatesReturned' => 'required|numeric',
            'confidenceThreshold' => 'required|numeric'
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

                $response[] = [
                    'participant' => [
                        'id' => $participant->id,
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

            return response()->json(["results" => $response]);
        } catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()]);
        }
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
