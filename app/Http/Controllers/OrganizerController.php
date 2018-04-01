<?php

namespace App\Http\Controllers;

use App\Capability;
use App\Organizer;
use Illuminate\Http\Request;

/**
 * Class OrganizerController
 *
 * An admin class to handle organizers
 *
 * @package App\Http\Controllers
 */
class OrganizerController extends Controller
{
    public function index()
    {
        $organizers = Organizer::all();
        return view("organizer.index", ["organizers" => $organizers]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Organizer $organizer)
    {
        $capabilities = Capability::all();
        return view("organizer.show", ["organizer" => $organizer, "capabilities" => $capabilities]);
    }

    public function edit(Organizer $organizer)
    {
        return view("organizer.edit", ["organizer" => $organizer]);
    }

    public function update(Request $request, Organizer $organizer)
    {
        $organizer->name = $request->input('name');
        $organizer->email = $request->input('email');
        $organizer->save();
        return response()->json("ok");
    }

    public function destroy(Organizer $organizer)
    {
        $organizer->delete();
        return response()->json("ok");
    }
}