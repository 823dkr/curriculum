<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Type;
use App\Creature;
use App\Http\Requests\CreateData;
use App\Image;
use App\Sex;
use App\Feed;
use Carbon\Carbon;


class MainController extends Controller
{
    public function index()
    {
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
            'feed' => $feed,
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

    public function store(CreateData $request)
    {
        $request->validate([
            'image' => ['file', 'mimes:jpeg,png,jpg,bmb', 'max:2048', 'image'],

        ]);
        $creature = new Creature;
        $image = new Image;

        if (null != ($request->file('image'))) {

            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }
            Auth::user()->creature()->save($creature);

            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('image')->storeAs('public', $file_name);


            $image->name = $file_name;
            $image->path = 'storage/' . $file_name;
            $image->creature_id = $creature->id;

            Auth::user()->image()->save($image);


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
    public function update(CreateData $request, Creature $creature)
    {
        $request->validate([
            'image' => ['file', 'mimes:jpeg,png,jpg,bmb', 'max:2048', 'image'],

        ]);

        $image = new Image;
        if (null != ($request->file('image'))) {
            $columns = ['type_id', 'name', 'sex_id',];
            foreach ($columns as $column) {
                $creature->$column = $request->$column;
            }

            Auth::user()->creature()->save($creature);

            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // 取得したファイル名で保存
            $request->file('image')->storeAs('public', $file_name);

            $image->name = $file_name;
            $image->path = 'storage/' . $file_name;
            $image->creature_id = $creature->id;

            $id = $creature->id;
            $image->where('creature_id', $id)->delete();

            Auth::user()->image()->save($image);
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
