<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    public function dashboard()
    {
        DB::beginTransaction();
        try {
            $rooms = Room::all();
            $students = Student::all();

            DB::commit();

            return view('dashboard', compact('rooms', 'students'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function login()
    {
        if (Session::has('jwt_token')) {
            return redirect()->route('pages.dashboard');
        }
        return view('auth.login');
    }
}
