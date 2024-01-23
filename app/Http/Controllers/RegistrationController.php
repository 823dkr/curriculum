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

class RegistrationController extends Controller
{
    public function createTypeForm()
    {
        return view('create_type_form');
    }
    public function createType(Request $request)
    {
        $type = new Type;

        $type->name = $request->name;
        Auth::user()->type()->save($type);

        return redirect('create_creature_form');
    }

    public function createCreatureForm(Sex $sex)
    {
        $sexes = $sex->get();
        $types = Auth::user()->type()->get();
        if ($types->isEmpty()) {
            return view('create_type_form');
        } else {
            return view('create_creature_form', [
                'types' => $types,
                'sexes' => $sexes,
            ]);
        }
    }

    public function createCreature(Creature $creature, Image $image, CreateData $request)
    {
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

        return redirect('/');
    }

    public function editCreatureForm(Creature $creature, Sex $sex)
    {
        $sexes = $sex->get();
        $types = Auth::user()->type()->get();
        return view('edit_creature_form', [
            'id' => $creature,
            'types' => $types,
            'result' => $creature,
            'sexes' => $sexes,
        ]);
    }

    public function editCreature(Creature $creature, Image $image, CreateData $request)
    {
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
    }

    public function deleteCreature(Creature $creature)
    {
        $creature->delete();

        return redirect('/');
    }
}
