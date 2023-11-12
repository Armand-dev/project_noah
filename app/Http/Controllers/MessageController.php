<?php

namespace App\Http\Controllers;

use App\Events\SendMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->hasRole('leader')) {
            $company = auth()->user()->companies()->first();
        } else {
            $company = auth()->user()->employerCompany;
        }
dd($company);
        return view('chat.index')
            ->with('company', $company);
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
            'message' => ['required', 'max:1000']
        ]);

        if (auth()->user()->hasRole('leader')) {
            $company = auth()->user()->companies()->first();
        } else {
            $company = auth()->user()->employerCompany;
        }

        $message = Message::create([
            'content' => $request->message,
            'sent_at' => now(),
            'sent_by' => auth()->user()->id,
            'company_uuid' => $company->uuid,
        ]);

        event(new SendMessage($message->fresh()));

        return response()->json($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }

    public function getChat()
    {
        if (auth()->user()->hasRole('leader')) {
            $company = auth()->user()->companies()->first();
        } else {
            $company = auth()->user()->employerCompany;
        }

        $chat = Message::where('company_uuid', $company->uuid)->get()->map(function($message) {
            return [
                'meta' => [
                    'sent_at' => $message->sent_at,
                    'sent_by' => $message->user->toArray(),
                ],
                'data' => [
                    'message' => $message->content
                ]
            ];
        });

        return response()->json($chat);
    }
}
