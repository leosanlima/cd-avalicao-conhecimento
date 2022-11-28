<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\FirstAccessRequest;
use App\Models\FirstAccess;
use App\Providers\RouteServiceProvider;
use App\Services\LayoutMessageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FirstAccessController extends Controller
{
    public function __construct(private LayoutMessageService $layoutMessageService)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        return view('auth.first-access-set-password', ['request' => $request]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FirstAccessRequest  $request
     * @return RedirectResponse
     */
    public function store(FirstAccessRequest $request): RedirectResponse
    {
        /** @var FirstAccess $firstAccess */
        $firstAccess = FirstAccess::with('user')->where('token', $request->token)->first();

        $user = $firstAccess->user;
        $user->password = Hash::make($request->password);
        $user->is_first_access = false;
        $user->save();

        $this->layoutMessageService->flashSuccessMessage();
        return redirect(route('login'));
    }

    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function edit(Request $request): View|RedirectResponse
    {
        if (!$request->user()->is_first_access) {
            return redirect(RouteServiceProvider::HOME);
        }

        return view('auth.first-access-reset-password');
    }

    public function update(FirstAccessRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->is_first_access = false;
        $user->save();

        return redirect(RouteServiceProvider::HOME);
    }
}
