<?php
// app/Http/Controllers/Auth/LoginController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // ✅ Redirect to admin after login
    protected $redirectTo = '/admin';

    public function __construct()
    {
        // ✅ Only guest middleware — NOT auth
        $this->middleware('guest')->except('logout');
    }

    // ✅ After logout go to HOME not login
    protected function loggedOut(Request $request)
    {
        return redirect('/');
    }
}