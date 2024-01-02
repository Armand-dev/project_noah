<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\Timesheet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $headings = ['ID', 'Title', 'Project', 'Assignee', 'Status', 'Due Date'];

        $tasks = Task::query()
            ->orderBy('number', 'DESC')
            ->get()
            ->map(function (Task $task){
                /** @var User $assignee */
                $assignee = $task->assignee()->first();
                $task->assignee = $assignee->name;
                $task->project_name = $task->project->name ?? '-';
                $task->assignee_image = $assignee->getAvatarUrl(30);
                $task->due = Carbon::parse($task->due_date)->format('d M y');
                $task->prefixed_number = $task->prefix . '-' . $task->number;
                $task->status_name = Task::STATUSES[$task->status];

                return $task;
            })
            ->toArray();

        return view('tasks.index')
            ->with('heading', $headings)
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'user_id' => ['sometimes', 'numeric', 'exists:users,id'],
            'priority' => ['sometimes', 'numeric'],
            'status' => ['sometimes', 'numeric'],
            'due_date' => ['sometimes', 'date'],
            'description' => ['string'],
        ]);

        if (auth()->user()->hasRole('leader')) {
            $company = auth()->user()->companies()->first();
        } else {
            $company = auth()->user()->employerCompany;
        }

        /** Increment task number for company */
        $company->task_number++;

        /** Create task */
        Task::create([
            'user_id' => $request->user_id,
            'company_id' => $company->id,
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'prefix' => $company->task_prefix,
            'number' => $company->task_number,
        ]);

        /** Save incremented task number for company */
        $company->save();

        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $task->prefixed_number = $task->prefix . '-' . $task->number;
        return view('tasks.edit')
            ->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index');
    }

    public function addSpentTime(Request $request, Task $task): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'time' => ['required', 'numeric'],
            'day' => []
        ]);


        if (auth()->user()->hasRole('leader')) {
            $company = auth()->user()->companies()->first();
        } else {
            $company = auth()->user()->employerCompany;
        }

        $existingTime = $task->hours;

        /** Add time to task */
        $task->update([
            'hours' => $existingTime + $request->time
        ]);

        /** Add time to timesheet */
        Timesheet::create([
            'user_id' => auth()->user()->id,
            'client_id' => 1,
            'project_id' => 1,
            'activity_id' => 1,
            'hours' => $request->time,
            'observations' => '',
            'day' => $request->day ?? today(),
            'company_id' => $company->id,
            'task_id' => $task->id
        ]);

        return response()->json();
    }
}
