<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

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


    public function getTechs()
    {
        $technologies = Technology::all();
        return response()->json($technologies);
    }

    public function getTypes()
    {
        $types = Type::all();
        return response()->json($types);
    }
}
