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
}

?>