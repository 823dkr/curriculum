<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Creature;
use App\Sex;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DisplayController extends Controller
{
    public function index()
    {
        $creatures = Auth::user()->creature()->get();
        $types = Auth::user()->type()->get();
        $images = Auth::user()->image()->get();
        $sexes = new Sex;

        $all_creature = $creatures->all();
        $all_types = $types->all();
        $all_images = $images->all();
        $all_sexes = $sexes->all();
        return view('top', [
            'creatures' => $all_creature,
            'types' => $all_types,
            'images' => $all_images,
            'sexes' => $all_sexes,
            'all_types' => $all_types,

        ]);
    }
    public function searchindex(Request $request)
    {
        $creatures = Auth::user()->creature()->get();
        $types = Auth::user()->type()->get();
        $images = Auth::user()->image()->get();
        $sexes = new Sex;

        $all_creature = $creatures->all();
        $all_types = $types->all();
        $all_images = $images->all();
        $all_sexes = $sexes->all();

        $type = $request->type_id;
        $sex = $request->sex_id;

        if (isset($type) || isset($sex)) {
            $search_type = $types->where("id", '==', $type);
            $search_creature = $creatures->where("sex_id", '==', $sex);
            return view(
                'top',
                [
                    'all_types' => $all_types,
                    'types' => $search_type,
                    'creatures' => $search_creature,
                    'sexes' => $all_sexes,
                ]

            );
        }
    }
}
