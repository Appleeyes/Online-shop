<?php
$activePage = 'about';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<section id="page-header" class="about-header">
    <h2>#KnowUs</h2>
    <p>Lorem ipsum dolor sit amet consectetur</p>
</section>

<section id="about-head" class="section-p1">
    <img src="/Online-shop/public/images/about/a6.jpg" alt="">
    <div>
        <h2>Who We Are?</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae quaerat animi harum. Corrupti nesciunt, sequi perspiciatis officia fugiat eligendi magni tempore nobis atque rem voluptatum facilis in dicta nihil? Quos id accusamus quo, laboriosam blanditiis quisquam assumenda similique, eaque dolorem expedita laudantium maxime aliquid porro reiciendis officia labore ipsum sunt minima quasi alias tenetur! Hic tempora ut harum voluptates vitae Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque, provident!?</p>
        <abbr title="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias dolorem nemo eveniet repellendus sunt architecto pariatur eum! Quo harum reiciendis doloribus?
        </abbr>
        <br><br>

        <marquee bgcolor="#CCC" loop="-1" scrollamount="5" width="100%">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quas voluptatem ipsa ipsam eveniet provident sed id asperiores aliquam dignissimos perspiciatis! Quibusdam, nesciunt?.</marquee>
    </div>
</section>

<section id="about-app" class="section-p1">
    <h1>Download Our <a href="#">App</a></h1>
    <div class="video">
        <video autoplay muted loop src="/Online-shop/public/images/about/1.mp4"></video>
    </div>
</section>

<section id="feature" class="section-p1">
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f1.png" alt="">
        <h6>Free Shipping</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f2.png" alt="">
        <h6>Online Order</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f3.png" alt="">
        <h6>Save Money</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f4.png" alt="">
        <h6>Promotions</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f5.png" alt="">
        <h6>Happy Shell</h6>
    </div>
    <div class="fe-box">
        <img src="/Online-shop/public/images/features/f6.png" alt="">
        <h6>F24/7 Support</h6>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/newsletter.php';
require_once __DIR__ . '/../templates/footer.php';
?>