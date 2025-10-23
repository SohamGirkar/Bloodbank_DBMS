// Hospital data by area
const hospitalsByArea = {
  Andheri: [
    "Criticare Hospital",
    "Holy Spirit Hospital",
    "Seven Hills Hospital",
    "Hiranandani Hospital",
    "Cooper Hospital",
  ],
  Bandra: [
    "Lilavati Hospital",
    "P. D. Hinduja Hospital",
    "Bhabha Hospital",
    "Asian Heart Institute",
    "Holy Family Hospital",
  ],
  Dadar: [
    "Shushrusha Citizens' Co-op. Hospital",
    "Parel Hospital",
    "Kem Hospital",
    "Tata Memorial Hospital",
    "Seth G.S. Medical College & KEM Hospital",
  ],
  Borivali: [
    "Karuna Hospital",
    "Lotus Multispeciality Hospital",
    "Namaha Hospital",
    "Orchid Hospital",
    "Apex Superspeciality Hospital",
  ],
  Thane: [
    "Jupiter Hospital",
    "Bethany Hospital",
    "Horizon Prime Hospital",
    "Currae Specialty Hospital",
    "Hiranandani Hospital Thane",
  ],
  Ghatkopar: [
    "Zen Multi Speciality Hospital",
    "Parakh Hospital",
    "Sarvodaya Hospital",
    "Kohinoor Hospital",
    "Hindu Sabha Hospital",
  ],
  Malad: [
    "Atlantis Hospital",
    "Suchak Hospital",
    "Thunga Hospital",
    "Vivaan Hospital",
    "Riddhi Vinayak Critical Care Hospital",
  ],
  Colaba: [
    "INHS Asvini Hospital",
    "Bombay Hospital & Medical Research Centre",
    "St. George Hospital",
    "Saifee Hospital",
    "Cumballa Hill Hospital",
  ],
};

// Toggle last donation field
function toggleLastDonationField(show) {
  const lastDonationField = document.getElementById("last-donation-field");
  const lastDonationInput = document.getElementById("last-donation");

  if (show) {
    lastDonationField.style.display = "block";
    lastDonationInput.setAttribute("required", "required");
  } else {
    lastDonationField.style.display = "none";
    lastDonationInput.removeAttribute("required");
    lastDonationInput.value = "";
  }
}

// Update hospitals based on selected area
function updateHospitals() {
  const areaSelect = document.getElementById("area");
  const hospitalSelect = document.getElementById("hospital");
  const selectedArea = areaSelect.value;

  // Clear previous options
  hospitalSelect.innerHTML = '<option value="">Select Hospital</option>';

  // Add hospitals for selected area
  if (selectedArea && hospitalsByArea[selectedArea]) {
    hospitalsByArea[selectedArea].forEach((hospital) => {
      const option = document.createElement("option");
      option.value = hospital;
      option.textContent = hospital;
      hospitalSelect.appendChild(option);
    });
  }
}
// Mobile menu toggle
// document.addEventListener('DOMContentLoaded', function() {
//     const menuToggle = document.createElement('div');
//     menuToggle.className = 'menu-toggle';
//     menuToggle.innerHTML = '<span></span><span></span><span></span>';

//     const nav = document.querySelector('nav');
//     nav.appendChild(menuToggle);

//     const navLinks = document.querySelector('.nav-links');

//     menuToggle.addEventListener('click', function() {
//         navLinks.classList.toggle('active');
//     });

//     // Make submenus work on mobile
//     const menuItems = document.querySelectorAll('nav li:has(.menu)');
//     menuItems.forEach(item => {
//         const link = item.querySelector('a');
//         link.addEventListener('click', function(e) {
//             if (window.innerWidth <= 768) {
//                 e.preventDefault();
//                 const menu = item.querySelector('.menu');
//                 menu.classList.toggle('active');
//             }
//         });
//     });
// });

// Update areas based on selected district
function updateAreas() {
  const districtSelect = document.getElementById("district");
  const areaSelect = document.getElementById("area");

  // For now, only Mumbai is available
  if (districtSelect.value === "Mumbai") {
    areaSelect.disabled = false;
  } else {
    areaSelect.disabled = true;
    areaSelect.value = "";
  }
}

// Set minimum date for donation date to today
window.onload = function () {
  const today = new Date().toISOString().split("T")[0];
  document.getElementById("donation-date").setAttribute("min", today);

  const lastDonationInput = document.getElementById("last-donation");
  lastDonationInput.setAttribute("max", today);

  // Initially hide last donation field
  document.getElementById("last-donation-field").style.display = "none";
};
