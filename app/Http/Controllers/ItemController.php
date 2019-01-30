<?php

namespace App\Http\Controllers;

use App\Checklist;

class ItemController extends Controller
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
        $templates = Checklist::with('items')->paginate(5);

        return response()->json($templates);
    }

    //
}
