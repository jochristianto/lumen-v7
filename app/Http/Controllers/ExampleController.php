<?php

namespace App\Http\Controllers;

use App\Test;
use Exception;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function all()
    {
        $items = Test::where([])->get();

        return response()->json(['message' => 'Success', 'data' => $items], 200);
    }

    public function create(Request $request)
    {
        $item = new Test();
        $item->test_string = $request->test_string;
        $item->test_float = $request->test_float;
        $item->test_decimal = $request->test_decimal;
        $item->test_double = $request->test_double;
        $result = $item->saveOrFail();
        if (!$result) throw new Exception();

        $item->refresh();

        return response()
            ->json(['data' => $item], 201);
    }
}
