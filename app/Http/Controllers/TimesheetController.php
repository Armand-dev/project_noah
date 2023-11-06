<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headings = ['Day', 'Client', 'Project', 'Activity', 'Sub-activity', 'Hours', 'Actions'];
        $timesheet = $this->fillTimesheet(Timesheet::whereDate('day', '>=', Carbon::today()->subYear())->get());

        return view('timesheet.index')
            ->with('headings', $headings)
            ->with('timesheet', $timesheet)
            ->with('clients', auth()->user()->companies()->first()->clients)
            ->with('projects', auth()->user()->companies()->first()->projects)
            ->with('activities', auth()->user()->companies()->first()->activities);
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
        $request->validate([
            'client_id' => ['required', 'numeric', 'exists:App\\Models\\Client,id'],
            'project_id' => ['required', 'numeric', 'exists:App\\Models\\Project,id'],
            'activity_id' => ['required', 'numeric', 'exists:App\\Models\\Activity,id'],
            'hours' => ['required', 'numeric'],
            'day' => ['required', 'date'],
        ]);

        $timesheet = Timesheet::create([
            'client_id' => $request->client_id,
            'project_id' => $request->project_id,
            'activity_id' => $request->activity_id,
            'hours' => $request->hours,
            'day' => $request->day,
            'company_id' => auth()->user()->companies()->first()->id,
        ]);

        return response()->json($timesheet);
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

    public function getEmptyTimesheet()
    {
        $timesheet = [];
        $period = CarbonPeriod::create(Carbon::today()->subYear(), Carbon::today()->addDays(2));

        // Iterate over the period
        foreach ($period as $date) {
            $timesheet[] = [
                'meta' => [
                    'is_weekend' => $date->isWeekend()
                ],
                'id' => null,
                'day' => $date->format('Y-m-d'),
                'client' => null,
                'project' => null,
                'activity' => null,
                'subactivity' => null,
                'hours' => null,
                'actions' => null,
            ];
        }

        return array_reverse($timesheet);
    }

    public function fillTimesheet(Collection $timesheet)
    {
        $emptyTimesheet = $this->getEmptyTimesheet();

        if ($timesheet->isEmpty()) {
            return $emptyTimesheet;
        }

        foreach ($emptyTimesheet as $index => $emptyDay) {
            if ($timesheet->contains('day', $emptyDay['day'])) {
                $spentTime = $timesheet->where('day', $emptyDay['day'])->first();

                $emptyTimesheet[$index]['id'] = $spentTime->id;
                $emptyTimesheet[$index]['client'] = $spentTime->client->name;
                $emptyTimesheet[$index]['project'] = $spentTime->project->name;
                $emptyTimesheet[$index]['activity'] = $spentTime->activity->name;
                $emptyTimesheet[$index]['hours'] = $spentTime->hours;
            }
        }

        return $emptyTimesheet;
    }
}
