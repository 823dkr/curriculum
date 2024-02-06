<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RequestsCreateData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Type;
use App\Creature;
use App\Http\Requests\CreateData;
use App\Image;
use App\Sex;
use Carbon\Carbon;
use App\Feed;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
                'creature.index',
                [
                    'all_types' => $all_types,
                    'types' => $search_type,
                    'creatures' => $search_creature,
                    'sexes' => $all_sexes,
                    'images' => $all_images,
                ]

            );
        } else {
            $creatures = Auth::user()->creature()->get();
            $types = Auth::user()->type()->get();
            $images = Auth::user()->image()->get();
            $sexes = new Sex;
            $today = Carbon::today();
            $user_id = Auth::user()->id;

            $all_creature = $creatures->all();
            $all_types = $types->all();
            $all_sexes = $sexes->all();
            $all_images = $images->all();
            $feed = Feed::where('user_id', $user_id)->whereDate('created_at', $today)->get();

            return view('creature.index', [
                'creatures' => $all_creature,
                'types' => $all_types,
                'images' => $all_images,
                'sexes' => $all_sexes,
                'all_types' => $all_types,
                'feed' => $feed,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
