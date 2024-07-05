<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Kelulusan;
use App\Models\KompetensiResult;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            $user = $request->user();

            // Check user type and redirect accordingly
            if ($user->usertype === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Check if there are any competency results for the user
            $hasCompetencyResults = KompetensiResult::where('user_id', $user->id)->exists();

            // If no competency results, redirect to the dashboard
            if (!$hasCompetencyResults) {
                return redirect()->intended(route('dashboard'));
            }

            // Check if the user has passed all required competencies
            KompetensiResult::insertKelulusanIfPassed($user->id);

            // Check if user data exists in kelulusan table
            if (Kelulusan::checkIfPassed($user->id)) {
                return redirect()->route('hasil-akhir');
            }

            // Redirect based on competency status
            if (KompetensiResult::hasPassedGeneralCompetency($user->id) ||
                (!KompetensiResult::hasPassedGeneralCompetency($user->id) && !KompetensiResult::hasSpecialCompetencyData($user->id))) {
                return redirect()->route('pilih-lab');
            }

            return redirect()->intended(route('dashboard'));
        } catch (ValidationException $e) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Maaf, email atau password salah. Jika lupa password, maka hubungi pihak terkait'])
                ->withInput($request->only('email'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
