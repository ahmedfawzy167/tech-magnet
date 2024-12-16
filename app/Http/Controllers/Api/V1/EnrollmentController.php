<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\StudentEnrollment;
use App\Models\Admin;
use App\Models\Course;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Notifications\NewEnrollmentNotification;
use App\Notifications\StudentEnrollmentAdminNotification;

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

         // Broadcast the Event
         StudentEnrollment::dispatch($course);

         // Notify the student
         $user->notify(new NewEnrollmentNotification($course));

         // Notify all Admins
         $admins = Admin::all();
         foreach ($admins as $admin) {
            $admin->notify(new StudentEnrollmentAdminNotification($user, $course));
         }

         return $this->created("Enrollment Done Successfully");
      } catch (\Exception $e) {
         return $this->serverError($e->getMessage());
      }
   }
}
