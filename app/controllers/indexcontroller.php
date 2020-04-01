<?php
namespace PHPMVC\Controllers;

use PDO;
use PHPMVC\lib\FileUpload;
use PHPMVC\LIB\Helper;
use PHPMVC\Model\TraducteurModel;
use PHPMVC\Model\TraductionModel;

class IndexController extends AbstractController
{
    use Helper;
    private $conn;
    protected $_data2 = array();
    public function defaultAction()
    {

        if (isset($_SESSION)) {
            // var_dump($_SESSION);
            $_SESSION['sess_user_id'] = "";
            $_SESSION['sess_user_name'] = "";
            $_SESSION['sess_prenom'] = "";
            $_SESSION['sess_email'] = "";
            $_SESSION['sess_errormsg'] = "";
        }

        $this->_view();
    }

    public function clientAction()
    {

        session_start();
        $result = TraducteurModel::getAll();
        foreach ($result as $row) {
            array_push($this->_data, $row);
        }
        $result2 = TraducteurModel::getAllLangue();
        foreach ($result2 as $row) {
            array_push($this->_data2, $row);
        }

        if (isset($_POST['submit9'])) {

            $file = (new FileUpload($_FILES['file'], $_SESSION['client_id']))->upload();
            $fichier = $file->getFileName();
            $obj = array($_SESSION['client_id'],
                $_POST['traducteur'],
                $_POST['type'],
                $_POST['langue_fichier'],
                $_POST['langue_traduction'],
                $fichier,
            );

            try {

                $traduction = new TraductionModel($obj, false);
                $traduction->create();
                $this->redirect('/web2/public/index/client');

            } catch (\Exception $e) {

                echo 'Message ' . $e->getMessage();
            }
        }

        $this->_view();
    }

}
