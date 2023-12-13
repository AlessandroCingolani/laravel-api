<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'name' => 'required|min:2|max:255',
                'email' => 'required|min:2|max:255',
                'message' => 'required|min:2'

            ],
            [
                'name.required' => 'Name is required',
                'name.min' => 'Name must be at least :min character',
                'name.max' => 'Name cannot exceed :max character',
                'email.required' => 'Email is required',
                'email.min' => 'Email must be at least :min character',
                'email.max' => 'Email cannot exceed :max character',
                'message.required' => 'Message is required',
                'message.min' => 'Message must be at least :min character'
            ]
        );
        return response()->json($data);
    }
}
