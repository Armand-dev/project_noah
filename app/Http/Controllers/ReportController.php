<?php

namespace App\Http\Controllers;

use App\Exports\ReportW001;
use App\Jobs\NotifyUserOfCompletedExport;
use App\Models\Project;
use App\Models\User;
use App\Traits\ExportsReports;
use Illuminate\Http\JsonResponse;

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

    public function reportW001(array $params): JsonResponse
    {
        $path = $this->getReportFileName();
        (new ReportW001($params))->queue($path, 'public')->chain([
            new NotifyUserOfCompletedExport(request()->user(), $path),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Export started.'
        ]);
    }
}
