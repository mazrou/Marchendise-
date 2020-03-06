<?php

namespace PHPMVC\controllers;

session_start();
use PDO;
use PHPMVC\LIB\Helper;
use PHPMVC\Model\TraducteurModel;
use PHPMVC\Model\TraductionModel;
use PHPMVC\Model\UserModel;

class TraducteurController extends AbstractController
{

    use Helper;
    public function defaultAction()
    {
        $user = UserModel::getAll();
        foreach ($user as $us) {
            var_dump($us);
        }
        $this->_view();
    }

    public function addAction()
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
            $traduction = new TraducteurModel($obj, false);
            $traduction->create();
            $this->redirect('/web/public/');

        }
        $this->_view();

    }

    public function loginAction()
    {

        $rows = TraductionModel::getByTraducteur((int) $_SESSION['sess_traducteur_id']);
        foreach ($rows as $row) {
            array_push($this->_data, new TraductionModel($row));

        }
        if (isset($_POST['logout'])) {
            $this->redirect('/web/public/index');
        }

        $this->_view();
    }

    public function listAction()
    {
        session_start();
        //$id = $_SESSION['sess_user_id'];
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME . ';port=' . DATABASE_PORT_NUMBER . ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            )
        );

        $stmt = $conn->prepare("SELECT * FROM `traducteur`");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $this->_data = [];
        foreach ($result as $row) {
            array_push($this->_data, new TraducteurModel($row));

        }

        $this->_view();

    }

    public function connexionAction()
    {
        
        if (isset($_POST['login'])) {
            $result = TraducteurModel::authenticate($_POST['email'], $_POST['password']);
            if ($result) {
                $traducteur = new TraducteurModel($result);
                $_SESSION['Traducteur'] = [$traducteur];
                $this->redirect('/web/public/traducteur/login');
            } else {
                $this->redirect('/web/public/index');
            }
        }
        $this->_view();
    }

    public function devisAction()
    {
        session_start();
        //$id = $_SESSION['sess_user_id'];
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME . ';port=' . DATABASE_PORT_NUMBER . ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            )
        );

        $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom` FROM `traducteur`");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            //var_dump($row[0] . "--" . $row[1] . "--" . $row[2] . "--");
        }
        $this->_view();

    }

}
