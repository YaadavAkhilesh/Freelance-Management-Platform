<?php

    include_once '../Data/Session.php';
    include '../Data/Conn.php';

    $message = "";

    if(isset($_POST['btnlogout'])){
        session_unset();
        session_destroy();
        header("Location: /Main/Pages/Login.php");
        exit();
    }

    $usrid = $_SESSION['usrid'];
    $ftch_qry = "SELECT * FROM frelacer_det WHERE frelance_id = '$usrid'";

    $ftch_qry_rslt = $conn->query($ftch_qry);

    if($ftch_qry_rslt->num_rows > 0){

        $ftch_qry_rslt_data = $ftch_qry_rslt->fetch_assoc();

    }
    else{
        $message = "No data found !";
        header("Location: /Main/Pages/Registration.php");
        exit();
    }

    if(isset($_POST['MainEditPersonalForm'])){

        
        $name = $_POST['fname'];
        $lnm = $_POST['lname'];
        $freage = $_POST['age'];
        $cntry = $_POST['countryFreelancer'];

        $updt_qry = "UPDATE frelacer_det SET frenm = '$name' , frelnm = '$lnm' , freage = $freage , frecntry = '$cntry' WHERE frelance_id = '$usrid'";

        $updt_qry_rslt = $conn->query($updt_qry);

        if($updt_qry_rslt === true){

            header("Location: /Main/Pages/Dashboard.php");
            $message = "Updated Successfully !";

        }
        else{
            $message = "Error ! While Updating ..".$conn->error;
        }
    }

    if(isset($_POST['MainEditEDUForm'])){

        if (isset($_POST['fieldLang3'])) {
            $fieldLang3 = $_POST['fieldLang3'];
            $lang3flg = 1;
        } else {
            $lang3flg = 0;
        }

        if (isset($_POST['degree'])) {
            $degree = $_POST['degree'];
            $degflg = 1;
        } else {
            $degflg = 0;
        }

        $field = $_POST['field'];
        $fieldLang1 = $_POST['fieldLang1'];
        $fieldLang2 = $_POST['fieldLang2'];
        $technology = $_POST['technology'];

        if($degflg == 1 && $lang3flg == 1){

            $updt_qry = "UPDATE frelacer_det SET frefield = '$field' , frelan1 = '$fieldLang1' , frelan2 = '$fieldLang2' , frelan3 = '$fieldLang3' , fretech = '$technology' , fredeg = '$degree' WHERE frelance_id = '$usrid'";

        }
        else if($degflg == 0 && $lang3flg == 0){

            $updt_qry = "UPDATE frelacer_det SET frefield = '$field' , frelan1 = '$fieldLang1' , frelan2 = '$fieldLang2' , fretech = '$technology' WHERE frelance_id = '$usrid'";

        }
        else if($degflg == 1 && $lang3flg == 0){

            $updt_qry = "UPDATE frelacer_det SET frefield = '$field' , frelan1 = '$fieldLang1' , frelan2 = '$fieldLang2' , fretech = '$technology' , fredeg = '$degree' WHERE frelance_id = '$usrid'";

        }
        else{

            $updt_qry = "UPDATE frelacer_det SET frefield = '$field' , frelan1 = '$fieldLang1' , frelan2 = '$fieldLang2' , frelan3 = '$fieldLang3' , fretech = '$technology' WHERE frelance_id = '$usrid'";

        }

        $updt_qry_rslt = $conn->query($updt_qry);

        if($updt_qry_rslt === true){

            header("Location: /Main/Pages/Dashboard.php");
            $message = "Updated Successfully !";

        }
        else{
            $message = "Error ! While Updating ..".$conn->error;
        }


    }


    if(isset($_POST['editFormexpintern'])){
        $experience = $_POST['experience'];

        $updt_qry = "UPDATE frelacer_det SET freexpr = '$experience' WHERE frelance_id = '$usrid'";
        $updt_qry_rslt = $conn->query($updt_qry);

        if($updt_qry_rslt === true){

            header("Location: /Main/Pages/Dashboard.php");
            $message = "Updated Successfully !";

        }
        else{
            $message = "Error ! While Updating ..".$conn->error;
        }
        
    }

    if(isset($_POST['MainEditContactForm'])){

        $mail = $_POST['contactEmail'];
        $phone = $_POST['contactPhone'];

        $updt_qry = "UPDATE frelacer_det SET fremail = '$mail' , frephone = '$phone' WHERE frelance_id = '$usrid'";
        $updt_qry_rslt = $conn->query($updt_qry);

        if($updt_qry_rslt === true){

            header("Location: /Main/Pages/Dashboard.php");
            $message = "Updated Successfully !";

        }
        else{
            $message = "Error ! While Updating ..".$conn->error;
        }


    }

    if(isset($_POST['MainEditUserPasForm'])){

        $username = $_POST['username'];
        $passwd = $_POST['password'];
        $conformPasswd = $_POST['confirmPassword'];

        if($password === $confirmPassword){

            $confirmPassword = password_hash($conformPasswd,PASSWORD_DEFAULT);

            $updt_qry = "UPDATE frelacer_det SET freusrnm = '$username' , frepasswd = '$confirmPassword' WHERE frelance_id = '$usrid'";

            $updt_qry_rslt = $conn->query($updt_qry);

            if($updt_qry_rslt === true){
                
                session_unset();
                session_destroy();
                header("Location: /Main/Pages/Login.php");
                $message = "Updated Successfully !";
    
            }
            else{
                $message = "Error ! While Updating ..".$conn->error;
            }
        }
        else{
            $message = "Password Not Match !";
        }
    }
    

    $ftch_prj_det_qry  = "SELECT bp.id AS bid_id, bp.project_id, bp.client_id, bp.bid_prj_stat, bp.bid_date , p.prj_title, p.prj_descr, p.prj_lnk , p.prj_req_1 , p.prj_req_2 , p.prj_req_3 , p.prj_min_time, p.prj_max_time, p.prj_bid_val ,c.clnm AS client_name , c.claddr FROM bided_projects bp JOIN project_det p ON bp.project_id = p.project_id JOIN client_det c ON bp.client_id = c.client_id WHERE bp.frelance_id = '$usrid';";

    $ftch_prj_det_qry_rslt = $conn->query($ftch_prj_det_qry);




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
    <link rel="stylesheet" href="../Assets/CSS/dashboard.css">

    <script defer src="../Assets/BS/js/bootstrap.bundle.min.js"></script>
    <script defer src="../Assets/BS/js/bootstrap.min.js"></script>
    <script defer src="../Assets/JS/dashboard.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Flat&family=Passero+One&family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Karla:ital,wght@0,200..800;1,200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Megrim&display=swap" rel="stylesheet">

