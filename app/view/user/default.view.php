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
  		<div class="col-sm-10"><h1><?php echo $_SESSION['client'][0]->getNom(); ?></h1></div>
    	<div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src=""></a></div>
    </div>
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
          <ul class="list-group">
            <li class="list-group-item text-muted">Profil</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Nom</strong></span> <?php echo $_SESSION['client'][0]->getNom();?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> <?php echo $_SESSION['client'][0]->getEmail();?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Telephone</strong></span> <?php echo $_SESSION['client'][0]->getTelephone()?></li>
             <li class="list-group-item text-right"><span class="pull-left"><strong>Adresse</strong></span> <?php echo $_SESSION['client'][0]->getAdresse()?></li>
            
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
            <li class="active"><a href="#home" data-toggle="tab">Ultimo Trattamento</a></li>
            <li><a href="#messages" data-toggle="tab">Ajouter une marchendise</a></li>
            <li><a href="#settings" data-toggle="tab">Modifica utente</a></li>
          </ul>
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Trattamento</th>
                      <th>Prodotti utilizzati</th>
                      <th>Colori utilizzati</th>
                      <th>Note</th>
                      <th>Modifica</th>
                    </tr>
                  </thead>
                  <tbody id="items">
                    <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle ">
                      <td>10.05.2017</td>
                      <td>MASSAGGIO schiena</td>
                      <td>usato loreal</td>
                      <td>colore rosso</td>
                      <td>il cliente preferisce il verde</td>
                      <td><button type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></button></td>
                      <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                    </tr>
                    
                    <tr>
            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo1"> 
            <form method="POST" name="ajoutr-marchendise"> 
            <table class="table table-striped">
                  <h1>Ajouter une marchendise</h1>
                      
                     <tbody>
					<tr id='addr0'>
						<td>
						
						</td>
						<td>
						<textarea type="text" name='discription'  placeholder='discription' class="form-control"></textarea>
						</td>
						<td>
						<input type="text" name='lieu-depart' placeholder='Lieu du depart' class="form-control"/>
						</td>
						<td>
						<input type="text" name='lieu-arrive' placeholder="Lieu d'arrive " class="form-control"/>
						</td>
          </tr>
          <tr id='addr3'>
						<td>
						
						</td>
						<td>
						<input type="date" name='date-depart' placeholder='date du depart' class="form-control"/>
					 </td>
						<td>
						<input type="date" name='date-arrive' placeholder="date d'arrive" class="form-control"/>
						</td>
					</tr>
          <tr id='addr1'>
            <td>
						<input type="number" name='volume' placeholder='Volume ' class="form-control"/>
            </td>
            <td>
						<select name="cat-volum">
                <option value="m³">m³</option>     
           </select>
            </td>
            <td>
						<input type="number" name='poid' placeholder='Poid en kg' class="form-control"/>
            </td>
            <td>
						<select name="cat-poid">
                <option value="kg" >kg</option>     
           </select></td>
          </tr>
          <tr>
            <td>
              <textarea type = "text" name = "demmande-speaciale" placeholder="demande speciale" class="form-control"></textarea>
            </td>
            <td>
              <label for="mesimage">Ajouter des photos</label>
              <input type="file" id="mesimages" name="photos">
            </td>
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
                      <th>Data</th>
                      <th>Servizio</th>
                      <th>Modifica</th>
                    </tr>
                  </thead>
                  <tbody id="items">
                    <tr>
                      <td>10.05.2017</td>
                      <td>MASSAGGIO schiena</td>
                     
                      <td><button type="button" data-toggle="modal" data-target="#edit" data-uid="1" class="update btn btn-warning btn-sm"><span class="glyphicon glyphicon-pencil"></span></button></td>
                      
                      
                    </tr>
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