<?php

namespace PHPMVC\controllers;

session_start();
use PDO;
use PHPMVC\LIB\Helper;
use PHPMVC\Model\UserModel;

class UserController extends AbstractController
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
        /*  if(isset($_POST['submit']))
        {
        $user=new UserModel();
        $user->nom=$_POST['nom'];
        $user->prenom=$_POST['prename'];
        $user->email=$_POST['mail'];
        $user->password=$_POST['psw'];
        $user->phone=$_POST['tel'];
        if($user->save()){

        $_SESSION['message']='registred successfully';
        $this->redirect('/web/public/index');

        }
        //  var_dump($_POST);
        }
        $this->_view();*/
        if (isset($_POST['regester'])) {
            $obj = array(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['adresse'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['password'],
            );
            $traduction = new UserModel($obj, false);
            
           if($traduction->create())
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
                $_SESSION['client_id'] = $client->getID();
                $_SESSION['client_nom'] = $client->getNom();
                $_SESSION['client_prenom'] = $client->getPrenom();
                $_SESSION['client_email'] = $client->getEmail();
                $_SESSION['client_phone'] = $client->getPhone();
                $_SESSION['client_adresse'] = $client->getAdresse();

                $this->redirect('/web/public/index/client');
            } else {
                // $this->redirect('/web/public/index');
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
