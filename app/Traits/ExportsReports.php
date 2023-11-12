<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

trait ExportsReports
{
    public function download(Request $request)
    {
        dd($request->all());
        if (!in_array(\request()->query('report'), self::REPORTS))
        {
            return abort(404);
        }

        if (! auth()->user()->hasRole('leader'))
        {
            return abort(403);
        }

        return $this->{'report' . \request()->query('report')}(
            \request()->query('start') ?? Carbon::now()->subMonth(),
            \request()->query('end') ?? Carbon::now()
        );
    }
}
