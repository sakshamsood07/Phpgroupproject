<?php
include('header.php');  // Including header.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../assets/style.css" type="text/css">

</head>

<body>

    <!-- Hero Section -->
    <section class="hero text-white text-center">
    </section>
    <section id="shop" class="container py-12">
        <h2 class="text-center mb-4">Featured Speakers</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card-home">
                    <img src="images/Ultimate Sound Speaker.jpeg" class="product-img" alt="Speaker 1">
                    <div class="card-body">
                        <h5 class="card-title text-center">Ultimate Sound Speaker</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-home">
                    <img src="images/portable.jpg" class="product-img" alt="Speaker 2">
                    <div class="card-body">
                        <h5 class="card-title text-center">Portable Bluetooth Speaker</h5>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-home">
                    <img src="images/Studio Quality Sound.png" class="product-img" alt="Speaker 3">
                    <div class="card-body">
                        <h5 class="card-title text-center">Studio Quality Sound</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
 

    <!-- About Us Section -->
    <section class="about">
        <div class="container">
            <h2 class="text-center mb-4">About Us</h2>
            <div class="row align-items-center">
                <div class="col-md-6 py-5">
                    <p class="lead">We are passionate about delivering the best sound experience to our customers. Our
                        company has been providing high-quality audio solutions for over 10 years, offering a wide range
                        of speakers suitable for all environments. Whether you’re at home, on the go, or in the studio,
                        we have the perfect speaker for you.</p>
                </div>
                <div class="col-md-6">
                    <img src="images/about.png" class="img" alt="About Us">
                </div>
            </div>
        </div>
    </section>
 
<!-- Latest Blog Posts Section -->

<section class="blog-posts">
    <div class="container">
        <h2 class="text-center mb-4">Latest Blog Posts</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="blog-card">
                    <img src="images/blog1.png" alt="Cozy living room with premium speakers." class="blog-img" style="width: 100%; height: 300px;">
                    <div class="blog-content">
                        <h5 class="blog-title">5 Tips for Better Sound Quality</h5>
                        <p class="blog-desc">Discover how to enhance your audio experience with simple yet effective techniques.</p>
                        <a href="" class="readmore">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-card">
                    <img src="images/blog2.png" alt="Collage of vintage to modern speakers" class="blog-img" style="width: 100%; height: 300px;">
                    <div class="blog-content">
                        <h5 class="blog-title">The Evolution of Bluetooth Speakers</h5>
                        <p class="blog-desc">Learn about the history and advancements in Bluetooth speaker technology.</p>
                        <a href="" class="readmore">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="blog-card">
                    <img src="images/blog3.png" alt="Illustration of various speaker types" class="blog-img" style="width: 100%; height: 300px;">
                    <div class="blog-content">
                        <h5 class="blog-title">Choosing the Right Speaker for You</h5>
                        <p class="blog-desc">A guide to selecting the perfect speaker for your lifestyle and needs.</p>
                        <a href=""  class="readmore">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


     <!-- Services Section -->
     <section class="services">
        <div class="container text-center">
            <h2>Our Services</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="serv">
                        <i class="fas fa-shipping-fast icon"></i>
                        <h5>Free Shipping</h5>
                        <p>Enjoy free shipping on orders over $50.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="serv">
                        <i class="fas fa-headphones-alt icon"></i>
                        <h5>24/7 Support</h5>
                        <p>Our team is here to help around the clock.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="serv">
                        <i class="fas fa-star icon"></i>
                        <h5>Quality Assurance</h5>
                        <p>Only the best products with guaranteed quality.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Bootstrap JS & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
        integrity="sha384-qAiK5MxQz+sbMwPBA8hliofReiGr5XW+2YrJm2n4Gx+hxJsiMl5M6TEWKHbL9j7j" 
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" 
        integrity="sha384-wAq8m2+QbCq+MkKlCVHqYTBHCDlJzppEMBgcgnqwRnIte+znp91NOnhMh6oX+gkN" 
        crossorigin="anonymous"></script>   
    <?php
 include('footer.php'); 
 ?>

</body>


</html>