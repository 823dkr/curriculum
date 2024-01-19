<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Creature;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisplayController extends Controller
{
    public function index()
    {
        $creatures = Auth::user()->creature()->get();
        $types = Auth::user()->type()->get();
        $image = Auth::user()->image()->get();

        $all = $creatures->all();
        $all2 = $types->all();
        $all3 = $image->all();
        return view('top', [
            'creatures' => $all,
            'types' => $all2,
            'images' => $all3
        ]);
    }
}
