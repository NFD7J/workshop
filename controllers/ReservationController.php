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
    public function delete($get)
    {
        $id = $get['id'];
        if (isset($_POST['true'])) {
            $reservationModel = new ReservationModel();
            $reservationModel->deleteReservation($_POST['id']);
            header('Location: index.php?controller=reservation');
            exit();
        } elseif (isset($_POST['false'])) {
            header('Location: index.php?controller=reservation');
            exit();
        }else{
            $this->render('reservation/delete', ['id' => $id]);
        }
    }
}

?>