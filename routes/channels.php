<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat-app', function ($user, $id) {
    return true;
});
