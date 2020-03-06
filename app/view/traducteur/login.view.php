<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
  <title>Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1><?php  echo $_SESSION['Traducteur'][0]->getNom().' '. $_SESSION['Traducteur'][0]->getPrenom()?></h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->


      <div class="text-center">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a different photo...</h6>
        <input type="file" class="text-center center-block file-upload">
      </div></hr><br>


          <div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="#">Traduili.com</a></div>
          </div>


          <ul class="list-group">
            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
             <li class="list-group-item text-right"><form method="post"><button type="submit" name="logout" class="btn btn-secondary">Logout</form></button></li>
          </ul>

        
        </div><!--/col-3-->
    	<div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                <li><a data-toggle="tab" href="#messages">Demmandes de traduction</a></li>
                <li><a data-toggle="tab" href="#settings">Mes traductions</a></li>
              </ul>


          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="first_name"><h4>Nom</h4></label>
                              <input type="text" class="form-control" name="nom" id="first_name" placeholder="Entre votre nom" title="enter your first name if any."
                              Value = <?php echo $_SESSION['Traducteur'][0]->getNom(); ?> >
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                            <label for="last_name"><h4>Prenom</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any."
                              Value = <?php echo $_SESSION['Traducteur'][0]->getPrenom(); ?>>
                          </div>
                      </div>

                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="phone"><h4>Phone</h4></label>
                              <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any."
                              Value = <?php echo $_SESSION['Traducteur'][0]->getPhone(); ?>>
                          </div>
                      </div>

                      <div class="form-group">

                          <div class="col-xs-6">
                             <label for="mobile"><h4>Langues</h4></label>
                              <input type="text" class="form-control" name="langues" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any."
                                Value = <?php
                                    $langues = '';
                                    foreach ($_SESSION['Traducteur'][0]->getLangues() as $langue) {
                                        $langues .= $langue . ',';
                                    }
                                    echo $langues;
                                    ?>>
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email."
                              value = <?php
                                        echo $_SESSION['Traducteur'][0]->getEmail()
                                        ?>>
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="adresse"><h4>Adresse</h4></label>
                              <input type="adresse" class="form-control" id="location" placeholder="somewhere" title="enter a location" name ="adresse"
                              value = <?php
                                        echo $_SESSION['Traducteur'][0]->getAdresse()
                                        ?>>
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password."
                              value ="" >
                          </div>
                      </div>
                      <div class="form-group">

                          <div class="col-xs-6">
                            <label for="password2"><h4>Verify</h4></label>
                              <input type="password" class="form-control" name="verify" id="verify" placeholder="confirm" title="enter your password2." required>
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit" id ="save"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                      </div>
              	</form>

              <hr>

             </div><!--/tab-pane-->
           
             <div class="tab-pane" id="messages">
                     
               <h2>Les demmanes du traduction </h2>

               <hr>
                  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nom du client</th>
                <th>Fichier</th>
                <th>Type</th>
                <th>Date de remise</th>
                <th>Date du fin</th>
                <th>Prix Istimer</th>
                <th>Reponse</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->_data  as $traduction){
                if($traduction->getEtat()== 'Demmande traduction') {?>
                

            <tr>
                <td><?php echo $traduction->getClient()->getNom().' '. $traduction->getClient()->getPrenom()?></td>
                <td><?php  echo $traduction->getFichier() ?></td>
                <td><?php echo $traduction->getType() ?></td>
                <td><?php echo $traduction->getDateDebut() ?></td>
                <td>  <input type='date' class="form-control " /></td>
                <td>  <input type='number' class="form-control " /> </td>
                <td><i class="glyphicon glyphicon-ok"></i>
                     <i class="glyphicon glyphicon-remove">
                </td>
            </tr>
            <?php  }}?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nom du client</th>
                <th>Fichier</th>
                <th>Type</th>
                <th>Date de remise</th>
                <th>Date du fin</th>
                <th>Prix</th>
                <th>Reponse</th>
            </tr>
        </tfoot>
    </table>

             </div><!--/tab-pane-->
             <div class="tab-pane" id="settings">

   
             <div class="tab-pane" id="messages">
                     
               <h2>Les demmanes du traduction </h2>

               <hr>
                  <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nom du client</th>
                <th>Fichier</th>
                <th>Type</th>
                <th>Date de remise</th>
                <th>Date du fin</th>
                <th>Prix Istimer</th>
                <th>Reponse</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->_data  as $traduction){
            ?>
                

            <tr>
                <td><?php echo $traduction->getClient()->getNom().' '. $traduction->getClient()->getPrenom()?></td>
                <td><?php  echo $traduction->getFichier() ?></td>
                <td><?php echo $traduction->getType() ?></td>
                <td><?php echo $traduction->getDateDebut() ?></td>
                <td>  <input type='date' class="form-control " /></td>
                <td>  <input type='number' class="form-control " /> </td>
                <td><i class="glyphicon glyphicon-ok"></i>
                     <i class="glyphicon glyphicon-remove">
                </td>
            </tr>
            <?php  }?>
        </tbody>
        <tfoot>
            <tr>
                <th>Nom du client</th>
                <th>Fichier</th>
                <th>Type</th>
                <th>Date de remise</th>
                <th>Date du fin</th>
                <th>Prix</th>
                <th>Reponse</th>
            </tr>
        </tfoot>
    </table>

             </div><!--/tab-pane-->

              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row--->
    <script>
      $("#save").click(function(){
            
            if($("#password").val() != $("#verify").val()){
                alert ('Les mots de passe ne sont pas identiques');
            }
            });
    </script>