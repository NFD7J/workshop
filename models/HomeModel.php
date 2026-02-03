<?php
namespace App\models;

use App\core\Dbconnect;

class HomeModel extends Dbconnect
{
    public function getUpcomingEvents()
    {
        $this->request = $this->connection->prepare("SELECT * FROM workshops WHERE date >= CURDATE() ORDER BY date ASC LIMIT 3");
        $this->request->execute();
        return $this->request->fetchAll();
    }
}
?>