<!--PHP Header Portion-->
    
<?php require_once "vistas/parte_superior.php"?>

<style>
 th{
     background:linear-gradient(to bottom, #222121,rgb(220, 4, 20));
     color:white;
 }
 th:nth-of-type(6){
     width:77px;
 }
 tbody{

 }

</style>
<div class="container">
    <h1>Gestion des évènements organisés à l'ESTO</h1>

 <?php
require_once '../includesPhp/conn.php';

$consulter = "SELECT * FROM evenement e, departement d where ID_Professeur=:ID_Professeur AND d.ID_Departement = e.ID_Departement";
$resultatConsulter = $db->prepare($consulter);
$resultatConsulter->bindParam(':ID_Professeur',$_SESSION['ID_Professeur']);
$resultatConsulter->execute();
$data=$resultatConsulter->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnAdd" type="button" class="btn btn-success" data-toggle="modal">Ajouter un événement</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tableEvents" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th style="display:none;">ID&nbspEvènement</th>
                                <th>Nom&nbspde&nbspDépartement</th>                           
                                <th>Sujet&nbspd'évènement</th>  
                                <th>Description&nbspd'évènement</th>  
                                <th>Date&nbspdébut</th>  
                                <th>Date&nbspfin</th>
                                <th>Action</th>      
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                                     
                            foreach($data as $dat) {     
                                    
                            ?>
                            <tr class="tLine">
                                <td style="display:none;"><?php echo $dat['ID_Evenement'] ?></td>
                                <td><?php echo $dat['nomDept'] ?></td>
                                <td><?php echo $dat['sujetEvent'] ?></td>
                                <td>
                                    <?php // echo $dat['descriptionEvent']; ?>
                                    <?php if(strlen($dat['descriptionEvent']) > 40 ){ echo "<span id=\"threePoints\">".substr($dat['descriptionEvent'],0,38)."..."."</span>"; }else{ echo $dat['descriptionEvent'];  }?> <span style="display:none"><?php echo $dat['descriptionEvent'] ?></span>
                                </td> 
                                <td class="datedebut"><?php echo $dat['dateDebut']?></td>
                                <td class="datefin"><?php echo $dat['dateFin']?></td>
                                <td>
                                <div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEdit'>Modifier</button><button class='btn btn-danger btnDelete'>Supprimer</button></div></div>
                                </td>

                                <!-- <td><img class="img-profile rounded-circle" style="width: 50px"src="<?php /* echo "../../SignUpProf/php/uploads/".$dat['photoProf'] */ ?>"/></td> -->
                            </tr>
                            <?php
                            
                                }
                                
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    

<?php

$currentDate = date('Y-m-d', time());
$currentTime = date('h:i', time());




?>

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

        <form id="formEvents" name="formEvents" method="POST" action="" enctype="multipart/form-data">    
            <div class="modal-body">
                
                <div class="form-group">
                <label for="nomDept" class="col-form-label">Nom de département:</label>
                <select name="ID_Departement"  class="form-control" id="nomDept">
                    <option value="1">genie informatique</option>
                    <option value="2">genie applique</option>
                    <option value="3">management</option>
                </select>
                </div>

                <div class="form-group">
                <label for="sujetEvent" class="col-form-label">Sujet d'évènement:</label>
                <input type="text" name="sujetEvent" class="form-control" id="sujetEvent" required>
                </div>   

                <div class="form-group">
                <label for="descriptionEvent" class="col-form-label">Description:</label>
                <textarea type="text" name="descriptionEvent" class="form-control" id="descriptionEvent" required></textarea>
                </div> 

                <div class="form-group">
                <label for="photoEvent" class="col-form-label">Photo (A4):</label>
                <input type="file" name="photoEvent" accept="image/png, image/jpeg, image/jpg, image/gif" class="form-control" id="photoEvent" required>
                </div>

                <div class="form-group">
                <label for="ddEvent" class="col-form-label">Date debut:</label>
                <input type="date" name="ddEvent" class="form-control" id="ddEvent" min="<?php echo $currentDate; ?>" required><br>
                <input type="time" name="ddtEvent" class="form-control" id="ddtEvent" required>
                </div> 

                <div class="form-group">
                <label for="dfEvent" class="col-form-label">Date fin:</label>
                <input type="date" name="dfEvent" class="form-control" id="dfEvent" min="<?php echo $currentDate; ?>"  required><br>
                <input type="time" name="dftEvent" class="form-control" id="dftEvent" required>
                </div>      

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                <button type="submit" name="submit" id="btnGuardar" class="btn btn-dark">Sauvegarder</button>
            </div>

        </form>    
        </div>
    </div>
</div>  
</div>


<?php
$consulter2 = "SELECT * FROM professeur where ID_Professeur=:ID_Professeur";
$resultatConsulter2 = $db->prepare($consulter2);
$resultatConsulter2->bindParam(':ID_Professeur',$_SESSION['ID_Professeur']);
$resultatConsulter2->execute();
$data2=$resultatConsulter2->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(to bottom, #222121,rgb(169, 4, 20));" >
                <h5 class="modal-title" id="exampleModalLabel">
                     <i class="fas fa-user fa-sm fa-fw mr-2 "></i>Modification de profil
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
                    


        <form id="formEditUser" method="POST" action="" enctype="multipart/form-data">    
            <div class="modal-body">
                    <?php    
                          if(isset($_SESSION['ID_Professeur']) AND $_SESSION['ID_Professeur'] > 0):
                            $getid = intval($_SESSION['ID_Professeur']);
                            $requser = $db->prepare('SELECT * FROM professeur WHERE ID_Professeur= ?');
                            $requser->execute([$getid]);
                            $userinfo = $requser->fetch();
                      ?>
                    <div class='text-center'>
                         <img class="img-profile rounded-circle " style="margin:0 auto; width:64px;"src="<?php echo "../../SignUpProf/php/uploads/".$userinfo['photoProf']; ?>"/>
                    </div>
                    <?php endif ?>
                <?php                                 
                    foreach($data2 as $dat2) {     
                ?>
                    <div class="form-group">
                    <label for="nom" class="col-form-label">Nom:</label>
                    <input type="text" name="nom" value="<?php echo $dat2['nomProf'] ?>" class="form-control" id="nom" required>
                    </div>   

                    <div class="form-group">
                    <label for="prenom" class="col-form-label">Prenom:</label>
                    <input type="text" name="prenom" value="<?php echo $dat2['prenomProf'] ?>" class="form-control" id="prenom" required>
                    </div> 

                    <div class="form-group">
                    <label for="discipline" class="col-form-label">Discipline:</label>
                    <input type="text" name="discipline" value="<?php echo $dat2['Discipline'] ?>" class="form-control" id="discipline" required>
                    </div> 

                    <div class="form-group">
                    <label for="password" class="col-form-label">Mot de Passe:</label>
                    <input type="text" name="password" value="<?php // echo $dat2['motDePasse'] ?>" autocomplete="off" placeholder="Champ vide = Ancient mot de passe " class="form-control" id="password">
                    </div> 
                    <div class="form-group">
                    <label for="pdp" class="col-form-label">Photo De Profil:</label>
                    <input type="file" name="pdp"  accept="image/png, image/jpeg, image/jpg, image/gif" value="" class="form-control" id="pdp">
                    </div> 

                    <!--
                    <div id="success" style="color:#00dd00"><?php // if(isset($sucess)){ echo $sucess; }else{ $sucess="";}?></div>
                    <div id="error" style="color:red"><?php // if(isset($error)){ echo $error; }else{ $error="";}?></div> -->

                 <?php } ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
                <button type="submit" name="Edit" id="btnGuardar2" class="btn btn-dark">Sauvegarder</button>
            </div>

        </form>    
        </div>
    </div>
</div>
  
<!--PHP Footer Portion-->
<?php require_once "vistas/parte_inferior.php"?>