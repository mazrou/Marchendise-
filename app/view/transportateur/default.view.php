<!DOCTYPE html>
<?php  session_start();?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>User profile  - Bootsnipp.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>

<hr>
<div class="container bootstrap snippet">
    <div class="row">
  		<div class="col-sm-10"><h1><?php echo $_SESSION['Transportateur'][0]->getNom(); ?></h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src=""></a></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
          <ul class="list-group">
            <li class="list-group-item text-muted">Profil</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Nom</strong></span> <?php echo $_SESSION['Transportateur'][0]->getNom();?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> <?php echo $_SESSION['Transportateur'][0]->getEmail();?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Telephone</strong></span> <?php echo $_SESSION['Transportateur'][0]->getTelephone()?></li>
             <li class="list-group-item text-right"><span class="pull-left"><strong>Adresse</strong></span> <?php echo $_SESSION['Transportateur'][0]->getAddresse()?></li>
            
          </ul> 
          <ul class="list-group">
              <li class="list-group-item text-right"><span class="pull-left"><strong>Allergie</strong></span> <button>edit</button><div class="expandable form-group text-center" style="margin-top:30px; width:100%" data-count="1">
        <div class="row">
    	    <input name="name[]" type="text" id="name[]"  placeholder="Allergia">
		    <button class="btn add-more" id="add-more" type="button">+</button>
	    </div>
    </div></li>
           
            
          </ul> 
               
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
          
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#home" data-toggle="tab">Mes trajets</a></li>
            <li><a href="#messages" data-toggle="tab">Les marchnedises</a></li>
            <li><a href="#settings" data-toggle="tab">Les reponses</a></li>
          </ul>
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Moyen</th>
                      <th>lieu du depart</th>
                      <th>date de depart</th>
                      <th>lieu d'arrive</th>
                      <th>date arrive</th>
                      <th>Devis</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="items">
    
                     <?php 
                     foreach ($this->_data["trajet"] as $march) {
                      echo '<tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle ">
                      <td>' . $march->getMoyenTranspor() . '</td>
                      <td>' . $march->getLieuDepart() . '</td>
                      <td>' . $march->getDateDepart() . '</td>
                      <td>' . $march->getLieuArrive() . '</td>
                      <td>' . $march->getDateArrive() . '</td>
                      <td>' . $march->getDevis() . '</td>
                      <td><button type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></button></td>
                      <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                    </tr>
                    ';
                     }?>
                
                    <tr>
            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo1"> 
            <form method="POST" name="ajoutr-marchendise"> 
            <table class="table table-striped">
                  <h1>Declarer un trajet</h1>
                      
                     <tbody>
					<tr id='addr0'>
						<td>
						
						</td>
            
						<td>
            	<input type="text" name='lieu-depart2' placeholder="Lieu depart " class="form-control"/>
						<input type="text" name='lieu-arrive' placeholder="Lieu d'arrive " class="form-control"/>
						</td>
						<td>
						<textarea type="text" name='arret'  placeholder='lieux d’arrêts entre le départ et l’arrivée' class="form-control"></textarea>
						</td>
					
          </tr>
          <tr id='addr3'>
						<td>
						
						</td>
						<td>
              <label for ="date1">Date de depart</label>
						<input type="date" id="date1" name='date-depart' placeholder='date du depart' class="form-control"/>
					 </td>
						<td>
              <label for ="date2">Date d'arrive</label>
						<input type="date" id ="date2"name='date-arrive' placeholder="date d'arrive" class="form-control"/>
            </td>
            <td>
              <label for ="nbkilo">Nombre de kilometre</label>
						<input type="number" id="nbkilo" name='nb-kilomettre' placeholder="nombre de kilomettre" class="form-control"/>
						</td>
					</tr>
          <tr id='addr1'>
            <td>
               <label for ="vol">Volume maximale</label>
						<input type="number" id ="vol" name='volume' placeholder='Volume ' class="form-control"/>
            </td>
            <td>
						<select name="cat-volum">
                <option value="m³">m³</option>     
           </select>
            </td>
            <td>
              <label for ="poid">Poid maximale</label>
						<input type="number" name='poid' placeholder='Poid en kg' class="form-control"/>
            </td>
            <td>
              
						<select name="cat-poid" >
                <option value="kg" >kg</option>     
           </select></td>
          </tr>
           <tr id='addr1'>
            <td>
               <label for ="vol">Voyage regulier</label>
               	<select name="regulier">
                   <option value="0">NON</option>   
                    <option value="1">OUI</option>   
               </select>
          </td>
          <td>
            
              <label for ="date3">Date de retoure</label>
						<input type="date" id ="date2"name='date-retoure'  class="form-control"/>
          </td>
          <td>
               <label for ="number">frequence de voyage</label>
						<input type="number" id ="date2"name='frq'  class="form-control"/>
          </td>
          <td>
               	<select name="frequen">
                   <option value="sem">Par semaine</option>   
                    <option value="moi">Par mois</option>   
                    <option value="jour">Par jour</option>   
               </select>
          </td>
          
          </tr>
          <tr>
            <td>
            
              <label for ="date4">Date de Voyage</label>
						<input type="date" id ="date4"name='date-voyage'  class="form-control"/>
          </td>
            <td>
              <label >Moyen de transport</label>
               <input type="text" id ="date4"name='moyen'  class="form-control"/></td>
                <label >Devis</label>
             	<input type="number" id ="date4"name='devis'  class="form-control"/></td>
       
          </tr>
          
             
				</tbody>
				
                 </table>

               	<a id="add_row" class="btn btn-default pull-left">Annuler</a><input type="submit" value="Ajouter" name="ajouter" class="pull-right btn btn-default">
              </form>      
              </div> </td>
        </tr>
                    
     </tbody>                  
              </table>
                <hr>
               <div class="row">
                  <div class="col-md-6 col-md-offset-4 text-center">
                  	<ul class="pagination" id="myPager"></ul>
                  </div>
                </div>
              </div><!--/table-resp-->
              
              
              
              <hr>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="messages">
               
               <h2></h2>
               
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                  
  
                  <tr>
                      <th>Description</th>
                      <th>Lieu depart</th>
                      <th>date depart</th>
                      <th>Lieu arrive</th>
                      <th>Date arrive</th>
                      <th>tarif</th>
                    </tr>
                  </thead>
                  <tbody id="items">
                    <form method="POST">

                  
                    <?php 
                   
                    foreach ($this->_data['marchendise'] as $march) {
                      echo '<tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle ">
                      <td>' . $march->getDescription() . '</td>
                      <td>' . $march->getLieuDepart() . '</td>
                      <td>' . $march->getDateArrive() . '</td>
                      <td>' . $march->getLieuArrive() . '</td>
                      <td>' . $march->getDateDepart() . '</td>
                      <td> <input type="text" class="form-control" name="tarif" placeholder="tarif" title="Inserisci il nome"></td>
                      <td><button name="submit1" type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></button></td>
                      <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                    </tr>
                    ';
}?>

                      
                    </tr>
                      </form>
                  </tbody>
                </table>
                </div>
               
             </div><!--/tab-pane-->
             <div class="tab-pane" id="settings">
            		
               	
                  <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Nome</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="nome" title="Inserisci il nome">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Cognome</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Cognome" title="Inserisci il cognome">
                          </div>
                      </div>
          
                      
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Telefono</h4></label>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="inserisci il numero di telefono" title="inserisci il numero di telefono">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="tua@email.it" title="Inserisci l'email">
                          </div>
                      </div>
                      
                      
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                              	<button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Salva</button>
                               	<button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Ripristina</button>
                            </div>
                      </div>
              	</form>
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
                               </hr>
