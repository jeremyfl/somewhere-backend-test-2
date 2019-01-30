<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $template = new Template;
        $template->name = $request->input('name');
        $template->save();

        if (!$template) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($template);
    }

    public function show($template)
    {
        $templates = Template::with('checklists.items')->where('id', $template)->paginate(5);

        return response()->json($templates);
    }

    public function update(Request $request, $template)
    {
        $updateTemplate = Template::where('id', $template)->update(['name' => $request->input('name')]);

        if (!$updateTemplate) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($updateTemplate);
    }

    public function delete($template)
    {
        $deleteTemplate = Template::where('id', $item)->delete();

        if (!$deleteTemplate) {
            return response()->json(['message' => "Sorry something went wrong"]);
        }

        return response()->json($deleteTemplate);
    }
}
