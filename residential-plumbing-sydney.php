<?php $blogdate="12 Mar 2021"; ?>
<?php $blogname="Residential Plumbing Sydney"; ?>

<!DOCTYPE html>
<html lang="en"> 
<head>
<!-- Stylesheets -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Responsive File -->
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- Header Aside -->
    <?php include 'include/header.php'; ?>
    
        <!-- Banner Section -->
        <section class="page-banner">
            <div class="image-layer" style="background-image:url(images/background/banner-image-1.jpg);"></div>
            <div class="banner-bottom-pattern"></div>
            <div class="banner-inner">
                <div class="auto-container">
                    <div class="inner-container clearfix">
                        <h1><?php echo $blogname; ?></h1>
                        <div class="page-nav">
                            <ul class="bread-crumb clearfix">
                                <li><a href="index.html">
                                    <span class="fa fa-home"></span></a>
                                </li>
                                <li class="active">Blogs</li>
                                <li><?php echo $blogname; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End Banner Section -->


        <div class="sidebar-page-container blog-page">

        <div class="auto-container">
            <div class="row clearfix">
                
                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-content">
                        <div class="post-details">
                            <div class="inner-box">
                                
                                <div class="upper">
                                    <div class="image-box">
                                        <img src="images/resource/blog-12.jpg" alt="sydney plumber" title="<?php echo $blogname; ?>">
                                    </div>
                                </div>
                                <div class="post-meta">
                                    <ul class="clearfix">
                                        <li><span class="icon far fa-user"></span> by Admin</li>
                                        <li><span class="icon far fa-calendar"></span> <?php echo $blogdate; ?></li>
                                    </ul>
                                </div>
                                <div class="lower">
                                    <div class="text">
                                        <h2 class="lpg-blog"><?php echo $blogname; ?></h2>

                                        <p>
                                            Do you need to get your plumbing fixed or installed quickly? Are you worried about what damage your broken plumbing is causing to your home? Do you have time to wait around for plumbers that don’t show up on time, or at all? Does the quality of your plumbers work concern you? We understand the frustration of no-shows, poor communication and shoddy work. We’re here to help. As plumbing specialists, we know what a hassle it can be when you need plumbing repairs, installations or maintenance. It’s our mission to get your plumbing job done promptly and with minimal fuss – all the while, maintaining great communication with you.
                                        </p>
                                        <p>
                                            Hydrolink plumbing service is a team of <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>professional residential plumbers in Sydney</strong></a>, serving the city and the metropolitan area. Our plumbers are equipped with advanced plumbing gears and well trained to assist you in any plumbing issues in the shortest time possible. They will schedule everything as per your convenience and provide high quality repairs and maintenance. Professionals at Hydrolink plumbing assist you with complete<a href="https://www.hydrolinkplumbing.com.au/residential-plumbing" title="Hydrolink Plumbing Sydney" target="_blank"><strong> residential plumbing design</strong></a> and installation. Our residential plumbing services consist of repairing drains, water lines, water heaters and toilets. Repairing and maintaining your hot water system, assisting you in kitchen and bathroom plumbing. Being the most reliable and <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>affordable residential plumber in Sydney</strong></a>, we are always available in emergency cases as well. Our plumbers are licensed, well trained and committed to provide best plumbing services in accordance with the Australian standards. 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Blog Aside -->
                <?php include 'include/blogsaside.php'; ?>



            </div>
        </div>
    </div>








    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>

    <script src="js/jquery.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/scrollbar.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/custom-script.js"></script>

    <script type="text/javascript">
        function openNav() {
            document.getElementById("mySidenav").style.width = "30%";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
  
  </body>
</html>