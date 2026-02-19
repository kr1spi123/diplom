<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        return response()->json(Application::with('specialty')->get());
    }

    public function show($id)
    {
        $application = Application::with('specialty')->findOrFail($id);
        return response()->json($application);
    }
}
