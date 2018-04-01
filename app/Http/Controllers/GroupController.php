<?php

namespace App\Http\Controllers;

use App\Group;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class GroupController
 *
 * An admin class to handle groups
 *
 * @package App\Http\Controllers
 */
class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view("group.index", ["groups" => $groups]);
    }

    public function create()
    {
        return view('group.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:1|max:190'
        ]);

        if ($validator->fails()) {
            return redirect(route('groups.create'))
                ->withErrors($validator)
                ->withInput($request->all());
        }

        $group = new Group;
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->save();
        return redirect(route('groups.index'));
    }

    public function show(Group $group)
    {
        $participants = $group->participants()->get();
        return view("group.show", ["group" => $group, "participants" => $participants]);
    }

    public function edit(Group $group)
    {
        $participants = Participant::all();

        return view("group.edit", [
            "group" => $group,
            "participants" => $participants,
        ]);
    }

    public function update(Request $request, Group $group)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'description' => 'required|min:1|max:190',
            'participants' => 'array'
        ]);

        if ($validator->fails()) {
            return redirect(route('groups.update'))
                ->withErrors($validator)
                ->withInput($request->all());
        }

        // if not default group
        if ($group->id != 1) {
            $ids = $request->input('participants');

            $group->name = $request->input('name');
            $group->description = $request->input('description');
            $group->save();

            Participant::where('group_id', $group->id)
                ->update(['group_id' => 1]);

            if (sizeof($ids) != 0) {
                Participant::whereIn('id', $ids)
                    ->update(['group_id' => $group->id]);
            }
        }

        return redirect(route('groups.show', $group->id));
    }

    public function destroy($group_id)
    {
        $group = Group::find($group_id);

        // set to default
        Participant::where('group_id', $group->id)
            ->update(['group_id' => 1]);

        $group->delete();
        return redirect(route('groups.index'));
    }
}