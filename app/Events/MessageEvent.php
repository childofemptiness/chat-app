<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Message details
     * 
     * @var Message
     */
    public $message;


    /**
     * Create a new event instance.
     */
    public function __construct(Message $message)
    {

        $this->message = $message;

        Log::info('Событие запущено' . $this->message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {

        Log::info('aaaaaaaaaaa');
        return [
            
            new Channel('chat-app'),
        ];
    }

    // public function broadcastAs() {

    //     return 'message.sent';
    // }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->content,
            'user' => $this->message->user->name,
        ];
    }
}
