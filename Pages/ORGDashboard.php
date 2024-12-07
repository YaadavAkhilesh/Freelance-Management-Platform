<?php

include_once '../Data/Session.php';
include '../Data/Conn.php';
$message = "";

if (isset($_POST['btnlogout'])) {

    session_unset();
    session_destroy();
    header("Location: /Main/Pages/Login.php");
    exit();

}

$usrid = $_SESSION['usrid'];
$ftch_qry = "SELECT * FROM client_det WHERE client_id = '$usrid'";

$ftch_qry_rslt = $conn->query($ftch_qry);

if ($ftch_qry_rslt->num_rows > 0) {

    $ftch_qry_rslt_data = $ftch_qry_rslt->fetch_assoc();

} else {
    $message = "No data found !";
    header("Location: /Main/Pages/Registration.php");
    exit();
}

function convertDateToMySQLFormat($date)
{
    // Create a DateTime object from the input date
    $dateTime = DateTime::createFromFormat('d-F-Y', $date);

    // Check if the date was created successfully
    if ($dateTime) {
        // Return the date in 'YYYY-MM-DD' format
        return $dateTime->format('Y-m-d');
    } else {
        // Return null if the date format is invalid
        return null;
    }
}

if (isset($_POST['MainEditPersonalForm'])) {

    $srvrtype = $_POST['serviceType'];
    $cntrycl = $_POST['countryClient'];


    $updt_qry = "UPDATE client_det SET clsrvrtype = '$srvrtype' , claddr = '$cntrycl' WHERE client_id = '$usrid'";

    $updt_qry_rslt = $conn->query($updt_qry);

    if ($updt_qry_rslt === true) {

        header("Location: /Main/Pages/ORGDashboard.php");
        $message = "Updated Successfully !";

    } else {
        $message = "Error ! While Updating .." . $conn->error;
    }

}

if (isset($_POST['MainEditContactForm'])) {

    $mail = $_POST['contactEmail'];
    $phone = $_POST['contactPhone'];

    $updt_qry = "UPDATE client_det SET clmail = '$mail' , clphone = '$phone' WHERE client_id = '$usrid'";

    $updt_qry_rslt = $conn->query($updt_qry);

    if ($updt_qry_rslt === true) {

        header("Location: /Main/Pages/ORGDashboard.php");
        $message = "Updated Successfully !";

    } else {
        $message = "Error ! While Updating .." . $conn->error;
    }

}


if (isset($_POST['MainEditUserPasForm'])) {

    $usrnm = $_POST['username'];
    $inchpasswd = $_POST['password'];
    $confpass = $_POST['confirmPassword'];

    if ($inchpasswd === $confpass) {

        $confirmPassword = password_hash($confpass, PASSWORD_DEFAULT);

        $updt_qry = "UPDATE client_det SET clusrnm = '$usrnm' , clpasswd = '$confirmPassword' WHERE client_id = '$usrid'";

        $updt_qry_rslt = $conn->query($updt_qry);

        if ($updt_qry_rslt === true) {

            session_unset();
            session_destroy();
            header("Location: /Main/Pages/Login.php");
            $message = "Updated Successfully !";

        } else {
            $message = "Error ! While Updating .." . $conn->error;
        }
    } else {
        $message = "Password Not Match !";
    }

}


// Function to generate Project ID
function generateProjectID($conn)
{
    // Get the highest project ID
    $result = $conn->query("SELECT project_id FROM project_det ORDER BY id DESC LIMIT 1");

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Fetch the associative array
            $row = $result->fetch_assoc();
            $lastProjectID = $row['project_id']; // Access the project ID
        } else {
            // No rows found, set lastProjectID to null
            $lastProjectID = null; // or handle accordingly
        }
    } else {
        // Query failed, handle the error
        echo "Query error: " . $conn->error;
        return null; // Return null or handle the error as needed
    }

    // Extract the number and increment it
    if ($lastProjectID) {
        $number = (int) substr($lastProjectID, 4); // Get the number part (after 'Prj-')
        $number++; // Increment the number
    } else {
        $number = 1; // Start from 1 if no records exist
    }

    // Format the new Project ID with the prefix 'Prj-'
    return "Prj-" . str_pad($number, 3, '0', STR_PAD_LEFT); // e.g., Prj-001
}



