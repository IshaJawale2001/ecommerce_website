<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $adminEmail = 'isha123@gmail.com';
    private $adminPassword = 'Pass@123';

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($credentials['email'] === $this->adminEmail && $credentials['password'] === $this->adminPassword) {
            Session::put('admin_logged_in', true);
            return redirect()->route('products.index')->with('success', 'Logged in successfully.');
        }

        return redirect()->route('admin.login')->with('error', 'Invalid credentials.');
    }

    public function logout()
    {
        Session::forget('admin_logged_in');
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
