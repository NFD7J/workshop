<?php
namespace App\controllers;
use App\models\ReservationModel;

class ReservationController extends Controller
{
    public function index()
    {
        $reservationsModel = new ReservationModel();
        $reservations = $reservationsModel->getReservations($_SESSION['user']['id']);
        $pastReservations = $reservationsModel->getPastReservations($_SESSION['user']['id']);
        $this->render('reservation/index', ['reservations' => $reservations, 'pastReservations' => $pastReservations]);
    }
}

?>