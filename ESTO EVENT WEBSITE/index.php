<?php
require_once 'SignUpProf/includesPhp/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ"
    crossorigin="anonymous">
  <link rel="shortcut icon" type="image/x-icon" href="Logo.ico">
  <link rel="stylesheet" href="Accueil/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap" rel="stylesheet"> 
  <title>Welcome to ESTO EVENT</title>
  <style>
  
    @-moz-document url-prefix(){
      #showcase header nav.cf ul.cf li.hide-on-small > a{
      margin-top:-16px;
      height:56px;
    }
    #showcase header nav.cf ul.cf li > a.BigA{
      width:160px;
    }
    }
    @media screen and (max-width:580px) {
      #showcase header nav.cf ul.cf li > a.BigA{
      width:100%;
    }
    }
  </style>
</head>

<body>
  <!-- Showcase & Nav -->
  <div id="showcase">
    <header>
      <nav class='cf'>
        <ul class='cf'>
          <li class="hide-on-small">
            <a href="#showcase"><img src="" alt="">ESTOEVENT</a>
          </li>
          <li>
            <a href='SignUpEtud/LoginEtud.php'>Espace Etudiant</a>
          </li>
          <li>
            <a href='SignUpProf/LoginProf.php' class="BigA">Espace Professeur</a>
          </li>
          <li>
            <a href='#A-propos'>À propos</a>
          </li>
        </ul>
        <a href='#' id='openup'>ESTO EVENT</a>
      </nav>
    </header>
    <div class="section-main container">
      <img src="Accueil/imgs/Logo.svg" alt="LogoESTOEVENT" id="logo">
      <h1 class="LogoText"> <span>E</span>STO <span>E</span>VENT.</h1>
      <h2>Notre université, nos événements.</h2>
      <p class="lead hide-on-small">
        Bienvenue sur notre page d’accueil, vous êtes soit professeur ou étudiant à l’école Supérieure de Technologie d’Oujda, 
        ESTO EVENT est un site pour vous. Regroupant tous les événements organisés à l’ESTO, ESTOEVENT est aussi une plateforme pratique
        pour les professeurs pour créer et gérer les événements, tous cela en proposant un « Dashboard » facilitant les tâches de gestion pour les organisateurs.
      </p>
    </div>
  </div>

  <!-- Main Section -->
  <section id="A-propos" class="section">
    <div class="container">
      <h2 class="section-head">
        <i class="far fa-calendar-alt" style="margin-right: 12px;"></i>ESTO EVENTS
      </h2>
      <h3>1990 - 2020 </h3>
      <p class="lead">Depuis 1990, L’Ecole Supérieure de Technologie d’Oujda propose 
        divers événements de tous genres passant par des sujets scientifiques, à des coachings 
        par les professeurs de l’ESTO, de l’entreprenariat et de l’entreprenariat social mais aussi des 
        événements des clubs présent à l’ESTO comme ceux d’Enactus, Biz-Squad ainsi que le Bureau des étudiants. </p>
      <a href="SignUpEtud/LoginEtud.php" class="btn btn-primary mb">Rejoignez nous cher étudiant</a>
      <img src="Accueil/imgs/mockup1.png" class="mockup1" alt="">
    </div>
  </section>

  <!-- Espace Proffesseur Section -->
  <section id="EspaceProf" class="section bg-light">
    <div class="container">
      <h3>Espace Professeur</h3>
      <p class="lead">L’espace professeur propose différentes fonctionnalités qui facilite la gestion pour ce dernier.
        Il pourra créer son compte facilement sur notre site et ainsi pouvoir s’authentifier plus tard.
        Toutes ces informations seront stockées pour qu’il puisse ainsi créer et ajouter un événement sur la plateforme et pouvoir la gérer en toute simplicité.
        Tout cela apparaitra dans l’espace étudiant qui pourra ensuite consulter les événements de l’ESTO par département.</p>
        <img src="Accueil/imgs/event2.svg"alt="" class="eventsvg"><br>
      <a href="./SignUpProf/LoginProf.php" class="btn btn-primary mb">inscrivez-vous</a>
    </div>
  </section>

  <?php
    $query= "select dateDebut from evenement";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $count= $stmt->rowCount();
    $event = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dateDebutArray = new SplFixedArray($count);
    $i=0;
    foreach($event as $evento){
      $dateDebutArray[$i] = $evento['dateDebut'];
      $i++;
    }

    $procheDate = strtotime($dateDebutArray[0]);
    for($i=0; $i < $count ; $i++){
        if(strtotime($dateDebutArray[$i]) < $procheDate){
           $procheDate = strtotime($dateDebutArray[$i]);
        }
    }
    $procheEvent=date("d-m-Y H:i",$procheDate);

  
    $queryInfos= "select * from evenement e, departement d where e.ID_Departement = d.ID_Departement AND dateDebut = :dateDebut";
    $stmtInfos= $db->prepare($queryInfos);
    $stmtInfos->bindParam(":dateDebut",$procheEvent);
    $stmtInfos->execute();
    $newEvents= $stmtInfos->fetchAll(PDO::FETCH_ASSOC);
      foreach($newEvents as $newEvent){
  ?>

  <!-- infos Section -->
  <section id="infos" class="section">
    <div class="container">
      <h3><i class="fas fa-exclamation-circle " style="margin-right: 10px;"></i>News</h3>
      <h2><?php echo $newEvent['sujetEvent']; ?></h2>
      <p class="lead">
            <?php 
                  echo "Departemenet : " .$newEvent['nomDept']."<br>";
                  echo $newEvent['descriptionEvent']."<br>"; 
                  echo "Date debut : " . $newEvent['dateDebut'] . "<br>";
                  echo "Date fin : " . $newEvent['dateDebut']; ?>
            </p>    
    </div>
  </section>

  <?php  } ?>

  <!-- Espace Etudiant Section -->
  <section id="EspaceEtud" class="section bg-light">
    <div class="container">
      <div class="EspaceEtud">
        <div>
          <img src="Accueil/imgs/mockup4.png" alt="">
        </div>
        <div>
          <h2>Espace Etudiant</h2>
          <p>
            L’étudiant pourra aussi créer son compte et s’y identifier pour accéder à l’espace étudiant qui proposera 
            un panel d’informations sur les événements présent à l’Ecole Supérieur de Technologie d’Oujda organisés par date & département.
          </p>
          <a href="SignUpEtud/LoginEtud.php"> Déjà un compte ?</a>
          <hr>
          <a href="SignUpEtud/LoginEtud.php" class="text-secondary">
            <i class="fas fa-chevron-right"></i> Espace Etudiant
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-cols">
        <ul>
          <li>ESTO EVENT</li>
          <li>
              <p>Un site web intranet pour la gestion et l'organisation des événements de l'ESTO,
                 ce site web facilite la tâche de consultation aux étudiants et permet aux professeurs de bien contrôler 
                 le déroulement de chaque événement</p>
          </li>
        </ul>

        <ul>
          <li>Menu</li>
          <li>
            <a href="SignUpEtud/LoginEtud.php">Espace Etudiant</a>
          </li>
          <li>
            <a href="SignUpProf/LoginProf.php">Espace Proffesseur</a>
          </li>
          <li>
            <a href="#A-propos">A propos</a>
          </li>

        </ul>

        <ul>
          <li>Réseaux Sociaux</li>
          <li>
            <i class="fab fa-facebook-f"></i> <a href="">FaceBook</a>
          </li>
          <li>
            <i class="fab fa-instagram"></i><a href="">Instagram</a>
          </li>
          <li>
            <i class="fab fa-twitter"></i> <a href="">Twitter</a>
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
    <div class="footer-bottom text-center">
      Copyright &copy; 2020 ESTO EVENT | AM/NWA
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="Accueil/js/main.js"></script>
</body>

</html>