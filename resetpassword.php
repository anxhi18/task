<?php
ob_start();
?>
<?php

if (isset($_POST['submit'])) {
    $selector = $_POST ['selector'];
    $validator = $_POST ['validator'];
    $pass = $_POST ['user_password'];
    $passwordrepeat = $_POST['pass'];
    if (empty($passwordrepeat) || empty($pass)) {
        header("Location: create-new-pass.php?newpwd=empty");
        exit();
    } else if ($pass != $passwordrepeat) {
        header("Location: create-new-pass.php?newpwd=pwdnotsame");
        exit();
    }

    $currentdate = date("U");
    include './database/conn.php';

    $sql = "SELECT * FROM pwdreset WHERE pwdresetselector =? AND pwdresetexpires >=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo 'Error! qualcosa è andato storto' . mysqli_stmt_error($stmt);
        exit();
    } else {

        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentdate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            echo 'You have to re-submit your request';
            echo 'Error!' . mysqli_stmt_error($stmt);
            exit();
        } else {
            $tokenbin = hex2bin($validator);
            $tokencheck = password_verify($tokenbin, $row['pwdresetoken']);

            if ($tokencheck === false) {
                echo 'You need to re-submit your request';
                exit();
            } elseif ($tokencheck === TRUE) {
                $tokenEmail = $row ['pwdresetEmail'];

                $sql = "SELECT * FROM users WHERE email =?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'There was an error';
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo 'You have to re-submit your request';
                        exit();
                    } else {
                        $sql = "UPDATE users SET password=? WHERE email =?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo 'There was an error';
                            exit();
                        } else {
                            $newPassHash = password_hash($pass, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPassHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdreset WHERE pwdresetEmail=?";
                            $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo 'There was an error';
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: login_form.php?newpwd=passwordupdated");
                              ob_end_flush();
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location : index.php");
     ob_end_flush();
}
    