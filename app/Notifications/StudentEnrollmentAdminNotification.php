<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Course;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentEnrollmentAdminNotification extends Notification
{
    use Queueable;

    protected $student;
    protected $course;


    /**
     * Create a new notification instance.
     */
    public function __construct(User $student, Course $course)
    {
        $this->student = $student;
        $this->course = $course;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Student Enrollment')
            ->greeting("Hello {$notifiable->name},")
            ->line("A New Student, {$this->student->name}, has Enrolled in the Course: {$this->course->name}.")
            ->action('View Student', url('/admin/students/' . $this->student->id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        return [
            'student_id' => $this->student->id,
            'student_name' => $this->student->name,
            'course_id' => $this->course->id,
            'course_name' => $this->course->name,
            'message' => "{$this->student->name} Enrolled in {$this->course->name}.",
            'url' => url('/admin/courses/' . $this->course->id),
        ];
    }
}
