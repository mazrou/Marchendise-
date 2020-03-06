<?php


namespace PHPMVC\controllers;
use PDO;
use PHPMVC\LIB\Helper;
class AdminController extends AbstractController
{
    use Helper;



    public function defaultAction()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
        if(isset($_POST['submit30']))
        {
            $stmt = $conn->prepare("select * from `admin` where `nom`=:nom and `password`=:password");
            $stmt->bindParam('nom', $_POST['nom'], PDO::PARAM_STR);
            $stmt->bindValue('password', $_POST['psw'], PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if($count == 1 && !empty($row)) {

                $this->redirect('/web/public/admin/main');
            }
            else{
                $this->redirect('/web/public/admin');
            }

        }


        $this->_view();
    }

    public function mainAction()
    {
        $this->_view();

    }

    public function traducteurAction()
    {$servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );

        $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block`,`nbdoc` FROM `traducteur` order by nom");
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->_data['traducteur']=$result;
        //var_dump($this->_data['traducteur']);
        //$this->_view();

        if(isset($_POST['submit105']) and isset($_POST['tree3']  ))
        {

            if($_POST['tree3']=='nbdoc')
            {
                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block`,`nbdoc` FROM `traducteur` order by nbdoc");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['traducteur']=$result;
            }
            if($_POST['tree3']=='nom'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block`,`nbdoc` FROM `traducteur` order by nom");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['traducteur']=$result;
            }

        }


        if(isset($_POST['submit106']) and isset($_POST['tree4']  ))
        {

            if($_POST['tree4']=='tradnbl')
            {
                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block`,`nbdoc` FROM `traducteur` where block=0");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['traducteur']=$result;
            }
            if($_POST['tree4']=='tradbl'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block`,`nbdoc` FROM `traducteur` where block=1");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['traducteur']=$result;
            }
            if($_POST['tree4']=='traddem'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block`,`nbdoc` FROM `traducteur` where nbdoc>0");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['traducteur']=$result;
            }
            if($_POST['tree4']=='tradndem'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block`,`nbdoc` FROM `traducteur`where nbdoc=0");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['traducteur']=$result;
            }
            if($_POST['tree4']=='tous'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block`,`nbdoc` FROM `traducteur`");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['traducteur']=$result;
            }
        }
        $this->_view();

    }

    public function clientAction()
    {$servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );



        $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`tel`,`mail`,`block`,`nbddemande` FROM `client` order by nom");
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->_data['client']=$result;

        if(isset($_POST['submit100']) and isset($_POST['tree']  ))
        {

            if($_POST['tree']=='nbddemande')
            {
                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`tel`,`mail`,`block`,`nbddemande` FROM `client` order by nbddemande");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['client']=$result;
            }
            if($_POST['tree']=='nom'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`tel`,`mail`,`block`,`nbddemande` FROM `client` order by nom");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['client']=$result;
            }

        }

        if(isset($_POST['submit101']) and isset($_POST['tree1']  ))
        {

            if($_POST['tree1']=='clinbl')
            {
                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`tel`,`mail`,`block`,`nbddemande` FROM `client` where block=0");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['client']=$result;
            }
            if($_POST['tree1']=='clibl'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`tel`,`mail`,`block`,`nbddemande` FROM `client` where block=1");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['client']=$result;
            }
            if($_POST['tree1']=='clidem'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`tel`,`mail`,`block`,`nbddemande` FROM `client` where nbddemande>0");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['client']=$result;
            }
            if($_POST['tree1']=='clindem'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`tel`,`mail`,`block`,`nbddemande` FROM `client`where nbddemande=0");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['client']=$result;
            }

            if($_POST['tree1']=='touscli'){

                $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`tel`,`mail`,`block`,`nbddemande` FROM `client`");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['client']=$result;
            }


        }

        /* foreach ($result as $row)
         {
             var_dump($row[0]."--".$row[1]."--".$row[2]."--".$row[3]);
         }*/
        $this->_view();

    }

    public function blockertraducteurAction()
    {
        $id=$this->_params[0];
        $block=$this->_params[1];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
        if($block=='1')
        {
            $stmt = $conn->prepare("UPDATE `traducteur` SET `block` = '0' WHERE `traducteur`.`id` = $id");
        }else{
            $stmt = $conn->prepare("UPDATE `traducteur` SET `block` = '1' WHERE `traducteur`.`id` = $id");
        }



        $stmt->execute();
        $this->redirect('/web/public/admin/traducteur');


    }

    public function blockerclientAction()
    {
        $id=$this->_params[0];
        $block=$this->_params[1];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
        if($block=='1')
        {
            $stmt = $conn->prepare("UPDATE `client` SET `block` = '0' WHERE `client`.`id` = $id");
        }else{
            $stmt = $conn->prepare("UPDATE `client` SET `block` = '1' WHERE `client`.`id` = $id");
        }



        $stmt->execute();
        $this->redirect('/web/public/admin/client');


    }

    public function deletetraducteurAction()
    {
        $id=$this->_params[0];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );

            $stmt = $conn->prepare("DELETE from `traducteur`  WHERE `id` = $id");
            var_dump($stmt);




        $stmt->execute();
        $this->redirect('/web/public/admin/traducteur');


    }

    public function deleteclientAction()
    {
        $id=$this->_params[0];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );

        $stmt = $conn->prepare("DELETE from `client`  WHERE `id` = $id");
        var_dump($stmt);




        $stmt->execute();
        $this->redirect('/web/public/admin/client');


    }

    public function profiltraducteurAction()
    {

        $id=$this->_params[0];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );

        $stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block` FROM `traducteur` where `id` =$id ");
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->_data['trad']=$result;


        $stmt = $conn->prepare("SELECT `nom`,`prenom`,`mail`,`langorg`,`landsource`,`fichier`,`etat`,`id`,`cliantid` FROM `demande` where `tradid` =$id ");
        $stmt->execute();
        $result2=$stmt->fetchAll();
        $this->_data['demande']=$result2;



        $this->_view();

    }

    public function profilclientAction()
    {
        $id=$this->_params[0];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );

        $stmt = $conn->prepare("SELECT  `id`,`nom`,`prenom`,`tel`,`mail` FROM `client` where `id` =$id ");
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->_data['clie']=$result;


        $stmt = $conn->prepare("SELECT `nom`,`prenom`,`mail`,`langorg`,`landsource`,`fichier`,`etat`,`id`,`tradid` FROM `demande` where `cliantid` =$id ");
        $stmt->execute();
        $result2=$stmt->fetchAll();
        $this->_data['demandeclie']=$result2;



        $this->_view();

    }

    public function modifclientAction()
    {

        $id = $this->_params[0];


        $servername = "localhost";
        $username = "root";
        $password = "";

        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME . ';port=' . DATABASE_PORT_NUMBER . ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
        if (isset($_POST['submit50'])) {

            $stmt = $conn->prepare("UPDATE `client` SET `nom`=:nom,`prenom`=:prenom,`tel`=:tel WHERE `id`=:id");

            $stmt->bindParam('nom', $_POST['nom'], PDO::PARAM_STR);
            $stmt->bindValue('prenom', $_POST['prename'], PDO::PARAM_STR);
            $stmt->bindValue('tel', $_POST['tel'], PDO::PARAM_INT);
            $stmt->bindValue('id', $id, PDO::PARAM_INT);
            $stmt->execute();






            $this->redirect('/web/public/admin/client');

        }
        $this->_view();
    }

    public function modiftraducteurAction()
    {

        $id = $this->_params[0];


        $servername = "localhost";
        $username = "root";
        $password = "";

        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME . ';port=' . DATABASE_PORT_NUMBER . ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD, array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );
        if (isset($_POST['submit500'])) {

            $stmt = $conn->prepare("UPDATE `traducteur` SET `nom`=:nom,`prenom`=:prenom,`tel`=:tel ,`fax`=:fax WHERE `id`=:id");

            $stmt->bindParam('nom', $_POST['nom'], PDO::PARAM_STR);
            $stmt->bindValue('prenom', $_POST['prename'], PDO::PARAM_STR);
            //$stmt->bindValue('lang', $_POST['lang'], PDO::PARAM_STR);
            $stmt->bindValue('tel', $_POST['tel'], PDO::PARAM_INT);
            $stmt->bindValue('fax', $_POST['fax'], PDO::PARAM_INT);
            $stmt->bindValue('id', $id, PDO::PARAM_INT);
            $stmt->execute();





            $this->redirect('/web/public/admin/traducteur');

        }
        $this->_view();
    }

    public function documentAction()
    {

        //$id=$this->_params[0];
        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );

        /*$stmt = $conn->prepare("SELECT `id`,`nom`,`prenom`,`langues`,`wilaya`,`tel`,`fax`,`mail`,`commune`,`adresse`,`block` FROM `traducteur` where `id` =$id ");
        $stmt->execute();
        $result=$stmt->fetchAll();
        $this->_data['trad']=$result;*/


        $stmt = $conn->prepare("SELECT `nom`,`prenom`,`mail`,`langorg`,`landsource`,`fichier`,`etat`,`id`,`cliantid`,`date`,`type`,`tradid` FROM `demande`");
        $stmt->execute();
        $result2=$stmt->fetchAll();
        $this->_data['demande']=$result2;

        if(isset($_POST['submit109']) and isset($_POST['tree9']  ))
        {

            if($_POST['tree9']=='date')
            {
                $stmt = $conn->prepare("SELECT `nom`,`prenom`,`mail`,`langorg`,`landsource`,`fichier`,`etat`,`id`,`cliantid`,`date`,`type`,`tradid` FROM `demande` order by `date`");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['demande']=$result;
            }


        }

        if(isset($_POST['submit1099']) and isset($_POST['tree99']  ))
        {


            if($_POST['tree99']=='docen'){

                $stmt = $conn->prepare("SELECT `nom`,`prenom`,`mail`,`langorg`,`landsource`,`fichier`,`etat`,`id`,`cliantid`,`date`,`type`,`tradid` FROM `demande` where etat='encour'");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['demande']=$result;
            }
            if($_POST['tree99']=='docte'){

                $stmt = $conn->prepare("SELECT `nom`,`prenom`,`mail`,`langorg`,`landsource`,`fichier`,`etat`,`id`,`cliantid`,`date`,`type`,`tradid` FROM `demande` where etat='terminer'");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['demande']=$result;
            }
            if($_POST['tree99']=='tous'){

                $stmt = $conn->prepare("SELECT `nom`,`prenom`,`mail`,`langorg`,`landsource`,`fichier`,`etat`,`id`,`cliantid`,`date`,`type`,`tradid` FROM `demande`");
                $stmt->execute();
                $result=$stmt->fetchAll();
                $this->_data['demande']=$result;
            }

        }


        $this->_view();


    }

    public function deletedocumentAction()
    {

        $id=$this->_params[0];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $conn = new \PDO(
            'mysql:hostname=' . DATABASE_HOST_NAME .';port='.DATABASE_PORT_NUMBER. ';dbname=' . DATABASE_DB_NAME,
            DATABASE_USER_NAME, DATABASE_PASSWORD , array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            )
        );

        $stmt = $conn->prepare("DELETE from `demande`  WHERE `id` = $id");
        //var_dump($stmt);




        $stmt->execute();
        $this->redirect('/web/public/admin/document');


    }


}