<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Squad;
use App\Models\TimeDistance;
use App\Models\User;
use App\Models\Workout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{

    public function view($id)
    {
        return view('log', [
            'user'  => Auth::user(),
            'data' => Log::findOrFail($id)
        ]);
    }

    public function index(Request $request)
    {
        $workout = $request->query('workout');
        $user = $request->query('user');
        $squad = $request->query('squad');

        $query = Log::query();

        if($workout != 'all')
        {
            $query->where('workout_id', $workout);
        }

        if($user != 'all')
        {
            $query->where('user_id', $user);
        }
        if($squad != 'all')
        {
            $query->where('squad_id', $squad);
        }   


        $logs = $query;


        if(!$request->hasAny(['workout', 'user', 'squad']))
        {
            $logs = Log::orderBy('datetime', 'desc');
        }
        $users = new User();
        return view('logs', [
            'logs'      => $logs->paginate(5),
            'user'      => Auth::user(),
            'workouts'  => Workout::all(),
            'users'     => $users->all(),
            'squads'    => Squad::all(),
        ]);
    }

    public function destroy($id)
    {
        $log = Log::findOrFail($id);

        $log->delete();

        return redirect('/dashboard');
    }
    public function store(Request $request)
    {

        
        // Validate the form data
        $validatedData = $request->validate([
            'workout'   => 'required',
            // 'image'     =>'required|image|mimes:png,jpg|max:2048'
        ]);
        // Create a new instance of YourModel
        $log = new Log();


        //Uploaded image related things
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $log->image = $imagePath;
        }

        

        // Assign the form data to the model properties
        $log->user_id = Auth::user()->id;
        $log->team_id = Auth::user()->team_id;
        $log->workout_id = $validatedData['workout'];
        $log->squad_id = Auth::user()->squad_id;
        $log->datetime = Carbon::now('Pacific/Auckland');
        

        if(!$log->save())
        {
            ddd($log->errors());
        }
        // Assign other form fields to the model properties
        for($i=0; $i < 10; $i++){
            if($request->input('time_'.$i) != null){
                $timeDistance = new TimeDistance();

                $timeDistance->time = $request->input('time_'.$i);
                $timeDistance->distance = $request->input('distance_'.$i);
                $timeDistance->log_id = $log->id;
                $timeDistance->interval_no = $i;

                $timeDistance->save();
                if(!$timeDistance->save())
                {
                    ddd($timeDistance->errors());
                }
            }
        }

        // Save the model to the database
        

        // Redirect or return a response
        return redirect('/log/'.$log->id);
    }
}
