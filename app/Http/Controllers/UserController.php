<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heading = [
            'ID',
            'Name',
            'Role',
            'Actions',
        ];
        $users = User::all()->map(function ($user){
            $avatarName = str_replace(' ', '+', $user->name);
            $nameColumn =
                '<span>
                    <a
                        href="/user/'.$user->id.'"
                    >
                        <img style="display:inline; width: 30px;" src="https://ui-avatars.com/api/?background=random&name='.$avatarName.'"> '.$user->name.'
                    </a>
                </span>';

            return [
                $user->id,
                $nameColumn,
                $user->getRoleNames(),
                'Edit'
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
}
