<?php

namespace PHPMVC\controllers;

session_start();
use PDO;
use PHPMVC\LIB\Helper;
use PHPMVC\Model\MarchendiseModel;
use PHPMVC\Model\UserModel;

class UserController extends AbstractController
{

    use Helper;
    public function defaultAction()
    {
        if(isset($_POST["ajouter"])){
           $obj = array(
               $_POST["discription"],
               $_POST["lieu-depart"],
               $_POST["lieu-arrive"],
               $_POST["photos"],
               $_POST["demmande-speaciale"],
               $_POST["volume"].$_POST["cat-volum"],
               $_POST["poid"].$_POST["cat-poid"],
               $_SESSION["client"][0]->getId(),
               $_POST["date-depart"],
               $_POST["date-arrive"],
              
           );
           $marchendise = new MarchendiseModel($obj, false) ; 

           if($marchendise->create()){
             
           }
        }
        $this->_view();
    }

    public function addAction()
    {
        if (isset($_POST['regester'])) {
            $obj = array(
                $_POST['nom']." ".$_POST['prenom'],
                $_POST['adresse'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['password'],
            );
            $client = new UserModel($obj, false);
          
            if($client->create())
                $this->redirect('/web/public/');
        }
        $this->_view();

    }

    public function connexionAction()
    {

        if (isset($_POST['login'])) {

            $result = UserModel::authenticate($_POST['email'], $_POST['password']);
            if ($result) {
                $client = new UserModel($result);
                $_SESSION['client'] = [$client];   
                $this->redirect('/web/public/user');
            } else {
                 $this->redirect('/web/public/user/connexion');
            }
        }
        $this->_view();
    }

    public function modifAction()
    {
        session_start();

        $id = $_SESSION['sess_user_id'];

        $servername = "localhost";
        $username = "root";
        $password = "";

        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME . ';port=' . DATABASE_PORT_NUMBER . ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            )
        );
        if (isset($_POST['submit5'])) {

            $stmt = $conn->prepare("UPDATE `client` SET `nom`=:nom,`prenom`=:prenom,`password`=:password,`tel`=:tel,`mail`=:email WHERE `id`=:id");
            $stmt->bindParam('email', $_POST['mail'], PDO::PARAM_STR);
            $stmt->bindValue('password', $_POST['psw'], PDO::PARAM_STR);
            $stmt->bindParam('nom', $_POST['nom'], PDO::PARAM_STR);
            $stmt->bindValue('prenom', $_POST['prename'], PDO::PARAM_STR);
            $stmt->bindValue('tel', $_POST['tel'], PDO::PARAM_INT);
            $stmt->bindValue('id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->redirect('/web/public/index/login');

        }
        $this->_view();
    }

}
