<?php

namespace App\Events;


use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class AdminWelcome implements ShouldBroadcast
{
    public function __construct(public int $adminId) {}

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('admin.' . $this->adminId);
    }

    public function broadcastAs(): string
    {
        return 'admin.welcome';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => 'Halo, selamat datang di Admin Panel',
        ];
    }
}
