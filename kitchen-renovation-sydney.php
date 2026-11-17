<?php $blogdate="17 Aug 2022"; ?>
<?php $blogname="Kitchen Renovation Sydney"; ?>

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
                                        <img src="images/resource/kitchen-renovation-sydney.jpg" alt="Sydney Plumbing" title="<?php echo $blogname; ?>">
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
                                            Great kitchen design requires combining layout, appliances, and surfaces to create a beautiful, functional, and convenient cooking space. At <a href="https://www.hydrolinkplumbing.com.au/" title="Hydrolink Plumbing Sydney" target="_blank"><strong>Hydrolink Plumbing</strong></a>, we specialise in bringing together all the elements for your <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>Kitchen Renovations Sydney</strong></a> or new installation projects. Our kitchen designers always give priority to function before arranging a stunning palette of modern aesthetics for an attractive and effortless experience. We have the experience and expertise to transform your ideas and visions into reality while adhering to the highest professional standards.
                                        </p>
                                        <p> 
                                            We handle and complete every stage of the project, from design to construction of <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>Kitchen Cabinetry Sydney</strong></a> to installation and everything in between. We make your custom cabinetry in our own factory, which means we have full control over each step in the kitchen design and build process. While adhering to all the functional aspects of kitchen design, including the kitchen work triangle, we lay a lot of emphasis on your individual preferences. Your budget and personal preferences will determine whether your <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>Kitchen Renovations Sydney</strong></a> project needs integrated appliances or not. Such appliances bring a seamless aesthetic appeal to your kitchen design. Whether you prefer freestanding or integrated fridges, we can <a href="https://www.hydrolinkplumbing.com.au/kitchen-renovation" title="Hydrolink Plumbing Sydney" target="_blank"><strong>custom-design your kitchen</strong></a> around your requirements.
                                        </p>

                                        <p>
                                            At <a href="https://www.hydrolinkplumbing.com.au/" title="Hydrolink Plumbing Sydney" target="_blank"><strong>Hydrolink Plumbing</strong></a>, we understand the importance of the small details in creating the perfect kitchen. If you need a new installation or your old kitchen needs to be updated, you can trust us with all steps of the process. Call us today at <strong>0433 629 517</strong> or write to us using this Contact Form to discuss your ideas and vision. We can help you make the most of your space and design an inspirational kitchen you will love.
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