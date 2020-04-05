<?php

namespace App\Http\Controllers;

use App\Apple;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppleController extends Controller
{

    public $count;

    public function __construct()
    {
        $apples = Apple::all();
        $this->count = count($apples);
    }

    public function index(Apple $apple)
    {
        $apples = Apple::where('size', '>', 0)->get();

        foreach ($apples as $apple) {
            $created = strtotime($apple->created_at);
            $grown = strtotime($apple->grow_time);
            $spoiled = strtotime($apple->spoil_time);
            $now = strtotime(Carbon::now());
            $diff1 = $grown - $created;
            $diff2 = $spoiled - $created;
//            dd($diff1);
//            if ($now >= $grown) {
//                $this->down($apple);
//            }
            if ($spoiled && $now >= $spoiled) {
                $this->over($apple);
            }
        }

        return view('/apples', [
            'apples' => $apples,
            'apple' => $apple,
            'count' => $this->count,
            'now' => $now
        ]);
    }

    public function generate()
    {
        DB::table('apples')->delete();

        for ($i = 0; $i < rand(10, 20); $i++) {
            $apple = new Apple();
            $apple->size = 100;
            $apple->created_at = Carbon::now()->addSeconds(rand(10, 60));
            $apple->updated_at = Carbon::now()->addSeconds(rand(10, 60));
            $apple->grow_time = ($apple->created_at)->addMinutes(1);
//            $apple->spoil_time = Carbon::now()->addMinutes(2);
            $apple->top = rand(100, 400);
            $apple->left = rand(60, 400);
            $apple->color = 255 . ',' . rand(0, 150) . ',' . rand(0, 5);
            $apple->save();
        }

        $apples = Apple::all();

        return redirect()->action('AppleController@index')->with([
            'apples' => $apples,
        ]);
    }


    public function update(Apple $apple)
    {
        if (!$apple->size <= 0) {
            $apple->size = $apple->size - 25;
            $apple->save();

            $apples = Apple::where('size', '>', 0)->get();
            return redirect()->action('AppleController@index')->with([
                'apples' => $apples,
            ]);

        }


//        if (!$apple->size <= 0){
//            $apple->size = $apple->size - 25;
//            $apple->save();
//        }else{
//            $apples = Apple::all();
//
//            return redirect()->action('AppleController@index')->with([
//                'apples' => $apples,
//            ]);
//        }
//
//        return [
//            'size' => $apple->size
//        ];
    }


    public function down(Apple $apple)
    {
        $apple->top = 600;
        $apple->status = 'onGround';
        $apple->spoil_time = Carbon::now()->addMinutes(1);
        $apple->save();

        $apples = Apple::where('size', '>', 0)->get();

        return redirect()->action('AppleController@index')->with([
            'apples' => $apples,
        ]);
    }


    public function over(Apple $apple)
    {
        $apple->status = 'spoiled';
        $apple->top = 600;
        $apple->save();

        $apples = Apple::where('size', '>', 0)->get();

        return redirect()->action('AppleController@index')->with([
            'apples' => $apples,
        ]);
    }

}

