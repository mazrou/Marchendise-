<?php

namespace PHPMVC\controllers;

use PDO;
use PHPMVC\LIB\Helper;
use PHPMVC\Model\AdminModel;
use PHPMVC\Model\TransportateurModel;
use PHPMVC\Model\TrajetModel;
use PHPMVC\Model\UserModel;
use PHPMVC\Model\MarchendiseModel;


class AdminController extends AbstractController
{
    use Helper;

    public function defaultAction()
    {
        if ($_POST['login']) {
            $result = AdminModel::authenticate($_POST['email'], $_POST['password']);
            if ($result) {
                $this->redirect('/web2/public/admin/main');
            } else {
                $this->redirect('/web2/public/admin/');
            }

        }

        $this->_view();
    }
    public function addAction()
    {

        if ($_POST["add"]) {
            $obj = array(
                $_POST["nom"] . " " . $_POST["prenom"],
                $_POST["addresse"],
                $_POST["phone"],
                $_POST["email"],
                $_POST["mot_de_passe"],
            );
             var_dump($obj);

            $transportateur = new TransportateurModel($obj, false);
            var_dump($transportateur);

            if ($transportateur->create()) {
                  $this->redirect('/web2/public/admin/main');

            }
        }
        $this->_view();
    }

    public function mainAction()
    {
        $this->_view();
    }

    public function clientAction()
    {   
        $this->_data["clients"] = UserModel::getAll();
        $this->_view();
    }

    public function transportateurAction(){
        $this->_data["transportateurs"] = TransportateurModel :: getAll();
        $this->_view();
    }

   public function marchAction(){
       
       $this->_data["marchendise"] = MarchendiseModel :: getMarchendise();
        $this->_view();
    }
    public function blockerclientAction()
    {
       

    }

    public function deletetraducteurAction()
    {

    }

    public function deleteclientAction()
    {
    }

    public function profiltraducteurAction()
    {

    }

    public function profilclientAction()
    {
    

    }

    public function modifclientAction()
    {


        $this->_view();
    }

    public function modiftraducteurAction()
    {
    }
    

    public function documentAction()
    {
        $this->_data["trajet"] = TrajetModel::getTrajet();

        $this->_view();

    }

    public function deletedocumentAction()
    {


    }

}
