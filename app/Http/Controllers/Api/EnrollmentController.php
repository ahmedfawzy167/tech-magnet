<?php

namespace App\Http\Controllers\Api;

use App\Models\Course;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Notifications\NewEnrollmentNotification;

class EnrollmentController extends Controller
{
   use ApiResponder;

   public function enroll(StoreEnrollmentRequest $request)
   {
      try {
         $user = auth()->user();

         $course = Course::findOrFail($request->course);
         if ($user->courses()->where('course_id', $course->id)->exists()) {
            // Student is already Enrolled //
            return $this->conflict("You Are Already Enrolled in This Course");
         }

         $user->courses()->attach($course, [
            'date' => $request->date ?? now(),
         ]);

         $user->notify(new NewEnrollmentNotification($course));

         return $this->created("Enrollment Done Successfully");
      } catch (\Exception $e) {
         return $this->serverError('An error Occurred During Enrollment.');
      }
   }
}
