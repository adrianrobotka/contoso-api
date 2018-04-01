<?php

namespace App\Http\Controllers;

use App\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('organizer.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:100',
            'last_name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:organizers|min:3|max:200',
            'passwd' => 'required|min:3|max:100'
        ]);

        if ($validator->fails()) {
            return redirect(route('organizers.create'))
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $organizer = new Organizer;
        $organizer->first_name = $request->input('first_name');
        $organizer->last_name = $request->input('last_name');
        $organizer->email = $request->input('email');
        $organizer->password = $request->input('passwd');
        $organizer->save();
        return redirect(route('organizers.index'));
    }

    public function show(Organizer $organizer)
    {

        return view("organizer.show", ["organizer" => $organizer]);
    }

    public function edit(Organizer $organizer)
    {
        return view("organizer.edit", ["organizer" => $organizer]);
    }

    public function passwd_update($organizer_id)
    {
        $organizer = Organizer::find($organizer_id);

        return view("organizer.passwd", ["organizer" => $organizer]);
    }

    public function update(Request $request, $organizer_id)
    {
        $organizer = Organizer::find($organizer_id);

        $emailValidationRule = 'email';
        $changeEmail = false;

        if ($request->has('email')) {
            $email = $request->input('email');

            if ($organizer->email != $email) {
                $changeEmail = true;
                $emailValidationRule = 'required|email|unique:organizers|min:3|max:200';
            }
        }

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:100',
            'last_name' => 'required|min:3|max:100',
            'email' => $emailValidationRule
        ]);

        if ($validator->fails()) {
            return redirect(route('organizers.edit', $organizer_id))
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $organizer->first_name = $request->input('first_name');
        $organizer->last_name = $request->input('last_name');

        if ($changeEmail)
            $organizer->email = $request->input('email');

        $organizer->save();

        return redirect(route('organizers.show', $organizer->id));
    }

    public function passwd(Request $request, $organizer_id)
    {
        $organizer = Organizer::find($organizer_id);

        $new_pwd = $request->input('new_pwd');
        $organizer->password = bcrypt($new_pwd);
        $organizer->save();

        return redirect(route('organizers.show', $organizer->id));
    }

    public function destroy($organizer_id)
    {
        $organizer = Organizer::find($organizer_id);
        $organizer->delete();
        return redirect(route('organizers.index'));
    }
}