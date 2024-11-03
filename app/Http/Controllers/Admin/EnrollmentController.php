<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = CourseUser::with(['course', 'user'])->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function update(Request $request, $id)
    {
        $enrollment = CourseUser::findOrFail($id);
        $enrollment->status = $request->input('status');
        $enrollment->save();

        return redirect()->route('enrollments.index')->with('message', 'Enrollment Status Updated Successfully');
    }

    public function destroy($id)
    {
        $enrollment = CourseUser::find($id);
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('message', 'Enrolllment Deleted Successfully');
    }
}
