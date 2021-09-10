<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AdminController
 */
class AdminController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * @param AdminRequest $request
     * @return RedirectResponse|Response|void
     * @throws ValidationException
     */
    public function login(AdminRequest $request)
    {
        $validated = $request->validated();
        
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
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }
}
