<?php

namespace App\Http\Controllers;

use App\Checklist;

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
        $checklists = Checklist::paginate(5);

        return response()->json($checklists);
    }

    /**
     * Get all Checklist with Items
     */
    public function items($item)
    {
        $checklistWithItems = Checklist::with('items')->where('id', $item)->paginate(5);

        return response()->json($checklistWithItems);
    }

    /**
     * Get Checklist with Item
     */
    public function item($checklist, $item)
    {
        $checklistWithItem = Checklist::with(['items'], function ($query, $item) {
            $query->where('id', $item);
        })->where('id', $item)->first();

        return response()->json($checklistWithItem);
    }
}
