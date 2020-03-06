

<style type="text/css">

    /*inscription*/

    body {font-family: Arial, Helvetica, sans-serif;}

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 10px 10px;
        margin: 1px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    /* Set a style for all buttons */
    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 4px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
        width: auto;
        padding: 10px 18px;
        background-color: #f44336;
    }

    /* Center the image and position the close button */
    .imgcontainer {
        text-align: center;
        margin: 5px 0 12px 0;
        position: relative;
    }

    img.avatar {
        width: 40%;
        border-radius: 50%;
    }

    .container {
        padding: 16px;
    }

    span.psw {
        float: right;
        padding-top: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 2px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 50%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)}
        to {-webkit-transform: scale(1)}
    }

    @keyframes animatezoom {
        from {transform: scale(0)}
        to {transform: scale(1)}
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
    }

    .modal-content {


        width: 80%!important;
        padding-top: 1px!important;
    }






</style>


<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">modifier</button>

<div id="id01" class="modal">

    <form class="modal-content animate" action="" method="post">

        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

        </div>

        <div class="container">
            <label for="nom"><b>Nom</b></label>
            <input type="text" placeholder="Enter nom" name="nom" required value=<?php echo $this->_params[1]; ?> >

            <label for="prenom"><b>Prenom</b></label>
            <input type="text" placeholder="Enter Prenom" name="prename" required value=<?php echo $this->_params[2]; ?>>


            <label for="lang"><b>lang</b></label>
            <input type="text" placeholder="Enter Tel"    name="lang" required value=<?php echo $this->_params[3]; ?>>

            <label for="tel"><b>tel</b></label>
            <input type="text" placeholder="Enter nom" name="tel" required value=<?php echo '0'.$this->_params[4]; ?> >

            <label for="fax"><b>fax</b></label>
            <input type="text" placeholder="Enter Prenom" name="fax" required value=<?php echo '0'.$this->_params[5]; ?>>


            <button type="submit" name="submit500" value="save">modifier</button>

        </div>


    </form>
</div>

<br/><br/><br/>
<div style="display: inline-flex;width: 100%" >
    <button   style="width:10%;margin-left: 15px;margin-right: 15px ;"><a style="color: #f7f5fe" href= "/web/public/admin/traducteur"> retour</a></button>
</div>