<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $project = Project::create($request->validate(['name' => 'string']));
        return response()->json($project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json($project);
    }
}
