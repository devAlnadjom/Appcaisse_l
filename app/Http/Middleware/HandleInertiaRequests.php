<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request)
    {
        $auth= Account::Where("id_ui",Auth::user()?->users_in_id)->first();
        $permission= $auth ? $auth->permissions:null;
        $level= $auth ? $auth->level_ui:null;
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'permission'=>json_decode( $permission),
                'level'=>$level,
            ],
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                ];
            },
            'showingMobileMenu' => false,
        ]);
    }
}
