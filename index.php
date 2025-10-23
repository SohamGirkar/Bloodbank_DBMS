<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeShare </title>

    <!-- tailwind+daisyui cdn -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="images/favicon.jpg" type="image/x-icon">
</head>

<body>
<header>
    <nav>
        <div class="logo">LifeShare</div>
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="nav-links" style="text-align: center;">
            <li><a href="index.php">Home</a></li>
            <li><a href="find_donors.php">Find Donors</a></li>
            <li><a href="AI.html"><i class="fas fa-robot"></i> Ask AI</a></li>
            <li><a href="donation_centres.html">Donation Centres</a></li>

            <li class="has-submenu">
                <a href="#service">Services <i class="fas fa-chevron-down"></i></a>
                <ul class="submenu">
                    <li><a href="donate_now.html">Donate Now</a></li>
                    <li><a href="donate_later.html">Donate Later</a></li>
                    <li><a href="request.html">Request Blood</a></li>
                    <li><a href="available.php">Available Blood</a></li>
                    <li><a href="compatibility.php" class="active">Compatibility</a></li>
                </ul>
            </li>

            <?php if(isset($_SESSION['username'])): ?>
                <li><a href="profile.php">👤 <?php echo $_SESSION['username']; ?></a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>

            <li><a href="index.php#contact">Contact</a></li>
            <li><a href="emergency.php" class="emergency-btn">Emergency</a></li>
        </ul>
    </nav>
</header>
       
<section id="home">
    <div class="carousel w-full h-[500px]">
        <!-- Slide 1 -->
        <div id="slide1" class="carousel-item relative w-full">
          <div class="absolute inset-0">
            <img src="images/blood 2.jpg" class="w-full h-full object-cover blur-sm" />
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
          </div>
          <div class="relative flex flex-col items-center justify-center text-center text-white w-full px-5">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Give Blood Give Life : Your Donation Save life</h1>
            <p class="text-lg md:text-xl mb-6">Your donation can make the difference between life and death. Join thousands of heroes who give the gift of life every day.</p>
            <a href="donate_now.html" class="cta-button">Donate Now</a>
          </div>
          <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide4" class="btn btn-circle">❮</a> 
            <a href="#slide2" class="btn btn-circle">❯</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div id="slide2" class="carousel-item relative w-full">
          <div class="absolute inset-0">
            <img src="images/bg-1.jpg" class="w-full h-full object-cover blur-sm" />
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
          </div>
          <div class="relative flex flex-col items-center justify-center text-center text-white w-full px-5">
            <h1 class="text-4xl md:text-5xl font-bold  mb-4">Respond to the Request :Be the Answer to Someone’s Prayer</h1>
            <p class="text-lg md:text-xl mb-6">Every unit of blood donated is a step closer to saving a life. Answer the call</p>
            <a href="request.html" class="cta-button">Request Blood</a>
          </div>
          <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide1" class="btn btn-circle">❮</a> 
            <a href="#slide3" class="btn btn-circle">❯</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div id="slide3" class="carousel-item relative w-full">
          <div class="absolute inset-0">
            <img src="images/bg-2.jpeg" class="w-full h-full object-cover blur-sm" />
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
          </div>
          <div class="relative flex flex-col items-center justify-center text-center text-white w-full px-5">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Give Blood Give Life : Your Donation Save life</h1>
            <p class="text-lg md:text-xl mb-6">Step into our Blood Donation Center and step into someone’s story of survival. Your contribution is the gift of life.</p>
            <a href="donation_centres.html" class="cta-button">Donation Centres</a>
          </div>
          <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide2" class="btn btn-circle">❮</a> 
            <a href="#slide4" class="btn btn-circle">❯</a>
          </div>
        </div>

        <!-- Slide 4 -->
        <div id="slide4" class="carousel-item relative w-full">
          <div class="absolute inset-0">
            <img src="images/bg-3.jpeg" class="w-full h-full object-cover blur-sm" />
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
          </div>
          <div class="relative flex flex-col items-center justify-center text-center text-white w-full px-5">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Searching for Blood, Finding Hope</h1>
            <p class="text-lg md:text-xl mb-6">Our platform makes it easier to find verified blood donors quickly. Because in critical times, every moment matters.</p>
            <a href="find_donors.php" class="cta-button">Find Donors</a>
          </div>
          <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
            <a href="#slide3" class="btn btn-circle">❮</a> 
            <a href="#slide1" class="btn btn-circle">❯</a>
          </div>
        </div>
      </div>
</section>

<!-- Upcoming Campaigns Section -->
<section id="campaigns" class="py-12 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8"> Upcoming Blood Donation Campaigns</h2>
        <div id="campaigns-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Campaign cards will be inserted here via AJAX -->
        </div>
        <div class="text-center mt-6">
            <a href="campaigns.php" class="px-6 py-3 bg-red-600 text-white rounded hover:bg-red-700">View All Campaigns</a>
        </div>
    </div>
</section>

