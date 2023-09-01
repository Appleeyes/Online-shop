<?php
$activePage = 'contact';
require_once __DIR__ . '/../templates/header.php';
require_once __DIR__ . '/../templates/navigation.php';

?>

<section id="page-header" class="about-header">
    <h2>#let's_talk</h2>
    <p>LEAVE A MESSAGE, We love to hear from you!</p>
</section>

<section id="contact-details" class="section-p1">
    <div class="details">
        <span>GET IN TOUCH</span>
        <h2>Visit one of our agency locations or contact us today</h2>
        <h3>Head Office</h3>
        <div>
            <li>
                <i class="far fa-map"></i>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </li>
            <li>
                <i class="far fa-envelope"></i>
                <p>contact@example.com</p>
            </li>
            <li>
                <i class="fas fa-phone-alt"></i>
                <p>contact@example.com</p>
            </li>
            <li>
                <i class="far fa-clock"></i>
                <p>Monday to Saturday: 9:00am to 16.pm</p>
            </li>
        </div>
    </div>

    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15784.815680066244!2d4.654522991323899!3d8.479542859672753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10364b160da266c7%3A0x827380536d646f55!2s240102%2C%20Ilorin%2C%20Kwara!5e0!3m2!1sen!2sng!4v1679663123317!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<section id="form-details">
    <form action="">
        <span>LEAVE A MESSAGE</span>
        <h2>We love to hear from you</h2>
        <input type="text" placeholder="Your Name">
        <input type="email" placeholder="E-mail">
        <input type="text" placeholder="Subject">
        <textarea name="" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
        <button class="normal">Submit</button>
    </form>

    <div class="people">
        <div>
            <img src="/Online-shop/public/images/people/1.png" alt="">
            <p><span>John Doe </span>Senior Marketing Manager <br>Phone: +234 902 498 1028 <br>Email: contact@example.com</p>
        </div>
        <div>
            <img src="/Online-shop/public/images/people/2.png" alt="">
            <p><span>William Smith </span>Senior Marketing Manager <br>Phone: +234 902 498 1028 <br>Email: contact@example.com</p>
        </div>
        <div>
            <img src="/Online-shop/public/images/people/3.png" alt="">
            <p><span>Jane Doe </span>Senior Marketing Manager <br>Phone: +234 902 498 1028 <br>Email: contact@example.com</p>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/newsletter.php';
require_once __DIR__ . '/../templates/footer.php';
?>