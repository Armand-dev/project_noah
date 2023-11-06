<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headings = ['Day', 'Client', 'Project', 'Activity', 'Sub-activity', 'Actions'];
        $timesheet = [];
        $period = CarbonPeriod::create(Carbon::today()->subYear(), Carbon::today()->addDays(2));

        // Iterate over the period
        foreach ($period as $date) {
            $timesheet[] = [
                'meta' => [
                    'is_weekend' => $date->isWeekend()
                ],
                'day' => $date->format('Y-m-d'),
                'client' => null,
                'project' => null,
                'activity' => null,
                'subactivity' => null,
                'actions' => null,
            ];
        }

        $timesheet = array_reverse($timesheet);

        return view('timesheet.index')
            ->with('headings', $headings)
            ->with('timesheet', $timesheet);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Timesheet $timesheet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Timesheet $timesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Timesheet $timesheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Timesheet $timesheet)
    {
        //
    }
}
