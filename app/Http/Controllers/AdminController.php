<?php

namespace App\Http\Controllers;

use App\Events;
use App\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index(Events $events, User $user)
    {

        return view('admin.index');


    }

    public function events(Events $events, User $user)
    {
        $events = Events::all();
        $events = $events->sortBy('date');
        $users = User::all();
        //      $events = DB::table('events')->get(); //Это второй способ обращения к базе данных. В этом случае добавляем: use Illuminate\Support\Facades\DB;
        return view('admin.admin_events', ['events' => $events, 'users' => $users]);
    }

    public function update(Request $request, Events $events)
    {
        $events = Events::all();
        foreach ($events as $key) {
            // echo($key->id);
            if ($request->has($key->id)) {
                $data = Events::find($key->id);
                $data->manager = $request->input($key->id);
                $data->save();
            }
        }
        return redirect('admin/events');
    }


}
