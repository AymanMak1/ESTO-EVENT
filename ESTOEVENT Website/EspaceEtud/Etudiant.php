<?php
ob_start();
require_once 'includesPhp/conn.php';
session_start();
if($_SESSION["ID_Etudiant"] === null){
  header("Location: ../SignUpEtud/LoginEtud.php");
}
if(isset($_SESSION['ID_Etudiant']) AND $_SESSION['ID_Etudiant'] > 0):
   $getid = intval($_SESSION['ID_Etudiant']);
   $requser = $db->prepare('SELECT * FROM etudiant WHERE ID_Etudiant= ?');
   $requser->execute([$getid]);
   $userinfo = $requser->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Location" content="Etudiant.php">
    <title>Espace Etudiant</title>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="./css/all.css">

    <!-- --------- Owl-Carousel ------------------->
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    
    <!-- ------------ AOS Library ------------------------- -->
    <link rel="stylesheet" href="./css/aos.css">

    <!-- Custom Style   -->
    <link rel="stylesheet" href="./css/style2.css">

    <!-- SweetAlert -->
    <script src="js/sweetalert2.all.min.js"></script>
    <style media="screen">


    </style>
    


</head>

<body>

<!-- ----------------------------  Navigation ---------------------------------------------- -->

  <div id="content">

    <span class="slide">
      <a href="#" onclick="openSlideMenu()">
        <i class="fas fa-bars burgerMenu"></i>
      </a>
    </span>

    <div id="menu" class="navigation">
      <a href="#" class="close" onclick="closeSlideMenu()">
        <i class="fas fa-times"></i>
      </a>
        <a href="#" style="color:#B90415">ESTO EVENT</a>
        <a href="#">A PROPOS</a>
        <a href="#listEvents">EVENEMENTS</a>
        <div id="profil">
              <div id="dropClick" onclick="dropDownMenu()">
                  <i class="fas fa-users-cog" style="margin-right:10px;"></i><span id="nomPrenomEtud"><?php  echo $userinfo['nomEtud'].' ' . $userinfo['prenomEtud'];?></span>
              </div>    
              <div id="dropdownMenu" style="">
                <a href="#"  onclick="EditProfil()" style="font-size:16px; padding: 20px;">
                  <i class="fas fa-cogs"></i> Modification de profil
                </a>
              <a href="#" onclick="logoutModal()" style="font-size:16px; padding: 0 20px 20px 20px;">
                  <i class="fas fa-sign-out-alt"></i>Se déconnecter
              </a>
              </div>
    </div>
  </div>
  <script>
        function dropDownMenu() {

      }
  </script>

  <form action="./php/editProfil.php" method="POST" name="editProfilForm" id="editProfilModal"></form>
  <div class="modal" id="modal">
  <div class="modal__dialog">
    <section class="modal__content" style="width:450px;">
      <header class="modal__header">
        <h2 class="modal__title">Modification de profil</h2>
        <a href="#" class="modal__close" onclick="CloseModal()">  <i class="fas fa-times closemodal" style="margin-left:16px;"></i></a>
      </header>
      <div class="modal__body">
          <input type="text" id="nom" placeholder="Nom" name="nom" value="<?php  echo $userinfo['nomEtud'] ?>" required>
                
          <input type="text" id="prenom" placeholder="Prenom" name="prenom" value="<?php echo $userinfo['prenomEtud']; ?>" required>

          <input type="password" id="password" placeholder="champ vide = ancien mot de passe" name="password">  

      </div>
      <footer class="modal__footer">
          <input type="submit" id="editProfilSubmit" value="Confirmer" class="update">
      </footer>
    </section>
  </div>
