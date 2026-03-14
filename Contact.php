<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Changes - Contact</title>
<link rel="stylesheet" href="Contact.css">
</head>


<body>

<header>
    <div>
        <a href="Index.html" class="logo">CHVNGES</a>
    </div>  
    <nav>
        <a href="Page.html">Fitness</a>
        <a href="#">Wellness</a>
        <a href="Shop.html">Shop</a>
        <a href="About.html">About</a>
        <a href="Contact.php" class="active">Contact</a>
        <a href="/Changes/LogInPage.html" class="login">Log In</a>
        <a href="SignUpPage.html" class="signup-link">Sign Up</a>
    </nav> 
</header>

<section class="contact-section">


<div class="contact-container">



<div class="contact-info">
<h2>Get In Touch</h2>

<p><strong>Phone:</strong> +254793 691 023</p>
<p><strong>Email:</strong> mwakamoledaniel@gmail.com</p>

<p>
Check out our social media for the latest updates, fitness tips and wellness inspiration.
</p>

<div class="social-media">

<a href="https://www.facebook.com/share/16ggqN4f9G/" target="_blank">
<img src="Facebook Icon.png" alt="Facebook">
</a>

<a href="https://www.instagram.com/changes_center?igsh=N2dubzdhY2V0eHp4" target="_blank">
<img src="Instagram Icon.png" alt="Instagram">
</a>

<a href="https://www.tiktok.com/@changes.centre?_r=1&_t=ZS-94ed9MvKtU5" target="_blank">
<img src="TikTok Icon.png" alt="TikTok">
</a>

</div>

</div>

<form class="contact-form" action="SendEmail.php" method="POST">
    <input type="text" name="name" placeholder="Your Name" required>

    <input type="email" name="email" placeholder="Your Email" required>

    <input type="text" name="subject" placeholder="Subject">

    <textarea name="message" rows="6" placeholder="Your Message"></textarea>

    <button type="submit">Send Message</button>
</form>
</div>

</section>

<footer class="site-footer">
    <p>© 2026 CHVNGES</p>
</footer>

</body>
</html>