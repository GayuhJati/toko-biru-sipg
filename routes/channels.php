<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat-room.{roomId}', function ($user = null, $roomId) {
     // Jika room-public, izinkan semua user (termasuk guest)
     if ($roomId === 'room-guest') {
          return true;
     }

     // Untuk room private, harus user login
     // dan roomId harus sesuai dengan user id (room-123 untuk user.id = 123)
     if ($user) {
          $userRoomId = 'room-' . $user->id;
          return $userRoomId === $roomId;
     }


     return false;
});

Broadcast::channel('presence-chat-room.room-{id}', function ($user, $id) {
     return ['id' => $user->id, 'name' => $user->name];
});
