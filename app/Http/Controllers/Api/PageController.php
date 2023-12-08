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

        if ($project) {
            $success = true;
            if (!$project->image) {
                $project->image = asset('img/placeholder.webp');
            } else {
                $project->image = asset('storage/' . $project->image);
            }
        } else {
            $success = false;
        }

        return response()->json(compact('project', 'success'));
    }
}
