<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RoomController extends Controller
{
    public function get(Request $request)
    {
        $id = $request->query('id');
        DB::beginTransaction();

        try {
            if ($id) {
                $rooms = Room::where('id', $id)->get();
                if (!$rooms) {
                    return response()->json([
                        'message' => 'Room not found.',
                        'status' => 404,
                    ], 404);
                }
            } else {
                $rooms = Room::all();
            }

            DB::commit();

            return response()->json([
                'data' => $rooms,
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create room.',
                'error' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:10',
            ]);

            $room = Room::create([
                'name' => $validated['name'],
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Room created successfully!',
                'data' => $room,
                'status' => 201,
            ], 201);
        } catch (ValidationException $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create room.',
                'error' => $e->errors(),
                'status' => 500,
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create room.',
                'error' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'name' => 'sometimes|string|max:10',
            ]);

            $room = Room::findOrFail($id);
            $room->update($validated);

            DB::commit();

            return response()->json([
                'message' => 'Room updated successfully!',
                'data' => $room,
                'status' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Student not found.',
                'status' => 404,
            ], 404);
        } catch (ValidationException $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to update room.',
                'error' => $e->errors(),
                'status' => 500,
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to update rpom.',
                'error' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $room = Room::findOrFail($id);
            $room->delete();

            DB::commit();

            return response()->json([
                'message' => 'Room deleted successfully!',
                'status' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Room not found.',
                'error' => $e->getMessage(),
                'status' => 404,
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'An error occurred during deletion.',
                'error' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }
}
