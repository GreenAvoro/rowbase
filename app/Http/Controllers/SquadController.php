<?php

namespace App\Http\Controllers;

use App\Models\Squad;
use Illuminate\Http\Request;

class SquadController extends Controller
{
    public function index()
    {
        return view('squads', [
            'squads' => Squad::all()
        ]);
    }


    public function create()
    {
        return view('create-squad');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'squad-name' => 'required',
            'squad-color'=> 'required'
        ]);


        $squad = new Squad();
        $squad->name = $request->input('squad-name');
        $squad->color = $request->input('squad-color');
        $squad->save();

        if(!$squad->save())
        {
            ddd($squad->errors());
        }

        return redirect('/squads');
    }
}
