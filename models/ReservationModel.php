<?php
namespace App\models;
use App\core\Dbconnect;

class ReservationModel extends Dbconnect
{
    public function getReservations($userId)
    {
        $this->request = $this->connection->prepare("SELECT * FROM reservations r JOIN workshops w ON r.workshops_id = w.workshops_id WHERE user_id = :user_id AND w.date >= NOW() ORDER BY w.date ASC");
        $this->request->execute(['user_id' => $userId]);
        return $this->request->fetchAll();
    }

    public function getPastReservations($userId)
    {
        $this->request = $this->connection->prepare("SELECT * FROM reservations r JOIN workshops w ON r.workshops_id = w.workshops_id WHERE user_id = :user_id AND w.date < NOW() ORDER BY w.date DESC");
        $this->request->execute(['user_id' => $userId]);
        return $this->request->fetchAll();
    }
}

?>