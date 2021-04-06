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

        <link href="css/cssstyle.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <div id="style" class="centered">
            <div class="container" align="center">
                <!--                <div class="wrapper" style="background-image: url('images/LogoPA2.png');">-->
                <div class="wrapper" >
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <?php
                        if (isset($success_message)) {
                            echo '<div class="success_message">' . $success_message . '</div>';
                        }
                        if (isset($error_message)) {
                            echo '<div class="error_message">' . $error_message . '</div>';
                        }
                        ?>
                        <h1 style="color: white"><strong>Login </strong></h1><br><br>
                        <div >
                            <input type="hidden" id="id" name="id_user"><!--
                            -->                                        </div>
                        <div class="form-wrapper" align="center">
                            <label  style=" font-size: 19px;"  >E-mail</label>
                            <span class="fontawesome-envelope"></span>
                            <input type="text" class="form-control" placeholder="Inserisci il tuo indirizzo email.." style=" font-size: 16px;"  name="user_email" required>
                        </div>
                        <div class="form-wrapper" align="center">
                            <label  style=" font-size: 19px;"  > Password</label>
                            <span class="fontawesome-lock"></span>
                            <input type="password" class="form-control" name="user_password" id="pass"  style=" font-size: 16px;"  placeholder="Inserisci il tuo password.." pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        </div><br>
                        <div class="show">
                            <input type="checkbox" id="box-1" onclick="myFunction()">
                            <label id="check" for="box-1">Mostra Password</label>


                        </div>

                        <button type="submit" class="button" style="align-content: center" id="submit" name="sub" >ACCEDI</button>

                        <div class="inline">
                            <a href="resetForm.php" class="button"  style="text-decoration:none ; font-size: 14px;">Hai dimenticato il tuo password ?!</a> 
                            <a href="index.php" class="button"  style="text-decoration:none; font-family:Muli-SemiBold; ; font-size: 14px;">Non hai un Account ?!</a> 
                        </div>

<!
                        
                                            </div>
                
                    </form>
                </div>
            </div>
        </div>

        <script>
            function myFunction() {
                var x = document.getElementById("pass");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
    </body>
</html>