</div>


    <!-- ------------x---------------  Navigation --------------------------x------------------- -->

    <!----------------------------- Main Site Section ------------------------------>

    <main>

        <!------------------------ Site Title ---------------------->

        <section class="site-title" id="slider">
            <!--iv class="darkOverlay"></div-->
            <div class="site-background" data-aos="fade-up" data-aos-delay="100">
              <div id="showcase">
              <div class="section-main container">
                <img src="assets/Logo.svg" alt="LogoESTOEVENT" id="logo">
                <h1 class="LogoText"> <span>E</span>STO <span>E</span>VENT.</h1>
                <h2>Notre université, nos événements.</h2>
                <p class="lead hide-on-small" style="color:white;">
                     Voici votre espace cher étudiant,vous allez pouvoir retrouver tous les événements de l'École Supérieure de Technologie d'Oujda ici 
                     listés de façon dynamique pour pouvoir vous y repérez.
                     Vous attendez quoi? Faite défiler maintenant les événements, peut être  qu'il y aura un ou plusieurs qui vont intéressez !
                </p>
              </div>
            </div>
            </div>
        </section>

        <!----------x----------- Site Title ----------x----------->

        <!-- --------------------- Blog Carousel ----------------- -->
     
        <section id="listEvents" class="listEvents">
            <div class="blog">
                <div class="container" >
                    <div class="owl-carousel owl-theme blog-post">

                    <?php
                      $consulter = "SELECT * FROM evenement e, departement d where d.ID_Departement = e.ID_Departement";
                      $resultatConsulter = $db->prepare($consulter);
                      $resultatConsulter->execute();
                      $data=$resultatConsulter->fetchAll(PDO::FETCH_ASSOC);

                      foreach($data as $event){
                      
                    ?>
                        <div class="blog-content" data-aos="fade-right" data-aos-delay="200">
                           <a href="<?php echo "../uploadsEvents/".$event['photoEvent'] ?>"><img src=<?php echo "../uploadsEvents/".$event['photoEvent'] ?> alt="post-1"></a> 
                            <div class="blog-title">

                                <div class="IDEvent"><?php // echo $event['ID_Evenement'] ?></div>
                                <h3><?php echo $event['sujetEvent']; ?></h3>
                                  <span class="EventDescription">
                                      <?php echo $event['descriptionEvent'] ?><br>
                                       <span style="font-weight:bold;">Département : <?php echo $event['nomDept']; ?></span> 
                                    </span>
                                    <!--   -->
                                <button class="btn btn-blog"> 
                                        Status : <?php
                                            $status="";
                                             if(strtotime($event['dateFin']) <= strtotime(date("d-m-Y h:i")) ) {
                                                $status="terminé";
                                                echo $status;
                                              } else{
                                                $status="ouvert";
                                                echo $status;
                                              } 
                                         ?>
                                </button>
                                <button class="btn btn-blog">Date Debut : <?php echo $event['dateDebut']; ?></button><br>
                                <button class="btn btn-blog">Date Fin : <?php echo $event['dateFin']; ?></button><br>

                                <?php
                             
                                  $queryFetchInscription = "SELECT inscris FROM inscription WHERE ID_Etudiant =:ID_Etudiant AND ID_Evenement =:ID_Evenement";
                                  $stmtFetchInscription= $db->prepare($queryFetchInscription);
                                  $stmtFetchInscription->bindParam(":ID_Etudiant",$_SESSION['ID_Etudiant'],PDO::PARAM_INT);
                                  $stmtFetchInscription->bindParam(":ID_Evenement",$event['ID_Evenement'],PDO::PARAM_INT);
                                  $stmtFetchInscription->execute();
                                  $inscrisBool= $stmtFetchInscription->fetch();
                                  $inscrisValue = $inscrisBool['inscris'];
                                  //$count = $stmtFetchInscription->rowCount();
                                  if($status == "ouvert"  && $inscrisValue == 0){ 
                                  ?>

                                  <a href="Etudiant.php?inscrisEvent=<?php echo $event['ID_Evenement'] ?>&ID_Etudiant=<?php echo $_SESSION['ID_Etudiant']?>">
                                    <button class="btn btn-blog inscris" value="<?php echo $event['ID_Evenement'] ?>"> S'inscrire </button> </a>
                                  <?php } require_once 'php/InscrisEvent.php'; ?>
                                  
                                  <?php if($inscrisValue == 1 ){ ?>
                                    <a href="Etudiant.php?desinscrisEvent=<?php echo $event['ID_Evenement'] ?>&ID_Etudiant=<?php echo $_SESSION['ID_Etudiant']?>">
                                    <button class="btn btn-blog inscris desinscris"  value="<?php echo $event['ID_Evenement'] ?>">désinscrire</button></a>
                                  <?php } require_once 'php/desinscrisEvent.php'; ?>
                            </div>

                        </div>
                      <?php }  ?>
                    </div>

                    <div class="owl-navigation">
                        <span class="owl-nav-prev"><i class="fas fa-long-arrow-alt-left"></i></span>
                        <span class="owl-nav-next"><i class="fas fa-long-arrow-alt-right"></i></span>
                    </div>

                    
                </div>
            </div>
        </section>
      

        <!-- ----------x---------- Blog Carousel --------x-------- -->

          <!-- Footer -->
          <footer id="footer" >
            <div class="container">
              <div class="footer-cols">
                <ul>
                  <li>ESTO EVENT</li>
                  <li>
                      <p style="color:#d7d7d7;">Un site web intranet pour la gestion et l'organisation des événements de l'ESTO,
                         ce site web facilite la tâche de consultation aux étudiants et permet aux professeurs de bien contrôler
                         le déroulement de chaque événement</p>
                  </li>
                </ul>


                <ul>
                  <li>Social Media</li>
                  <li>
                    <i class="fab fa-facebook-f"></i> <a href="#" style="color:#d7d7d7;">FaceBook</a>
                  </li>
                  <li>
                    <i class="fab fa-instagram"></i><a href="#" style="color:#d7d7d7;">Instagram</a> 
                  </li>
                  <li>
                    <i class="fab fa-twitter"></i> <a href="#" style="color:#d7d7d7;">Twitter</a>
                  </li>
                </ul>

                <ul>
                  <li>Contact</li>
                  <li>
                    <i class="fas fa-phone" ></i>05365-00224
                  </li>
                  <li>
                    <i class="fas fa-map-marked-alt"  ></i> Address: BP 473 Complexe universitaire Al Qods, Oujda 60000
                  </li>
                </ul>
              </div>
            </div>
            <div class="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3282.218623806503!2d-1.8995964845613624!3d34.64918129348298!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd787cbd8186f0b7%3A0x5226a42c88c53d39!2sEcole%20Sup%C3%A9rieure%20de%20Technologie%2C%20Oujda!5e0!3m2!1sen!2sma!4v1579819079404!5m2!1sen!2sma" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
          </div>
            <div class="footer-bottom text-center" style="text-align:center">
              Copyright &copy; 2020 ESTO EVENT | AM-NWA
            </div>
          </footer>


    <!-- -------------x------------- Footer --------------------x------------------- -->

    <!-- Jquery Library file -->
    <script src="./js/Jquery3.4.1.min.js"></script>
   
    <!-- --------- Owl-Carousel js ------------------->
    <script src="./js/owl.carousel.min.js"></script>

    <!-- ------------ AOS js Library  ------------------------- -->
    <script src="./js/aos.js"></script>

    <!-- Custom Javascript file -->
    <script src="./js/main.js"></script>
    <script src="./js/editProfil.js"></script>


    <script>

        var i = 0;
        var images = [];
        var time = 5000;

        //images list

        images[0] = 'assets/j.jpeg';
        images[1] = 'assets/v.jpg';
        images[2] = 'assets/s.jpg';
        images[3] = 'assets/e.jpeg';
        document.querySelector("main .site-title").style.backgroundImage="url("+images[0]+")"; 
       // images[4] = 'assets/construction3.jpg';
        function autoslider() {    
            document.querySelector("section#slider").style.transition = "2s";
            if (i < images.length-1) {
                i++;        
                document.querySelector("main .site-title").style.backgroundImage="url("+images[i]+")";
                document.querySelector("section#slider").style.transition = "2s";
                console.log(images[i]);
            } else {
                i = 0;
                document.querySelector("main .site-title").style.backgroundImage="url("+images[i]+")";
                document.querySelector("section#slider").style.transition = "2s";
                console.log(images[i]);
            }
            setTimeout("autoslider()", time);
        }
      
        autoslider();


    </script>
<style>

 @media screen and (max-width: 500px) {
  .modal__dialog{
    margin-right:70px;
  }
} 
</style>
</body>
</html>
<?php
endif
?>