<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

trait ExportsReports
{
    public function download(Request $request)
    {
        if (!in_array($request->query('report'), self::REPORTS))
        {
            return abort(404);
        }

        if (! auth()->user()->hasRole('leader'))
        {
            return abort(403);
        }

        return $this->{'report' . \request()->query('report')}($request->all());
    }

    public function getReportFileName(string $extension = 'xlsx'): string
    {
        $reportName = debug_backtrace()[1]['function'];
        $date = Carbon::now()->format('Y-m-d_h-i-s');

        return $date . '_' . $reportName . '.' . $extension;
    }
}
