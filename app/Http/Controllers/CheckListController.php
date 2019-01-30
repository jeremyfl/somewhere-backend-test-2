<?php

namespace App\Http\Controllers;

class CheckListController extends Controller
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
        return response()->json(
            ['data' => ['Hello']]
        );
    }

    //
}