</head>

<body>

    <?php

        include_once "../Utils/Error_Model.php";

    ?>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashboard Navbar +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="dashbar-main fixed-top d-flex justify-content-between p-0 my-3 text-center">

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashbar > Offcanvas Toggler +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <ul class="nav dashnav-top-btns mx-3 px-1 align-items-center dashnav-toggle">

            <button class="navbar-toggler p-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <span class="navbar-toggler-icon"></span>
            </button>

        </ul>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dashbar > Username + Notification + Profile Icon +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <ul class="nav justify-content-between dashnav-top p-2 mx-2 align-items-center">

            <a class="dashnav-user p-0 me-5 ms-3" href="#">
                <?php
                    echo $ftch_qry_rslt_data['frenm'] . " " . $ftch_qry_rslt_data['frelnm'];
                ?>
            </a>

            <div class="dashnav d-flex gap-2 px-2">
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

    <div class="offcanvas offcanvas-start cust-dashoffcan m-3" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Offcanvas > Header +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <div class="offcanvas-header py-3 d-flex justify-content-between">
            <h5 class="d-block mx-auto m-0" id="offcanvasScrollingLabel">Dashboard</h5>
        </div>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Offcanvas > Body + Links Btn +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <div class="offcanvas-body">

            <div class="btn btn-nav-items active text-center w-100 py-2 my-1" data-section-id="profielRow">
                Desk
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="personalDetailsRow">
                Personal Details
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="EduCertRow">
                Education
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="ExpInternRow">
                Experience
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="ContactRow">
                Contact Details
            </div>
            <div class="btn btn-nav-items text-center w-100 py-2 my-1" data-section-id="IdentityspaceRow">
                Identity
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

                            <img src="../Assets/SVG/free-profile.svg" class="d-block mx-auto my-1" alt="Profile" height="200" width="200" loading="lazy">

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > Card > Username + Bluetickmark +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="text-center my-0 dash-card-user-name p-0">#
                                <span>
                                    <?php
                                        echo $ftch_qry_rslt_data['frenm'] . " " . $ftch_qry_rslt_data['frelnm'];
                                    ?>
                                    <img src="../Assets/SVG/blurmark.svg" alt="verified" height="40" width="32" loading="lazy">
                                </span>

                            </div>

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > Card > All Links +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="d-flex justify-content-center my-0 py-2">

                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > Github ++++++++++++++++++++++++++++ -->

                                <a href="" class="card-link">
                                    <img src="../Assets/SVG/link-45deg.svg" alt="Link" height="25" width="25" class="p-0 m-0" loading="lazy">
                                    Github
                                </a>

                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > user_mail ++++++++++++++++++++++++++++ -->

                                <a href="" class="card-link">
                                    <img src="../Assets/SVG/link-45deg.svg" alt="Link" height="25" width="25" class="p-0 m-0" loading="lazy">
                                    <?php
                                        echo $ftch_qry_rslt_data['fremail'];
                                    ?>
                                </a>

                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > user_location ++++++++++++++++++++++++++++ -->

                                <a href="" class="card-link">
                                    <img src="../Assets/SVG/location.svg" alt="Link" height="25" width="25" class="p-0 m-0" loading="lazy">
                                    <?php
                                        echo $ftch_qry_rslt_data['frecntry'];
                                    ?>
                                </a>

                            </div>


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > card > Fields + Languages + Technologies +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="d-flex py-3 gap-2 flex-wrap justify-content-center align-items-center w-50 mx-auto">


                                <button type="button" class="btn my-0 px-4 py-2 dash-card-btn-specs">
                                    <?php
                                        echo $ftch_qry_rslt_data['frefield'];
                                    ?>
                                </button>


                                <button type="button" class="btn my-0 px-4 py-2 dash-card-btn-specs">
                                    <?php
                                        echo $ftch_qry_rslt_data['frelan1'];
                                    ?>
                                </button>
                                <button type="button" class="btn my-0 px-4 py-2 dash-card-btn-specs">
                                    <?php
                                        echo $ftch_qry_rslt_data['frelan2'];
                                    ?>
                                </button>

                                <button type="button" class="btn my-0 px-4 py-2 dash-card-btn-specs">
                                    <?php
                                        echo $ftch_qry_rslt_data['fretech'];
                                    ?>  
                                </button>


                            </div>


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > card > Working + Previous + Experience Projects +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="row gap-2 m-0 flex-wrap justify-content-center">

                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > Previous Projects ++++++++++++++++++++++++++++ -->

                                <div class="col-xxl-5 btn px-4 py-3 dash-card-prof-previous position-relative">
                                    Comming Soon ...
                                    <span class="position-absolute px-3 py-1 rounded-pill dash-card-prof-current-title m-0">
                                        Previous
                                    </span>
                                </div>

                                <!-- ++++++++++++++++++++++++++++ ( main profile ) > card > Experience ++++++++++++++++++++++++++++ -->

                                <div class="col-xxl-5 btn px-4 py-3 dash-card-prof-previous position-relative">
                                    <?php echo $ftch_qry_rslt_data['freexpr']; ?>
                                    <span class="position-absolute px-3 py-1 rounded-pill dash-card-prof-current-title m-0">
                                        Experience
                                    </span>
                                </div>

                            </div>



                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( main profile ) > card > Working On Big Card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="row my-5 justify-content-center align-items-center" style="min-width:90vw;">

                            <?php
                                if($ftch_prj_det_qry_rslt->num_rows > 0){

                                    while($ftch_prj_det_qry_rslt_data = $ftch_prj_det_qry_rslt->fetch_assoc()){

                            ?>

                                <div class="col-xxl-8 col-xl-12">

                                    <div class="card">

                                        <div class="text-center card-header py-3"> 
                                            <?php 
                                                echo $ftch_prj_det_qry_rslt_data['prj_title'];
                                            ?>
                                        - <b>Working ON</b>
                                        </div>
                                        
                                        <img src="../Assets/SVG/microsoft.svg" class="d-block mx-auto my-1 mt-3 py-1" alt="Profile" height="200" width="200" loading="lazy">



                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Client Name +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="text-center my-0 projects-card-org-name p-0">#
                                            <span>
                                            <?php 
                                                echo $ftch_prj_det_qry_rslt_data['client_name'];
                                            ?>
                                                <img src="../Assets/SVG/blurmark.svg" alt="verified" height="40" width="32" loading="lazy">
                                            </span>
                                        </div>


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Project Description +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="project-disc text-center p-3">
                                            <?php 
                                                echo $ftch_prj_det_qry_rslt_data['prj_descr'];
                                            ?>
                                        </div>


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Project Links +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="d-flex justify-content-center my-0 py-2">

                                            <!-- ++++++++++++++++++++++++++++ Working On Big Card > Project Links > Help Desk ++++++++++++++++++++++++++++ -->

                                            <a href="#" class="card-link">
                                                <img src="../Assets/SVG/link-45deg.svg" alt="Link" height="25" width="25" class="p-0 m-0" loading="lazy">
                                                <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['prj_lnk'];
                                                ?>
                                            </a>

                                            <!-- ++++++++++++++++++++++++++++ Working On Big Card > Project Links > Project / Company Location ++++++++++++++++++++++++++++ -->

                                            <a href="#" class="card-link">
                                                <img src="../Assets/SVG/location.svg" alt="Link" height="25" width="25" class="p-0 m-0" loading="lazy">
                                                <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['claddr'];
                                                ?>
                                            </a>

                                        </div>


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Projects Requirements Techno + Lang +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="d-flex pt-3 gap-2 flex-wrap justify-content-center align-items-center mb-3">


                                                <button type="button" class="btn my-2 px-4 py-2 projects-card-btn-req position-relative">
                                                <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['prj_req_1'];
                                                ?>
                                                </button>

                                                <button type="button" class="btn my-2 px-4 py-2 projects-card-btn-req position-relative">
                                                <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['prj_req_2'];
                                                ?>
                                                </button>

                                                <button type="button" class="btn my-2 px-4 py-2 projects-card-btn-req position-relative">
                                                <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['prj_req_3'];
                                                ?>
                                                </button>

                                        </div>

                                        <hr>


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Project Time Line + Bid Date +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Timeline > Bid Date +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <button type="button" class="btn px-4 py-3 mb-3 mx-auto projects-card-min-time position-relative" id="bidDate">
                                                <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['bid_date'];
                                                ?>
                                            <span class="position-absolute px-3 py-1 rounded-pill projects-card-time-title">
                                                Bid Date
                                            </span>
                                        </button>

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Timeline > Min Time +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <button type="button" class="btn px-4 py-3 mb-3 mx-auto projects-card-min-time position-relative">
                                                <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['prj_min_time'];
                                                ?>
                                            <span class="position-absolute px-3 py-1 rounded-pill projects-card-time-title">
                                                Minimum Timelimit
                                            </span>
                                        </button>

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Timeline > Max-time +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <button type="button" class="btn px-4 py-3 mx-auto projects-card-max-time position-relative mb-3">
                                            <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['prj_max_time'];
                                                ?>    
                                        <span class="position-absolute px-3 py-1 rounded-pill projects-card-time-title m-0">
                                                Maximum Timelimit
                                            </span>
                                        </button>


                                        <hr>

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Bid value +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <div class="w-100 d-flex justify-content-center align-items-center">
                                            <button class="btn bid-val text-center px-4 py-2 mb-3">
                                                <?php 
                                                    echo $ftch_prj_det_qry_rslt_data['prj_bid_val'];
                                                ?>
                                            </button>
                                        </div>

                                    </div>

                                </div>


                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Working On Big Card > Project Title + Client Logo +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


                            <?php
                                
                                    }

                                }
                                else {
                                    $message = "No project Selected !";
                                }
                            ?>

                            </div>

                        </div>

                    </div>

                </div>
            </div>


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( Personal Details ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-personal justify-content-center align-items-center m-0" id="personalDetailsRow" style="display:none;">

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
                                        <tr>
                                            <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Current > Name ++++++++++++++++++++++++++++ -->
                                            <th scope="col" class="text-center card-field">Name</th>
                                            <td class="card-field-val">
                                                <?php echo $ftch_qry_rslt_data['frenm']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Current > Last Name ++++++++++++++++++++++++++++ -->
                                            <th scope="col" class="text-center">Last Name</th>
                                            <td>
                                                <?php echo $ftch_qry_rslt_data['frelnm']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Current > Age ++++++++++++++++++++++++++++ -->    
                                            <th scope="col" class="text-center">Age</th>
                                            <td>
                                                <?php echo $ftch_qry_rslt_data['freage']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <!-- ++++++++++++++++++++++++++++ ( Personal Details ) > Card > Current > Country ++++++++++++++++++++++++++++ -->
                                            <th scope="col" class="text-center">Country</th>
                                            <td>
                                                <?php echo $ftch_qry_rslt_data['frecntry']; ?>
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


                                    <!-- ++++++++++++++++++++++++++++ ( Personal Details ) >> Hidden Form ( PHP ) > Update Name ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-6 col-xl-6">
                                        <label for="firstName" class="form-field-title py-1 px-1">Name</label>
                                        <input type="text" class="form-control" id="firstName" name="fname" placeholder="Name" minlength="3" maxlength="30">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Personal Details ) >> Hidden Form ( PHP ) > Update Last Name ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-6 col-xl-6">
                                        <label for="lastName" class="form-field-title py-1 px-1">Last name</label>
                                        <input type="text" class="form-control" id="lastName" name="lname" placeholder="Last Name" minlength="3" maxlength="30">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Personal Details ) >> Hidden Form ( PHP ) > Update Age ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-4">
                                        <label for="age" class="form-field-title  py-1 px-1">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" placeholder="Age" min="18" max="50">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Personal Details ) >> Hidden Form ( PHP ) > Update Country ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-4">
                                        <label for="countryFreelancer" class="form-field-title  py-1 px-1">Country</label>
                                        <input type="text" class="form-control" id="countryFreelancer" name="countryFreelancer" placeholder="Country" maxlength="25">
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


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( Education + Certification ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-educert justify-content-center align-items-center m-0" id="EduCertRow" style="display:none;">

                <div class="col-xxl-7 col-xl-6 col-lg-10">


                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Education + Certification ) > Card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card">

                        <div class="card-header dash-personal-cur-hed">
                            Current Details
                        </div>


                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Education + Certification ) > Card > Current +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <div class="card-body py-3">


                        <table class="table table-striped-columns table-bordered">
                            <tbody>
                                <!-- ++++++++++++++++++++++++++++ ( Education + Certification ) > Card > Current > Field ++++++++++++++++++++++++++++ -->
                                <tr>
                                    <th scope="col" class="text-center card-field">Field</th>
                                    <td class="card-field-val">
                                        <?php echo $ftch_qry_rslt_data['frefield']; ?>
                                    </td>
                                </tr>

                                <!-- ++++++++++++++++++++++++++++ ( Education + Certification ) > Card > Current > Programming Language ++++++++++++++++++++++++++++ -->
                                <tr>
                                    <th scope="col" class="text-center card-field">Programming Language</th>
                                    <td class="card-field-val">
                                        <?php echo $ftch_qry_rslt_data['frelan1']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center card-field">Programming Language</th>
                                    <td class="card-field-val">
                                        <?php echo $ftch_qry_rslt_data['frelan2']; ?>
                                    </td>
                                </tr>

                                <?php
                                if ($ftch_qry_rslt_data['frelan3'] !== null && $ftch_qry_rslt_data['frelan3'] !== '') { ?>
                                    <tr>
                                        <th scope="col" class="text-center card-field">Programming Language</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['frelan3']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <!-- ++++++++++++++++++++++++++++ ( Education + Certification ) > Card > Current > Technology ++++++++++++++++++++++++++++ -->
                                <tr>
                                    <th scope="col" class="text-center card-field">Technology Specification</th>
                                    <td class="card-field-val">
                                        <?php echo $ftch_qry_rslt_data['fretech']; ?>
                                    </td>
                                </tr>

                                <!-- ++++++++++++++++++++++++++++ ( Education + Certification ) > Card > Current > Degree Certification If Exist PHP Code ++++++++++++++++++++++++++++ -->
                                <?php
                                if ($ftch_qry_rslt_data['fredeg'] !== null && $ftch_qry_rslt_data['fredeg'] !== '') { ?>
                                    <tr>
                                        <th scope="col" class="text-center card-field">Degree / Certification</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['fredeg']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>


                            <!-- ++++++++++++++++++++++++++++ ( Education + Certification ) > Card > Edit btn ++++++++++++++++++++++++++++ -->

                            <div class="btn btn-edit px-3 py-2 mt-4" onclick="toggleForm('editFormEduCert')">
                                Edit Details
                            </div>

                        </div>

                    </div>


                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Education / Certification ) > Hidden Section ( >> Form ) - UPDATE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card hidden-form mt-5 mb-3 mb-3" id="editFormEduCert">

                        <div class="card-body py-3">


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Education / Certification ) > Hidden Form ( PHP ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


                            <form method="POST" class="form" id="MainEditEDUForm">

                                <div class="row px-0 py-3 mx-0">

                                    <!-- ++++++++++++++++++++++++++++ ( Education / Certification ) >> Hidden Form ( PHP ) > Update Field ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-4">
                                        <label for="field" class="form-field-title  py-1 px-1">Field</label>
                                        <input type="text" class="form-control" id="field" name="field" placeholder="Web Development" maxlength="30">
                                    </div>


                                    <!-- ++++++++++++++++++++++++++++ ( Education / Certification ) >> Hidden Form ( PHP ) > Update Programming Language 1 ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-4">
                                        <label for="fieldLang1" class="form-field-title  py-1 px-1">Programming Language 1</label>
                                        <input type="text" class="form-control" id="fieldLang1" name="fieldLang1" placeholder="Python" maxlength="15">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Education / Certification ) >> Hidden Form ( PHP ) > Update Programming Language 2 ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-4">
                                        <label for="fieldLang2" class="form-field-title  py-1 px-1">Programming Language 2</label>
                                        <input type="text" class="form-control" id="fieldLang2" name="fieldLang2" placeholder="C++" maxlength="15">
                                    </div>


                                    <!-- ++++++++++++++++++++++++++++ ( Education / Certification ) >> Hidden Form ( PHP ) > Update Programming Language 3 ( Not Mendetory ) ++++++++++++++++++++++++++++ -->


                                    <div class="form-group col-xxl-4">
                                        <label for="fieldLang3" class="form-field-title  py-1 px-1">Programming Language 3</label>
                                        <input type="text" class="form-control" id="fieldLang3" name="fieldLang3" placeholder="Rust" maxlength="15">
                                    </div>


                                    <!-- ++++++++++++++++++++++++++++ ( Education / Certification ) >> Hidden Form ( PHP ) > Update Technolgy ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-4">
                                        <label for="technology" class="form-field-title  py-1 px-1">Technology Specification</label>
                                        <input type="text" class="form-control" id="technology" name="technology" placeholder="Blockchain" maxlength="30">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Education / Certification ) >> Hidden Form ( PHP ) > Update Degree / Certification ( Not Mendetory ) ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-4">
                                        <label for="degree" class="form-field-title  py-1 px-1">Degree / Certification</label>
                                        <input type="text" class="form-control" id="degree" name="degree" placeholder="Degree / Certification" maxlength="30">
                                    </div>

                                </div>


                                <!-- ++++++++++++++++++++++++++++ ( Education / Certification ) >> Hidden Form ( PHP ) > Save Btn ++++++++++++++++++++++++++++ -->

                                <button type="submit" class="btn btn-save px-3 py-2 mt-3" name="MainEditEDUForm">
                                    Save Details
                                </button>

                            </form>



                        </div>

                    </div>


                </div>

            </div>


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( Experience + Internship ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-expintern justify-content-center align-items-center m-0" id="ExpInternRow" style="display:none;">

                <div class="col-xxl-7 col-xl-6 col-lg-10">

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Experience + Internship ) > card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card">

                        <div class="card-header dash-personal-cur-hed">
                            Current Details
                        </div>


                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Experience + Internship ) > card > Current  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <div class="card-body py-3">

                            <table class="table table-striped-columns table-bordered">
                                <tbody>
                                    <!-- ++++++++++++++++++++++++++++ ( Experience + Internship ) > card > Experience + Certification ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Experience / Certifications</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['freexpr']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- ++++++++++++++++++++++++++++ ( Experience + Internship ) > card > Edit Btn  ++++++++++++++++++++++++++++ -->

                            <div class="btn btn-edit px-3 py-2 mt-3" onclick="toggleForm('editFormexpintern')">
                                Edit Details
                            </div>

                        </div>

                    </div>

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Experience + Internship ) > Hidden Section ( >> Form ) - UPDATE +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card hidden-form mt-5 mb-3" id="editFormexpintern">

                        <div class="card-body py-3">

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ ( Experience + Internship ) > Hidden Form ( PHP ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <form method="POST" class="form" id="MainEditExpIntForm">

                                <!-- ++++++++++++++++++++++++++++ ( Experience + Internship ) > Hidden Form ( PHP ) > Update Exper.. + Intership ++++++++++++++++++++++++++++ -->

                                <div class="row px-0 py-3 mx-0">
                                    <div class="form-group col-xxl-8">
                                        <label for="experience" class="form-field-title  py-1 px-1">Experience / Internship</label>
                                        <input type="text" class="form-control" id="experience" name="experience" placeholder="1 Year , FrelaxPro PVT. LTD" maxlength="50">
                                    </div>
                                </div>

                                <!-- ++++++++++++++++++++++++++++ ( Experience + Internship ) > Hidden Form ( PHP ) > Save Btn ++++++++++++++++++++++++++++ -->

                                <button type="submit" class="btn btn-save px-3 py-2 mt-3" name="editFormexpintern">
                                    Save Details
                                </button>

                            </form>



                        </div>

                    </div>


                </div>

            </div>


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Dash Fluid > Dash-con > row ( Contact Details ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row dash-detrow dash-contact justify-content-center align-items-center m-0" id="ContactRow" style="display:none;">

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
                                            <?php echo $ftch_qry_rslt_data['fremail']; ?>
                                        </td>
                                    </tr>

                                    <!-- ++++++++++++++++++++++++++++ ( Contact Details ) > Card > Current > Phone No ++++++++++++++++++++++++++++ -->
                                    <tr>
                                        <th scope="col" class="text-center card-field">Phone No.</th>
                                        <td class="card-field-val">
                                            <?php echo $ftch_qry_rslt_data['frephone']; ?>
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
                                        <input type="email" class="form-control" id="contactEmail" name="contactEmail" placeholder="Email" maxlength="40">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Contact Details ) > Hidden Form ( PHP ) > Update Phone Number ++++++++++++++++++++++++++++ -->

                                    <div class="form-group col-xxl-5">
                                        <label for="contactPhone" class="form-field-title  py-1 px-1">Phone number</label>
                                        <input type="tel" class="form-control" id="contactPhone" name="contactPhone" value="+91 " placeholder="+91 9265829761" maxlength="14" onfocus="this.setSelectionRange(this.value.length, this.value.length);" oninput="checkPhone('contactPhone')">
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
                                            <?php echo $ftch_qry_rslt_data['freusrnm']; ?>
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
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" minlength="3" maxlength="25" autocomplete="true">
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) > Update Password ++++++++++++++++++++++++++++ -->

                                    <div class="row gap-2">
                                        <div class="form-group col-xxl-5 position-relative" name="pass-group">

                                            <label for="password" class="form-field-title  py-1 px-1">Create Password</label>

                                            <div class="passiconwrap">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="18" autocomplete="true">
                                                <span class="toggle-password-icon" id="toggle-password-icon">

                                                    <img id="eye-open-icon" src="../Assets/SVG/eye-open.svg" alt="Open" loading="lazy">
                                                    <img id="eye-close-icon" src="../Assets/SVG/eye-closed.svg" alt="Close" loading="lazy">

                                                </span>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- ++++++++++++++++++++++++++++ ( Username + Password ) > Hidden Form ( PHP ) > Update Password Conform ++++++++++++++++++++++++++++ -->

                                    <div class="row gap-2">
                                        <div class="form-group col-xxl-5 position-relative" name="pass-group-conf">

                                            <label for="confirmPassword" class="form-field-title  py-1 px-1">Re-enter Password</label>

                                            <div class="passiconwrap">
                                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" maxlength="18" autocomplete="true">
                                                <span class="toggle-password-icon" id="toggle-password-icon-reenter">

                                                    <img id="eye-open-icon-reenter" src="../Assets/SVG/eye-open.svg" alt="Open" loading="lazy">
                                                    <img id="eye-close-icon-reenter" src="../Assets/SVG/eye-closed.svg" alt="Close" loading="lazy">

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


        </div>
    </div>


</body>

</html>