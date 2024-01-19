<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\RequestsCreateData;
use Illuminate\Support\Facades\Auth;

use App\Type;
use App\Creature;
use App\Image;

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

    public function createCreatureForm()
    {
        $creatures = Auth::user()->creature()->get();
        $params = Auth::user()->type()->get();
        if ($params->isEmpty()) {
            return view('create_type_form');
        } else {
            return view('create_creature_form', [
                'types' => $params,
            ]);
        }
    }

    public function createCreature(Creature $creature, Image $image, Request $request)
    {
        // ディレクトリ名
        $dir = 'images';

        // アップロードされたファイル名を取得
        $file_name = $request->file('image')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('image')->storeAs('public/' . $dir, $file_name);

        $image->image_name = $file_name;
        $image->image_path = 'storage/' . $dir . '/' . $file_name;

        Auth::user()->image()->save($image);

        $columns = ['type_id', 'name', 'sex',];
        foreach ($columns as $column) {
            $creature->$column = $request->$column;
        }
        Auth::user()->creature()->save($creature);

        return redirect('/');
    }
}
