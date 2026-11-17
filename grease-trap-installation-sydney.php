<?php $blogdate="22 May 2022"; ?>
<?php $blogname="Grease Trap Installation Sydney"; ?>

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
                                        <img src="images/resource/blog-2.jpg" alt="<?php echo $blogname; ? loading="lazy" decoding="async">" title="<?php echo $blogname; ?>">
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
                                            Hydrolink <strong>Plumbing Services</strong> specializes in <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>grease trap services across Sydney</strong></a>. We have a team of certified and experienced professional plumbers who can install, repair, and replace or clean grease traps efficiently and effectively. At Hydrolink Plumbing you will have full guidance regarding the suitable location and best type of grease trap for your specific needs. Our experts will schedule appointments regarding washing and cleaning of grease traps. Our <a href="https://www.hydrolinkplumbing.com.au/" title="Hydrolink Plumbing Sydney" target="_blank"><strong>experienced plumbers of sydney</strong></a> will connect the grease trap effectively to prevent oil and grease from entering sewage mains and then schedule cleaning and maintenance services as well. Our grease trap system is fully compliant with all OH&S (occupational health and safety regulation) requirements. We can advise you on your existing grease trap set-up or work with you prior to installation of a new grease trap.
                                        </p>

                                        <p>
                                            Hydrolink Plumbing’s team of specialist plumbers provide grease trap plumbing services including <a href="https://www.hydrolinkplumbing.com.au/grease-trap" title="Hydrolink Plumbing Sydney" target="_blank"><strong>grease trap installation</strong></a>, maintenance and repairs for commercial kitchens, factories and workshops. We ensure grease traps are located away from customers, yet remain in reach of pumb-out trucks for emptying. Our state of the art technology ensures we provide the best grease trap plumbing solution for your situation and budget.
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

    <script src="js/jquery.js" defer></script>
    <script src="js/jquery.validate.min.js" defer></script>
    <script src="js/popper.min.js" defer></script>
    <script src="js/bootstrap.min.js" defer></script>
    <script src="js/jquery-ui.js" defer></script>
    <script src="js/jquery.fancybox.js" defer></script>
    <script src="js/owl.js" defer></script>
    <script src="js/scrollbar.js" defer></script>
    <script src="js/appear.js" defer></script>
    <script src="js/wow.js" defer></script>
    <script src="js/custom-script.js" defer></script>

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