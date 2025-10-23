# LifeShare Blood Bank Management System

**Your Drop. Their Hope. Our Future.**

## 🩸 About LifeShare

LifeShare is a complete Blood Bank Management System designed for Mumbai, India. It connects donors, recipients, blood banks, and the public to make blood donation safer, easier, and more effective. Whether you want to donate, request blood urgently, or learn more about the process, LifeShare gives you all the tools and information you need.

---

## 📸 Project Demo

**Video of Project :** - https://youtu.be/yjU_f-wFpTI?si=Y6NpZRJuOKjIFvFW

**Homepage :**
![Homepage](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/1_Home-Top.png?raw=true)
**Find Donors :**
![Find Donors](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/6_Find_donors.png?raw=true)
**AI Assistant :**
![AI Assistant](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/8_LifeShare_AI_Assistant.png?raw=true)
**Donation Centres :**
![Donation Centres](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/10_Donation_Centres.png?raw=true)
**Donate Now :**
![Donate Now](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/12_Donate_now.png?raw=true)
**Donate Later :**
![Donate Later](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/15_Donate_Later.png?raw=true)
**Request Blood :**
![Request Blood](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/18_Request_Blood.png?raw=true)
**Available Donors :**
![Available Donors](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/21_Available_Donors.png?raw=true)
**Compatibility :**
![Compatibility](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/22_Compatibility.png?raw=true)
**Register :**
![Register](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/24_Register.png?raw=true)
**Contact Us :**
![Contact Us](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/4_Home-Contact_Us.png?raw=true)
**Emergency :**
![Emergency](https://github.com/maliha-yasmin-mim/BloodBank-Management-System/blob/main/Project-Demo/25_Emergency.png?raw=true)

---

## 🚀 Features

- **Donor Registry:** Register as a donor (Donate Now / Donate Later).
- **Donation Centers:** Locate verified donation centers in Dhaka.
- **Request Blood:** Submit urgent blood requests with detailed info.
- **Find Donors:** Search by blood group and location.
- **Blood Compatibility Checker:** See who can donate to whom.
- **Upcoming Campaigns:** View and join blood drives.
- **User Profile:** User can create account.
- **AI Assistant:** Chatbot answers about donation, eligibility, technical help.
- **Contact & Feedback:** Get support and send suggestions.
- **Emergency Hotline:** Immediate help for critical cases.

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Icons:** Font Awesome
- **Map Integration:** Google Maps Embed

---

## 🗂️ Project Structure

```
├── index.php / styles.css           # Home, service, why donate, process, contact
├── AI.html / AI.js / AI.css         # AI Assistant chat interface
├── donate_now.html / .css / .js     # Immediate donation form & logic
├── donate_later.html / .css / .js   # Donate later registry
├── donation_centres.html / .css     # Dhaka donation centers with map links
├── request.html / .css / .js        # Request blood form & logic
├── available.php / available.css    # View available donors/blood
├── find_donors.php / find_donor.css # Donor search by blood group/location
├── compatibility.php / .css         # Blood compatibility checker/table
├── db.php                           # Database connection
├── campaigns.php                    # Upcoming donation campaigns
├── emergency.php                    # Emergency request page & hotline
├── contact.php                      # Contact & feedback form
├── login.php / login.css            # Basic login/register UI
├── submit_*.php                     # Form handlers for DB insert
├── images/                          # Project images (favicon, logo, backgrounds)
└── README.md                        # Project documentation
```

---

## ⚡ Installation

**Requirements:**

- PHP 7.x or 8.x
- MySQL Server
- Localhost environment (XAMPP/WAMP/MAMP)

**Setup:**

1. Clone or download this repository.
2. Import the `bloodbank` database (see below).
3. Place files in your web server root (htdocs for XAMPP).
4. Update credentials in `db.php` if needed.
5. After run Localhost and MySQL Server. Enter the link : http://localhost/blood-bank-management-system/index.php

**Database Structure:**

- Tables: `donate_now`, `donate_later`, `blood_requests_list`, `campaigns`, `contact_messages`, `login_Users`
- See PHP files for exact column names or use PHPMyAdmin's import feature.

# Blood Bank Database Tables

This SQL script creates the main tables for the **bloodbank** database.

## Tables Created

- `donate_now` → Immediate donation requests
- `donate_later` → Scheduled donations
- `blood_requests_list` → Blood requests tracking
- `campaigns` → Blood donation campaigns/events
- `contact_messages` → Messages sent through contact form
- `login_Users` → Store user's information

## SQL Script

```sql
-- Switch to bloodbank database
CREATE DATABASE bloodbank;
USE bloodbank;

-- Table 1: donate_now (immediate donation requests)
CREATE TABLE donate_now (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    age INT NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    previous_donation ENUM('yes', 'no') NOT NULL,
    last_donation DATE,
    address TEXT NOT NULL,
    donation_date DATE,
    district VARCHAR(50),
    area VARCHAR(50),
    hospital VARCHAR(100),
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
status ENUM('pending', 'processing', 'fulfilled') DEFAULT 'pending'

);


-- Table 2: donate_later (scheduled donations)
CREATE TABLE  donate_later (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    age INT NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    previous_donation ENUM('yes', 'no') NOT NULL,
    last_donation DATE,
    address TEXT NOT NULL,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'processing', 'fulfilled') DEFAULT 'pending'

);


-- Table 3: blood_requests_list (all blood requests)
CREATE TABLE blood_requests_list (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    bags INT(2) NOT NULL,
    district VARCHAR(50) NOT NULL,
    area VARCHAR(50) NOT NULL,
    urgency VARCHAR(20) NOT NULL,
    details TEXT,
    terms TINYINT(1) NOT NULL,
    request_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'processing', 'fulfilled') DEFAULT 'pending'

);


-- Table 4: campaigns (blood donation campaigns/events)
CREATE TABLE campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date DATE NOT NULL,
    time VARCHAR(50) NOT NULL,
    location VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Table 5: contact_messages (messages sent via contact form)
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    subject VARCHAR(150),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Table 6: login_Users
CREATE TABLE login_Users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    locations VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

```

---

## 💡 Usage Guide

- **Register as Donor:** Fill Donate Now/Later forms to join the registry.
- **Find Donors:** Search by blood group/location for quick matches.
- **Request Blood:** Submit requests for urgent or scheduled needs.
- **Check Compatibility:** Use compatibility checker for safe transfusions.
- **Get Help:** Use AI Assistant or contact form for any questions.

---

## 🧑‍💻 Contributing

We welcome pull requests!

1. Fork the repo
2. Create your feature branch
3. Commit changes
4. Open a pull request

---

## 📞 Emergency & Support

- **Emergency Hotline:** `01732278875`
- **Email:** `lifeshare@gmail.com`
- **Location:** 111/2 Kawlar Jame Mosjid Road, Ashkona, Dakshinkhan, Dhaka-1230

---

## 📝 License

This project is for educational, non-commercial use only.  
See [LICENSE](LICENSE) for details.

---

## 🙏 Acknowledgments

- All volunteer donors and collaborators
- Font Awesome for icons

---

## ❤️ Donate Blood, Save Lives!

_Your donation is the greatest gift. Join LifeShare and be a hero today._
