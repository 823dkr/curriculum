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
use App\Feed;

class MainController extends Controller
{
    public function index()
    {
        $creatures = Auth::user()->creature()->get();
        $types = Auth::user()->type()->get();
        $images = Auth::user()->image()->get();
        $sexes = new Sex;

        $all_creature = $creatures->all();
        $all_types = $types->all();
        $all_sexes = $sexes->all();
        // $image_path = $images->path;

        return view('creature.index', [
            'creatures' => $all_creature,
            'types' => $all_types,
            //'image' => $image_path,
            'sexes' => $all_sexes,
            'all_types' => $all_types,

        ]);
    }

    public function create()
    {
        $sex = new Sex;
        $sexes = $sex->get();
        $types = Auth::user()->type()->get();

        if ($types->isEmpty()) {
            return view('type.create_type');
        } else {
            return view('creature.create', [
                'types' => $types,
                'sexes' => $sexes,
            ]);
        }
    }

    public function store(Request $request)
    {
        $creature = new Creature;
        $image = new Image;

        if (null != ($request->file('image'))) {
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('image')->storeAs('public', $file_name);

            $image->name = $file_name;
            $image->path = 'storage/' . $file_name;
            $image->type_id = $request->type_id;
            $image->creature_id = $creature->id;

            Auth::user()->image()->save($image);



            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }
            Auth::user()->creature()->save($creature);

            return redirect('/creatures');
        } else {
            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }
            Auth::user()->creature()->save($creature);

            return redirect('/creatures');
        }
    }

    public function show(Creature $creature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Creature  $creature
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
     * @param  \App\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Creature $creature)
    {
        $image = new Image;
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

            return redirect('/creatures');
        } else {
            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }

            Auth::user()->creature()->save($creature);

            return redirect('/creatures');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Creature  $creature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Creature $creature)
    {
        $id = $creature->id;
        $creature->where('id', $id)->delete();

        return redirect('/creatures');
    }
}
