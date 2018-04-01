<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Participant;
use App\ParticipantImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ParticipantImageController extends Controller
{
    public function show($faceId)
    {
        $participantImage = Participant::where('api_face_id', $faceId)->first();
        return response()->file($participantImage->image);
    }

    public function upload(Request $request, $participantId)
    {
        $validator = Validator::make(["id" => $participantId], [
            'id' => 'required|string|size:36',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        if (Participant::where('id', $participantId)->count() == 0) {
            return response()->json(["error" => "No participant was found under provided id."], 400);
        }

        $validator = Validator::make($request->all(), [
            'image' => 'required|file'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        if (!$request->image->isValid()) {
            return response()->json([
                'error' => 'Image is not valid',
            ], 409);
        }

        $tempFilename = str_random(20) . ".jpg";
        $request->image->storeAs('temp', $tempFilename, 'images');
        $tempFilename = "temp/" . $tempFilename;

        $image = Storage::disk('images')->get($tempFilename);

        $faceId = APIClient::sendPersonImage($participantId, $image);

        $permanentFilename = $faceId . ".jpg";
        Storage::disk('images')->move($tempFilename, $permanentFilename);

        $participantImage = new ParticipantImage();
        $participantImage->id = $faceId;
        $participantImage->participant_id = $participantId;
        $participantImage->save();

        $minImagesNum = config('app.required_face_images');
        $isMoreImageNeeded = ParticipantImage::where('participant_id', $participantId)->count() < $minImagesNum;

        APIClient::startTraining();

        return response()->json([
            'persistedFaceId' => $faceId,
            'isMoreImageNeeded' => $isMoreImageNeeded,
        ]);
    }

}
