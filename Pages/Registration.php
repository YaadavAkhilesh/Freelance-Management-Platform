<?php

    include "../Data/Conn.php";
    $message = "";
    $message = $dbmessage;

    session_start();
    
    if(isset($_SESSION['usrid']) && isset($_SESSION['Logstatus'])){

        if($_SESSION['Logstatus'] === true){

            $usrid  = $_SESSION['usrid'];

            if (strpos($usrid, 'Fre-') === 0) {
                
                header("Location: /Main/Pages/Dashboard.php");
                exit();
            
            } else {
                // Redirect if the prefix is not "Fre-"
                header("Location: /Main/Pages/ORGDashboard.php");
                exit();
            }

        }
        else{
            $message = "Error ! Login status ..";
        }

    }
    else{
        $message = "Welcome , Make your space ..";
    }


    // Function to generate Freelancer ID
    function generateFreelancerID($conn)
    {
        // Get the highest freelancer ID
        $result = $conn->query("SELECT frelance_id FROM frelacer_det ORDER BY id DESC LIMIT 1");
    
        // Check if the query was successful
        if ($result) {
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Fetch the associative array
                $row = $result->fetch_assoc();
                $lastFreelancerID = $row['frelance_id']; // Access the freelancer ID
            } else {
                // No rows found, set lastFreelancerID to null
                $lastFreelancerID = null; // or handle accordingly
            }
        } else {
            // Query failed, handle the error
            echo "Query error: " . $conn->error;
            return null; // Return null or handle the error as needed
        }
    
        // Extract the number and increment it
        if ($lastFreelancerID) {
            $number = (int) substr($lastFreelancerID, 4); // Get the number part
            $number++; // Increment the number
        } else {
            $number = 1; // Start from 1 if no records exist
        }
    
        // Format the new Freelancer ID
        return "Fre-" . str_pad($number, 3, '0', STR_PAD_LEFT); // e.g., Fre-001
    }


    // Function to generate Client ID
    function generateClientID($conn)
    {
        // Get the highest client ID
        $result = $conn->query("SELECT client_id FROM client_det ORDER BY id DESC LIMIT 1");

        // Check if the query was successful
        if ($result) {
            // Check if there are any rows returned
            if ($result->num_rows > 0) {
                // Fetch the associative array
                $row = $result->fetch_assoc();
                $lastClientID = $row['client_id']; // Access the client ID
            } else {
                // No rows found, set lastClientID to null
                $lastClientID = null; // or handle accordingly
            }
        } else {
            // Query failed, handle the error
            echo "Query error: " . $conn->error;
            return null; // Return null or handle the error as needed
        }

        // Extract the number and increment it
        if ($lastClientID) {
            $number = (int) substr($lastClientID, 5); // Get the number part (after 'Cli-')
            $number++; // Increment the number
        } else {
            $number = 1; // Start from 1 if no records exist
        }

        // Format the new Client ID
        return "Cli-" . str_pad($number, 3, '0', STR_PAD_LEFT); // e.g., Cli-001
    }


    

    if (isset($_POST['btnsubmit'])) {

        $name = $_POST['firstName'];
        $usrtype = $_POST['userType'];
        $contactEmail = $_POST['contactEmail'];
        $contactPhone = $_POST['contactPhone'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];


        if ($_POST['userType'] == "Freelancer") {

            $fre_id = generateFreelancerID($conn);

            $lastName = $_POST['lastName'];
            $age = $_POST['age'];
            $countryFreelancer = $_POST['countryFreelancer'];
            $field = $_POST['field'];
            $fieldLang1 = $_POST['fieldLang1'];
            $fieldLang2 = $_POST['fieldLang2'];

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


            $technology = $_POST['technology'];
            $experience = $_POST['experience'];
            
            if($password === $confirmPassword){

                $confirmPassword = password_hash($confirmPassword,PASSWORD_DEFAULT);

                if($lang3flg == 1 && $degflg == 1){

                    $insr_qry = "INSERT INTO frelacer_det (frelance_id, frenm, frelnm , freage, frecntry , frefield, frelan1, frelan2, frelan3 , fretech, fredeg , freexpr, fremail , frephone, freusrnm, frepasswd) VALUES('$fre_id','$name','$lastName',$age,'$countryFreelancer','$field','$fieldLang1','$fieldLang2','$fieldLang3','$technology','$degree','$experience','$contactEmail','$contactPhone','$username','$confirmPassword')";

                }
                elseif($lang3flg == 0 && $degflg == 0){

                    $insr_qry = "INSERT INTO frelacer_det (frelance_id, frenm, frelnm , freage, frecntry , frefield, frelan1, frelan2,  fretech, freexpr, fremail , frephone, freusrnm, freepasswd) VALUES('$fre_id','$name','$lastName',$age,'$countryFreelancer','$field','$fieldLang1','$fieldLang2','$technology','$experience','$contactEmail','$contactPhone','$username','$confirmPassword')";

                }
                elseif($lang3flg == 0 && $degflg == 1){

                    $insr_qry = "INSERT INTO frelacer_det (frelance_id, frenm, frelnm , freage, frecntry , frefield, frelan1, frelan2, fretech, fredeg , freexpr, fremail , frephone, freusrnm, freepasswd) VALUES('$fre_id','$name','$lastName',$age,'$countryFreelancer','$field','$fieldLang1','$fieldLang2','$technology','$degree','$experience','$contactEmail','$contactPhone','$username','$confirmPassword')";

                }
                elseif($lang3flg == 1 && $degflg == 0){

                    $insr_qry = "INSERT INTO frelacer_det (frelance_id, frenm, frelnm , freage, frecntry , frefield, frelan1, frelan2, frelan3 , fretech, freexpr, fremail , frephone, freusrnm, freepasswd) VALUES('$fre_id','$name','$lastName',$age,'$countryFreelancer','$field','$fieldLang1','$fieldLang2','$fieldLang3','$technology','$experience','$contactEmail','$contactPhone','$username','$confirmPassword')";

                }
                else{
                    $insr_qry = "INSERT INTO frelacer_det (frelance_id, frenm, frelnm , freage, frecntry , frefield, frelan1, frelan2, frelan3 , fretech, fredeg , freexpr, fremail , frephone, freusrnm, freepasswd) VALUES('$fre_id','$name','$lastName',$age,'$countryFreelancer','$field','$fieldLang1','$fieldLang2','$fieldLang3','$technology','$degree','$experience','$contactEmail','$contactPhone','$username','$confirmPassword')";
                }
                
            }
            else{
                $message .= "Password Not match !";
            }

            
        } elseif ($_POST['userType'] == "Client") {
            $serviceType = $_POST['serviceType'];
            $countryClient = $_POST['countryClient'];

            $cli_id = generateClientID($conn);

            if($password === $confirmPassword){

                $confirmPassword = password_hash($confirmPassword,PASSWORD_DEFAULT);
                $insr_qry = "INSERT INTO client_det (client_id, clnm , clsrvrtype , claddr , clmail , clphone , clusrnm , clpasswd) VALUES('$cli_id','$name','$serviceType','$countryClient','$contactEmail','$contactPhone','$username','$confirmPassword')";
            
            }

            


        } else {
            $message = "Please Select One : Freelancer | Client";
            exit();
        }


        $insr_qry_rslt = $conn->query($insr_qry);

        if($insr_qry_rslt === true){
            $message = "Inserted Successfully !";
            header("Location: /Main/Pages/Login.php");
            exit();
        }
        else{
            $message = "Error ! :".$conn->error;
        }

        $conn->close();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join us</title>
    <link rel="stylesheet" href="../Assets/BS/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/CSS/registration.css">
    <link rel="stylesheet" href="../Assets/CSS/common.css">

    <script defer src="../Assets/BS/js/bootstrap.bundle.min.js"></script>
    <script defer src="../Assets/BS/js/bootstrap.min.js"></script>
    <script defer src="../Assets/JS/registration.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Flat&family=Passero+One&family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Karla:ital,wght@0,200..800;1,200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Megrim&display=swap" rel="stylesheet">

</head>
<body>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid regstr-fluid px-0">
        <div class="regstr-con">

            <?php
                include_once "../Utils/Error_Model.php";
            ?>
        
            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid > con > row +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row m-0 regstr-con-row">

                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid > con > row > col +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                <div class="col-xxl-12 col-lg-12 col-md-12 regstr-con-row-col p-0">

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid > con > row > col > Main Card in View +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="regstr-con-card p-0">

                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>> Main Card > Top Bar +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <div class="sticky-top d-flex justify-content-between align-items-center px-4 py-2 mb-4 register-top-bar">
                            <div class="register-brand py-0">FrelaxPro</div> 
                            <div class="register-title py-0">Register</div>
                        </div>


                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>> Main Card > PHP Main Register Form +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


                        <form id="registrationForm" method="POST">


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>> Form > First Section ( Personal Details ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


                            <div class="row register-form-inline-field-row m-0">


                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Personal Details > Title ++++++++++++++++++++++++++++ -->

                                <span class="register-form-inline-field-row-title translate-middle rounded-pill w-auto top-0">
                                    Personal Details
                                </span>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Personal Details > Name ++++++++++++++++++++++++++++ -->

                                <div class="col-xxl-6 form-group">
                                    <label for="firstName" class="form-field-title py-1 px-1">Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Name" minlength="3" maxlength="30">
                                </div>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Personal Details > Who are You ++++++++++++++++++++++++++++ -->
                                
                                <div class="col-xxl-5 form-group">

                                    <div class="form-group"  name="user">
                                        <label class="form-field-title  py-1 px-1">Who are You : </label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input my-2" type="radio" name="userType" id="freelancer" value="Freelancer">
                                            <label class="form-check-label form-field-title" for="freelancer">Freelancer</label>
                                        </div>
                                        <div class="form-check form-check-inline"> 
                                            <input class="form-check-input my-2" type="radio" name="userType" id="client" value="Client">
                                            <label class="form-check-label form-field-title" for="client">Client</label>
                                        </div>
                                    </div>
                                    
                                </div>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Personal Details > Hidden Freelance Details Section / Lname , Age , Country ++++++++++++++++++++++++++++ -->

                                <div class="hidden my-3 row freelancerFields">
                                    <div class="form-group col-xxl-4">
                                        <label for="lastName" class="form-field-title py-1 px-1">Last name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" minlength="3" maxlength="30">
                                    </div>
                                    <div class="form-group col-xxl-4">
                                        <label for="age" class="form-field-title  py-1 px-1">Age</label>
                                        <input type="number" class="form-control" id="age" name="age" placeholder="Age" min="18" max="50">
                                    </div>
                                    <div class="form-group col-xxl-4">
                                        <label for="countryFreelancer" class="form-field-title  py-1 px-1">Country</label>
                                        <input type="text" class="form-control" id="countryFreelancer" name="countryFreelancer" placeholder="Country" maxlength="25">
                                    </div>
                                </div>

                            </div>



                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Freelancer ( Education + Certification ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="row register-form-inline-field-row m-0 mt-5 hidden freelancerFields">


                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Education + Certification > Title ++++++++++++++++++++++++++++ -->

                                <span class="register-form-inline-field-row-title translate-middle rounded-pill w-auto top-0">
                                    Education + Certifications
                                </span>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Education + Certification > Field ++++++++++++++++++++++++++++ -->
                                
                                <div class="form-group col-xxl-4">
                                    <label for="field" class="form-field-title  py-1 px-1">Field</label>
                                    <input type="text" class="form-control" id="field" name="field" placeholder="Web Development" maxlength="30">
                                </div>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Education + Certification > PL 1 ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-4">
                                    <label for="fieldLang1" class="form-field-title  py-1 px-1">Programming Language 1</label>
                                    <input type="text" class="form-control" id="fieldLang1" name="fieldLang1" placeholder="Python" maxlength="15">
                                </div>
                                
                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Education + Certification > PL 2 ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-4">
                                    <label for="fieldLang2" class="form-field-title  py-1 px-1">Programming Language 2</label>
                                    <input type="text" class="form-control" id="fieldLang2" name="fieldLang2" placeholder="C++" maxlength="15">
                                </div>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Education + Certification > PL 3 - Not Mendetory ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-4">
                                    <label for="fieldLang3" class="form-field-title  py-1 px-1">Programming Language 3</label>
                                    <input type="text" class="form-control" id="fieldLang3" name="fieldLang3" placeholder="Rust" maxlength="15">
                                </div>
                                
                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Education + Certification > Technology Specification ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-4">
                                    <label for="technology" class="form-field-title  py-1 px-1">Technology Specification</label>
                                    <input type="text" class="form-control" id="technology" name="technology" placeholder="Blockchain" maxlength="30">
                                </div>
                                
                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Education + Certification > Degree / Certification ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-4">
                                    <label for="degree" class="form-field-title  py-1 px-1">Degree / Certification</label>
                                    <input type="text" class="form-control" id="degree" name="degree" placeholder="Degree / Certification" maxlength="30">
                                </div>

                            </div>



                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Freelancer ( Experience + Internship ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="row register-form-inline-field-row m-0 mt-5 hidden freelancerFields">


                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Experience + Internship > Title ++++++++++++++++++++++++++++ -->

                                <span class="register-form-inline-field-row-title translate-middle rounded-pill w-auto top-0">
                                    Experience + Internship
                                </span>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Experience + Internship > Experience / Internship ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-8">
                                    <label for="experience" class="form-field-title  py-1 px-1">Experience / Internship</label>
                                    <input type="text" class="form-control" id="experience" name="experience" placeholder="1 Year , FrelaxPro PVT. LTD" maxlength="50">
                                </div>
                            
                            </div>



                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Client ( Type + Address ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="row register-form-inline-field-row m-0 mt-5 hidden clientFields">

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Type + Address > Title ++++++++++++++++++++++++++++ -->

                                <span class="register-form-inline-field-row-title translate-middle rounded-pill w-auto top-0">
                                    Company Details
                                </span>

                                <div class="col-xxl-6">

                                    <div class="form-group"  name="serviceTypeer">

                                        <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Type + Address > Type Options ++++++++++++++++++++++++++++ -->

                                        <label class="form-field-title  py-1 px-1">Which type of service you provide ?</label>

                                        <br>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input my-2" type="radio" name="serviceType" value="SaaS" id="serviceSS">
                                            <label class="form-check-label form-field-title" for="serviceSS">SaaS</label>
                                        </div>

                                        <div class="form-check form-check-inline"> 
                                            <input class="form-check-input my-2" type="radio" name="serviceType" value="PaaS" id="servicePS">
                                            <label class="form-check-label form-field-title" for="servicePS">PaaS</label>
                                        </div>

                                        <div class="form-check form-check-inline"> 
                                            <input class="form-check-input my-2" type="radio" name="serviceType" value="IaaS" id="serviceIS">
                                            <label class="form-check-label form-field-title" for="serviceIS">IaaS</label>
                                        </div>

                                    </div>

                                </div>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Type + Address > Client Address ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-5">
                                    <label for="countryClient" class="form-field-title  py-1 px-1">Country - Address</label>
                                    <input type="text" class="form-control" id="countryClient" name="countryClient" placeholder="Country - Address" maxlength="30">
                                </div>

                            </div>



                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Common ( Contact + Mail ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="row register-form-inline-field-row m-0 mt-5 py-4">


                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Contact + Mail > Title ++++++++++++++++++++++++++++ -->

                                <span class="register-form-inline-field-row-title translate-middle rounded-pill w-auto top-0">
                                    Contact Details
                                </span>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Contact + Mail > Email ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-6">
                                    <label for="contactEmail" class="form-field-title  py-1 px-1">Email</label>
                                    <input type="email" class="form-control" id="contactEmail" name="contactEmail" placeholder="Email" maxlength="40">
                                </div>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Contact + Mail > Phone no ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-5">
                                    <label for="contactPhone" class="form-field-title  py-1 px-1">Phone number</label>
                                    <input type="tel" class="form-control" id="contactPhone" name="contactPhone" value="+91 " placeholder="+91 9265829761" maxlength="14" onfocus="this.setSelectionRange(this.value.length, this.value.length);" oninput="checkPhone('contactPhone')">
                                </div>
                                  
                            </div>



                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Common ( Make your Space / User , Pass ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="row register-form-inline-field-row m-0 mt-5">

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > User / Pass > Title ++++++++++++++++++++++++++++ -->

                                <span class="register-form-inline-field-row-title translate-middle rounded-pill w-auto top-0">
                                    Make Your Space
                                </span>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > User / Pass > Username ++++++++++++++++++++++++++++ -->

                                <div class="form-group col-xxl-6">
                                    <label for="username" class="form-field-title  py-1 px-1">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" minlength="3" maxlength="25" autocomplete="true">
                                </div>
                            
                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > User / Pass > Create Password ++++++++++++++++++++++++++++ -->

                                <div class="row gap-2">
                                    <div class="form-group col-xxl-5 position-relative" name="pass-group">

                                        <label for="password" class="form-field-title  py-1 px-1">Create Password</label>

                                        <div class="passiconwrap">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="18" autocomplete="true">
                                            <span class="toggle-password-icon" id="toggle-password-icon">

                                                <img id="eye-open-icon" src="../Assets/SVG/eye-open.svg" alt="Open">
                                                <img id="eye-close-icon" src="../Assets/SVG/eye-closed.svg" alt="Close">

                                            </span>
                                        </div>

                                    </div>
                                </div>

                                <!-- ++++++++++++++++++++++++++++ Register Fluid >>>>> Form > User / Pass > Conform Password ++++++++++++++++++++++++++++ -->

                                <div class="row gap-2">
                                    <div class="form-group col-xxl-5 position-relative" name="pass-group-conf">

                                        <label for="confirmPassword" class="form-field-title  py-1 px-1">Re-enter Password</label>
                                        
                                        <div class="passiconwrap">
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" maxlength="18" autocomplete="true">
                                            <span class="toggle-password-icon" id="toggle-password-icon-reenter">

                                                <img id="eye-open-icon-reenter" src="../Assets/SVG/eye-open.svg" alt="Open">
                                                <img id="eye-close-icon-reenter" src="../Assets/SVG/eye-closed.svg" alt="Close">
                                            
                                            </span>
                                        </div>

                                    </div>
                                </div>
                                
                            </div>


                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Agree Terms & Con +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->                     

                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input my-2" id="termscon" onchange="toggleSubmitButton()">
                                <label class="form-check-label form-field-title py-0" for="termscon">I'm Agree Terms & Conditions</label>
                            </div>

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>> Form > Last and Final Submit btn +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="d-flex justify-content-center mt-3 gap-3">
                                <button type="submit" class="text-center btn btn-register px-3 py-2 showMessageButton"
                                    name="btnsubmit" id="submitBtn" disabled
                                    data-message="<?php echo htmlspecialchars($message); ?>">Create my space</button>
                                <a href="../index.php" class="text-center btn btn-register px-3 py-2">Back</a>
                            </div>

                        </form>

                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Register Fluid >>>>>> Go to login +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <p class="text-center mt-3">Already have an account ?
                        <br>   
                        <a href="./Login.php" class="login-in-link">Login</a></p>

                    </div>

                </div>

            </div>
        
        </div>
    </div>

</body>
</html>