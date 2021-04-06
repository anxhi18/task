<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/PHPMailer-master/src/Exception.php';
require './PHPMailer/PHPMailer-master/src/PHPMailer.php';
require './PHPMailer/PHPMailer-master/src/SMTP.php';

$konst = "SECRETKEY";
//include './includes/functions.php';
if (isset($_POST['username']) && isset($_POST['user_email']) && isset($_POST['user_password'])) {

// CHECK IF FIELDS ARE NOT EMPTY
    if (!empty(trim($_POST['username'])) && !empty(trim($_POST['user_email'])) && !empty(trim($_POST['user_password']))) {

// Escape special characters.
        $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
        $user_email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['user_email']));

//IF EMAIL IS VALID
        if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

// CHECK IF EMAIL IS ALREADY REGISTERED
            $email = openssl_encrypt(json_encode($user_email), "AES-128-ECB", $konst);
            $check_email = mysqli_query($conn, "SELECT `email` FROM `users` WHERE email = '$email'");

            if (mysqli_num_rows($check_email) > 0) {
                $error_message = "Questo indirizzo email è già stato registrato. Per favore, prova un altro.";
            } elseif (mysqli_num_rows($check_email) == 0) {
// IF EMAIL IS NOT REGISTERED
 
                if (count($error_message) === 0) {
                    $user_hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);


                    $user = openssl_encrypt(json_encode($username), "AES-128-ECB", $konst);
                    
                    $code = rand(999999, 111111);
                    $status = "notverified";
                    $active_status = 'enable';
                  

                    $insert_user = mysqli_query($conn, "INSERT INTO `users` (username, email, password, code_verif,status , active_user,dataregjistrimit_regdt)"
                            . "VALUES ('$user', '$email', '$user_hash_password','$code','$status','$active_status', current_date())");

                    if ($insert_user === TRUE) {



                        if (isset($_POST['submit'])) {
                            if (!empty($_POST['user_email'])) {


                                $emailFrom = 'anxhlela.mullalli@gmail.com';
                                $emailFromName = 'anxhela';
                                $emailTo = $user_email;
                                $emailToName = '';
                                $smtpUsername = 'anxhlela.mullalli@gmail.com';

                                $smtpPassword = '';
                                $mail = new PHPMailer;
                                $mail->isSMTP();
//            $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
                                $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
                                $mail->Port = 587; // TLS only
                                $mail->SMTPSecure = 'tls'; // ssl is depracated
                                $mail->SMTPAuth = true;
                                $mail->Username = $smtpUsername;
                                $mail->Password = $smtpPassword;
                                $mail->setFrom($emailFrom, $emailFromName);
                                $mail->addAddress($emailTo, $emailToName);
                                $mail->Subject = 'TEST';
                                $mail->msgHTML("Grazie per esserti iscritto ! questo e il tuo codice $code ,vai a questo link per registrarti  <a href='verify.php'>Clicca qui</a> 
");
                                if ($mail->send()) {
                                    header('Location: verify.php');
                                } elseif (!$mail->send()) {
                                    $sql = mysqli_query($conn, "DELETE FROM users WHERE email = '$email';");
                                    $error_message = "Falimento di inviare la mail ";
                                    error_reporting();
                                }
//                    
                            } else {
                                $error_message = "Errore nel Inserimento" . mysqli_error($conn);
                            }
                        }
                    }
                }
            } else {
// IF EMAIL IS INVALID
                $error_message = "Indirizzo E-mail non valido.";
            }
        } else {
// IF FIELDS ARE EMPTY
            $error_message = "Si prega di compilare tutti i campi obbligatori.";
        }
    }
}
        