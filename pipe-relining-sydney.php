<?php $blogdate="15 Feb 2022"; ?>
<?php $blogname="Pipe Relining Sydney"; ?>

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
                                        <img src="images/resource/blog-6.jpg" alt="sydney plumber" title="<?php echo $blogname; ? loading="lazy" decoding="async">">
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
                                            With 15 years of operation, Hydrolink Plumbing has built a reputation as one of the reliable <a href="https://www.google.com/maps/place/Hydrolink+Plumbing+%26+Gas+Heater+Services+Sydney/@-33.8176381,150.9732376,15z/data=!4m5!3m4!1s0x0:0xa01aba37661942fe!8m2!3d-33.8176381!4d150.9732376" title="<?php echo $blogname; ?>" target="_blank"><strong>pipe relining services in Sydney</strong></a>. At Hydrolink Plumbing Services we offer fixing drains leaks and <a href="https://www.hydrolinkplumbing.com.au/pipe-relining" title="Hydrolink Plumbing Sydney" target="_blank"><strong>pipe relining services sydney</strong></a>. During Pipe relining our skilled plumbers repairs the cracked or broken pipes from the inside, without digging. Pipe relining is less invasive than pipe repairs and also cost effective.  Pipe relining services by Hydrolink Plumbing, assure reliability, durability and ensure increase in flow capacity. Our highly skilled plumbers are available 24/7 to provide <a href="https://www.hydrolinkplumbing.com.au/emergency" title="Hydrolink Plumbing Sydney" target="_blank"><strong>emergency plumbing services in sydney</strong></a> to cater your needs. We have all the experience and technology required to identify, fix and prevent further damage.
                                        </p>

                                        <p>
                                            Using state-of-the-art CCTV inspection cameras, we can locate pipes and pinpoint exactly where your home’s plumbing problems lie. This not only allows us to determine the exact location of the issue, but also lets us see the extent of the repairs needed. The Hydrolink Plumbing can diagnose and solve your plumbing issues promptly thanks to our pipe locating technology.
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