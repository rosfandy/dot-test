<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function store()
    {
        DB::beginTransaction();
        try {
            $token = session('jwt_token');
            $rooms = Room::all();

            DB::commit();

            return view('room.store', compact('rooms', 'token'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('errors', $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = Room::where('id', $request->id)->first();
            $token = session('jwt_token');

            DB::commit();

            return view('room.edit', compact('data', 'token'));
        } catch (\Exception $e) {
            return back()->with('errors', $e->getMessage());
        }
    }
}
