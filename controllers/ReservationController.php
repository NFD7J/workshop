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
    public function delete()
    {
        $id = $_POST['id'];
        $reservationModel = new ReservationModel();
        $reservationModel->deleteReservation($id);
        $json = ["id" => $id];
        echo json_encode($json);
    }
}

?>