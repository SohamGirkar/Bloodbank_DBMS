 // Toggle last donation field
        function toggleLastDonationField(show) {
            const lastDonationField = document.getElementById('last-donation-field');
            const lastDonationInput = document.getElementById('last-donation');
            
            if (show) {
                lastDonationField.style.display = 'block';
            } else {
                lastDonationField.style.display = 'none';
                lastDonationInput.value = '';
            }
        }
        
        // Set maximum date for last donation to today
        window.onload = function() {
            const today = new Date().toISOString().split('T')[0];
            const lastDonationInput = document.getElementById('last-donation');
            lastDonationInput.setAttribute('max', today);
            
            // Initially hide last donation field
            document.getElementById('last-donation-field').style.display = 'none';
            
            // Form validation
            document.getElementById('donation-form').addEventListener('submit', function(e) {
                let isValid = true;
                
                // Validate required fields
                const requiredFields = [
                    'fullname', 'email', 'phone', 'gender', 'age', 
                    'blood-group', 'address'
                ];
                
                requiredFields.forEach(field => {
                    const element = document.getElementById(field);
                    if (!element.value.trim()) {
                        document.getElementById(`${field}-error`).style.display = 'block';
                        element.classList.add('error');
                        isValid = false;
                    } else {
                        document.getElementById(`${field}-error`).style.display = 'none';
                        element.classList.remove('error');
                    }
                });
                
                // Validate previous donation selection
                const donatedYes = document.getElementById('donated-yes');
                const donatedNo = document.getElementById('donated-no');
                
                if (!donatedYes.checked && !donatedNo.checked) {
                    document.getElementById('previous-donation-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('previous-donation-error').style.display = 'none';
                }
                
                // Validate terms
                if (!document.getElementById('terms').checked) {
                    document.getElementById('terms-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('terms-error').style.display = 'none';
                }
                
                if (!isValid) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = document.querySelector('.error');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        };