<?php
namespace App\entities;
class Reservation
{
    private int $user_id;
    private int $room_id;

    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function getRoomId(): int
    {
        return $this->room_id;
    }
    public function setRoomId(int $room_id): void
    {
        $this->room_id = $room_id;
    }
}

?>