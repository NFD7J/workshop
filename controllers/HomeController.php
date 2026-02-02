<?php
namespace App\controllers;
use App\models\HomeModel;
class HomeController extends Controller
{
    public function index()
    {
        $events = new HomeModel();
        $events = $events->getUpcomingEvents();
        $this->render('home/index', ['events' => $events]);
    }
}
