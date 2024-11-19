document.addEventListener('DOMContentLoaded', () => {
    // Populate Dropdowns
    const appellations = [
        "Select Appellation", "Mr.", "Mrs.", "Ms.", "Dr.", "Prof.", "Hon."
    ];
    const placesOfBirth = [
        "Select Place of Birth", "Abra", "Agusan del Norte", "Agusan del Sur", "Aklan", "Albay", "Antique", "Apayao",
        "Aurora", "Basilan", "Bataan", "Batanes", "Batangas", "Benguet", "Biliran", 
        "Bohol", "Bukidnon", "Bulacan", "Cagayan", "Camarines Norte", "Camarines Sur", 
        "Camiguin", "Capiz", "Catanduanes", "Cavite", "Cebu", "Compostela Valley", 
        "Cotabato", "Davao del Norte", "Davao del Sur", "Davao Occidental", "Davao Oriental", 
        "Dinagat Islands", "Eastern Samar", "Guimaras", "Ifugao", "Ilocos Norte", 
        "Ilocos Sur", "Iloilo", "Isabela", "Kalinga", "La Union", "Laguna", "Lanao del Norte", 
        "Lanao del Sur", "Leyte", "Maguindanao", "Marinduque", "Masbate", "Metro Manila", 
        "Misamis Occidental", "Misamis Oriental", "Mountain Province", "Negros Occidental", 
        "Negros Oriental", "Northern Samar", "Nueva Ecija", "Nueva Vizcaya", "Occidental Mindoro", 
        "Oriental Mindoro", "Palawan", "Pampanga", "Pangasinan", "Quezon", "Quirino", 
        "Rizal", "Romblon", "Samar", "Sarangani", "Siquijor", "Sorsogon", "South Cotabato", 
        "Southern Leyte", "Sultan Kudarat", "Sulu", "Surigao del Norte", "Surigao del Sur", 
        "Tarlac", "Tawi-Tawi", "Zambales", "Zamboanga del Norte", "Zamboanga del Sur", 
        "Zamboanga Sibugay"
    ];
    const civilStatuses = [
        "Select Civil Status", "Single", "Married", "Widowed", "Divorced", "Separated", "Annulled"
    ];
    const philhealthMemberships = [
        "Select Membership", "Member", "Dependent", "Retiree", "None"
    ];
    const educationalAttainments = [
        "Select Educational Attainment", "No Formal Education", "Elementary Graduate", "High School Graduate", 
        "Vocational", "Associate Degree", "Bachelor's Degree", "Master's Degree", "Doctorate"
    ];
    const employmentStatuses = [
        "Select Employment Status", "Employed", "Unemployed", "Self-Employed", "Student", "Retired", "Others"
    ];
    const remarksNS = [
        "Select Nutrition Status", "Normal", "Underweight", "Overweight", "Obese", "Malnourished", "Others"
    ];
    const nationalities = [
        "Select Nationality", "Filipino", "American", "Chinese", "Japanese", "Korean", "Indian", "British", 
        "Canadian", "Australian", "Other"
    ];
    const relationships = [
        "Select Relationship", "Parent", "Sibling", "Spouse", "Child", "Relative", "Friend", "Colleague", "Neighbor", "Other"
    ];

    // Function to populate dropdowns
    function populateDropdown(dropdownId, options) {
        const dropdown = document.getElementById(dropdownId);
        console.log('Populating dropdown:', dropdownId); // Debugging line
        dropdown.innerHTML = ''; // Clear existing options
        options.forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.value = option;
            optionElement.textContent = option;
            dropdown.appendChild(optionElement);
        });
    }

    // Populate static dropdowns
    populateDropdown('appellation', appellations);
    populateDropdown('place_of_birth', placesOfBirth);
    populateDropdown('civil_status', civilStatuses);
    populateDropdown('philhealth_membership', philhealthMemberships);
    populateDropdown('educational_attainment', educationalAttainments);
    populateDropdown('employment_status', employmentStatuses);
    populateDropdown('remark_NS', remarksNS);
    populateDropdown('nationality', nationalities);
    populateDropdown('relationship', relationships);

    // Validate PhilHealth ID to be exactly 12 digits
    const philhealthIdInput = document.getElementById('philhealth_id');
    philhealthIdInput.addEventListener('input', (event) => {
        const value = event.target.value;
        if (/^\d{0,12}$/.test(value)) {
            event.target.value = value; // Allow only digits and up to 12 characters
        } else {
            event.target.value = value.slice(0, -1); // Remove last character if invalid
        }
    });

    // Validate Contact Number to be exactly 11 digits
    const contactNumberInput = document.getElementById('contact_number');
    contactNumberInput.setAttribute('placeholder', '09xxxxxxxxx'); // Hint for phone number format

    contactNumberInput.addEventListener('input', (event) => {
        let value = event.target.value;
        // Remove all non-numeric characters
        value = value.replace(/\D/g, '');

        // Ensure it is exactly 11 digits
        if (value.length > 11) {
            value = value.slice(0, 11); // Limit to 11 digits
        }
        event.target.value = value;
    });

    // Validate Emergency Phone Number to be exactly 11 digits
    const emergencyPhoneInput = document.getElementById('emergency_phone');
    emergencyPhoneInput.setAttribute('placeholder', '09xxxxxxxxx'); // Hint for phone number format

    emergencyPhoneInput.addEventListener('input', (event) => {
        let value = event.target.value;
        // Remove all non-numeric characters
        value = value.replace(/\D/g, '');

        // Ensure it is exactly 11 digits
        if (value.length > 11) {
            value = value.slice(0, 11); // Limit to 11 digits
        }
        event.target.value = value;
    });
});
