<?php

namespace App\Http\Controllers\Api;

class APIClient
{
    public static function createPerson($name, $userData)
    {
        $requestBody = [
            "name" => $name,
            "userData" => $userData
        ];

        $response = \Httpful\Request::post(config('app.face_api_url') .
            'persongroups/' .
            config('app.face_api_default_group') .
            '/persons')
            ->addHeader('Ocp-Apim-Subscription-Key', config('app.face_api_key'))
            ->body(json_encode($requestBody))
            ->send()->body;

        return $response->personId;
    }

    public static function detect($image)
    {
        $response = \Httpful\Request::post(config('app.face_api_url') .
            'detect')
            ->addHeader('Ocp-Apim-Subscription-Key', config('app.face_api_key'))
            ->body($image, 'application/octet-stream')
            ->send()->body;

        $response = json_decode($response);

        return $response;
    }

    public static function trainingStatus()
    {
        $response = \Httpful\Request::get(config('app.face_api_url') .
            'persongroups/' .
            config('app.face_api_default_group') .
            '/training')
            ->addHeader('Ocp-Apim-Subscription-Key', config('app.face_api_key'))
            ->send()->body;

        return $response;
    }

    public static function startTraining()
    {
        $response = \Httpful\Request::post(config('app.face_api_url') .
            'persongroups/' .
            config('app.face_api_default_group') .
            '/train')
            ->addHeader('Ocp-Apim-Subscription-Key', config('app.face_api_key'))
            ->send()->body;

        return $response;
    }

    public static function identify($faceId, $maxCandidates, $threshold)
    {
        $requestBody = [
            "personGroupId" => config('app.face_api_default_group'),
            "faceIds" => [$faceId],
            "maxNumOfCandidatesReturned" => $maxCandidates,
            "confidenceThreshold" => $threshold
        ];

        $response = \Httpful\Request::post(config('app.face_api_url') .
            'identify')
            ->addHeader('Ocp-Apim-Subscription-Key', config('app.face_api_key'))
            ->body(json_encode($requestBody))
            ->send()->body;

        return $response;
    }

    public static function sendPersonImage($personId, $image)
    {
        $response = \Httpful\Request::post(config('app.face_api_url') .
            'persongroups/' .
            config('app.face_api_default_group') .
            '/persons/' .
            $personId .
            '/persistedFaces')
            ->addHeader('Ocp-Apim-Subscription-Key', config('app.face_api_key'))
            ->body($image, 'application/octet-stream')
            ->send()->body;

        $response = json_decode($response);

        return $response->persistedFaceId;
    }
}