<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function logout(Request $request)
    {
        // Activity::createLog('Logout', 'Keluar ke sistem');
        auth()->logout();
        auth('administrator')->logout();
        auth('officer')->logout();
        auth('student')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
