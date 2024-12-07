<?php 

    include '../Data/Conn.php';
    session_start();
    include_once '../Utils/Gen_link.php';

    $ftch_qry = "SELECT f.frelance_id AS freid, f.frenm AS frenm, f.frelnm AS frelnm, f.freage AS freelancer_age, f.frecntry AS frecntry, f.fremail AS fremail , f.freexpr AS freexpr , f.frefield AS frefield, f.fretech AS fre_tech, GROUP_CONCAT(p.prj_title SEPARATOR ', ') AS project_titles FROM frelacer_det f LEFT JOIN bided_projects b ON f.frelance_id = b.frelance_id LEFT JOIN project_det p ON b.project_id = p.project_id GROUP BY f.frelance_id;";
    $ftch_qry_rslt = $conn->query($ftch_qry);

    $org_qry = "SELECT c.client_id AS org_id, c.clnm AS org_name, c.clmail AS org_email, c.claddr AS org_address, recent_projects.prj_title AS recent_project_title, recent_projects.prj_up_date AS recent_project_date FROM client_det c LEFT JOIN (SELECT org_id, prj_title, prj_up_date, ROW_NUMBER() OVER (PARTITION BY org_id ORDER BY prj_up_date DESC) AS rn FROM project_det) AS recent_projects ON c.client_id = recent_projects.org_id AND recent_projects.rn = 1;";
    $org_qry_rslt = $conn->query($org_qry);


?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's Browse</title>
    <link rel="stylesheet" href="../Assets/BS/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Assets/CSS/common.css">
    <link rel="stylesheet" href="../Assets/CSS/browse.css">

    <script defer src="../Assets/BS/js/bootstrap.bundle.min.js"></script>
    <script defer src="../Assets/BS/js/bootstrap.min.js"></script>
    <script defer src="../Assets/JS/browse.js"></script>

    <link rel="stylesheet" href="../Assets/CSS/nav.css">
    <link rel="stylesheet" href="../Assets/CSS/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Flat&family=Passero+One&family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Karla:ital,wght@0,200..800;1,200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Megrim&display=swap" rel="stylesheet">

    <script defer src="../Assets/JS/nav.js"></script>

