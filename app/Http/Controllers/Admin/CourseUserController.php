<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseUserController extends Controller
{
    public function index()
    {
        $enrollments = CourseUser::with(['course', 'user'])
            ->where('status', 'pending')->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function update($id)
    {
        $enrollment = CourseUser::findOrFail($id);
        $enrollment->status = 'approved';
        $enrollment->save();
        return redirect()->route('enrollments.index')->with('message', 'Enrolllment Status Updated Successfully');
    }
}