<script type="text/javascript">
        $(document).ready(function() {
          $(".expandable").on("click", ".add-more", function(e) {
            e.preventDefault();
            var rmButton = '<button class="btn btn-danger remove-me" type="button">-</button>';
            var grandParent = $(this).parent().parent();
            var countVal = grandParent.data("count");
            var count = parseInt(countVal);
            if (count == 1) {
              $(this).before(rmButton);
            }
            var toBeCopied = $(this).parent().clone();
            if (count == 1) { 
                var curClass = toBeCopied.find("input").attr('class');
                toBeCopied.find("input:first").attr('class', curClass + " offset-md-3");
                toBeCopied.find("label").remove();

            }
            var add_button = $(this).detach();
            grandParent.append(toBeCopied);
            count++;
            grandParent.data("count", count);
          });
          $(".expandable").on("click", ".remove-me", function(e) {
            e.preventDefault();
            var grandParent = $(this).parent().parent();
            var countVal = grandParent.data("count");
            count = parseInt(countVal);
            count--;
            grandParent.data("count", count);

            var nextButton = $(this).next("button");
            var prevButton = $(this).parent().prev().find("button");

            //When we click remove on the last entry:
            if (/add-more/.test(nextButton.attr("class")) && /remove-me/.test(prevButton.attr("class"))) {
              var add_button = nextButton.detach();
              $(this).parent().prev().find(".remove-me").after(add_button);
            }
            //When we click on the first entry:
            if ($(this).parent().children().is("label")) {
                secondEntry=$(this).parent().next().find("input");
                secondEntry.removeClass("offset-md-3");
                secondEntry.before($(this).parent().find("label"));
            }
            if (count == 1) {
              $(this).parent().prev().find(".remove-me").remove();
              $(this).parent().next().find(".remove-me").remove();
            }
            $(this).parent().remove();
          });


        });
        
        
        
        
             $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input name='name"+i+"' type='text' placeholder='Name' class='form-control input-md'  /> </td><td><input  name='mail"+i+"' type='text' placeholder='Mail'  class='form-control input-md'></td><td><input  name='mobile"+i+"' type='text' placeholder='Mobile'  class='form-control input-md'></td>");

      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});

</script>
</body>
</html>