<?php

namespace App\Http\Controllers;

use App\Checklist;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    public function all(Request $request)
    {
        if ($request['include'] == "items") {
            $checklists = Checklist::with('items')->get();
        } else {
            $checklists = Checklist::paginate(5);
        }

        return response()->json($checklists);
    }

    public function show($checklist)
    {
        $checklist = Checklist::find($checklist);

        return response()->json($checklist);
    }

    public function store(Request $request)
    {
        $checklist = new Checklist;
        $checklist->object_domain = $request->input('object_domain');
        $checklist->object_id = $request->input('object_id');
        $checklist->description = $request->input('description');
        $checklist->description = $request->input('description');
        $checklist->completed_at = $request->input('completed_at');
        $checklist->urgency = $request->input('urgency');
        $checklist->save();

        if (!$checklist) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($checklist);
    }

    public function update(Request $request, $template)
    {
        $updateTemplate = Template::where('id', $template)->update([
            'object_domain' => $request->input('object_domain'),
            'object_id' => $request->input('object_id'),
            'description' => $request->input('description'),
            'is_completed' => $request->input('is_completed'),
            'updated_by' => $request->input('updated_by'),
            'urgency' => $request->input('urgency'),
            'template_id' => $request->input('template_id'),
        ]);

        if (!$updateTemplate) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($updateTemplate);
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
        $checklistWithItem = Checklist::with('item')->where('id', $checklist)->first();

        return response()->json($checklistWithItem);
    }

    public function assign(Request $request, $template)
    {
        $updateTemplate = Checklist::where('id', $request->input('checklist_id'))->update([
            'template_id' => $template,
        ]);

        if (!$updateTemplate) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($updateTemplate);
    }
}
