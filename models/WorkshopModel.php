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
        var_dump($sql);
        $this->request = $this->connection->prepare("SELECT * FROM workshops WHERE category_id = :category_id0".$sql);
        for($i=0; $i<$nb_categories; $i++){
            $this->request->bindValue(':category_id'.$i, $_POST['category'][$i]);
        }
        $this->request->execute();
        return $this->request->fetchAll();
    }
    public function getCategories()
    {
        $this->request = $this->connection->prepare("SELECT * FROM category");
        $this->request->execute();
        return $this->request->fetchAll();
    }
}

?>