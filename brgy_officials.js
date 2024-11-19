// Firebase initialization (Make sure this is present in your script.js)
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
const app = firebase.initializeApp(firebaseConfig);
const database = firebase.database();

// Form submission handler
document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    console.log("Form submitted"); // Debug log

    // Retrieve form data
    const firstName = document.querySelector('input[name="first_name"]').value;
    const middleInitial = document.querySelector('input[name="middle_initial"]').value;
    const lastName = document.querySelector('input[name="last_name"]').value;
    const suffix = document.querySelector('select[name="suffix"]').value;

    // Validation (basic)
    if (!firstName || !lastName || !middleInitial) {
        alert('Please fill in all required fields.');
        return;
    }

    // Create reference to database
    const ref = database.ref('Brgy_Official').push();
    
    // Insert data into Firebase Realtime Database
    ref.set({
        first_name: firstName,
        middle_initial: middleInitial,
        last_name: lastName,
        suffix: suffix,
    })
    .then(() => {
        console.log('Data inserted successfully');
        showPopup(); // Call function to show success popup
    })
    .catch((error) => {
        console.error('Error inserting data: ', error);
        alert('There was an error inserting data. Please try again.');
    });
});

// Popup function
function showPopup() {
    const popup = document.createElement('div');
    popup.textContent = 'Data inserted successfully!';
    popup.style.position = 'fixed';
    popup.style.top = '50%';
    popup.style.left = '50%';
    popup.style.transform = 'translate(-50%, -50%)';
    popup.style.padding = '20px';
    popup.style.backgroundColor = 'green';
    popup.style.color = 'white';
    popup.style.fontWeight = 'bold';
    document.body.appendChild(popup);

    setTimeout(() => {
        window.location.href = 'resident_list.php'; // Redirect after 2 seconds
    }, 2000);
}
