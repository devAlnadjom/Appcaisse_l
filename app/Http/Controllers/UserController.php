<?php

namespace App\Http\Controllers;

use App\Actions\CustomPermission;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Account;
use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        CustomPermission::check("user");
        CustomPermission::check("systeme");
        return Inertia::render('Users/Index', [
            'users' => User::with('account')->paginate()
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create', [
            'users' => User::with('account')->paginate()
        ]);
    }

    public function store(StoreUserRequest $rq)
    {
        $data= $rq->except(['permissions','c_password_ui']);
        $user = Account::create($data);
        $user->update([
            'permissions' => json_encode($rq->permissions),
            'password_ui' => md5($rq->password_ui)
        ]);

        $user->user()->create([
            'name' => $data['nom_p_ui'],
            'email' => $data['email_ui'],
            'password' => Hash::make($data['password_ui']),
        ]);

        return redirect()->route('users.index')->with('success',"Utilsateur ajouté.");
    }

    public function edit(User $user) {
        // dd($user->load('account'));
        return Inertia::render('Users/Edit', [
            'user' => $user->load('account')
        ]);
    }

    public function update(User $user, UpdateUserRequest $rq)
    {
        $data= $rq->except(['permissions']);
        $user->account()->update($data);
        $user->account()->update([
            'permissions' => json_encode($rq->permissions)
        ]);

        $user->update([
            'name' => $data['nom_p_ui'],
            'email' => $data['email_ui'],
        ]);

        return redirect()->route('users.index')->with('success',"Compte Utilisateur Modifié.");
    }
}
