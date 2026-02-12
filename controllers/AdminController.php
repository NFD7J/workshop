<?php
namespace App\Controllers;
use App\models\AdminModel;
use App\entities\Workshop;
class AdminController extends Controller
{
    /********* workshops *********/
    public function index()
    {
        $workshopsModel = new AdminModel();
        $Workshops = $workshopsModel->getAllWorkshops();
        $this->render('admin/workshops', ['workshops' => $Workshops]);
    }

    public function addWorkshop()
    {
        if(isset($_POST['title'], $_POST['description'], $_POST['datetime'], $_POST['category'], $_POST['capacity'])) {
            if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['datetime']) && !empty($_POST['category']) && !empty($_POST['capacity'])) {
                
                $workshop = new Workshop();
                $workshop->setTitle(htmlspecialchars($_POST['title']));
                $workshop->setDescription(htmlspecialchars($_POST['description']));
                $workshop->setDate(htmlspecialchars($_POST['datetime']));
                $workshop->setCategoryId(intval($_POST['category']));
                $workshop->setCapacity(intval($_POST['capacity']));  
                if(isset($_FILES['image'])){
                    $uploadFile = '../views/images/' . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
                    $workshop->setImage($_FILES['image']['name']);
                }else{
                    $workshop->setImage("");
                }
                
                $workshopsModel = new AdminModel();
                $workshopsModel->addWorkshop($workshop);
                header('Location: index.php?controller=admin');
                exit();
            }else{
                header('Location: index.php?controller=admin&action=addWorkshop');
                exit();
            }
        }else{
            $workshopsModel = new AdminModel();
            $categories = $workshopsModel->getCategories();
            $this->render('admin/workshopAdd', ['categories' => $categories]);
        }
    }

    public function editWorkshop($get)
    {
        
        if(isset($_POST['title'], $_POST['description'], $_POST['datetime'], $_POST['category'], $_POST['capacity'], $_POST['id'])) {
            $id = $_POST['id'];
            if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['datetime']) && !empty($_POST['category']) && !empty($_POST['capacity'])) {
                
                $workshop = new Workshop();
                $workshop->setTitle(htmlspecialchars($_POST['title']));
                $workshop->setDescription(htmlspecialchars($_POST['description']));
                $workshop->setDate(htmlspecialchars($_POST['datetime']));
                $workshop->setCategoryId(intval($_POST['category']));
                $workshop->setCapacity(intval($_POST['capacity']));
                if(isset($_FILES['image'])){
                    $uploadFile = '../views/images/' . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
                    $workshop->setImage($_FILES['image']['name']);
                }else{
                    $workshop->setImage("");
                }

                $workshopsModel = new AdminModel();
                $workshopsModel->editWorkshop($id, $workshop);
                
                header('Location: index.php?controller=admin');
                exit();
            }else{

                header('Location: index.php?controller=admin&action=editWorkshop&id=' . $id);
                exit();
            }
        } else {
            $id = $get['id'];
            $workshopsModel = new AdminModel();
            $workshop = $workshopsModel->getWorkshop($id);
            $categories = $workshopsModel->getCategories();
            $this->render('admin/workshopEdit', ['workshop' => $workshop, 'categories' => $categories]);
        }
    }

    public function deleteWorkshop($get)
    {
        $id = $get['id'];
        if(isset($_POST["true"])){
            $workshopModel = new AdminModel();
            $workshopModel->deleteWorkshop($_POST['id']);
            header("location: index.php?controller=admin");
        }elseif(isset($_POST["false"])){
            header("location: index.php?controller=admin&action=editWorkshop&id=" . $_POST['id']);
        }else{
            $this->render("admin/workshopDelete", ['id' => $id]);
        }   
    }

    /********* reservations *********/
    public function reservation()
    {
        $reservationsModel = new AdminModel();
        $reservations = $reservationsModel->getAllReservations();
        $this->render('admin/reservations', ['reservations' => $reservations]);
    }

    public function deleteReservation($get)
    {
        $id = $get['id'];
        if(isset($_POST["true"])){
            $reservationModel = new AdminModel();
            $reservationModel->deleteReservation($_POST['id']);
            header("location: index.php?controller=admin&action=reservation");
        }elseif(isset($_POST["false"])){
            header("location: index.php?controller=admin&action=reservation");
        }else{
            $this->render("admin/reservationDelete", ['id' => $id]);
        }   
    }

    /********* categories *********/
    public function category()
    {
        $categoriesModel = new AdminModel();
        $categories = $categoriesModel->getAllCategories();
        $this->render('admin/category', ['categories' => $categories]);
    }

    public function getCategory($get)
    {
        $id = $get['id'];
        $categoriesModel = new AdminModel();
        $category = $categoriesModel->getCategory($id);
        echo json_encode($category);
    }

    public function addCategory()
    {
        if(isset($_POST['title'])) {
            if(!empty($_POST['title'])) {
                
                $categoriesModel = new AdminModel();
                $id = $categoriesModel->addCategory(htmlspecialchars($_POST['title']));
                echo json_encode(['category' => $id]);
            }else{
                header('Location: index.php?controller=admin&action=category');
                exit();
            }
        }else{
            $this->render('admin/categoryAdd');
        }
    }

    public function editCategory($get)
    {
        
        if(isset($_POST['title'], $_POST['id'])) {
            $id = $_POST['id'];
            if(!empty($_POST['title'])) {
                
                $categoriesModel = new AdminModel();
                $categoriesModel->editCategory($id, htmlspecialchars($_POST['title']));
                echo json_encode(['category_id' => $id, 'libelle' => htmlspecialchars($_POST['title'])]);
                
            }else{

            }
        } else {
            $id = $get['id'];
            $categoriesModel = new AdminModel();
            $category = $categoriesModel->getCategory($id);
            $this->render('admin/categoryEdit', ['category' => $category]);
        }
    }

    public function deleteCategory($get)
    {
        $id = $get['id'];
        if(isset($_POST["true"])){
            $categoryModel = new AdminModel();
            $categoryModel->deleteCategory($id);
            header("location: index.php?controller=admin&action=category");
        }elseif(isset($_POST["false"])){
            header("location: index.php?controller=admin&action=category");
        }else{
            $this->render("admin/categoryDelete", ['id' => $id]);
        }   

    }
}

?>