<?php 
namespace App\Models;
use App\core\Dbconnect;
class AdminModel extends Dbconnect
{
    public function getAllWorkshops()
    {
        $this->request = $this->connection->prepare("SELECT w.*,w.capacity-COUNT(r.reservations_id) as capacity_left FROM workshops w LEFT JOIN reservations r ON w.workshops_id = r.workshops_id GROUP BY w.workshops_id");
        $this->request->execute();
        return $this->request->fetchAll();
    }

    public function getReservations()
    {
        $this->request = $this->connection->prepare("SELECT * FROM reservations");
        $this->request->execute();
        return $this->request->fetchAll();
    }
}

?>