
<head>
    <title>Traduili</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/style.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/fontawesome.min.css" rel="stylesheet" type="text/css"/>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>





    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.12.4%20min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/jquery-3.4.1.slim.min.js"></script>
<script src="js/main.js"></script>
<style type="text/css">
    <?php
require "css/style.css";
require "css/bootstrap.min.css";
require "css/fontawesome.min.css";
//include "css/style.css";

?>

</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav bg-primary">
      <a class="nav-item nav-link active" href="/web/public/">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="#">Blog</a>
      <a class="nav-item nav-link" href="/web/public/traducteur/add">Recrutement</a>
      <a class="nav-item nav-link " href="/web/public/traducteur/list">Liste de traducteur</a>
      <div style="margin-left:1300px">
      <a href="#" class="fa fa-facebook"></a>
      <a href="#" class="fa fa-instagram"></a>
      <a href="#" class="fa fa-youtube"></a>
      </div>
    </div>
  </div>
</nav>


<!--<div  id="socialContainer" style="background:#7fd414;" >

    <div id="socialDiv" >
        <ul id="socialIcons">
            <li><a href="#" class="fa fa-facebook"></a></li>
            <li><a href="#" class="fa fa-twitter"></a></li>
            <li><a href="#" class="fa fa-instagram"></a></li>
            <li><a href="#" class="fa fa-reddit"></a></li>
            <li><a href="#" class="fa fa-linkedin"></a></li>

        </ul>

    </div>
    <h2 id="titel1">ITARD</h2>


</div>


<div id="tesst">
    <div id="navbar" style="    background-color: #577359;">
        <a class="active" href="/web/public/">Home</a>
        <a href="javascript:void(0)">News</a>
        <a href="/web/public/user/modif">modifier profile</a>

    </div>
</div>


-->





<br/><br/><br/><br/>
<br/><br/><br/><br/>
<div id='divre' >



        <form class="modal-content animate" method="post" enctype="multipart/form-data">

            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>


            </div>

            <div class="container">
                <label for="nom"><b>Nom</b></label>
                <input type="text" value=<?php echo $_SESSION['client_nom'] ?> name="nom" required>

                <label for="prenom"><b>Prenom</b></label>
                <input type="text" value=<?php echo $_SESSION['client_prenom'] ?> name="prenom" required>

                <label for="mail"><b>Mail</b></label>
                <input type="text" value=<?php echo $_SESSION['client_email'] ?> name="email"  pattern=".+@*.com" required>

                <label for="tel"><b>Tel</b></label>
                <input type="text" value=<?php echo $_SESSION['client_phone'] ?> name="phone" required>

                <label for="adresse"><b>Adresse</b></label>
                <input type="text" value=<?php echo $_SESSION['client_adresse'] ?> name="adresse" required>

                <label for="lang origine"><b>lang origine</b></label>
                <select name="langue_fichier" style="width:100%; height:35%;">
                             <?php foreach ($this->_data2 as $langue) {?>
                        <option value=<?php echo $langue['id_langue'] ?>><?php echo $langue['name_langue'] ?></option>
                        <?php
}
?>
                </select>

                <label for="lang source"><b>lang source</b></label>
                <select name="langue_traduction" style="width:100%; height:35%;">
                        <?php foreach ($this->_data2 as $langue) {?>
                        <option value=<?php echo $langue['id_langue'] ?>><?php echo $langue['name_langue'] ?></option>
                        <?php
}
?>
                </select>

                <label for="type trad"><b>type trad</b></label>
                <select name="type" style="width:100%; height:35%;">
                    <option value="3">generale</option>
                    <option value="2">scientifique</option>
                    <option value="1">site web</option>
                </select>

                <label for="type tradeur"><b>traducteur assermenter</b></label>
                <select name="typetradeur" style="width:100%; height:35%;">
                    <option value="oui">oui</option>
                    <option value="non">non</option>
                </select>

                <label for="file"><b>ajouter fichier</b></label>
                <input type="file" name="file" style="width:100%; height:35%;" required>

                <label for="traducteur"><b>traducteur</b></label>
                <select name="traducteur" style="width:100%; height:35%;">
                    <?php
                         foreach ($this->_data as $traducteur) {?>
                        <option value=<?php echo $traducteur->getID(); ?>><?php echo $traducteur->getNom() . ' ' . $traducteur->getPrenom() . '  langues :  ( ' . $traducteur->getLanguesString() . ' )' ?></option>
                        <?php
}
?>
                </select>
<br/><br/>
                <button type="submit" name="submit9" value="save">envoyer</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>











            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>

</div>


<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<?php

include "read-more-panel.php";
include "read-more-panel.php";
?>
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!-- Footer -->
<!-- Footer-->
<section id="footer" style="float: right;width: 100%">
    <div class="container"style="align-content: center">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
                </ul>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p><u><a href="https://www.nationaltransaction.com/">National Transaction Corporation</a></u> is a Registered MSP/ISO of Elavon, Inc. Georgia [a wholly owned subsidiary of U.S. Bancorp, Minneapolis, MN]</p>
                <p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank">Sunlimetech</a></p>
            </div>
            </hr>
        </div>

</section>

<!-- ./Footer -->



<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->




<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->
<!--Accordion wrapper-------------------------------------------------------------------------------------------------------->




<script>

        (function()
        {
            var langorigine = document.querySelector('input[name=langorigine]');

            if(null !== langorigine) {
                langorigine.addEventListener('blur', function()
                {
                    var req = new XMLHttpRequest();
                    console.log("mm");
                    req.open('POST', 'http://localhost/web/public/index/chectradajax');
                    req.send("langorigine"+this.value);
                    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');



                   // req.send("Username=" + this.value);
                }, false);
            }
        })();



    /*
    window.onscroll = function() {myFunction()};

    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;

    function myFunction() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
      } else {
        navbar.classList.remove("sticky");
      }
    }*/
    /* function myFunction() {
var dots = document.getElementById("dots");
var moreText = document.getElementById("more");
var btnText = document.getElementById("myBtn");

if (dots.style.display == "none" ) {
dots.style.display = "inline";
btnText.innerHTML = "Read more";
moreText.style.display = "none";
} else {
dots.style.display = "none";
btnText.innerHTML = "Read less";
moreText.style.display = "inline";
}
}         */

</script>







</body>