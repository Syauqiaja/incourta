<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('admin.{adminId}', function ($user, $adminId) {
    return (int) $user->id === (int) $adminId;
});
