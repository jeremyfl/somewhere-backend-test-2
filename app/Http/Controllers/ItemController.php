<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function all()
    {
        $templates = Checklist::with('items')->paginate(5);

        return response()->json($templates);
    }

    public function complete(Request $request)
    {
        $completeItem = Item::where('id', $request->input('item_id'))->update(['is_completed' => 1]);

        if (!$completeItem) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($completeItem);
    }

    public function incomplete(Request $request)
    {
        $incompleteItem = Item::where('id', $request->input('item_id'))->update(['is_completed' => 0]);

        if (!$incompleteItem) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($incompleteItem);
    }

    public function store(Request $request, $checklist)
    {
        $item = new Item;
        $item->checklist_id = $checklist;
        $item->description = $request->input('description');
        $item->due = $request->input('due');
        $item->urgency = $request->input('urgency');
        $item->save();

        if (!$item) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($item);
    }

    public function delete($item, $checklist)
    {
        $deleteItem = Item::where('id', $item)->where('checklist_id', $checklist)->delete();

        if (!$deleteItem) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($deleteItem);
    }
}
