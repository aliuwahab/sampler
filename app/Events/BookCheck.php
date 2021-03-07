<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookCheck
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bookId;
    public $checkType;

    /**
     * Create a new event instance.
     *
     * @param int $bookId
     * @param string $checkType
     */
    public function __construct(int $bookId, string $checkType)
    {
        $this->bookId = $bookId;
        $this->checkType = $checkType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('book-check');
    }
}
