// Firebase configuration
const firebaseConfig = {
    apiKey: "AIzaSyD_Rj31N263vhY2QypFp1A330A72DGbeNc",
    authDomain: "dict-22013.firebaseapp.com",
    databaseURL: "https://dict-22013-default-rtdb.firebaseio.com",
    projectId: "dict-22013",
    storageBucket: "dict-22013.appspot.com",
    messagingSenderId: "738709120223",
    appId: "1:738709120223:web:fa7b76ca749e8c2eb0356a",
    measurementId: "G-EJHFFGH0PN"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Get a reference to the database service
const database = firebase.database();

// Firebase form submission script
document.getElementById('householdForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Retrieve Respondent Information
    const firstName = document.getElementById('first_name').value;
    const middleName = document.getElementById('middle_name').value || null;
    const lastName = document.getElementById('last_name').value;
    const relationshipToHead = document.getElementById('rhh').value;

    // Retrieve Household Information
    const householdNumber = document.getElementById('household_number').value;
    const isRenter = document.getElementById('renter').value;
    const renterMonths = document.getElementById('renter_months').value || null;

    // Retrieve Social Economic Status
    const nhtsStatus = document.querySelector('input[name="nhts_status"]:checked').value;
    const tribe = document.getElementById('tribe').value || null;

    // Retrieve Household Facilities
    const waterSource = document.getElementById('water_source').value;
    const toiletFacility = document.getElementById('toilet_facility').value;
    const wasteManagement = document.getElementById('waste_management').value;
    const blindDrainage = document.getElementById('blind_drainage').value;

    // Retrieve Business Information
    const businessName = document.getElementById('business_name').value || null;
    const businessAddress = document.getElementById('business_address').value || null;

    // Create a reference for a new household and get a unique ID
    const householdRef = database.ref('Households').push();
    const householdId = householdRef.key; // Firebase generates a unique ID

    // Insert all data into the households table
    householdRef.set({
        // Respondent Information
        first_name: firstName,
        middle_name: middleName,
        last_name: lastName,
        relationship_to_head: relationshipToHead,
        // Household Information
        household_number: householdNumber,
        is_renter: isRenter,
        renter_months: renterMonths,
        // Social Economic Status
        nhts_status: nhtsStatus,
        tribe: tribe,
        // Household Facilities
        water_source: waterSource,
        toilet_facility: toiletFacility,
        waste_management: wasteManagement,
        blind_drainage: blindDrainage,
        // Business Information
        business_name: businessName,
        business_address: businessAddress
    }).then(() => {
        console.log('Household information added successfully.');
        // Show the pop-up and redirect after 2 seconds
        showPopup();
    }).catch((error) => {
        console.error('Error adding data:', error);
    });
});

// Function to show the pop-up and then redirect after 2 seconds
function showPopup() {
    const popup = document.getElementById('successPopup');
    popup.classList.remove('hidden');

    // Delay of 2 seconds before redirecting
    setTimeout(() => {
        window.location.href = 'household_profile.php';
    }, 2000); // 2000 milliseconds = 2 seconds
}

// Function to close the pop-up (if needed)
function closePopup() {
    const popup = document.getElementById('successPopup');
    popup.classList.add('hidden');
}
