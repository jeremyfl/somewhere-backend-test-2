<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Domain;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    public function all(Request $request)
    {
        $sort = "id";

        if ($request['sort'] == "urgency") {
            $sort = "urgency";
        }

        $checklists = Domain::with('checklists')->orderBy($sort, 'DESC')->paginate(5);

        if ($request['include'] == "items") {
            $checklists = Domain::with('checklists')->orderBy($sort, 'DESC')->with('items')->get();
        }

        return response()->json($checklists);
    }

    public function show($checklist)
    {
        $checklist = Checklist::with('domain')->where('id', $checklist)->first();

        if (!$checklist) {
            return response()->json(["status" => 404, "error" => "not found"], 404);
        }

        return response()->json(['data' => $checklist]);
    }

    public function store(Request $request)
    {
        $checklist = new Checklist;
        $checklist->description = $request->input('description');
        $checklist->urgency = $request->input('urgency');
        $checklist->template_id = $request->input('template_id');
        $checklist->domain_id = $request->input('domain_id');
        $checklist->save();

        if (!$checklist) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($checklist);
    }

    public function update(Request $request, $template)
    {
        $checklist = Checklist::find($checklist);

        if (!$checklist) {
            return response()->json(["status" => 404, "error" => "not found"], 404);
        }

        $updateTemplate = Template::where('id', $template)->update([
            'description' => $request->input('description'),
            'updated_by' => $request->input('updated_by'),
            'urgency' => $request->input('urgency'),
            'template_id' => $request->input('template_id'),
            'domain_id' => $request->input('domain_id'),
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
