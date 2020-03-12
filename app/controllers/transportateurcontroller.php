<?php

namespace PHPMVC\controllers;

session_start();

use PHPMVC\LIB\Helper;
use PHPMVC\Model\TrajetModel;
use PHPMVC\Model\TransportateurModel;
use PHPMVC\Model\MarchendiseModel;

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
                //var_dump($transportateur);
                $this->redirect('/web/public/transportateur');
            } else {
                $this->redirect('/web/public/transportateur/connexion');
            }
        }
        $this->_view();
    }

    public function defaultAction()
    {
    
        if ($_POST["ajouter"]) {
            $obj = array(
                $_POST['lieu-depart2'],
                $_POST['lieu-arrive'],
                $_POST['arret'],
                $_POST['date-depart'],
                $_POST['date-arrive'],
                $_POST['nb-kilomettre'],
                $_POST['volume'] . $_POST['cat-volum'],
                $_POST['poid'] . $_POST['cat-poid'],
                $_POST['regulier'],
                $_POST['date-retoure'],
                $_POST['frq'] . $_POST['frequen'],
                $_POST['date-voyage'],
                $_POST['moyen'],
                $_POST['devis'],
                $_SESSION['Transportateur'][0]->getId(),
                false,
            );
           if($_POST["submit1"]){
               
           }
     
            $trajet = new TrajetModel($obj, false);
           
            if ($trajet->create()) {
               $this->redirect('/web/public/transportateur');
            }

        }
        $this->_data['marchendise'] = MarchendiseModel::getMarchendise();
        $this->_data['trajet'] = $_SESSION['Transportateur'][0]->getTrajet();
    

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
