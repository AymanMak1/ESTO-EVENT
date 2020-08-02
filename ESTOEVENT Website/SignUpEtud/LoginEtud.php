<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap" rel="stylesheet"> 
    <title>Sign In-Etudiant ESTO EVENT</title>
    <link rel="stylesheet" href="css/style2.css">
    <style>
        *{
            box-sizing: border-box;
            margin:0;
            padding: 0;
        }
        body {
            font-weight:bold;
            height: 100%;
            width: 100%;
            max-height: 100%;
            max-width: 100%;
            overflow: hidden;
        }
        #signup{
            transform: scale(0.93, 0.93);
        }
        @media(max-width:767px){
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
        input:hover{
            border: 3px solid #d3071b;
            transition: 0.5s;
            background-color: rgba(0, 0, 0, 0.77);
            color: white;
            border-radius: 25px;
            outline:none;
        }
    body{
      font-family: 'Baloo Chettan 2', cursive;
    }
        /*
        @media(max-width:414px){
            #wrapper #left #signin,#main-footer{
                margin-bottom: 100px;
            }
            #wrapper #left #signup{
                margin-bottom: 100px;
            }
        }
        */
    </style>
    <script>

    </script>
</head>
<body>
    <div id="wrapper">
        <div id="left">
            <div id="signin">
                <div class="logo">
                    <img src="imgs/Logo.svg" alt="ESTO EVENT">
                </div>
                <form action="php/LoginEtudiant.php" method="POST" name="LogIn">
                    <div>
                        <label for="IEmail">Email</label>
                        <input type="text" id="IEmail" name="IEmail" class="text-input">
                    </div>
                    <div>
                        <label for="IPwd">Mot de passe</label>
                        <input type="password" id="IPwd" name="IPwd" class="text-input">
                    </div>
                   <input type="submit" class="primary-btn" name="LogIn" value="Se connecter">
                </form>
                <div class="links">
                    <a href="">Mot de passe oublié</a>
                </div>
                <div class="or">
                    <hr class="bar">
                    <span>OU</span>
                    <hr class="bar">
                </div>
                <button class="secondary-btn" id="SignUpSwitch" onclick="Switch()">Créer un compte </a>
            </div>
            <div id="signup" style="display: none;">
                <div class="logo">
                    <img src="imgs/Logo.svg" alt="ESTO EVENT">
                </div>
                <form action="php/SignUpEtud.php" method="POST" name="SignUp">
                    <div>
                        <label for="Email">Email</label>
                        <input type="text" id="SEmail" name="Email" class="text-input" >
                    </div>
                    <div>
                        <label for="Name">Nom</label>
                        <input type="text" id="Name" name="NomEtud" class="text-input">
                    </div>
                    <div>
                        <label for="fname">Prénom</label>
                        <input type="text" id="fname" name="PrenomEtud" class="text-input">
                    </div>
                    <div>
                        <label for="Pwd">Mot de passe</label>
                        <input type="password" id="SPwd" pattern=".{5,}" required title="5 caractéres min" placeholder="5 caractéres min" name="SPwd" class="text-input" >
                    </div>
                    <div>
                        <label for="CPwd">Confirmation de mot de passe</label> 
                        <input type="password" id="CPwd" name="CPwd" class="text-input" >
                    </div>
                   <input type="submit" class="primary-btn" value="S'inscrire" name="SignUp">
                </form>
                <a href="" class="secondary-btn" onclick="Switch2()">Dèja un compte ?</a>
            </div>
                <footer id="main-footer" class="fh" style="display: block;">
                    <p>Copyright &copy; 2020, ESTO EVENT Tous les droits reservés</p>
                    <div>
                        <a href="">Terms of use</a> | <a href="">Privacy Policy</a>
                    </div>
                </footer>
        </div>
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
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</bodyonload="window.location">
</html>