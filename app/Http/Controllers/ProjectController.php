<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = auth()->user()->companies()->first();

        $heading = ['Id', 'Project', 'Client', 'Actions'];

        $clients = $company->projects->map(function ($project){
            return [
                $project->id,
                $project->name,
                $project->client->name,
                'Edit'
            ];
        });;

        return view('projects.index')
            ->with('heading', $heading)
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'numeric', 'exists:App\\Models\\Client,id'],
        ]);

        Project::create([
            'name' => $request->name,
            'client_id' => $request->client_id,
            'company_id' => auth()->user()->companies()->first()->id
        ]);

        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
