<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width , initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86" />
        <title></title>

        <link href="css/css2.css" rel="stylesheet" type="text/css"/>
        <style>
            .success_message {
                color: greenyellow;
            }
            .error_message {
                color: red;
            }
        </style>
    </head>
    <body>
    
        <div id="style" class="centered">
        <div class="container" align="center">

<!--        <p>Enter Email Address To Send Password Link</p>-->

            <div class="wrapper" >
                
                <form action="resetForm.php" method="post" >
                    <?php
                    if (isset($success_message)) {
                        echo '<div class="success_message">' . $success_message . ' </div>';
                    }if (isset($error_message)) {
                        echo '<div class="success_message">' . $error_message . ' </div>';
                    }
                    ?>
                    <h2 style="color: white"><strong>Un E-mail sara inviato per cambiare il tuo password</strong></h2><br><br>



                    <div class="form-wrapper" align="center">
                        <label >E-mail</label>
                         <span class="fontawesome-envelope"></span>
                         <input type="text" class="form-control" id="email" name="email" placeholder="Inserisci il tuo indirizzo email.." required>
                    </div>


                    <div class="form-wrapper" align="center">
                        <button name="submit_email" type="submit">Invia</button>
                    </div>

                   
                    <a href="index.php" class="button" style="text-decoration:none"> Hai già un account ?!</a><br>
        

                </form>
            </div>
        </div>
       </div>
    </body>
</html>
