<?php
namespace App\Controllers;
use App\models\AdminModel;
class AdminController extends Controller
{
    public function index()
    {
        $workshopsModel = new AdminModel();
        $Workshops = $workshopsModel->getAllWorkshops();
        $this->render('admin/workshops', ['workshops' => $Workshops]);
    }

    public function reservation()
    {
        $reservationsModel = new AdminModel();
        $Reservations = $reservationsModel->getReservations();
        $this->render('admin/reservations', ['reservations' => $Reservations]);
    }
}

?>