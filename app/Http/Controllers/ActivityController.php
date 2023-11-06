<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = auth()->user()->companies()->first();

        $heading = ['Id', 'Activity', 'Actions'];

        $activities = $company->activities->map(function ($activity){
            return [
                $activity->id,
                $activity->name,
                'Edit'
            ];
        });;

        return view('activities.index')
            ->with('heading', $heading)
            ->with('activities', $activities);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Activity::create([
            'name' => $request->name,
            'company_id' => auth()->user()->companies()->first()->id
        ]);

        return redirect()->route('activity.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
