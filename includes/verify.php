<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link href="../css/css2.css" rel="stylesheet" type="text/css"/>
       <!--        <script src="jquery-3.5.1.min.js"></script>-->
        <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width , initial-scale=0.86, maximum-scale=5.0, minimum-scale=0.86" />
        <title>Verification</title>
    </head>
    <body>
        <?php
          
        $konst = "SECRETKEY";
        if (isset($_POST['verify'])) {
            include './database/conn.php';

//            $_SESSION['info'] = "";
            $fcode = mysqli_real_escape_string($conn, htmlspecialchars($_POST['code']));

            $check_code = mysqli_query($conn, "SELECT * FROM users WHERE code_verif = '$fcode' ;");
//            $result = mysqli_query($conn, $check_code);
            if (mysqli_num_rows($check_code) > 0) {
                $fetch_data = mysqli_fetch_assoc($check_code);
                $email = $fetch_data['users'];
                $emailD = openssl_decrypt($email, 'AES-128-ECB', $konst);
                $emailResult = str_replace(array('\'', '"',
                    ',', ';', '<', '>'), '', $emailD);
                $code = 0;
                $status = 'verified';
                $update = "UPDATE users SET code_verif = $code, status = '$status' WHERE code_verif = $fcode";
                $update_res = mysqli_query($conn, $update);
                if ($update_res) {

                    header('location: index.php');
                   
                    ob_end_flush();
                    exit();
                }
            } else {
                $errors = "Il Codice che hai Inserito non e Corretto!";
            }
        }
        ?>

 <div id="style" class="centered">
     <h1 style="color: white"><strong>Inserire il codice che hai ricevuto via mail </strong></h1>
        <div class="container" align="center">

            <!--                <div class="wrapper" style="background-image: url('images/LogoPA2.png');">-->
            <div class="wrapper" >
                <?php
                if (isset($errors)) {
                    echo '<div class="error_message">' . $errors . '</div>';
                }
                ?>
                
                <form action="" method="post">
                    <input type="text" class="form-control" name="code" placeholder="&#8902 &#8902 &#8902 &#8902 &#8902 &#8902 " 
                           oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>

                    <button type="submit" name="verify" >Verifica</button><br>

  
                </form>
            </div>
        </div>
     </div>
    </body>
</html>