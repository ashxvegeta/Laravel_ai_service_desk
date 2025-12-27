<?php

namespace App\Notifications;
// data used in notification
use app\Models\Ticket;
// data used in notification
use app\Models\Comment;
// allows sending via queue (async)
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// for email formatting
use Illuminate\Notifications\Messages\MailMessage;
// base Laravel notification class
use Illuminate\Notifications\Notification;



class TicketCommented extends Notification
{
    // This notification can be queued, so emails don’t slow your app.
    use Queueable;
    // The ticket being commented on
    public $ticket;
    // The comment that was added
    public $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket, $comment)
    {
        //
        $this->ticket = $ticket;
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    // This data is stored in the notifications table as JSON.
    public function toDatabase(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'ticket_title' => $this->ticket->title,
            'comment_id' => $this->comment->id,
            'comment_body' => $this->comment->body,
            'commented_by' => $this->comment->user->name,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New  reply on your ticket: ' . $this->ticket->title)
            ->greeting('Hello ' . $notifiable->name)
            ->line($this->comment->user->name . ' has replied to your ticket.')
            ->line('Comment: "' . $this->comment->body . '"')
             ->action(
                'View Ticket',
                url(route('tickets.show', $this->ticket))
            )
            ->line('Thank you for using our support system!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
