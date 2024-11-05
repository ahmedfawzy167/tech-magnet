<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEnrollmentNotification extends Notification
{
    use Queueable;

    public $course;

    /**
     * Create a new notification instance.
     */
    public function __construct($course)
    {
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
            ->subject('Course Enrollment Confirmation')
            ->greeting("Hello {$notifiable->name},")
            ->line('You have Successfully Enrolled in ' . $this->course->name)
            ->action('Start Learning', url('/api/courses/' . $this->course->id))
            ->line('Thank you for Choosing Our Platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable)
    {
        return [
            'course_id' => $this->course->id,
            'course' => $this->course->name,
            'message' => "You have Successfully Enrolled in the Course: {$this->course->name}.",
            'url' => url('/courses' . $this->course->id),
        ];
    }
}
