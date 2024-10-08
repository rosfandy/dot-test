<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function get(Request $request)
    {
        $id = $request->query('id');
        $roomId = $request->query('room');

        DB::beginTransaction();

        try {
            if ($id) {
                $students = Student::where('id', $id)->get();
                if (!$students) {
                    return response()->json([
                        'message' => 'Student not found.',
                        'status' => 404,
                    ], 404);
                }
            } elseif ($roomId) {
                $students = Student::where('room_id', $roomId)->get();
                if (!$students) {
                    return response()->json([
                        'message' => 'Student with room id: ' . $roomId . ' not found.',
                        'status' => 404,
                    ], 404);
                }
            } else {
                $students = Student::all();
            }

            DB::commit();

            return response()->json([
                'data' => $students->makeHidden(['password']),
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
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students',
                'password' => 'required|string',
            ]);

            $student = Student::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Student created successfully!',
                'data' => $student->makeHidden(['password']),
                'status' => 201,
            ], 201);
        } catch (ValidationException $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create student.',
                'error' => $e->errors(),
                'status' => 500,
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to create student.',
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
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|unique:students,email,' . $id,
                'room_id' => 'sometimes|exists:rooms,id',
            ]);

            $student = Student::findOrFail($id);
            $student->update($validated);

            DB::commit();

            return response()->json([
                'message' => 'Student updated successfully!',
                'data' => $student->makeHidden(['password']),
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
                'message' => 'Failed to update student.',
                'error' => $e->errors(),
                'status' => 500,
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to update student.',
                'error' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $student = Student::findOrFail($id);

            DB::commit();

            if ($student->delete()) {
                return response()->json([
                    'message' => 'Student deleted successfully!',
                    'status' => 200,
                ], 200);
            }
        } catch (ModelNotFoundException $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Student not found.',
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
