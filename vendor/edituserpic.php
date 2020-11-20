<?php
    session_start();
    require_once 'connect.php';

    // var_dump($_FILES);

    $path = 'uploads/' . time() . $_FILES['userpic']['name'];
    move_uploaded_file($_FILES['userpic']['tmp_name'], '../' . $path);

    $updateUserpic = mysqli_query($connect, "UPDATE `users` SET `userpic` = '$path' WHERE `id_user` = " . $_SESSION['user']['id_user']);

    $_SESSION['userpic'] = $path;
    $_SESSION['user']['userpic'] = $_SESSION['userpic'];

    // var_dump($_SESSION);
    header('Location: ../profile.php');

    
    // var_dump( $_SESSION['userpic']);























//    $userId = $_SESSION['user']['id_user'];


//     $insertUserpic = mysqli_query($connect, "SELECT `userpic` FROM `users` WHERE `login` = '$login'");
    // mysqli_query($connect,"INSERT INTO `users` (`nickname`, `login`, `password`) VALUES ('$nickname', '$login', '$password')");

    // $insertUserpic = mysqli_query($connect, "INSERT INTO `users` (`userpic`) SELECT ('$path') FROM `users` WHERE `id_user` = '$userId'");
//     INSERT INTO TableName (Field1,Field2,...,Fieldn)
// SELECT Value1,Value2,...,Valuen FROM dual
// WHERE Value1 NOT IN ('myValue1','myValue2','myValue3')
//    echo mysqli_num_rows($insertUserpic);

    // var_dump($_FILES);
    // var_dump($_SESSION);

    // echo $userId;