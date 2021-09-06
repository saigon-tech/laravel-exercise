<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

/**
 *
 */
class AdminController extends Controller
{
    use AuthenticatesUsers;
    protected $maxAttempts = 5;
    protected $decayMinutes = 1;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {
        return view('student.admin-login');
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(AdminRequest $request) {
        $validated = $request->validated();

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        if (Auth::attempt($validated)) {
            $this->clearLoginAttempts($request);
            return redirect()->route('student.index');
        } else {
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
