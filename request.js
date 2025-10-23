// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');
    
    menuToggle.addEventListener('click', function() {
        navLinks.classList.toggle('active');
    });
    
    // Make submenus work on mobile
    const menuItems = document.querySelectorAll('nav li:has(.menu)');
    menuItems.forEach(item => {
        const link = item.querySelector('a');
        link.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const menu = item.querySelector('.menu');
                menu.classList.toggle('active');
            }
        });
    });
});

// Blood bag selection
function selectBags(num) {
    const bags = document.querySelectorAll('.blood-bag');
    bags.forEach(bag => {
        bag.classList.remove('selected');
    });
    
    const selectedBag = document.querySelector(`.blood-bag[data-bags="${num}"]`);
    selectedBag.classList.add('selected');
    
    document.getElementById('blood-bags').value = num;
    document.getElementById('bags-error').style.display = 'none';
}

// Show review information
function showReview() {
    // Validate form first
    let isValid = true;
    
    const fullname = document.getElementById('fullname').value;
    const phone = document.getElementById('phone').value;
    const bloodGroup = document.getElementById('blood-group').value;
    const bloodBags = document.getElementById('blood-bags').value;
    const district = document.getElementById('district').value;
    const area = document.getElementById('area').value;
    const urgency = document.getElementById('urgency').value;
    
    if (!fullname) {
        document.getElementById('fullname-error').style.display = 'block';
        isValid = false;
    }
    
    if (!phone) {
        document.getElementById('phone-error').style.display = 'block';
        isValid = false;
    }
    
    if (!bloodGroup) {
        document.getElementById('blood-group-error').style.display = 'block';
        isValid = false;
    }
    
    if (!bloodBags) {
        document.getElementById('bags-error').style.display = 'block';
        isValid = false;
    }
    
    if (!district) {
        document.getElementById('district-error').style.display = 'block';
        isValid = false;
    }
    
    if (!area) {
        document.getElementById('area-error').style.display = 'block';
        isValid = false;
    }
    
    if (!urgency) {
        document.getElementById('urgency-error').style.display = 'block';
        isValid = false;
    }
    
    if (!isValid) {
        alert('Please fill all required fields correctly.');
        return;
    }
    
    // Populate review fields
    document.getElementById('review-fullname').textContent = fullname;
    document.getElementById('review-phone').textContent = phone;
    document.getElementById('review-blood-group').textContent = bloodGroup;
    document.getElementById('review-bags').textContent = bloodBags + ' bag(s)';
    document.getElementById('review-district').textContent = district;
    document.getElementById('review-area').textContent = area;
    document.getElementById('review-urgency').textContent = document.getElementById('urgency').options[document.getElementById('urgency').selectedIndex].text;
    
    // Show review container
    document.getElementById('review-container').classList.add('active');
}

// Close review information
function closeReview() {
    document.getElementById('review-container').classList.remove('active');
}

// Form submission validation
document.getElementById('blood-request-form').addEventListener('submit', function(e) {
    // Validate terms
    if (!document.getElementById('terms').checked) {
        e.preventDefault();
        document.getElementById('terms-error').style.display = 'block';
        alert('Please agree to the terms and conditions.');
        return;
    }
    
    // The form will submit to PHP script
});