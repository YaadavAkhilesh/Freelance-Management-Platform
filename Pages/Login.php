<?php

    session_start();

    if(isset($_SESSION['usrid']) && isset($_SESSION['Logstatus'])){

        if($_SESSION['Logstatus'] === true){

            header("Location: /Main/Pages/Dashboard.php");
            exit();

        }
    }

    include "../Data/Conn.php";
    $message = "";
    $message = $dbmessage;

    if(isset($_POST['btnlogin'])){

        $usrnm = $_POST['username'];
        $inppasswd = $_POST['passwd'];

        $passftch_qry = "SELECT frelance_id,freusrnm,frepasswd FROM frelacer_det WHERE freusrnm = '$usrnm'";
        $passftch_qry_cli = "SELECT client_id,clusrnm,clpasswd FROM client_det WHERE clusrnm = '$usrnm'";
        

        $passftch_qry_rslt = $conn->query($passftch_qry);
        $passftch_qry_cli_rslt = $conn->query($passftch_qry_cli);

        if($passftch_qry_rslt->num_rows > 0 ){

            $freelancerData = $passftch_qry_rslt->fetch_assoc();
            $message = $inppasswd . $freelancerData['frepasswd'];
            if(password_verify($inppasswd,$freelancerData['frepasswd'])){

                $_SESSION['usrid'] = $freelancerData['frelance_id'];
                $_SESSION['Logstatus'] = true;
                header("Location: /Main/Pages/Dashboard.php");
                exit();

            }
            else{

                $message = "Wrong password !";

            }

        }
        elseif($passftch_qry_cli_rslt->num_rows > 0){

            $clientData = $passftch_qry_cli_rslt->fetch_assoc();

            if(password_verify($inppasswd,$clientData['clpasswd'])){

                $_SESSION['usrid'] = $clientData['client_id'];
                $_SESSION['Logstatus'] = true;
                header("Location: /Main/Pages/ORGDashboard.php");
                exit();

            }
            else{

                $message = "Wrong password !";

            }

        }
        else{
            $message = "User not found !";
        }

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join us</title>
    <link rel="stylesheet" href="../Assets/BS/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/CSS/login.css">
    <link rel="stylesheet" href="../Assets/CSS/common.css">

    <script defer src="../Assets/BS/js/bootstrap.bundle.min.js"></script>
    <script defer src="../Assets/BS/js/bootstrap.min.js"></script>
    <script defer src="../Assets/JS/login.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Flat&family=Passero+One&family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Karla:ital,wght@0,200..800;1,200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Megrim&display=swap" rel="stylesheet">

</head>
<body>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Login Fluid +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid login-fluid">
        <div class="login-con">

            <?php

                include_once "../Utils/Error_Model.php";
    
            ?>


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Login Fluid > Login con > row +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row login-con-row">

                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Login Fluid > Login con > row > col +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                <div class="col-xxl-6 col-xl-6 col-lg-8 col-md-10  login-con-col">

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Login Fluid > Login con > row > Card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card">
                        
                        <div class="card-body px-5 py-4">

                            <!-- +++++++++++++++++++++++++++++ PHP Login ( Main ) Form > Brand + Title +++++++++++++++++++++++++++++ -->

                            <div class="w-100 d-flex justify-content-between">
                                <a class="login-brand px-0 py-3" href="#">FrelaxPro</a>
                                <h2 class="px-0 py-3">Login</h2>
                            </div>


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Login Fluid > Login con > row > Card > PHP Login ( Main ) Form +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <form id="loginForm" method="POST" action="../Pages/Login.php">

                                <!-- +++++++++++++++++++++++++++++ PHP Login ( Main ) Form > Email +++++++++++++++++++++++++++++ -->

                                <div class="form-group">

                                    <label for="userName" class="form-field-title py-1 px-1">Username</label>

                                    <div class="input-group-prepend">
                                        <img class="user-icon" src="../Assets/SVG/profile-user.svg" alt="User">
                                        <input type="text" class="form-control" id="userName" name="username" placeholder="Username" maxlength="25">
                                    </div>

                                    <!-- +++++++++++++++++++++++++++++ PHP Login ( Main ) Form > Email > Error +++++++++++++++++++++++++++++ -->
                                    <span id="username-error" class="d-block my-2 mx-1 form-err"></span>

                                </div>



                                <!-- +++++++++++++++++++++++++++++ PHP Login ( Main ) Form > Password +++++++++++++++++++++++++++++ -->

                                <div class="form-group mt-3">

                                    <label for="password" class="form-field-title py-1 px-1">Password</label>

                                    <div class="input-group-prepend">
                                        <img class="password-icon" src="../Assets/SVG/passlock.svg" alt="">
                                        <input type="password" class="form-control" id="password" name="passwd" placeholder="Password" maxlength="18">
                                        
                                        <span id="toggle-password-icon">
                                            <img id="eye-open-icon" src="../Assets/SVG/eye-open.svg" alt="Open">
                                            <img id="eye-close-icon" src="../Assets/SVG/eye-closed.svg" alt="Close">
                                        </span>
                                    </div>

                                    <!-- +++++++++++++++++++++++++++++ PHP Login ( Main ) Form > Password > Error +++++++++++++++++++++++++++++ -->
                                    <span id="password-error" class="d-block my-2 mx-1 form-err"></span>

                                </div>



                                <!-- +++++++++++++++++++++++++++++ PHP Login ( Main ) Form > Remember Me +++++++++++++++++++++++++++++ -->

                                <div class="form-check mt-3">
                                    <input type="checkbox" class="form-check-input my-2" id="rememberMe">
                                    <label class="form-check-label form-field-title py-0" for="rememberMe">Keep me in</label>
                                </div>



                                <!-- +++++++++++++++++++++++++++++ PHP Login ( Main ) Form > LoginBtn + backBtn +++++++++++++++++++++++++++++ -->
                                
                                <div class="d-flex justify-content-center mt-3 gap-3">
                                    <button type="submit" class="text-center btn btn-login px-3 py-2 showMessageButton" name="btnlogin" data-message="<?php echo htmlspecialchars($message); ?>">Let me in</button>
                                    <a href="../index.php" class="text-center btn btn-login px-3 py-2">Back</a>
                                </div>



                                <!-- +++++++++++++++++++++++++++++ PHP Login ( Main ) Form > Sign Up Btn +++++++++++++++++++++++++++++ -->
                                
                                <p class="text-center mt-3">Don't have an account ? 
                                <br>
                                    <a href="./Registration.php" class="sign-up-link">Sign up</a>
                                </p>

                            </form>
                        
                        </div>
                    
                    </div>
                
                </div>
            
            </div>
        
        </div>
    </div>

</body>
</html>