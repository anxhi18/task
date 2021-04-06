<?php 
session_start();
 include './databaseConn/conn.php';
include './includes/insert_user.php';
if (isset($_SESSION['user_email'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link href="css/css.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>


        <div id="style" class="center">
            <div class="container" align="center">
                <!--                <div class="wrapper" style="background-image: url('images/LogoPA2.png');">-->
                <div class="wrapper" >

                    <form action="" method="post"  onSubmit = "return checkPassword(this), return formValidation(this);">

                        <?php
                        if (isset($success_message)) {
                            echo '<div class="success_message">' . $success_message . '     </div>';
                        }
                        if (isset($error_message)) {
                            echo '<div class="error_message">' . $error_message . '</div>';
                        }
                        ?>
                        <h1 style="color: white"><strong>Registrazione </strong></h1><br><br>
                     
                        <div class="form-wrapper" align="center">
                            <label style=" font-size: 19px;"  >Nome e Cognome</label>
                            <span class="fontawesome-user"></span>
                            <input type="text" class="form-control" placeholder="Inserisci il tuo nome.." style=" font-size: 16px;" id="username" name="username" required>
                        </div>

                        <div class="form-wrapper" align="center">
                            <label style=" font-size: 19px;" >E-mail</label>

                            <span class="fontawesome-envelope"></span>
                            <input type="text"  class="form-control" placeholder="Inserisci il tuo mail.." style=" font-size: 16px;" name="user_email"  required>
                        </div>
                        <div class="form-wrapper" align="center">
                            <label style=" font-size: 19px;" > Password</label>
                            <span class="fontawesome-lock"></span>
                            <input type="password" class="form-control" placeholder="Inserisci il tuo password.." id="pass1" style=" font-size: 16px;" name="user_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div>
                        <div class="form-wrapper" align="center">
                            <label style=" font-size: 19px;" >Confermare Password</label>
                            <span class="fontawesome-lock"></span>
                            <input type="password" class="form-control" placeholder="Inserisci il tuo password.." id="pass2" style=" font-size: 16px;" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div><br>

                        <div class="show">
                            <input type="checkbox" id="box-1" onclick="myFunction()">
                            <label id="check" for="box-1">Mostra Password</label>
                        </div>
                        <p>
                            License Agreement :<br />

                            <textarea id="cin" name="licenseAgreement" rows="10" readonly cols="35">This is my long, long license agreement where you agree to all of my demands.

    This is my long, long license agreement where you agree to all of my demands.

    This is my long, long license agreement where you agree to all of my demands.

    This is my long, long license agreement where you agree to all of my demands.

    This is my long, long license agreement where you agree to all of my demands.

    This is my long, long license agreement where you agree to all of my demands.

    This is my long, long license agreement where you agree to all of my demands.

    This is my long, long license agreement where you agree to all of my demands.

    This is my long, long license agreement where you agree to all of my demands.

                            </textarea>

                        </p>

                        <p>
                            <input name="agree" id="btn" type="button" class="agree" style="text-decoration:none ; font-family:Muli-SemiBold; ; font-size: 14px;" onclick="this.style.background = 'green', enableButton2()" value="Sono d'accordo" disabled > 
                        </p>

                        <button class ="button" id="inscriviti"  type="submit" name="submit" disabled="true"> Iscriviti</button>

                        <a rel="" href="login_form.php"  style="text-decoration:none ; font-family:Muli-SemiBold; ; font-size: 14px;"  >Hai già un account ?!</a><br><br>
                     

                    </form>
                </div>

            </div>
        </div>
        <script>
            // Function to check Whether both passwords 
            // is same or not. 
            function checkPassword(form) {
                user_password = form.user_password.value;
                pass = form.pass.value;

                // If password not entered 
                if (user_password === '')
                    alert("Per favore, inserisci la password");
                // If confirm password not entered 
                else if (pass === '')
                    alert("Si prega di inserire la password di conferma");
                // If Not same return False.     
                else if (user_password !== pass) {
                    alert("\nLa password non corrisponde: riprova ...");
                    return false;
                }
                // If same return True. 
                else {
                    //                    alert("") 
                    return true;
                }
            }
            function myFunction() {
                var x = document.getElementById("pass1");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
                var y = document.getElementById("pass2");
                if (y.type === "password") {
                    y.type = "text";
                } else {
                    y.type = "password";
                }

            }
        </script>

        <script>

            document.getElementsByName("licenseAgreement")[0].addEventListener("scroll", checkScrollHeight, false);

            function checkScrollHeight() {
                var agreementTextElement = document.getElementsByName("licenseAgreement")[0];
                if ((agreementTextElement.scrollTop + agreementTextElement.offsetHeight) >= agreementTextElement.scrollHeight) {
                    document.getElementsByName("agree")[0].disabled = false;
//               
                    document.getElementById("btn").style.background = '#ae3c33';
                    document.getElementById("btn").style.color = 'white';
                }
            }



        </script>

        <script>
            function enableButton2() {
                document.getElementById("inscriviti").disabled = false;
            }
        </script>

    </body>
</html>
