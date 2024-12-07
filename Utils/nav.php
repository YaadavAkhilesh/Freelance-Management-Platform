<body>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Nabar > All Attachment Responsive absolute link Base URL +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <?php
        // Define the base URL
        define('BASE_URL', 'http://akhilyadav78.infinityfreeapp.com/Main/'); // Adjust this to your actual project path

        $dashlink = BASE_URL . $dashlink;
    ?>

    <nav class="navbar fixed-top navbar-expand-xxl custom-navbar-light p-2 my-3">
        <div class="container-fluid p-0">
        
            <a class="navbar-brand p-0 mx-4" href="#">FrelaxPro</a>

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Nabar > Container-fluid > navbar-menus-xl code ( Show >= 1440px ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                <div class="navbar-menus-xl">            
                    <ul class="navbar-nav mb-lg-0 px-2 navbar-ul-1">

                        <li class="nav-item">
                            <a class="nav-link curpage" aria-current="page" href="<?php echo BASE_URL; ?>index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Browse.php">Browse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Bid.php">Bid</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/About.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Registration.php">Register</a>
                        </li>

                        <li class="nav-item offcanva-profile">
                            <a class="nav-link" href="<?php echo $dashlink;?>">
                                <img src="<?php echo BASE_URL; ?>Assets/SVG/person-circle.svg" alt="Profile" height="25" width="25" class="p-0 m-0 user-pro">
                            </a>
                        </li>
                    
                    </ul>
                </div>

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Nabar > Container-fluid > Profile + Toggler ul ( Show <= 1440px ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                <ul class="navbar-nav mb-lg-0 px-2 navbar-ul-2">
                        
                    <button class="navbar-toggler p-1" type="button" data-bs-toggle="offcan" data-bs-target="#offcan" aria-controls="offcan" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>    
            
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Dashboard.php">
                            <img src="<?php echo BASE_URL; ?>Assets/SVG/person-circle.svg" alt="Profile" height="30" width="30" class="user-pro">
                        </a>
                    </li>
                        
                </ul>

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Nabar > Container-fluid > Offcanvas Code > navbar-menus-xl-after ( Show <= 1440px ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
            
                <div class="offcan m-0 p-0" id="offcan">

                    <div class="navbar-menus-xl-after m-4">            
                        <ul class="navbar-nav mb-lg-0 px-2 navbar-ul-1">

                            <li class="nav-item">
                                <a class="nav-link curpage" aria-current="page" href="<?php echo BASE_URL; ?>index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Browse.php">Browse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Bid.php">Bid</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Registration.php">Register</a>
                            </li>
                        
                        </ul>
                    </div>

                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Nabar > Container-fluid > Offcanvas Code > Follow Us on ( Show <= 1200px ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="follow-div m-4 p-2">

                        <a href="#">
                            <img src="<?php echo BASE_URL; ?>Assets/SVG/twitter-x.svg" alt="twitter-x" class="follows-img">
                        </a>
                        <a href="#">
                            <img src="<?php echo BASE_URL; ?>Assets/SVG/facebook.svg" alt="Facebook" class="follows-img">
                        </a>
                        <a href="#">
                            <img src="<?php echo BASE_URL; ?>Assets/SVG/instagram.svg" alt="Instragram" class="follows-img">
                        </a>
                        <a href="#">
                            <img src="<?php echo BASE_URL; ?>Assets/SVG/meta.svg" alt="Meta" class="follows-img">
                        </a>

                    </div>
            
                </div>
            
        </div>
    </nav>