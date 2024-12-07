<?php
    if (isset($_SESSION['usrid']) && isset($_SESSION['Logstatus'])) {

        if ($_SESSION['Logstatus'] === true) {


            $usrid = $_SESSION['usrid'];

            if (strpos($usrid, 'Fre-') === 0) {

                $dashlink = "Pages/Dashboard.php";
            } else {

                $dashlink = "Pages/ORGDashboard.php";
            }
        } else {
            $dashlink = "Pages/Dashboard.php";
        }
    } else {
        $dashlink = "Pages/Dashboard.php";
    }
?>