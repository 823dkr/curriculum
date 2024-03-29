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

class CreatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('creature.index', [
            'creatures' => $all_creature,
            'types' => $all_types,
            'images' => $all_images,
            'sexes' => $all_sexes,
            'all_types' => $all_types,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sex = new Sex;
        $sexes = $sex->get();
        $types = Auth::user()->type()->get();
        if ($types->isEmpty()) {
            return view('create_type_form');
        } else {
            return view('creature.create', [
                'types' => $types,
                'sexes' => $sexes,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Creature $creature, Image $image, CreateData $request)
    {
        if (null != ($request->file('image'))) {
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('image')->storeAs('public', $file_name);

            $image->name = $file_name;
            $image->path = 'storage/' . $file_name;
            $image->type_id = $request->type_id;
            //$image->creature_id = $creature->id;

            Auth::user()->image()->save($image);



            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }
            Auth::user()->creature()->save($creature);

            return redirect('/');
        } else {
            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }
            Auth::user()->creature()->save($creature);

            return redirect('/');
        }
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
    public function edit(Creature $creature)
    {
        $sex = new Sex;
        $sexes = $sex->get();
        $types = Auth::user()->type()->get();

        return view('creature.edit', [
            'id' => $creature->id,
            'types' => $types,
            'result' => $creature,
            'sexes' => $sexes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Creature $creature, Image $image, CreateData $request, $id)
    {
        if (null != ($request->file('image'))) {
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('image')->storeAs('public', $file_name);

            $image->name = $file_name;
            $image->path = 'storage/' . $file_name;
            $image->type_id = $request->type_id;

            Auth::user()->image()->save($image);

            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }

            Auth::user()->creature()->save($creature);

            return redirect('/');
        } else {
            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }

            Auth::user()->creature()->save($creature);

            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creature $creature, $id)
    {
        $id = $creature->id;
        $creature->where('id', $id)->delete();

        return redirect('/');
    }
}
