<?php
namespace App\models;
use App\core\Dbconnect;

class WorkshopModel extends Dbconnect
{
    public function getAllWorkshops()
    {
        $this->request = $this->connection->prepare("SELECT w.*,w.capacity-COUNT(r.reservations_id) as capacity_left FROM workshops w LEFT JOIN reservations r ON w.workshops_id = r.workshops_id GROUP BY w.workshops_id");
        $this->request->execute();
        return $this->request->fetchAll();
    }
    public function getAllWorkshopsFiltered($categories)
    {
        $nb_categories = count($categories);
        if($nb_categories == 0){
            return $this->getAllWorkshops();
        }
        $sql ="";
        for($i=1; $i<$nb_categories; $i++){
            $sql .= " OR category_id = :category_id".$i;
        }
        $this->request = $this->connection->prepare("SELECT w.*,w.capacity-COUNT(r.reservations_id) as capacity_left FROM workshops w LEFT JOIN reservations r ON w.workshops_id = r.workshops_id WHERE category_id = :category_id0".$sql." GROUP BY w.workshops_id");
        for($i=0; $i<$nb_categories; $i++){
            $this->request->bindValue(':category_id'.$i, $categories[$i]);
        }
        $this->request->execute();
        return $this->request->fetchAll();
    }

    public function getWorkshop($id)
    {
        $this->request = $this->connection->prepare("SELECT w.*,w.capacity-COUNT(r.reservations_id) as capacity_left FROM workshops w LEFT JOIN reservations r ON w.workshops_id = r.workshops_id WHERE w.workshops_id = :id GROUP BY w.workshops_id");
        $this->request->execute([':id' => $id]);
        $workshop = $this->request->fetch();
        $workshop->available = $this->available($id);
        return $workshop;
    }

    public function getCategories()
    {
        $this->request = $this->connection->prepare("SELECT * FROM category");
        $this->request->execute();
        return $this->request->fetchAll();
    }

    public function booking($id)
    {
        var_dump($_SESSION);
        $this->request = $this->connection->prepare("INSERT INTO reservations (workshops_id, user_id) VALUES (:id, :user_id)");
        $this->request->execute([
            ':id' => $id,
            ':user_id' => $_SESSION['user']['id']
        ]);
    }
    private function available($id)
    {
        $this->request = $this->connection->prepare("SELECT w.capacity-COUNT(r.reservations_id) as capacity_left FROM workshops w LEFT JOIN reservations r ON w.workshops_id = r.workshops_id WHERE w.workshops_id = :id GROUP BY w.workshops_id");
        $this->request->execute([':id' => $id]);
        $seats = $this->request->fetch();
        return $seats->capacity_left;
    }
    
}

?>