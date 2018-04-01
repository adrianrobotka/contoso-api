<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Participant;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParticipantController extends Controller
{

    public function show($participantId)
    {
        $validator = Validator::make(["id" => $participantId], [
            'id' => 'required|string|size:36',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $participant = Participant::find($participantId);
        if ($participant == null) {
            return response()->json([
                'participant' => null,
            ]);
        }

        $images = $participant->images()->get();
        $faceIds = [];
        foreach ($images as $image) {
            $faceIds[] = [
                'id' => $image->id,
                'url' => $image->getUrl()
            ];
        }

        return response()->json([
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|max:100',
            'lastName' => 'required|max:100',
            'email' => 'required|email|unique:participants|max:200',
            'birth' => 'required|date_format:Y-m-d',
            'company' => 'required|max:200',
            'workTitle' => 'required|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $email = $request->input('email');
        $birth = $request->input('birth');
        $company = $request->input('company');
        $title = $request->input('workTitle');

        $participant = new Participant();

        // Try to register in Face API
        try {
            $fullName = $firstName . " " . $lastName;
            $apiPersonId = APIClient::createPerson($fullName, "");

            $participant->id = $apiPersonId;
            $participant->first_name = $firstName;
            $participant->last_name = $lastName;
            $participant->email = $email;
            $participant->birth = $birth;
            $participant->company = $company;
            $participant->work_title = $title;
            $participant->save();
        } catch (Exception $e) {
            // Do not store rubbish
            $participant->delete();

            return response()->json([
                'error' => 'Cannot create user in face API'
            ], 409);
        }

        return response()->json([
            'personId' => $apiPersonId,
        ]);
    }

    /**
     * Check if email is registered
     *
     * @param $email string Email to check in db
     * @return \Illuminate\Http\JsonResponse
     */
    public function isRegisteredEmail($email)
    {
        $validator = Validator::make(["email" => $email], [
            'email' => 'required|email|max:200'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        $registered = Participant::where('email', $email)->count() > 0;

        return response()->json([
            'email' => $email,
            'isRegistered' => $registered
        ]);
    }
}
