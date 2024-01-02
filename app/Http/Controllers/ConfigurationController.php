<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function show()
    {
        return view('configuration.show');
    }

    public function updateTaskPrefix(Request $request)
    {
        $request->validate([
            'task_prefix' => ['string', 'min:2', 'max:6']
        ]);
        auth()->user()->employerCompany()->update([
            'task_prefix' => $request->task_prefix
        ]);

        return redirect()->back();
    }
}
