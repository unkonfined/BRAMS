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
const database = firebase.database();

// Function to fetch resident details
function fetchResidentDetails(residentId) {
    const residentRef = database.ref('Residents/' + residentId);
    residentRef.once('value', function(snapshot) {
        if (snapshot.exists()) {
            const residentData = snapshot.val();
            populateResidentDetails(residentData);
        } else {
            console.error("Resident not found!");
        }
    });
}

function populateResidentDetails(residentData) {
    const documentType = document.getElementById('documentType').value;

    // Helper function to check if a value is undefined, null, or empty and replace it with a placeholder
    const safeValue = (value, placeholder) => value && value.trim() ? value : placeholder;

    // Populate the residentName field with names displayed closely together
    const fullName = `${safeValue(residentData.first_name, '')} ${safeValue(residentData.middle_name, '')} ${safeValue(residentData.last_name, '')} ${safeValue(residentData.suffix, '')}`.trim().replace(/\s+/g, ' ');

    document.getElementById('residentName').innerText = fullName;

    document.getElementById('age').innerText = 
        calculateAge(residentData.date_of_birth) || '____';

    document.getElementById('civilStatus').innerText = 
        safeValue(residentData.civil_status, '________________');

    document.getElementById('gender').innerText = 
        safeValue(residentData.gender, '______');

    document.getElementById('birthDate').innerText = 
        safeValue(residentData.date_of_birth, '________________');

    document.getElementById('birthPlace').innerText = 
        safeValue(residentData.place_of_birth, '________________');

    // Additional document type-specific logic (if any)
    if (documentType === 'clearance') {
        console.log("Processing Barangay Clearance");
    } else if (documentType === 'residency') {
        console.log("Processing Certificate of Residency");
    } else if (documentType === 'indigency') {
        console.log("Processing Certificate of Indigency");
    } else if (documentType === 'certification') {
        console.log("Processing Certification");
    } else {
        console.error("Unknown document type!");
    }
}

// Function to calculate age from date of birth
function calculateAge(birthDate) {
    if (!birthDate) return null;
    const birth = new Date(birthDate);
    const today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    const monthDifference = today.getMonth() - birth.getMonth();
    if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    return age;
}

// Fetch resident details when the page loads
window.onload = function() {
    const residentId = document.getElementById('residentId').value; // Resident ID from PHP
    const documentType = document.getElementById('documentType').value; // Document type from PHP
    
    if (residentId && documentType) {
        fetchResidentDetails(residentId);
    } else {
        console.error("Resident ID or Document Type is missing.");
    }
};