<!-- Why Donate Section -->
<section id="why-donate" class="why-donate">
    <div class="container">
        <h2 class="section-title">Why Your Donation Matters</h2>
        <div class="benefits-grid grid grid-cols-1 md:grid-cols-2">
            <div class="benefit-card">
                <div class="benefit-icon">💉</div>
                <h3>Emergency Care</h3>
                <p>Emergency trauma patients need immediate blood transfusions. Your donation could save someone's life in their most critical moment.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🏥</div>
                <h3>Cancer Treatment</h3>
                <p>Cancer patients undergoing chemotherapy often need blood transfusions to help their bodies recover and continue fighting.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">👶</div>
                <h3>Childbirth Support</h3>
                <p>Complications during childbirth may require blood transfusions to ensure both mother and baby remain healthy.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">⚕️</div>
                <h3>Surgical Procedures</h3>
                <p>Major surgeries often require blood transfusions to replace blood lost during the procedure.</p>
            </div>
        </div>
    </div>
</section>

<!-- Donation Process -->
<section id="procedure" class="process">
    <div class="container">
        <h2 class="section-title">The Donation Process</h2>
        <div class="process-steps">
            <div class="process-step">
                <div class="step-number">1</div>
                <h3>Registration</h3>
                <p>Complete registration forms and provide valid identification.</p>
            </div>
            <div class="process-step">
                <div class="step-number">2</div>
                <h3>Health Check</h3>
                <p>Quick health screening including blood pressure, temperature, and hemoglobin test.</p>
            </div>
            <div class="process-step">
                <div class="step-number">3</div>
                <h3>Donation</h3>
                <p>The actual blood donation takes about 8-10 minutes in a comfortable setting.</p>
            </div>
            <div class="process-step">
                <div class="step-number">4</div>
                <h3>Recovery</h3>
                <p>Rest and enjoy refreshments while your body adjusts after donation.</p>
            </div>
        </div>
    </div>
</section>
        
<!-- contact -->
<section id="contact" class="contact">
    <div class="contact-container">
        <div class="contact-header">
            <h1>Contact Us</h1>
            <p>Get in touch with LifeShare - we're here to help</p>
        </div>
        
        <div class="contact-content">
            <div class="contact-info">
                <h2>Contact Information</h2>
                
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="info-content">
                        <h3>Address</h3>
                        <p> OPD 4, First floor, Casualty Building, LTMG Hospital, Sion, Mumbai-400022</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div class="info-content">
                        <h3>Phone</h3>
                        <p>+91 93XXXXXXX5</p>
                        <p>022 24XXXX4 </p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>lifesharemum@gmail.com</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <div class="info-content">
                        <h3>Hours</h3>
                        <ul class="hours-list">
                            <li><span>Monday - Friday:</span> <span>8AM - 6PM</span></li>
                            <li><span>Saturday:</span> <span>9AM - 4PM</span></li>
                            <li><span>Sunday:</span> <span>10AM - 3PM</span></li>
                        </ul>
                    </div>
                </div>
                
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d138515.31940193888!2d72.8777!3d19.0355!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c8b4b4b4b4b4b%3A0x3be7c8b4b4b4b4b4b!2sLokmanya%20Tilak%20Municipal%20General%20Hospital%20Sion!5e0!3m2!1sen!2sin!4v1634567890123!5m2!1sen!2sin"  width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            
           <div class="contact-form">
    <h2>Send Us a Message</h2>
    
    <form id="contactForm" action="contact.php" method="POST">
        <div class="form-group">
            <label for="fullname">Full Name *</label>
            <input type="text" id="fullname" name="full_name" class="form-control" placeholder="Enter your full name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone_number" class="form-control" placeholder="Enter your phone number">
        </div>
         
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="form-control" placeholder="What is your message about?">
        </div>
        
        <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="message" class="form-control" placeholder="How can we help you?" required></textarea>
        </div>
        
        <button type="submit" class="btn-submit">Send Message</button>
        
        <div class="form-success" id="formSuccess" style="display:none;">
            Thank you for your message! We'll get back to you soon.
        </div>
    </form>
    
</div>

        </div>
    </div>
</section>
       
<!-- footer -->
<footer>
    <div class="container">
        <div class="footer-content grid grid-cols-4">
            <div class="footer-section">
                <h3>LifeShare</h3>
                <p>Dedicated to saving lives through blood donation. Every donation makes a difference.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#why-donate">Why Donate</a></li>
                    <li><a href="find_donors.php">Find Donors</a></li>
                    <li><a href="AI.html">AI Assistant</a></li>
                    <li><a href="#procedure">Process</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Resources</h3>
                <ul>
                    <li><a href="donation_centres.html">Donation Centers</a></li>
                    <li><a href="campaigns.php">Blood Drive Events</a></li>
                    <li><a href="AI.html">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="emergency.php">Emergency Services</a></li>
                    <li><a href="donate_now.html">Donate</a></li>
                </ul>
            </div>
        </div>
        <p>&copy; 2025 LifeShare Blood Donation Center. All rights reserved.</p>
    </div>
</footer>
   
</body>
</html>
