<?php

    session_start();
    
    if(isset($_SESSION['usrid']) && isset($_SESSION['Logstatus'])){

        if($_SESSION['Logstatus'] === true){

            $message = $_SESSION['usrid'] . $_SESSION['Logstatus'];

        }
        else{
            header("Location: /Main/Pages/Login.php");
            exit();    
        }

    }
    else{
        header("Location: /Main/Pages/Login.php");
        exit();
    }

?>