</head>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Show Navbar +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <?php
        include_once("../Utils/nav.php");
    ?>




    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Search Section +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid search-fluid">

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Search Section > Text brief +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <div class="container search-fluid-title">
            <div class="text-center d-block p-2 search-fluid-title-main">
                Explore Opportunities
            </div>
            <div class="text-center d-block p-2 search-fluid-title-brief">
                Connect with talented freelancers and organizations ready to collaborate on your next project
                Search for freelancers, organizations, or projects...
            </div>
        </div>

        <div class="container">
        
            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Search Section > Search Box +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="search-box d-block mx-auto">

                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Search Section > Search Box > Search Query Form  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                <form class="search-form">
                    <div class="input-group search-form-group gap-2">
                        <input type="text" class="form-control browse-search px-3 py-3" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        
                        <button type="button" class="btn search-btn px-3 py-0">
                            <img src="../Assets/SVG/search.svg" alt="" height="28" width="32" class="search-btn-src p-0 m-0">
                        </button>
                    </div>
                </form>

            </div>
        
        </div>

    </div>



    
    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid freelance-fluid">
        <div>

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > Title Brief +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="text-center py-5 freelance-fluid-title">
                Browse Freelancers
                <br>
                <div class="freelance-fluid-subtitle py-2">
                    Find skilled freelancers ready to take on your projects
                </div>
            </div>

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row justify-content-around p-5">


                <!-- ++++++++++++++++++++++++++++ Second Section > row > col ( PHP Repeat start ) +++++++++++++++++++++++++++++ -->

                <?php 

                    if($ftch_qry_rslt->num_rows > 0){

                        while($ftch_qry_rslt_data = $ftch_qry_rslt->fetch_assoc()){

                ?>

                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row > col +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            
                <div class="col-xxl-5 col-xl-6 my-md-4">

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row > col > card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="card text-center">

                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row > col > card > Profile-Icon +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <img src="../Assets/SVG/free-profile.svg" class="d-block mx-auto my-1" alt="Profile" height="200" width="auto">
                        
                        <div class="card-body py-0">

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row > col > card > User_Name +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <div class="text-center my-0 browse-card-user-name p-0">#
                                <span>
                                    <?php echo $ftch_qry_rslt_data['frenm']."  ".$ftch_qry_rslt_data['frelnm']; ?>
                                    <img src="../Assets/SVG/blurmark.svg" alt="verified" height="40" width="32">
                                </span>          
                            </div>
                            
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row > col > card > user_mail +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                <a href="#" class="card-link">
                                    <img src="../Assets/SVG/link-45deg.svg" alt="Link" height="25" width="25" class="p-0 m-0">
                                    <?php echo $ftch_qry_rslt_data['fremail']; ?>
                                </a>
                            
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row > col > card > user_location +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                
                                <a href="#" class="card-link">
                                    <img src="../Assets/SVG/location.svg" alt="Link" height="25" width="25" class="p-0 m-0">
                                    <?php echo $ftch_qry_rslt_data['frecntry']; ?>
                                </a>
                        </div>

                        <div class="card-body py-0">

                            <div class="d-flex py-3 gap-2 flex-wrap justify-content-center align-items-center w-50 mx-auto">


                                <button type="button" class="btn my-0 px-4 py-2 dash-card-btn-specs">
                                    <?php
                                        echo $ftch_qry_rslt_data['frefield'];
                                    ?>
                                </button>

                                <button type="button" class="btn my-0 px-4 py-2 dash-card-btn-specs">
                                    <?php
                                        echo $ftch_qry_rslt_data['fre_tech'];
                                    ?>  
                                </button>


                            </div>


                            <div class="d-flex pt-3 gap-2 flex-wrap justify-content-center align-items-center">
                            
                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row > col > card > Technologies +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                            
                                <button type="button" class="btn my-2 px-4 py-2 browse-card-btn-specs position-relative">
                                    Java
                                    <span class="position-absolute top-0 translate-middle badge rounded-pill browse-card-btn-specs-num">
                                        2+
                                    </span>
                                </button>

                                <button type="button" class="btn my-2 px-4 py-2 browse-card-btn-specs position-relative">
                                    python
                                    <span class="position-absolute top-0 translate-middle badge rounded-pill browse-card-btn-specs-num">
                                        5+
                                    </span>
                                </button>

                                <button type="button" class="btn my-2 px-4 py-2 browse-card-btn-specs position-relative">
                                    C++
                                    <span class="position-absolute top-0 translate-middle badge rounded-pill browse-card-btn-specs-num">
                                        9+
                                    </span>
                                </button>

                                <button type="button" class="btn my-2 px-4 py-2 browse-card-btn-specs position-relative">
                                    Ruby
                                    <span class="position-absolute top-0 translate-middle badge rounded-pill browse-card-btn-specs-num">
                                        1+
                                    </span>
                                </button> 

                                <button type="button" class="btn px-4 py-2 browse-card-btn-specs position-relative">
                                    Ruby
                                    <span class="position-absolute top-0 translate-middle badge rounded-pill browse-card-btn-specs-num">
                                        1+
                                    </span>
                                </button>

                            </div>

                        </div>

                        <hr>
                            
                        <div class="card-body prof-work p-3">

                            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > row > col > card > Recent + Current Project + Experience +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                            <?php
                                    if($ftch_qry_rslt_data['project_titles'] == ''){

                                    }
                                    else{
                            ?>
                            <button type="button" class="btn px-4 py-3 mb-3 browse-card-prof-current position-relative">
                                <?php echo $ftch_qry_rslt_data['project_titles']; ?>
                                <span class="position-absolute px-3 py-1 rounded-pill browse-card-prof-current-title">
                                Working on
                                </span>
                            </button>
                                        
                            <?php
                                    }
                            ?>

                            <button type="button" class="btn px-4 py-3 mb-3 browse-card-prof-previous position-relative">
                                Comming Soon ...
                                <span class="position-absolute px-3 py-1 rounded-pill browse-card-prof-current-title m-0">
                                    Previous
                                </span>
                            </button>

                            <button type="button" class="btn px-4 py-3 browse-card-prof-previous position-relative">
                            <?php echo $ftch_qry_rslt_data['freexpr']; ?>
                                <span class="position-absolute px-3 py-1 rounded-pill browse-card-prof-current-title m-0">
                                    Experience
                                </span>
                            </button>

                        </div>

                    </div>
                </div>



                <?php        }

                    }
                    else{
                        $message = "No data Found !";
                        header("Location: /Main/index.php");
                    }
                ?>
            
            </div>

        </div>
    </div>

    
    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid org-fluid">
        <div>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > Title Brief +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="text-center py-5 freelance-fluid-title">
                Browse Organizations
                <br>
                <div class="freelance-fluid-subtitle py-2">
                Connect with organizations that are actively seeking freelancers for exciting projects
                </div>
            </div>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="row justify-content-around p-5">

                <!-- ++++++++++++++++++++++++++++ Third Section > row > col ( PHP Repeat start ) +++++++++++++++++++++++++++++ -->

                <?php 
                    if($org_qry_rslt->num_rows > 0){

                        while($org_qry_rslt_data = $org_qry_rslt->fetch_assoc()){
                ?>
                
                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row > col +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                
                    <div class="col-xxl-11 col-xl-11 my-md-4">

                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row > col > card +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                        <div class="card text-center">
                            <div class="d-xl-flex">


                                <div class="card-body org-prof-side-line">

                                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row > col > card > Profile-icon-org +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                    <img src="../Assets/SVG/microsoft.svg" class="d-block mx-auto my-2 p-2" alt="Profile" height="200" width="auto">

                                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row > col > card > Org_name +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                    <div class="text-center my-0 browse-card-user-name">#
                                        <span>
                                            <?php echo $org_qry_rslt_data['org_name'];?>
                                            <img src="../Assets/SVG/blurmark.svg" alt="verified" height="40" width="32">
                                        </span>
                                    </div>

                                    <div class="my-0 py-1">

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row > col > card > Org_Mail +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                                    
                                        <a href="#" class="card-link py-1">
                                            <img src="../Assets/SVG/link-45deg.svg" alt="Link" height="25" width="25" class="p-0 m-0">
                                            <?php echo $org_qry_rslt_data['org_email'];?>
                                        </a>

                                        <br>

                                        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row > col > card > Org-Address +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                        <a href="#" class="card-link py-1">
                                            <img src="../Assets/SVG/location.svg" alt="Link" height="25" width="25" class="p-0 m-0">
                                            <?php echo $org_qry_rslt_data['org_address'];?>
                                        </a>

                                        <br>

                                        <div class="pt-3">
                                        
                                            <?php
                                                $b = 1;
                                                while($b < 4){
                                            ?>

                                                <button type="button" class="btn px-0 py-0">
                                                    <img src="../Assets/SVG/star_fill.svg" alt="star" height="28" width="28">
                                                </button>

                                            <?php
                                                $b++;
                                                }
                                            ?>
                                            
                                            <button type="button" class="btn px-0 py-0">
                                                <img src="../Assets/SVG/star_half.svg" alt="star" height="28" width="28">
                                            </button>

                                            <button type="button" class="btn px-0 py-0">
                                                <img src="../Assets/SVG/star_blank.svg" alt="star" height="28" width="28">
                                            </button>
                                                
                                        </div>

                                    </div>

                                </div>

                                    

                                <div class="card-body py-3 d-xl-flex flex-column justify-content-between">

                                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row > col > card > Org technology +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                    <div class="d-flex pt-3 gap-2 flex-wrap justify-content-center align-items-center">
                                        <button type="button" class="btn my-0 px-4 py-2 browse-card-btn-specs">Comming Soon ..</button>
                                        <button type="button" class="btn my-0 px-4 py-2 browse-card-btn-specs">Comming Soon ..</button>
                                        <button type="button" class="btn my-0 px-4 py-2 browse-card-btn-specs">Comming Soon ..</button>
                                        <button type="button" class="btn my-0 px-4 py-2 browse-card-btn-specs">Comming Soon ..</button>
                                        <button type="button" class="btn my-0 px-4 py-2 browse-card-btn-specs">Comming Soon ..</button>
                                    </div>

                                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > row > col > card > Org Recent Project +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                    <div class="pt-5">
                                        <?php
                                            if($org_qry_rslt_data['recent_project_title'] == ''){

                                            }
                                            else{
                                        ?>
                                        <button type="button" class="btn py-3 browse-card-orgprof-recent position-relative">
                                            <?php echo $org_qry_rslt_data['recent_project_title'];?>
                                            <span class="position-absolute px-3 py-1 rounded-pill browse-card-prof-current-title">
                                            Recently Uploaded
                                            </span>
                                        </button>
                                        <?php

                                            }
                                        ?>
                                        
                                    </div>

                                </div>
                                    
                            </div> 
                        </div>
                    
                    </div>


                <!-- ++++++++++++++++++++++++++++ Third Section > row > col ( PHP Repeat end ) +++++++++++++++++++++++++++++ -->

                <?php
                        }
                   }                    
                ?>



            </div>

        </div>
    </div>

    
    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Show Footer +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <?php
        include_once("../Utils/footer.php");
    ?>

</body>
</html>