if (isset($_POST['MainCreateProjForm'])) {

    $ProjectID = generateProjectID($conn);

    $prjtitle = $_POST['projectTitle'];
    $prjdescr = $_POST['projectDisc'];
    $prjreq1 = $_POST['fieldReq1'];
    $prjreq2 = $_POST['fieldReq2'];
    $prjreq3 = $_POST['fieldReq3'];
    $prjlnk = $_POST['prjlnk'];
    $prjmin = $_POST['mintime'];
    $prjmax = $_POST['maxtime'];
    $prjbid = $_POST['bidVal'];

    $prjmin = convertDateToMySQLFormat($prjmin);
    $prjmax = convertDateToMySQLFormat($prjmax);

    $insrt_qry = "INSERT INTO project_det (project_id, org_id, prj_title, prj_descr, prj_req_1, prj_req_2, prj_req_3, prj_lnk, prj_min_time, prj_max_time, prj_bid_val) VALUES ('$ProjectID', '$usrid', '$prjtitle', '$prjdescr', '$prjreq1', '$prjreq2', '$prjreq3', '$prjlnk', '$prjmin', '$prjmax', '$prjbid')";

    $insrt_qry_rslt = $conn->query($insrt_qry);

    if ($insrt_qry_rslt === true) {

        header("Location: /Main/Pages/ORGDashboard.php");
        exit();

    } else {
        $message = "Error ! While Inserting .." . $conn->error;
    }


}

$ftch_prj_det_qry = "SELECT pd.*, cd.* FROM project_det pd JOIN client_det cd ON pd.org_id = cd.client_id WHERE pd.org_id = '$usrid' AND pd.prj_stat = false";

$ftch_prj_det_qry_rslt = $conn->query($ftch_prj_det_qry);

$ftch_prj_det_qry_recent = "SELECT pd.prj_title FROM project_det pd JOIN client_det cd ON pd.org_id = cd.client_id WHERE pd.org_id = '$usrid' ORDER BY pd.prj_up_date DESC LIMIT 1";

$ftch_prj_det_qry_rslt_recent = $conn->query($ftch_prj_det_qry_recent);

if ($ftch_prj_det_qry_rslt_recent->num_rows > 0) {
    $ftch_prj_det_qry_rslt_data_recent = $ftch_prj_det_qry_rslt_recent->fetch_assoc();
} else {
    $ftch_recent_flag = 0;
    $message = "No project Found !";
}


$ftch_tbl_data = "SELECT * FROM project_det WHERE prj_stat = false && org_id = '$usrid'";

$ftch_tbl_data_rslt = $conn->query($ftch_tbl_data);

