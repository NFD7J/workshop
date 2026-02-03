<?php
namespace App\models;
use App\core\Dbconnect;

class WorkshopModel extends Dbconnect
{
    public function getAllWorkshops()
    {
        $this->request = $this->connection->prepare("SELECT * FROM workshops");
        $this->request->execute();
        return $this->request->fetchAll();
    }
    public function getAllWorkshopsFiltered()
    {
        $nb_categories = count($_POST['category']);
        $sql ="";
        for($i=1; $i<$nb_categories; $i++){
            $sql .= " OR category_id = :category_id".$i;
        }
        $this->request = $this->connection->prepare("SELECT * FROM workshops WHERE category_id = :category_id0".$sql);
        for($i=0; $i<$nb_categories; $i++){
            $this->request->bindValue(':category_id'.$i, $_POST['category'][$i]);
        }
        $this->request->execute();
        return $this->request->fetchAll();
    }

    public function getWorkshop($id)
    {
        $this->request = $this->connection->prepare("SELECT * FROM workshops WHERE workshops_id = :id");
        $this->request->execute([':id' => $id]);
        $workshop = $this->request->fetch();
        $workshop->available = $this->AvailableSeats($workshop->capacity, $id);
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

    private function AvailableSeats($capacity, $id)
    {
        $this->request = $this->connection->prepare("SELECT COUNT(*) as available FROM reservations WHERE workshops_id = :id");
        $this->request->execute([':id' => $id]);
        $result = $this->request->fetch();
        return $capacity - $result->available;
    }
}

?>