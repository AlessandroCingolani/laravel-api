<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->paginate(10);
        return response()->json($projects);
    }

    public function getSlugProject($slug)
    {
        $project = Project::where('slug', $slug)->with('technologies', 'type')->first();
        return response()->json($project);
    }
}
