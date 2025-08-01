<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AntrianKunjungan3 implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $kunjungan3;

    /**
     * Create a new event instance.
     */
    public function __construct($kunjungan3)
    {
        $this->kunjungan3 = $kunjungan3;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('informasi_kunjungan3'),
        ];
    }
}
