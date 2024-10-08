<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function store()
    {
        DB::beginTransaction();
        try {
            $rooms = Room::all();
            $token = session('jwt_token');

            DB::commit();

            return view('student.store', compact('rooms', 'token'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();

        try {
            $data = Student::where('id', $request->id)->first();
            $rooms = Room::all();
            $token = session('jwt_token');

            DB::commit();

            return view('student.edit', compact('data', 'rooms', 'token'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
