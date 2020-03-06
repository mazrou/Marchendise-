 <title>Traduili</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/fontawesome.min.css" rel="stylesheet" type="text/css"/>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



<style type="text/css">
    <?php
  require "css/style.css";
    require "css/bootstrap.min.css";
    require "css/fontawesome.min.css";
  //include "css/style.css";

  ?>

</style>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<div  id="socialContainer" style="background:#7fd414;" >

    <div id="socialDiv"  >
        <ul id="socialIcons">
            <li><a href="#" class="fa fa-facebook"></a></li>
            <li><a href="#" class="fa fa-twitter"></a></li>
            <li><a href="#" class="fa fa-instagram"></a></li>
            <li><a href="#" class="fa fa-reddit"></a></li>
            <li><a href="#" class="fa fa-linkedin"></a></li>

        </ul>

    </div>
    <h2 id="titel1">Traduili</h2>


</div>


<div id="tesst">
    <div id="navbar" style="    background-color: #577359;">
        <a href="javascript:void(0)">type de traduction</a>
        <a href="/web/public/traducteur/list">liste des traducteurs</a>
        <a href="javascript:void(0)">blog</a>
        <a href="/web/public/traducteur/add">recrutement</a>
        <a href="javascript:void(0)">à propos</a>
        <a class="active" href="/web/public/">accueil</a>





    </div>


    </div>



</div>





    </div>
</div>
<h2 style="margin-left:300px; margin-top:150px;"> La  liste de notre traducteurs</h2>
<table  class="table table-striped table-bordered" style="width:70% ; margin:auto; margin-top: 100px">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Langues</th>
            </tr>
        </thead>
        <tbody>
            <?php
             

             foreach($this->_data as $traducteur){

               ?>
            <tr>
                <td><?php echo $traducteur->getNom() ?></td>
                <td><?php echo $traducteur->getPrenom()?></td>
                <td><?php echo $traducteur->getAdresse()?></td>
                <td><?php echo $traducteur->getEmail() ?></td>
                <td><?php echo $traducteur->getPhone() ?></td>
                <td><?php 
                    $langues = '';
                    foreach ($traducteur->getLangues() as $langue) {
                    $langues .= $langue . ', ';
                     }
                      echo $langues;
 ?></td>
            </tr>
            <?php }?>
        <tfoot>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Langues</th>
            </tr>
        </tfoot>
    </table>

