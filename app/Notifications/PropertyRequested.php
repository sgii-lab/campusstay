<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PropertyRequested extends Notification
{
    use Queueable;

    protected $property;
    protected $student;

    /**
     * Create a new notification instance.
     */
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
            ->subject('New Property Request')
            ->line("{$this->student->name} has requested your property: {$this->property->title}")
            ->line("Contact: {$this->student->phone} | WhatsApp: {$this->student->whatsapp}")
            ->action('View Requests', url('/landlord/dashboard'));
    }
    

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
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
