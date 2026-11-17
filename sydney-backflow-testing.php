<?php $blogdate="16 Aug 2022"; ?>
<?php $blogname="Sydney Backflow Testing"; ?>

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
                                        <img src="images/resource/sydney-backflow-testing.jpg" alt="Sydney Plumbing" title="<?php echo $blogname; ?>">
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
                                            <strong>Hydrolink Plumbing</strong> can test your <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>backflow prevention sydney</strong></a> device in the Sydney which is a legal requirement from Sydney Water Authority. If you do not test your device annually by a licenced <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>backflow plumber sydney</strong></a> to make sure it is working properly and the test certificate submitted to them within 2 day of test. <strong>Sydney Water</strong> will shut off your water supply until it is tested, so it is crucial you follow these requirements or you will be without water. A plumber with a <strong>fully accredited backflow prevention</strong> license can install and test your backflow prevention devices. <a href="https://www.hydrolinkplumbing.com.au/" title="Hydrolink Plumbing Sydney" target="_blank"><strong>Hydrolink Plumbing</strong></a> are accredited to install and test <strong>backflow prevention devices in Sydney</strong> properties.
                                        </p>

                                        <p>
                                            Only <a href="https://www.hydrolinkplumbing.com.au/" title="Hydrolink Plumbing Sydney" target="_blank"><strong>qualified sydney plumbers</strong></a> with backflow training and endorsement can test your <a href="https://www.hydrolinkplumbing.com.au/backflow-testing" title="Hydrolink Plumbing Sydney" target="_blank"><strong>backflow prevention valves</strong></a>. In Sydney, the Technical Regulator keeps a register of backflow prevention devices which must be tested and reported annually by a backflow endorsed, <strong>qualified plumber</strong>. The test results must be sent to the Office of the Technical Regulator within two weeks of the due test date.
                                            <strong>Hydrolink Plumbing</strong> are fully licensed, accredited and trained to perform all aspects of <strong>Backflow Device maintenance</strong>, commisioning and <strong>installation in Sydney</strong>. The licensed plumbers at Hydrolink Plumbing know everything there is to know about backflow. Call <strong>Hydrolink Plumbing</strong> to book a backflow test, or to install a new backflow prevention device.
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