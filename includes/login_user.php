<?php

ob_start();
?>



<?php

$konst = "SECRETKEY";

if (isset($_POST['user_email']) && isset($_POST['user_password'])) {

// CHECK IF FIELDS ARE NOT EMPTY
    if (!empty(trim($_POST['user_email'])) && !empty(trim($_POST['user_password']))) {

// Escape special characters.
        $user_email = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['user_email'])));
        $userEm = openssl_encrypt(json_encode($user_email), "AES-128-ECB", $konst);
        $query = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$userEm'");

        if (mysqli_num_rows($query) > 0) {

            $row = mysqli_fetch_assoc($query);
            $user_db_pass = $row['fjalkalimi_pas'];
            $statusDB = $row ['status'];
            $active_status = $row ['active_user'];
            $dat_cregj = $row ['dataDisaktivimit'];
// VERIFY PASSWORD
            $check_password = password_verify($_POST['user_password'], $user_db_pass);

            if ($check_password === TRUE && $statusDB == 'verified' && $active_status == 'enable') {
                session_regenerate_id(true);

                $_SESSION['user_email'] = $user_email;
                header('Location: homemenu.php');
                ob_end_flush();
                exit;
            } elseif ($check_password === TRUE && $statusDB == 'verified' && $active_status == 'disable') {

                $query = "SELECT * FROM users WHERE dataDisaktivimit > current_date() - INTERVAL 30 DAY AND active_user = 'disable' AND email = '$userEm';";
                $check_disable = mysqli_query($conn, $query);
                if (mysqli_num_rows($check_disable) > 0) {
                    $update = mysqli_query($conn, "UPDATE users set active_user = 'enable' WHERE email = '$userEm';");
                    $msg = 'Il tuo account e stato attivato !!';
                    session_regenerate_id(true);

                    $_SESSION['user_email'] = $user_email;
                    header('Location: dashboard.php');
                    ob_end_flush();

                    exit;
                } else {
                    $error_message = 'A Passato piu di 30 giorni che hai disactivato il tuo account, adesso i tuoi dati sono eleminati , Per accedere a Family Asset devi fare una nuova registrazione !';
                }
            }
// SE IL USER A VERIFICATO IL SUO ACCOUNT
            elseif ($statusDB !== 'verified') {
                $error_message = 'Devi Verificare il Tuo Account';
            } // INCORRECT PASSWORD
            elseif ($check_password == FALSE) {
                $error_message = "Password Errata.";
            }
        } else {
// EMAIL NOT REGISTERED
            $error_message = "Email Non Registrato.";
        }
    }
}
