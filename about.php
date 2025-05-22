<?php
require 'includes/header.php';
?>
<link rel="stylesheet" href="css/c.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/style.css">
<style>
  body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f9f9f9;
    color: #333;
  }

  .hero {
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.6)), url('images/about-hero.jpg') center/cover no-repeat;
    height: 280px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-align: center;
    padding: 0 20px;
  }

  .hero h1 {
    font-size: 2.8rem;
    margin-bottom: 10px;
  }

  .section {
    max-width: 1000px;
    margin: 40px auto;
    padding: 30px 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
  }

  .section h2 {
    color: #222;
    font-size: 1.9rem;
    margin-bottom: 15px;
    text-align: center;
  }

  .section p {
    font-size: 1.1rem;
    line-height: 1.7;
    text-align: center;
  }

  .features {
    display: flex;
    justify-content: space-around;
    margin-top: 30px;
    flex-wrap: wrap;
  }

  .feature {
    flex: 1 1 30%;
    margin: 10px;
    padding: 20px;
    background: #f2f9ff;
    border-radius: 10px;
    text-align: center;
    border-top: 4px solid #3498db;
  }

  .feature h4 {
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: #333;
  }

  .feature p {
    font-size: 1rem;
    color: #555;
  }

  .contact-form {
    margin-top: 40px;
  }

  .contact-form form {
    display: flex;
    flex-direction: column;
    max-width: 600px;
    margin: 0 auto;
  }

  .contact-form input,
  .contact-form textarea {
    padding: 12px;
    margin-bottom: 15px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 6px;
  }

  .contact-form button {
    background-color: #3498db;
    color: white;
    padding: 12px;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
  }

  .contact-form button:hover {
    background-color: #2980b9;
  }

  @media (max-width: 768px) {
    .features {
      flex-direction: column;
      align-items: center;
    }

    .feature {
      width: 80%;
    }
  }
</style>

<div class="hero">
  <div>
    <h1>About Tech Corner</h1>
  <img src="image/logo.png" alt="Tech Corner Logo" style="max-height: 130px;">
</div>

    <p>Your digital lifestyle, reimagined — one gadget at a time.</p>
  </div>
</div>

<div class="section">
  <h2>Our Story</h2>
  <p>
    Welcome to <strong>Tech Corner</strong> — where innovation meets everyday life. Founded by a team of passionate techies, we saw a gap in the market: modern consumers needed more than just products. They needed confidence. Guidance. A place that felt less like a store and more like a home for tech lovers.  
  </p>
  <p>
    From humble beginnings, Tech Corner grew into a trusted online hub offering the latest electronics with unbeatable value and warm, human-centered service. Whether you’re hunting for your next laptop, upgrading your mobile life, or finding the perfect smartwatch — we’re here to help every step of the way.
  </p>
</div>

<div class="section">
  <h2>What We Offer</h2>
  <div class="features">
    <div class="feature">
      <h4>Carefully Curated Tech</h4>
      <p>We don’t just sell gadgets — we select them. Every item is handpicked based on performance, style, and reliability.</p>
    </div>
    <div class="feature">
      <h4>Support That Actually Cares</h4>
      <p>Our team listens, responds, and solves. No bots. No runarounds. Just real people making sure you’re taken care of.</p>
    </div>
    <div class="feature">
      <h4>Built for Every Budget</h4>
      <p>From premium picks to budget champions, we believe great tech should be accessible to everyone.</p>
    </div>
  </div>
</div>

<div class="section contact-form">
  <h2>We’d Love to Hear From You</h2>
  <p>Got a suggestion? A question? Or maybe just some kind words? Drop us a message — your feedback fuels our growth.</p>

  <form action="send_feedback.php" method="POST">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
    <button type="submit">Send Feedback</button>
  </form>
</div>

<?php
require 'includes/footer.php';
?>
