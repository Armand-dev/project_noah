<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heading = [
            'ID',
            'User Name',
            'Role',
            'Actions',
        ];

        if (auth()->user()->hasRole('leader')) {
            $company = auth()->user()->companies()->first();
        } else {
            $company = auth()->user()->employerCompany;
        }


        $users = User::all()
            ->where('employer_company_id', $company->id)
            ->where('employer_company_id', $company->id)
            ->map(function ($user){
            $avatarName = str_replace(' ', '+', $user->name);
            $nameColumn =
                '<span>
                    <a
                        href="/user/'.$user->id.'"
                    >
                        <img style="display:inline; width: 28px; border-radius:50%; margin-right: 4px;" src="https://ui-avatars.com/api/?background=random&name='.$avatarName.'"> '.$user->name.'
                    </a>
                </span>';

            return [
                $user->id,
                $nameColumn,
                implode(", ", array_map(function($role) {
                        return ucfirst($role);
                    },
                    json_decode($user->getRoleNames(), true))),
                \view('components.icons.edit')->render()
            ];
        });

        return view('users.index')
            ->with('heading', $heading)
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'employer_company_id' => ['required', 'numeric', 'exists:App\\Models\\Company,id'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $temporaryPassword = Str::random();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($temporaryPassword),
            'employer_company_id' => $request->employer_company_id
        ]);

        $user->assignRole('member');

        event(new UserCreated($user, $temporaryPassword));

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getNotifications()
    {
        return auth()->user()->notifications;
    }
}
