
<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In-Prof ESTO EVENT</title>
    <link rel="stylesheet" href="css/style3.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap" rel="stylesheet"> 
    <style type="text/css">
        *{  
            box-sizing: border-box;
            margin:0;
            padding: 0;
        }
        /*
        body {
            height: 100%;
            width: 100%;
            max-height: 100%;
            max-width: 100%;
            overflow: hidden;
        }
        */

        body{
      font-family: 'Baloo Chettan 2', cursive;
      overflow:hidden;
    }
    #signup{
            transform: scale(0.75, 0.75);
        }
        @media(max-width:768px){
            #signup{
            transform: scale(1);
            }
            #right{
                margin-top:-60px;
            }
            footer{
                margin-bottom:50px;
            }
            body {
                height: 100vh;
                width:100wh;
                overflow:scroll;
            }
            
            
        } 
        @media(max-width:1024px){
            #signup{
            transform: scale(1);
            }            
        } 

    </style>
</head>
<body>
    <!--left wrapper: form Connection-->
    <div id="wrapper">
        <div id="left">
            <div id="signin">
                <div class="logo">
                    <img src="imgs/Logo.svg" alt="ESTO EVENT">
                </div>
                <form action="php/LogInProf.php" method="POST" name="LogIn">
                    <div>
                        <label for="Nom">Nom</label>
                        <input type="text" id="Nom" name="INom" class="text-input">
                    </div>
                    <div>
                        <label for="Nom">Prénom</label>
                        <input type="text" id="Prenom" name="IPrenom" class="text-input">
                    </div>
                    <div>
                        <label for="Pwd">Mot de passe</label>
                        <input type="password" id="Pwd" name="IPwd" class="text-input">
                    </div>
                   <input type="submit" class="primary-btn" name="LogIn" value="Se connecter">
                </form>
                <div class="links">
                    <a href="">Mot de passe oublié ?</a>
                </div>
                <div class="or">
                    <hr class="bar">
                    <span>OU</span>
                    <hr class="bar">
                </div>
                <button class="secondary-btn" id="SignUpSwitch" onclick="Switch()">Créer un compte ?</a>
                </div>
              <!--left wrapper: form Inscription-->
            <div id="signup" style="display: none;">
                <div class="logo">
                    <img src="imgs/Logo.svg" alt="ESTO EVENT">
                </div>
                <form action="php/SignUpProf.php" method="POST" name="SignUp"  enctype="multipart/form-data">
                    <div>
                        <label for="Nom">Nom</label>
                        <input type="text" id="SNom" name="SNomProf" class="text-input">
                    </div>

                    <div>
                        <label for="Prenom">Prenom</label>
                        <input type="text" id="SPrenom" name="SPrenomProf" class="text-input">
                    </div>

                    <div>
                        <label for="Discipline">Discipline</label>
                        <input type="text" id="Discipline" name="SDisciplineProf" class="text-input">
                    </div>
                    <div>
                        <label for="Dépatement">Dépatement</label>
                         <select name="SDépatementProf" id="Dépatement" class="text-input">
                             <option value="1">management</option>
                             <option value="2">génie appliqué</option>
                             <option value="3">génie Informatique</option>
                         </select>
                    </div>
                    <div>

                        <label for="Pwd">Mot De Passe</label>
                        <input type="password" id="SPwd" pattern=.{5,} required title="5 caractéres min" placeholder="5 caractéres min" name="SPwdProf" class="text-input">
                    </div>

                    <div>
                        <label for="CPwd">Confirmation de Mot De Passe</label> 
                        <input type="password" id="CPwd"  name="CSPwdProf" class="text-input">
                    </div>

                    <div>
                        <label for="Photo">Photo De Profil</label> 
                        <input type="file" id="Photo" name="Pdp" class="text-input">
                    </div>

                   <input type="submit" class="primary-btn" name="SignUp" value="Sign Up">
                </form>
                <a href="" class="secondary-btn" onclick="Switch2()">Dèja un compte ?</a>
            </div>
              <!--Footer of Forms-->
                <footer id="main-footer" class="fh" style="text-align: center;">
                    <p>Copyright &copy; 2020, ESTO EVENT All rights Reserved</p>
                    <div>
                        <a href="">Terms of use</a> | <a href="">Privacy Policy</a>
                    </div>
                </footer>
            </div>
          <!--Right Wrapper:Showcase BgImage & Text-->
        <div id="right">
            <div id="showcase">
                <div class="showcase-content">
                    <h1 class="showcase-text" style="color: white;"> <strong>E</strong>STO <strong>E</strong>VENT</h1>
                    <h1 class="showcase-text" style="color: white;">Notre université, nos événements.</h1>
                </div>
            </div>
        </div>
    </div>
    <script src="js/main2.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</bodyonload="window.location">
</html>