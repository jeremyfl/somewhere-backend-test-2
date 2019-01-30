<?php

namespace App\Http\Controllers;

use App\Template;

class TemplateController extends Controller
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
        $templates = Template::with('checklists.items')->paginate(5);

        return response()->json($templates);
    }

    //
}
