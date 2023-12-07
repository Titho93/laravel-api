<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function index()
    {
        $projects = Project::with('tecnologies', 'type')->get();

        return response()->json($projects);
    }

    public function getProjectById($id)
    {

        $project = Project::where('id', $id)->with('tecnologies', 'type')->first();
        return response()->json($project);
    }
}
