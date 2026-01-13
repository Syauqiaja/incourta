<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view("admin.auth.login");
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                throw new \Exception('Invalid email or password.', 422);
            }
            if (!Auth::attempt($credentials, $request->boolean('remember'))) {
                throw new \Exception('Invalid email or password.', 422);
            }
            if (!$user->hasRole(['admin', 'superadmin'])) {
                throw new \Exception("You don't have access this page", 422);
            }
            $request->session()->regenerate();

            return response()->json([
                'status'   => true,
                'message'  => 'Login berhasil',
                'redirect' => url()->previous() !== route('admin.login.form')
                    ? url()->previous()
                    : route('admin.home.index'),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'errors' => [
                    'email' => [$th->getMessage()],
                ]
            ], $th->getCode());
        }
    }
    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('admin.login.form'));
    }
}
