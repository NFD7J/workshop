<?php
namespace App\models;

use App\core\Dbconnect;

class HomeModel extends Dbconnect
{
    public function getUpcomingEvents()
    {
        $this->request = $this->connection->prepare("SELECT w.*,w.capacity-COUNT(r.reservations_id) as capacity_left FROM workshops w LEFT JOIN reservations r ON w.workshops_id = r.workshops_id WHERE w.date >= CURDATE() GROUP BY w.workshops_id ORDER BY w.date ASC LIMIT 3");
        $this->request->execute();
        return $this->request->fetchAll();
    }
}
?>