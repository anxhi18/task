
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
        <link href="css/css2.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width , initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86" />
    </head>
    <body>
   
        <?php
        $selector = $_GET ['selector'];
        $validator = $_GET ['validator'];
        if (empty($selector) || empty($validator)) {
            echo 'Non possiamo validare la tua richiesta ';
        } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                ?>
                <div id="style" class="centered">
                    <div class="container" align="center">
                                    <!--        <p>Enter Email Address To Send Password Link</p>-->
                        <div class="wrapper" >
                            <form action="resetpassword.php" method="post" >
                                <h2 style="color: white"><strong>Nuovo Password</strong></h2><br><br>
                                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                                <input type="hidden" name="validator" value="<?php echo $validator ?>">

                                <div class="form-wrapper" align="center">
                                    <label> Password</label>
                                    <span class="fontawesome-lock"></span>
                                    <input type="password" class="form-control" id="pass1"  placeholder="Inserisci il tuo password.." name="user_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                                <div class="form-wrapper" align="center">
                                    <label>Confermare Password</label>
                                    <span class="fontawesome-lock"></span>
                                    <input type="password" class="form-control" id="pass2"  placeholder="Inserisci il tuo password.." name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div><br>
                                <div class="show">
                                    <input type="checkbox" id="box-1" onclick="myFunction()">
                                    <label id="check" for="box-1">Mostra Password</label>
                                </div>
                                <div class="form-wrapper" align="center">
                                    <button name="submit" type="submit">Cambia Password</button>
                                </div>
                                <div id="message">

                                    <a href="resetForm.php" class="button"  style="text-decoration:none">Hai dimenticato il tuo password ?!</a> 
                                </div>
                                <img src="images/SaraS.png" alt="sara" width="200" ><br>

                            </form>
                            <script>
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
        <?php
    }
}
?>
                </div>
            </div>
        </div>
    </body>
</html>
