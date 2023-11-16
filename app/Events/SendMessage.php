<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('companies.' . $this->message->company_uuid),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'meta' => [
                'sent_at' => $this->message->sent_at,
                'sent_by' => $this->message->user->toArray(),
            ],
            'data' => [
                'message' => $this->message->content
            ]
        ];
    }
}
