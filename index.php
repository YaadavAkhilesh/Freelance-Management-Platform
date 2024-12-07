<?php
    include_once 'Utils/Gen_link.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="Assets/BS/css/bootstrap.min.css">
    <link rel="stylesheet" href="Assets/CSS/common.css">
    <link rel="stylesheet" href="Assets/CSS/index.css">

    <script defer src="Assets/BS/js/bootstrap.bundle.min.js"></script>
    <script defer src="Assets/BS/js/bootstrap.min.js"></script>
    <script defer src="Assets/JS/common.js"></script>
    <script defer src="Assets/JS/index.js"></script>

    <link rel="stylesheet" href="Assets/CSS/nav.css">
    <link rel="stylesheet" href="Assets/CSS/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nova+Flat&family=Passero+One&family=Edu+AU+VIC+WA+NT+Hand:wght@400..700&family=Figtree:ital,wght@0,300..900;1,300..900&family=Karla:ital,wght@0,200..800;1,200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Megrim&display=swap" rel="stylesheet">

    <script defer src="Assets/JS/nav.js"></script>

</head>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Show Navbar +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <?php
        include_once("Utils/nav.php");
    ?>


    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ First Section +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid intro-container p-0">

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ First Section > Container > Intro Text +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="container intro-con-div p-0">
                    
                    <div class="intro-div-text p-2">
                        FrelaxPro -
                        <span class="intro-div-text-span p-1">Gateway to Limitless Opportunities . . .</span>
                    </div>

                    <div class="intro-div-text-brief p-3">

                        At <span class="brand">FrelaxPro</span> , we believe that the future of work is freelance. 
                        We've created a dynamic and secure platform that connects talented professionals like you with businesses and individuals seeking specialized skills and expertise.
                        <br>
                        <br>
                        Whether you're a seasoned freelancer or just starting your journey, <span class="brand">FrelaxPro</span> provides you with the tools and resources to thrive in the gig economy. Our user-friendly interface makes it easy to showcase your skills, find exciting projects, and build lasting professional relationships.
                        <br>
                        <br>
                        <a href="Pages/Login.php" class="btn btn-getstart px-3 py-2">Get Started</a>
                    
                    </div>
                
            </div>
            

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ First Section > Container > Intro SVGs ( Blank Load ) +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="container intro-con-back-img">

            </div>

    </div>



    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid userbase-main">
        <div class="container userbase-con px-0 py-5 my-0">
            
            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > Container > Title +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="h1 userbase-title text-center p-2">
                Thousands of Freelancers Trust 
                <br>
                <span class="intro-div-text">FrelaxPro</span>
            </div>


            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > Container > Numbers +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="container userbase-num-con px-5 py-4 mt-5">

                <div class="text-center userbase-text p-2">
                    Trusted by
                    <br>
                    <span class="userbase-text-num">1M+</span>
                    <br>Businesses for Top Freelance Talent
                </div>
                <div class="text-center userbase-text p-2">
                    <span class="userbase-text-num">1.5M+</span>
                    <br>Registered Users
                </div>
                <div class="text-center userbase-text p-2">
                    <span class="userbase-text-num">2K+</span>
                    <br>Jobs Posted Monthly
                </div>

            </div>

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Second Section > Container > More Text +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="intro-div-text-brief px-1 py-3 my-4">
                
                Unlock your full potential and take control of your career.
                Join <span class="brand">FrelaxPro</span> today and discover a world of possibilities at your fingertips. Explore our diverse range of job categories, connect with clients who value your unique abilities, and embark on a fulfilling freelance journey.
                <br>
                <br>
                Get started now and let <span class="brand">FrelaxPro</span> be your gateway to limitless opportunities.
                <br>
                <br>
                <a href="Pages/Registration.php" class="btn btn-getstart px-3 py-2">Create Your Profile</a>

            </div>

        </div>
    </div>




    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <div class="container-fluid feature-fluid py-2">

        <div class="container features-con p-3">

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > Container > Title +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="text-center features-con-title p-4">
                Find Your Next Gig
            </div>

            <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > Container > Features div +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="feature-div mt-5">
                
                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > Container > Features-1 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                <div class="my-5">

                    <div class="feature-div-title px-4 py-2">
                        Featured Freelance Job
                    </div>

                    <div class="feature-div-con mt-5 justify-content-between">
                        
                        <div class="feature-div-brief p-1 mx-0 my-auto">
                            Latest and most in-demand freelance opportunities across various industries and skill sets . . .
                        </div>

                        <div class="d-block animate-btn-1">

                            <div class="d-flex gap-3 m-3">

                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/shield.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/fingerprint.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/twitter.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/meta.svg" alt="" class="features-span-img-src">
                                </span>

                            </div>
                            
                            <div class="d-flex gap-3 m-3">

                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/google.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/linkedin.svg" alt="" class="features-span-img-src">
                                </span>

                            </div>
                            
                        </div>

                    </div>
                </div>


                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > Container > Features-2 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                <div class="my-5">
                    <div class="feature-div-title px-4 py-2" style="justify-self: end;">
                        Browse By Categories
                    </div>

                    <div class="feature-div-con mt-5 justify-content-between">
                        
                        <div class="d-block animate-btn-2">

                            <div class="d-flex gap-3 m-3">

                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/shield.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/fingerprint.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/twitter.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/meta.svg" alt="" class="features-span-img-src">
                                </span>

                            </div>
                            
                            <div class="d-flex gap-3 m-3">

                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/google.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/linkedin.svg" alt="" class="features-span-img-src">
                                </span>

                            </div>
                            
                        </div>

                        <div class="feature-div-brief p-1 mx-0 my-auto">
                            Easily browse and find the perfect freelancer for your project needs . . .
                        </div>

                    </div>
                </div>


                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Third Section > Container > Features-3 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                <div class="my-5">
                    <div class="feature-div-title px-4 py-2">
                        Most In-Demand
                    </div>

                    <div class="feature-div-con mt-5 justify-content-between">
                        
                        <div class="feature-div-brief p-1 mx-0 my-auto">
                        Unlock access to the top freelance talent pools powering today's fastest-growing industries. Browse our curated categories to find specialized expertise for your business needs . .
                        </div>

                        <div class="d-block animate-btn-3">

                            <div class="d-flex gap-3 m-3">

                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/shield.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/fingerprint.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/twitter.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/meta.svg" alt="" class="features-span-img-src">
                                </span>

                            </div>
                            
                            <div class="d-flex gap-3 m-3">

                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/google.svg" alt="" class="features-span-img-src">
                                </span>
                                <span class="features-span-img p-2">
                                    <img src="Assets/SVG/linkedin.svg" alt="" class="features-span-img-src">
                                </span>

                            </div>
                            
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Show Footer +++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

    <?php
        include_once("Utils/footer.php");
    ?>

</body>
</html>