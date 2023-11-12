<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Client;
use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
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
        $headings = ['Day', 'Client', 'Project', 'Activity', 'Sub-activity', 'User', 'Hours',  'Obs', ''];

        if (auth()->user()->hasRole('leader')) {
            $timesheet = Timesheet::query()
                ->whereDate('day', '>=', Carbon::today()->subYear())
                ->get()
                ->map(function ($work) {
                    $work['client'] = Client::withTrashed()->find($work['client_id'])->name;
                    $work['project'] = Project::withTrashed()->find($work['project_id'])->name;
                    $work['activity'] = Activity::withTrashed()->find($work['activity_id'])->name;
                    $work['user'] = User::withTrashed()->find($work['user_id'])->name;

                    return $work;
                })
                ->groupBy(function($timesheet) {
                    return $timesheet->day;
                });

            $clients = auth()->user()->companies()->first()->clients;
            $projects = auth()->user()->companies()->first()->projects;
            $activities = auth()->user()->companies()->first()->activities;
        } else {
            $timesheet = auth()->user()->timesheets()
                ->whereDate('day', '>=', Carbon::today()->subYear())
                ->get()
                ->map(function ($work) {
                    $work['client'] = Client::withTrashed()->find($work['client_id'])->name;
                    $work['project'] = Project::withTrashed()->find($work['project_id'])->name;
                    $work['activity'] = Activity::withTrashed()->find($work['activity_id'])->name;
                    $work['user'] = User::withTrashed()->find($work['user_id'])->name;

                    return $work;
                })
                ->groupBy(function($timesheet) {
                    return $timesheet->day;
                });

            $clients = auth()->user()->employerCompany->clients;
            $projects = auth()->user()->employerCompany->projects;
            $activities = auth()->user()->employerCompany->activities;
        }

        $timesheet = $this->fillTimesheet($timesheet);

        return view('timesheet.index')
            ->with('headings', $headings)
            ->with('timesheet', $timesheet)
            ->with('clients', $clients)
            ->with('projects', $projects)
            ->with('activities', $activities);
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
            'observations' => ['max:1000'],
            'day' => ['required', 'date'],
        ]);

        if (auth()->user()->hasRole('leader')) {
            $company = auth()->user()->companies()->first();
        } else {
            $company = auth()->user()->employerCompany;
        }

        $timesheet = Timesheet::create([
            'user_id' => auth()->user()->id,
            'client_id' => $request->client_id,
            'project_id' => $request->project_id,
            'activity_id' => $request->activity_id,
            'hours' => $request->hours,
            'observations' => $request->observations ?? '',
            'day' => $request->day,
            'company_id' => $company->id,
        ]);

        $timesheet->client = Client::find($timesheet->client_id)->name;
        $timesheet->project = Project::find($timesheet->project_id)->name;
        $timesheet->activity = Activity::find($timesheet->activity_id)->name;
        $timesheet->user = User::find($timesheet->user_id)->name;

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
        $timesheet->delete();

        return response()->json();
    }

    public function getEmptyTimesheet()
    {
        $timesheet = [];
        $period = CarbonPeriod::create(Carbon::today()->subYear(), Carbon::today()->addDays(2));

        // Iterate over the period
        foreach ($period as $date) {
            $timesheet[$date->format('Y-m-d')] = [
                'meta' => [
                    'is_weekend' => $date->isWeekend()
                ],
                'data' => []
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

        $fillTimesheet = $emptyTimesheet;
        foreach ($timesheet as $day => $work) {
            $fillTimesheet[$day]['data'] = $work->toArray();

//            if ($timesheet->contains('day', $emptyDay['day'])) {
//                $spentTime = $timesheet->where('day', $emptyDay['day'])->first();
//
//                $emptyTimesheet[$index]['id'] = $spentTime->id;
//                $emptyTimesheet[$index]['client'] = $spentTime->client->name;
//                $emptyTimesheet[$index]['project'] = $spentTime->project->name;
//                $emptyTimesheet[$index]['activity'] = $spentTime->activity->name;
//                $emptyTimesheet[$index]['hours'] = $spentTime->hours;
//            }
        }

        return $fillTimesheet;
    }

    public function getWorkday()
    {
        $day = \request()->query('day');
        if (!$day) {
            return response()->json([], 403);
        }

        if (auth()->user()->hasRole('leader')) {
            $workday = Timesheet::query()
                ->where('day', $day)
                ->get()
                ->map(function ($work) {
                    $work['client'] = Client::withTrashed()->find($work['client_id'])->name;
                    $work['project'] = Project::withTrashed()->find($work['project_id'])->name;
                    $work['activity'] = Activity::withTrashed()->find($work['activity_id'])->name;

                    return $work;
                });
        } else {
            $workday = auth()->user()->timesheets()
                ->where('day', $day)
                ->get()
                ->map(function ($work) {
                    $work['client'] = Client::withTrashed()->find($work['client_id'])->name;
                    $work['project'] = Project::withTrashed()->find($work['project_id'])->name;
                    $work['activity'] = Activity::withTrashed()->find($work['activity_id'])->name;

                    return $work;
                });
        }
        return response()->json($workday);
    }
}
