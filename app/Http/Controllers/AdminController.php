<?php

namespace App\Http\Controllers;

use App\Events;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
         // Добавляем публичную функцию показа страницы администратора
        public function index(Events $events, User $user)
    {
        $events = Events::all();
        $users = User::all();
        //      $events = DB::table('events')->get(); //Это второй способ обращения к базе данных. В этом случае добавляем: use Illuminate\Support\Facades\DB;
        return view('admin', ['events' => $events, 'users' => $users]);
        dd($user);
    }

}
