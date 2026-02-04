<?php
namespace App\controllers;
use App\models\WorkshopModel;
class WorkshopController extends Controller
{
    public function index()
    {
        $workshop = new WorkshopModel();
        
        $categories = $workshop->getCategories();
        if(isset($_POST['category'])){
            $workshops = $workshop->getAllWorkshopsFiltered();
        }else{
            $workshops = $workshop->getAllWorkshops();
        }
        $this->render('workshop/index', ['workshops' => $workshops, 'categories' => $categories]);
    }
    public function show($get)
    {
        $id = intval($get['id']);
        $workshopModel = new WorkshopModel();
        $workshop = $workshopModel->getWorkshop($id);
        $this->render('workshop/show',['workshop' => $workshop]);
    }

    public function booking($get)
    {
        $id = intval($get['id']);
        
        if(!isset($_SESSION['user'])){
            header('Location: index.php?controller=auth');
        }else{
            if(isset($_POST['true'])){
                $workshopModel = new WorkshopModel();
                $workshopModel->booking($id);
                header('Location: index.php?controller=reservation');
            }elseif(isset($_POST['false'])){
                header('Location: index.php?controller=workshop&action=show&id='.$id);
            }else{
                $this->render('workshop/booking');
                return;
            }
        }
    }
}

?>