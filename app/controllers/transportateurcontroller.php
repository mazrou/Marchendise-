<?php

namespace PHPMVC\controllers;

session_start();

use PHPMVC\LIB\Helper;
use PHPMVC\Model\TransportateurModel;
use PHPMVC\Model\TraductionModel;
use PHPMVC\Model\UserModel;

class TransportateurController extends AbstractController
{

    use Helper;


    public function connexionAction()
    {
        if (isset($_POST['login'])) {
            $result = TransportateurModel::authenticate($_POST['email'], $_POST['password']);
            if ($result) {
                $transportateur = new TransportateurModel($result);
                $_SESSION['Transportateur'] = [$transportateur];
                $this->redirect('/web/public/index');
            } else {
                $this->redirect('/web/public/transportateur/connexion');
            }
        }
        $this->_view();
    }

    public function defaultAction()
    {
        $user = UserModel::getAll();
        foreach ($user as $us) {
            var_dump($us);
        }
        $this->_view();
    }

   /* public function addAction()
    {
        if (isset($_POST['regester'])) {
            $obj = array(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['adresse'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['password'],
            );
            $transportateur = new TransportateurModel($obj, false);
            $transportateur->create();
            $this->redirect('/web/public/');

        }
        $this->_view();

    }
    */

    public function loginAction()
    {

        $rows = TraductionModel::getByTraducteur((int) $_SESSION['sess_traducteur_id']);
        foreach ($rows as $row) {
            array_push($this->_data, new TransportateurModel($row));
        }
        if (isset($_POST['logout'])) {
            $this->redirect('/web/public/index');
        }

        $this->_view();
    }

    
}
