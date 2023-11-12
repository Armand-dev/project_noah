<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Traits\ExportsReports;

class ReportController extends Controller
{
    use ExportsReports;

    public const REPORTS = [
        'W001',
    ];

    public function index()
    {
        return view('reports.index')
            ->with('projects', Project::withTrashed()->get())
            ->with('users', User::withTrashed()->get());
    }

    public function reportW001()
    {

    }
}
