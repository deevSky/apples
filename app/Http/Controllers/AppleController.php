<?php

namespace App\Http\Controllers;

use App\Apple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class AppleController extends Controller
{
    public function index()
    {
        $apples = Apple::all();

        if (!$apples->count()){
            $this->generate();
            $apples = Apple::all();
        }

        return view('apples', [
            'apples' => $apples,
        ]);
    }

    public function generate()
    {
        DB::table('apples')->delete();

        for ($i = 0; $i < rand(10, 20); $i++) {
            $apple = new Apple();
            $apple->size = 100;
            $apple->top = rand(-600, -300);
            $apple->left = rand(60, 400);
            $apple->color = 255 . ',' . rand(0, 150) . ',' . rand(0, 5);
            $apple->save();
    }

        $apples = Apple::all();

        return redirect()->action('AppleController@index')->with([
            'apples' => $apples,
        ]);
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Apple $apple)
    {
        //
    }


    public function change(Apple $apple)
    {
        $apple->status = 'On ground';
        $apple->save();

        return [
            'status' => 'On ground'
        ];
    }

    public function update(Apple $apple)
    {
        if (!$apple->size <= 0){
            $apple->size = $apple->size - 25;
            $apple->save();
        }else{
            return [
                'size' => 0,
                'hidden' => true
            ];
        }

        return [
            'size' => $apple->size
        ];
    }


    public function destroy(Apple $apple)
    {
        //
    }
}

