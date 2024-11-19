document.addEventListener('DOMContentLoaded', function() {
    // Utility function to populate dropdowns
    function populateDropdown(dropdownId, options) {
        const dropdown = document.getElementById(dropdownId);
        options.forEach(function(optionText) {
            const option = document.createElement('option');
            option.value = optionText;
            option.textContent = optionText;
            dropdown.appendChild(option);
        });
    }

    // Populate the Relationship to Household Head dropdown
    populateDropdown('rhh', [
        "Father", "Mother", "Son", "Daughter", "Brother", "Sister", 
        "Grandfather", "Grandmother", "Uncle", "Aunt", "Cousin", 
        "Nephew", "Niece", "Other"
    ]);

    // Populate the Type of Water Source dropdown
    populateDropdown('water_source', [
        "Bottled Water", "Deep Well", "River", "Spring", "Water District"
    ]);

    // Populate the Type of Toilet Facility dropdown
    populateDropdown('toilet_facility', [
        "Water-sealed", "Pit Latrine", "Open Pit", "None"
    ]);

    // Populate the Type of Waste Management dropdown
    populateDropdown('waste_management', [
        "Composting", "Recycling", "Burning", "None"
    ]);

    // Renter Dropdown and Conditional No. of Months Input Handling
    const renterDropdown = document.getElementById('renter');
    const renterMonthsInput = document.getElementById('renter_months');

    // Disable renter months input by default
    renterMonthsInput.disabled = true;

    // Add event listener to enable/disable months input based on renter selection
    renterDropdown.addEventListener('change', function() {
        if (renterDropdown.value === 'Renter_Yes') {
            renterMonthsInput.disabled = false;
        } else {
            renterMonthsInput.disabled = true;
            renterMonthsInput.value = ''; // Clear the value when disabled
        }
    });
});