if(isset($_POST['delprj_btn'])){

    $delid = $_POST['del_id'];
    $del_qry = "DELETE FROM project_det WHERE project_id = '$delid'";

    $del_qry_rslt = $conn->query($del_qry);

    if($del_qry_rslt === true){

        $message = "Deleted Successfully !";
        header("Location: /Main/Pages/ORGDashboard.php");
        exit();

    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <title>Welcome</title>
    <link rel="stylesheet" href="../Assets/BS/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/CSS/common.css">
    <link rel="stylesheet" href="../Assets/CSS/orgdashboard.css">

    <script defer src="../Assets/BS/js/bootstrap.bundle.min.js"></script>
    <script defer src="../Assets/BS/js/bootstrap.min.js"></script>
    <script defer src="../Assets/JS/orgdashboard.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nova+Flat&family=Passero+One&family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Karla:ital,wght@0,200..800;1,200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Megrim&display=swap"
        rel="stylesheet">

</head>

<body>


    <?php

    include_once "../Utils/Error_Model.php";

    ?>


    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard Navbar +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="dashbar-main fixed-top d-flex justify-content-between p-0 my-3 text-center">

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashbar > Offcanvas Toggler +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <ul class="nav dashnav-top-btns mx-3 px-1 align-items-center dashnav-toggle">

            <button class="navbar-toggler p-3" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <span class="navbar-toggler-icon"></span>
            </button>

        </ul>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashbar > Org Name + Notification + Profile Icon +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <ul class="nav justify-content-between dashnav-top p-2 mx-2 align-items-center">

            <a class="dashnav-user p-0 me-5 ms-3" href="#">
                <?php
                echo $ftch_qry_rslt_data['clnm'];
                ?>
            </a>

            <div class="dashnav d-flex px-2">
                <img src="../Assets/SVG/notification.svg" alt="Home" height="30" width="30" loading="lazy">
            </div>

        </ul>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashbar > Home Page +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <ul class="nav dashnav-top-btns px-1 mx-2 align-items-center dashnav-home">
            <div class="nav-item">
                <a href="../index.php" class="nav-link">
                    <img src="../Assets/SVG/home.svg" alt="Home" height="30" width="30" loading="lazy">
                </a>
            </div>
        </ul>

        <ul class="nav dashnav-top-btns px-1 mx-2 align-items-center dashnav-home">
            <div class="nav-item">
                <form action="" method="POST" style="display: inline;">
                    <input type="hidden" name="btnlogout" value="1">
                    <button type="submit" class="nav-link px-3" style="border: none; background: none; padding: 0;">
                        <img src="../Assets/SVG/logout.svg" alt="Logout" height="30" width="30" loading="lazy">
                    </button>
                </form>
            </div>
        </ul>



    </div>



    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Offcanvas +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="offcanvas offcanvas-start cust-dashoffcan m-3" data-bs-scroll="true" data-bs-backdrop="false"
        tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Offcanvas > Header +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <div class="offcanvas-header py-3 d-flex justify-content-between">
            <h5 class="d-block mx-auto m-0" id="offcanvasScrollingLabel">Dashboard</h5>
        </div>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Offcanvas > Body + Links Btn +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <div class="offcanvas-body">

            <div class="btn btn-nav-items active text-center w-100 py-2 my-1" data-section-id="profielRow">
                Desk
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="companyDetailsRow">
                Company Details
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="ContactRow">
                Contact Details
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="IdentityspaceRow">
                Identity
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="projectsRow">
                Projects
            </div>

        </div>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Offcanvas > Footer Primary hidden +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <div class="offcanvas-footer py-3 d-flex justify-content-between align-items-center">

            <img src="../Assets/SVG/notification.svg" alt="Notification" height="30" width="30" class="p-0 mx-3" loading="lazy">

            <a href="../index.php">
                <img src="../Assets/SVG/home.svg" alt="Home" height="30" width="30" loading="lazy">
            </a>
            
            <form action="" method="POST" style="display: inline;">
                    <input type="hidden" name="btnlogout" value="1">
                    <button type="submit" class="nav-link px-3" style="border: none; background: none; padding: 0;">
                        <img src="../Assets/SVG/logout.svg" alt="Home" height="30" width="30" loading="lazy">
                    </button>
            </form>

        </div>

    </div>


    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Main Fluid +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid px-0 dash-main-fluid">
        <div class="dashdet-con">

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( main profile ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-def-profile m-0" id="profielRow">

                <div class="col-xl-12 col-lg-12 px-0">

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > Card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card dash-def-profile-card">

                        <div class="card-body mx-auto dash-def-profile-card-bdy">

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > Card > Profile Icon +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <img src="../Assets/SVG/microsoft.svg" class="d-block mx-auto my-1" alt="Profile"
                                height="200" width="200" loading="lazy">

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > Card > Username + Bluetickmark +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="text-center my-0 dash-card-user-name p-0">#
                                <span>
                                    <?php
                                    echo $ftch_qry_rslt_data['clnm'];
                                    ?>
                                    <img src="../Assets/SVG/blurmark.svg" alt="verified" height="40" width="32"
                                        loading="lazy">
                                </span>

                            </div>

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > Card > All Links +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="d-flex justify-content-center my-0 py-2">

                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > Github ++++++++++++++++++++++++++++ -->

                                <a href="" class="card-link">
                                    <img src="../Assets/SVG/link-45deg.svg" alt="Link" height="25" width="25"
                                        class="p-0 m-0" loading="lazy">
                                    <?php
                                    echo $ftch_qry_rslt_data['clphone'];
                                    ?>
                                </a>

                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > user_mail ++++++++++++++++++++++++++++ -->

                                <a href="" class="card-link">
                                    <img src="../Assets/SVG/link-45deg.svg" alt="Link" height="25" width="25"
                                        class="p-0 m-0" loading="lazy">

                                    <?php
                                    echo $ftch_qry_rslt_data['clmail'];
                                    ?>

                                </a>

                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > user_location ++++++++++++++++++++++++++++ -->

                                <a href="" class="card-link">
                                    <img src="../Assets/SVG/location.svg" alt="Link" height="25" width="25"
                                        class="p-0 m-0" loading="lazy">
                                    <?php
                                    echo $ftch_qry_rslt_data['claddr'];
                                    ?>
                                </a>

                            </div>


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > card > Fields + Languages + Technologies +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="d-flex py-3 gap-2 flex-wrap justify-content-center align-items-center mx-auto">


                                <?php
                                $bt = 1;
                                while ($bt < 5) {
                                    ?>
                                    <button type="button" class="btn my-0 px-4 py-2 dash-card-btn-specs">Comming Soon
                                        ..</button>
                                    <?php
                                    $bt++;
                                }
                                ?>

                            </div>


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > card > Working + Previous + Experience Projects +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="row gap-2 m-0 flex-wrap justify-content-center">
                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > Recent Uploaded Projects ++++++++++++++++++++++++++++ -->

                                <?php
                                if (isset($ftch_recent_flag) && $ftch_recent_flag === 0) {
                                    $message = "No Recent Projects !";
                                } else {
                                    ?>

                                    <div class="col-xxl-5 btn px-4 py-3 dash-card-prof-previous position-relative">

                                        <?php
                                        echo $ftch_prj_det_qry_rslt_data_recent['prj_title'];
                                        ?>
                                        <span
                                            class="position-absolute px-3 py-1 rounded-pill dash-card-prof-current-title m-0">
                                            Recently Uploaded
                                        </span>
                                    </div>

                                    <?php
                                }
                                ?>



                            </div>


                            <div class="row my-5 justify-content-center align-items-center" style="min-width:90vw;">                            

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > card > Working On Big Card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <?php
                            if ($ftch_prj_det_qry_rslt->num_rows > 0) {
                                while ($ftch_prj_det_qry_rslt_data = $ftch_prj_det_qry_rslt->fetch_assoc()) {

                            ?>

                                <div class="col-xxl-6 col-xl-12 my-2">
                                    <div class="card">

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Project Title + Client Logo +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="text-center card-header py-3">
                                            <?php echo $ftch_prj_det_qry_rslt_data['prj_title']; ?>
                                            - <b>ON Biding</b>
                                        </div>
                                        <img src="../Assets/SVG/microsoft.svg" class="d-block mx-auto my-1 mt-3 py-1"
                                            alt="Profile" height="200" width="200" loading="lazy">



                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Client Name +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="text-center my-0 projects-card-org-name p-0">#
                                            <span><?php echo $ftch_prj_det_qry_rslt_data['clnm']; ?>
                                                <img src="../Assets/SVG/blurmark.svg" alt="verified" height="40" width="32"
                                                    loading="lazy">
                                            </span>
                                        </div>


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Project Description +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="project-disc text-center p-3">
                                            <?php echo $ftch_prj_det_qry_rslt_data['prj_descr']; ?>
                                        </div>


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Project Links +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="d-flex justify-content-center my-0 py-2">

                                            <!-- ++++++++++++++++++++++++++++ Working On Big Card > Project Links > Help Desk ++++++++++++++++++++++++++++ -->

                                            <a href="#" class="card-link">
                                                <img src="../Assets/SVG/link-45deg.svg" alt="Link" height="25" width="25"
                                                    class="p-0 m-0" loading="lazy">
                                                <?php echo $ftch_prj_det_qry_rslt_data['prj_lnk']; ?>
                                            </a>

                                            <!-- ++++++++++++++++++++++++++++ Working On Big Card > Project Links > Project / Company Location ++++++++++++++++++++++++++++ -->

                                            <a href="#" class="card-link">
                                                <img src="../Assets/SVG/location.svg" alt="Link" height="25" width="25"
                                                    class="p-0 m-0" loading="lazy">
                                                <?php echo $ftch_prj_det_qry_rslt_data['claddr']; ?>
                                            </a>

                                        </div>


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Projects Requirements Techno + Lang +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="d-flex pt-3 gap-2 flex-wrap justify-content-center align-items-center mb-3">


                                            <button type="button"
                                                class="btn my-2 px-4 py-2 projects-card-btn-req position-relative">
                                                <?php echo $ftch_prj_det_qry_rslt_data['prj_req_1']; ?>
                                            </button>
                                            <button type="button"
                                                class="btn my-2 px-4 py-2 projects-card-btn-req position-relative">
                                                <?php echo $ftch_prj_det_qry_rslt_data['prj_req_2']; ?>
                                            </button>
                                            <button type="button"
                                                class="btn my-2 px-4 py-2 projects-card-btn-req position-relative">
                                                <?php echo $ftch_prj_det_qry_rslt_data['prj_req_3']; ?>
                                            </button>

                                        </div>

                                        <hr>


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Project Time Line + Bid Date +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Timeline > Bid Date +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <button type="button" class="btn px-4 py-3 mx-auto mb-3 projects-card-min-time position-relative" id="bidDate">
                                            <?php echo $ftch_prj_det_qry_rslt_data['prj_up_date']; ?>
                                            <span class="position-absolute px-3 py-1 rounded-pill projects-card-time-title">
                                                Place Date
                                            </span>
                                        </button>

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Timeline > Min Time +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <button type="button" class="btn px-4 py-3 mx-auto mb-3 projects-card-min-time position-relative">
                                            <?php echo $ftch_prj_det_qry_rslt_data['prj_min_time']; ?>
                                            <span class="position-absolute px-3 py-1 rounded-pill projects-card-time-title">
                                                Minimum Timelimit
                                            </span>
                                        </button>

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Timeline > Max-time +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <button type="button" class="btn px-4 py-3 mx-auto projects-card-max-time position-relative mb-3">
                                            <?php echo $ftch_prj_det_qry_rslt_data['prj_max_time']; ?>
                                            <span class="position-absolute px-3 py-1 rounded-pill projects-card-time-title m-0">
                                                Maximum Timelimit
                                            </span>
                                        </button>


                                        <hr>

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Bid value +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="w-100 d-flex justify-content-center align-items-center">
                                            <button class="btn bid-val text-center px-4 py-2 mb-3">
                                                <?php echo $ftch_prj_det_qry_rslt_data['prj_bid_val']; ?>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            <?php
                                }
                            } else {
                                $message = "No Project Uploaded Yet !";
                            }
                            ?>
                            
                            </div>
                        
                        </div>

                    </div>

                </div>
            </div>


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( Company Details ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-company justify-content-center align-items-center m-0"
                id="companyDetailsRow" style="display:none;">

                <div class="col-xxl-7 col-xl-6 col-lg-10">


                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Personal Details ) > Card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card">

                        <div class="card-header dash-personal-cur-hed">
                            Current Details
                        </div>


                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Personal Details ) > Card > Current +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <div class="card-body py-3">

                            <table class="table table-striped-columns table-bordered">
                                <tbody>
                                    <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Current > Name ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Name</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['clnm']; ?>
                                        </td>
                                    </tr>

                                    <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Current > Type of Service ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Type of Service</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['clsrvrtype']; ?>
                                        </td>
                                    </tr>

                                    <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Current > Country - Address ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Country - Address</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['claddr']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>



                            <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Edit Btn ++++++++++++++++++++++++++++ -->

                            <div class="btn btn-edit px-3 py-2 mt-3" onclick="toggleForm('editFormPersonal')">
                                Edit Details
                            </div>

                        </div>

                    </div>

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Personal Details ) > Hidden Section ( >> Form ) - UPDATE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card hidden-form mt-5 mb-3" id="editFormPersonal">
                        <div class="card-body py-3">


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Personal Details ) > Hidden Form ( PHP ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <form method="POST" class="form" id="MainEditPersonalForm">

                                <div class="row px-0 py-3 mx-0">

                                    <div class="form-group col-xxl-5" name="serviceTypeer">

                                        <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Type + Address > Type Options ++++++++++++++++++++++++++++ -->

                                        <label class="form-field-title  py-1 px-1">Which type of service you provide
                                            ?</label>

                                        <br>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="serviceType" value="SaaS"
                                                id="serviceSS">
                                            <label class="form-check-label form-field-title"
                                                for="serviceSS">SaaS</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="serviceType" value="PaaS"
                                                id="servicePS">
                                            <label class="form-check-label form-field-title"
                                                for="servicePS">PaaS</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="serviceType" value="IaaS"
                                                id="serviceIS">
                                            <label class="form-check-label form-field-title"
                                                for="serviceIS">IaaS</label>
                                        </div>

                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Type + Address > Client Address ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-5">
                                        <label for="countryClient" class="form-field-title  py-1 px-1">Country -
                                            Address</label>
                                        <input type="text" class="form-control" id="countryClient" name="countryClient"
                                            placeholder="Country - Address" maxlength="30">
                                    </div>


                                </div>


                                <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Hidden Form > Save Btn ++++++++++++++++++++++++++++ -->

                                <button type="submit" class="btn btn-save px-3 py-2 mt-3" name="MainEditPersonalForm">
                                    Save Details
                                </button>

                            </form>



                        </div>
                    </div>


                </div>

            </div>


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( Contact Details ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-contact justify-content-center align-items-center m-0" id="ContactRow"
                style="display:none;">

                <div class="col-xxl-7 col-xl-6 col-lg-10">

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Contact Details ) < Card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card">

                        <div class="card-header dash-personal-cur-hed">
                            Current Details
                        </div>


                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Contact Details ) > Card > Current +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <div class="card-body py-3">

                            <table class="table table-striped-columns table-bordered">
                                <tbody>
                                    <!-- ++++++++++++++++++++++++++++ ( Contact Details ) > Card > Current > Email ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Email</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['clmail']; ?>
                                        </td>
                                    </tr>

                                    <!-- ++++++++++++++++++++++++++++ ( Contact Details ) > Card > Current > Phone No ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Phone No.</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['clphone']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <!-- ++++++++++++++++++++++++++++ ( Contact Details ) > Card > Edit Btn ++++++++++++++++++++++++++++ -->

                            <div class="btn btn-edit px-3 py-2 mt-3" onclick="toggleForm('editFormcontact')">
                                Edit Details
                            </div>

                        </div>

                    </div>


                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Contact Details ) > Hidden Section ( >> Form ) - UPDATE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card hidden-form mt-5 mb-3" id="editFormcontact">

                        <div class="card-body py-3">


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Contact Details ) > Hidden Form ( PHP ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <form method="POST" class="form" id="MainEditContactForm">

                                <div class="row px-0 py-3 mx-0">

                                    <!-- ++++++++++++++++++++++++++++ ( Contact Details ) > Hidden Form ( PHP ) > Update Email ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-6">
                                        <label for="contactEmail" class="form-field-title  py-1 px-1">Email</label>
                                        <input type="email" class="form-control" id="contactEmail" name="contactEmail"
                                            placeholder="Email" maxlength="40">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Contact Details ) > Hidden Form ( PHP ) > Update Phone Number ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-5">
                                        <label for="contactPhone" class="form-field-title  py-1 px-1">Phone
                                            number</label>
                                        <input type="tel" class="form-control" id="contactPhone" name="contactPhone"
                                            value="+91 " placeholder="+91 9265829761" maxlength="14"
                                            onfocus="this.setSelectionRange(this.value.length, this.value.length);"
                                            oninput="checkPhone('contactPhone')">
                                    </div>
                                </div>

                                <!-- ++++++++++++++++++++++++++++ ( Contact Details ) > Hidden Form ( PHP ) > Save Btn ++++++++++++++++++++++++++++ -->

                                <button type="submit" class="btn btn-save px-3 py-2 mt-3" name="MainEditContactForm">
                                    Save Details
                                </button>

                            </form>


                        </div>

                    </div>


                </div>

            </div>


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( Username + password ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-identity justify-content-center align-items-center m-0" id="IdentityspaceRow" style="display:none;">

                <div class="col-xxl-7 col-xl-6 col-lg-10">

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Username + password ) > card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card">

                        <div class="card-header dash-personal-cur-hed">
                            Current Details
                        </div>



                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Username + password ) > card > Current +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <div class="card-body py-3">

                            <table class="table table-striped-columns table-bordered">
                                <tbody>
                                    <!-- ++++++++++++++++++++++++++++ ( Username + password ) > card > Username ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Username</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['clusrnm']; ?>
                                        </td>
                                    </tr>

                                    <!-- ++++++++++++++++++++++++++++ ( Username + password ) > card > Password ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Password</th>
                                        <td class="card-field-val">
                                            <div class="position-relative">
                                                <div class="h-100 w-100" id="masked-password">
                                                    Not able to show password due to security reasons ..
                                                </div>
                                                <span class="toggle-password-icon-ui" id="toggle-password-icon-ui"
                                                    onmousedown="showPassword()"
                                                    onmouseup="hidePassword()"
                                                    onmouseleave="hidePassword()">
                                                    <img id="eye-open-icon-ui" src="../Assets/SVG/eye-open.svg" alt="Openpsui" style="display: none;" loading="lazy">
                                                    <img id="eye-close-icon-ui" src="../Assets/SVG/eye-closed.svg" alt="Closepsui" loading="lazy">
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <!-- ++++++++++++++++++++++++++++ ( Username + password ) > card > Edit btn ++++++++++++++++++++++++++++ -->

                            <div class="btn btn-edit px-3 py-2 mt-3" onclick="toggleForm('editFormidentity')">
                                Edit Details
                            </div>

                        </div>

                    </div>


                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Section ( >> Form ) - UPDATE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card hidden-form mt-5 mb-3" id="editFormidentity">

                        <div class="card-body py-3">


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <form method="POST" class="form" id="MainEditUserPasForm">

                                <div class="row px-0 py-3 mx-0">

                                    <!-- ++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) > Update Username ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-6">
                                        <label for="username" class="form-field-title  py-1 px-1">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            placeholder="Username" minlength="3" maxlength="25" autocomplete="true">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) > Update Password ++++++++++++++++++++++++++++ -->

                                    <div class="row gap-2">
                                        <div class="form-group col-xxl-5 position-relative" name="pass-group">

                                            <label for="password" class="form-field-title  py-1 px-1">Create
                                                Password</label>

                                            <div class="passiconwrap">
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="Password" maxlength="18"
                                                    autocomplete="true">
                                                <span class="toggle-password-icon" id="toggle-password-icon">

                                                    <img id="eye-open-icon" src="../Assets/SVG/eye-open.svg" alt="Open"
                                                        loading="lazy">
                                                    <img id="eye-close-icon" src="../Assets/SVG/eye-closed.svg"
                                                        alt="Close" loading="lazy">

                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) > Update Password Conform ++++++++++++++++++++++++++++ -->

                                    <div class="row gap-2">
                                        <div class="form-group col-xxl-5 position-relative" name="pass-group-conf">

                                            <label for="confirmPassword" class="form-field-title  py-1 px-1">Re-enter
                                                Password</label>

                                            <div class="passiconwrap">
                                                <input type="password" class="form-control" id="confirmPassword"
                                                    name="confirmPassword" placeholder="Confirm Password" maxlength="18"
                                                    autocomplete="true">
                                                <span class="toggle-password-icon" id="toggle-password-icon-reenter">

                                                    <img id="eye-open-icon-reenter" src="../Assets/SVG/eye-open.svg"
                                                        alt="Open" loading="lazy">
                                                    <img id="eye-close-icon-reenter" src="../Assets/SVG/eye-closed.svg"
                                                        alt="Close" loading="lazy">

                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                </div>


                                <!-- ++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) > Save Btn ++++++++++++++++++++++++++++ -->

                                <button type="submit" class="btn btn-save px-3 py-2 mt-3" name="MainEditUserPasForm">
                                    Save Details
                                </button>

                            </form>



                        </div>

                    </div>


                </div>

            </div>

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( Projects ORG ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-project justify-content-center align-items-center m-0" id="projectsRow" style="display:none;">

                <div class="col-xxl-10 col-xl-11">

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Username + password ) > card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card allprjs">

                        <div class="card-header dash-personal-cur-hed">
                            Current Projects
                        </div>



                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Username + password ) > card > Current +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <div class="card-body py-3">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Project Title</th>
                                        <th>Project Description</th>
                                        <th>Requirements</th>
                                        <th>Help Desk</th>
                                        <th>Timelimit - Min</th>
                                        <th>Timelimit - Max</th>
                                        <th>Bid Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                <?php
                                if ($ftch_tbl_data_rslt->num_rows > 0) {
                                    while ($ftch_tbl_data_rslt_data = $ftch_tbl_data_rslt->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_title']); ?></td>
                                            <td><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_descr']); ?></td>
                                            <td>
                                                <ul>
                                                    <li><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_req_1']); ?></li>
                                                    <li><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_req_2']); ?></li>
                                                    <li><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_req_3']); ?></li>
                                                </ul>
                                            </td>
                                            <td><a href="#" class="card-link"><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_lnk']); ?></a></td>
                                            <td><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_min_time']); ?></td>
                                            <td><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_max_time']); ?></td>
                                            <td><?php echo htmlspecialchars($ftch_tbl_data_rslt_data['prj_bid_val']); ?></td>
                                            <td>
                                                <form method="POST">
                                                    <input type="hidden" name="del_id" value="<?php echo htmlspecialchars($ftch_tbl_data_rslt_data['project_id']); ?>">
                                                    <button type="submit" class="btn btn-danger" name="delprj_btn">Delete Project</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php 
                                    }
                                } else {
                                    echo "<tr><td colspan='8' class='text-center'>No projects found.</td></tr>";
                                }
                                ?>

                                </tbody>
                            </table>



                            <div class="btn btn-edit px-3 py-2 mt-3" onclick="toggleForm('editFormprojects')">
                                Create & Place Projects
                            </div>

                        </div>

                    </div>


                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Section ( >> Form ) - UPDATE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card hidden-form mt-5 mb-3" id="editFormprojects">

                        <div class="card-body py-3">


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <form method="POST" class="form" id="MainCreateProjForm">

                                <div class="row px-0 py-3 mx-0">

                                    <!-- ++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) > Update Username ++++++++++++++++++++++++++++ -->

                                    <div class="col-xxl-6 form-group">
                                        <label for="projectTitle" class="form-field-title py-1 px-1">Title</label>
                                        <input type="text" class="form-control" id="projectTitle" name="projectTitle"
                                            placeholder="Project Name" minlength="5" maxlength="40">
                                    </div>

                                    <div class="col-xxl-6 form-group">
                                        <label for="projectDisc" class="form-field-title py-1 px-1">Description</label>
                                        <textarea class="form-control" name="projectDisc" id="projectDisc" cols=""
                                            rows="1" maxlength="300"></textarea>
                                    </div>

                                    <div class="form-group col-xxl-4">
                                        <label for="fieldLang1" class="form-field-title  py-1 px-1">Requirements</label>
                                        <input type="text" class="form-control" id="fieldLang1" name="fieldReq1"
                                            placeholder="BS - Frontend" minlength="2" maxlength="25">
                                    </div>

                                    <div class="form-group col-xxl-4">
                                        <label for="fieldLang2" class="form-field-title  py-1 px-1">Requirements
                                            2</label>
                                        <input type="text" class="form-control" id="fieldLang2" name="fieldReq2"
                                            placeholder="Node - Backend" minlength="2" maxlength="25">
                                    </div>

                                    <div class="form-group col-xxl-4">
                                        <label for="fieldLang3" class="form-field-title  py-1 px-1">Requirements</label>
                                        <input type="text" class="form-control" id="fieldLang3" name="fieldReq3"
                                            placeholder="MySQL - Database" minlength="2" maxlength="25">
                                    </div>

                                    <div class="form-group col-xxl-4">
                                        <label for="linkInput" class="form-label">Enter Link</label>
                                        <input type="url" class="form-control" id="linkInput"
                                            placeholder="https://helpDesk.com" name="prjlnk" required>
                                        <div class="form-text">Please enter a valid URL.</div>
                                    </div>

                                    <div class="form-group col-xxl-7">
                                        <label for="timelineInputmin" class="form-label">Timeline-min
                                            (DD-Month-YYYY)</label>
                                        <input type="text" class="form-control" id="timelineInputmin" name="mintime"
                                            placeholder="03-July-2025" minlength="11" maxlength="17" required>
                                        <div class="form-text">Please enter a date in the format DD-Month-YYYY.</div>
                                    </div>

                                    <div class="form-group col-xxl-7">
                                        <label for="timelineInputmax" class="form-label">Timeline-max
                                            (DD-Month-YYYY)</label>
                                        <input type="text" class="form-control" id="timelineInputmax" name="maxtime"
                                            placeholder="10-July-2025" minlength="11" maxlength="17" required>
                                        <div class="form-text">Please enter a date in the format DD-Month-YYYY.</div>
                                    </div>

                                    <div class="form-group col-xxl-7">
                                        <label for="bidVal" class="form-label">Bid Value</label>
                                        <input type="text" class="form-control" id="bidVal" name="bidVal"
                                            placeholder="$1000" minlength="3" maxlength="7" required>
                                    </div>


                                </div>


                                <!-- ++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) > Save Btn ++++++++++++++++++++++++++++ -->

                                <button type="submit" class="btn btn-save px-3 py-2 mt-3" name="MainCreateProjForm">
                                    Save Details
                                </button>

                            </form>



                        </div>

                    </div>


                </div>

            </div>


        </div>
    </div>


</body>

</html>