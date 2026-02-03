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
            header('Location: index.php?controller=auth&action=login');
        }else{
            $workshopModel = new WorkshopModel();
            $workshopModel->booking($id);
            $this->render('workshop/booking_confirmation', ['workshop_id' => $id]);
        }
    }
}

?>