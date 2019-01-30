<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function store(Request $request)
    {
        $domain = new Domain;
        $domain->name = $request->input('name');
        $domain->save();

        if (!$domain) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($domain);
    }
}
