<?php 
namespace App\Models;
use App\core\Dbconnect;
use App\Entities\Workshop;
class AdminModel extends Dbconnect
{
    /********* workshops *********/
    public function getAllWorkshops()
    {
        $this->request = $this->connection->prepare("SELECT w.*,w.capacity-COUNT(r.reservations_id) as capacity_left FROM workshops w LEFT JOIN reservations r ON w.workshops_id = r.workshops_id GROUP BY w.workshops_id");
        $this->request->execute();
        return $this->request->fetchAll();
    }

    public function getWorkshop($id)
    {
        $this->request = $this->connection->prepare("SELECT * FROM workshops WHERE workshops_id = :id");
        $this->request->bindValue(':id', $id);
        $this->request->execute();
        return $this->request->fetch();
    }

    public function getCategories()
    {
        $this->request = $this->connection->prepare("SELECT * FROM category");
        $this->request->execute();
        return $this->request->fetchAll();
    }

    public function addWorkshop(Workshop $workshop)
    {
        $sql = !empty($workshop->getImage()) ? "INSERT INTO workshops (title, description, date, category_id, capacity, image) VALUES (:title, :description, :date, :category_id, :capacity, :image)" : "INSERT INTO workshops (title, description, date, category_id, capacity) VALUES (:title, :description, :date, :category_id, :capacity)";
        $this->request = $this->connection->prepare($sql);
        $this->request->bindValue(':title', $workshop->getTitle());
        $this->request->bindValue(':description', $workshop->getDescription());
        $this->request->bindValue(':date', $workshop->getDate());
        $this->request->bindValue(':category_id', $workshop->getCategoryId());
        $this->request->bindValue(':capacity', $workshop->getCapacity());
        !empty($workshop->getImage()) ? $this->request->bindValue(':image', $workshop->getImage()) : "";
        return $this->request->execute();
    }

    public function editWorkshop($id, Workshop $workshop)
    {
        $sql = !empty($workshop->getImage()) ? "UPDATE workshops SET title = :title, description = :description, date = :date, category_id = :category_id, capacity = :capacity, image = :image WHERE workshops_id = :id" : "UPDATE workshops SET title = :title, description = :description, date = :date, category_id = :category_id, capacity = :capacity WHERE workshops_id = :id";
        $this->request = $this->connection->prepare($sql);
        $this->request->bindValue(':title', $workshop->getTitle());
        $this->request->bindValue(':description', $workshop->getDescription());
        $this->request->bindValue(':date', $workshop->getDate());
        $this->request->bindValue(':category_id', $workshop->getCategoryId());
        $this->request->bindValue(':capacity', $workshop->getCapacity());
        $this->request->bindValue(':id', $id);
        !empty($workshop->getImage()) ? $this->request->bindValue(':image', $workshop->getImage()) : "";
        return $this->request->execute();
    }

    public function deleteWorkshop($id)
    {
        $this->request = $this->connection->prepare("DELETE FROM workshops WHERE workshops_id = :id");
        $this->request->bindValue(':id', $id);
        return $this->request->execute();
    }

    /********* reservations *********/
    public function getAllReservations()
    {
        $this->request = $this->connection->prepare("SELECT r.reservations_id,u.name,u.email,w.* FROM reservations r LEFT JOIN users u ON r.user_id = u.user_id JOIN workshops w ON r.workshops_id = w.workshops_id");
        $this->request->execute();
        return $this->request->fetchAll();
    }

    public function deleteReservation($id)
    {
        $this->request = $this->connection->prepare("DELETE FROM reservations WHERE reservations_id = :id");
        $this->request->bindValue(':id', $id);
        return $this->request->execute();
    }
}

?>