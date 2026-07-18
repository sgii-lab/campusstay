<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PropertyLiked extends Notification
{
    use Queueable;

    protected $property;
    protected $student;

    public function __construct($property, $student)
    {
        $this->property = $property;
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your property was liked!')
            ->line("{$this->student->name} liked your property: {$this->property->title}")
            ->line("Contact: {$this->student->phone} | WhatsApp: {$this->student->whatsapp}")
            ->action('View Property', url('/landlord/dashboard'));
    }

    public function toArray($notifiable)
    {
        return [
            'property_id' => $this->property->id,
            'student_id' => $this->student->id,
            'message' => "{$this->student->name} has requested your property: {$this->property->title}",
            'contact' => "Phone: {$this->student->phone} | WhatsApp: {$this->student->whatsapp}",
        ];
    }
    
}
