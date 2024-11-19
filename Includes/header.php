<style>
.custom-header {
    background-color: #f5f5f5;
    padding: 1rem;
    width: 100%;
}
.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}
.logout-button {
    background-color: #FF0000;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}
.logout-button:hover {
    background-color: #CC0000;
}
.logo {
    width: 70px;
    height: 80px;
    margin-right: 1rem;
}
.date-time {
    font-size: 0.9rem;
    color: #666;
}
.floating-msg {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 128, 0, 0.8);
    color: white;
    padding: 15px 25px;
    border-radius: 5px;
    font-size: 16px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    display: none;
    z-index: 1000;
    animation: fadeInOut 5s ease-in-out forwards;
}
@keyframes fadeInOut {
    0% { opacity: 0; }
    10% { opacity: 1; }
    90% { opacity: 1; }
    100% { opacity: 0; }
}
</style>

<div class="custom-header">
    <div class="container">
        <div class="flex items-center">
            <img src="Includes/background/dict.png" alt="Logo" class="logo">
            <div>
                <div id="userEmail" class="text-gray-700"></div>
                <div id="currentDateTime" class="date-time"></div>
            </div>
        </div>
        <button id="logoutButton" class="logout-button">Logout</button>
    </div>
</div>

<!-- Floating message container -->
<div id="floatingMsg" class="floating-msg"></div>

<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-app.js";
import { getAuth, signOut } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-auth.js";
import { getDatabase, ref, push, serverTimestamp } from "https://www.gstatic.com/firebasejs/9.1.0/firebase-database.js";

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

// Initialize Firebase app
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const database = getDatabase(app);

// Get cookie value
function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Delete cookie
function deleteCookie(name) {
    document.cookie = name + '=; Max-Age=-99999999;';
}

// Display floating message
function showFloatingMessage(message) {
    const messageBox = document.getElementById('floatingMsg');
    if (messageBox) {
        messageBox.innerText = message;
        messageBox.style.display = 'block';
        setTimeout(() => {
            messageBox.style.display = 'none';
        }, 5000);
    } else {
        console.error('Floating message element not found.');
    }
}

// Get the current timestamp in the Philippines' timezone
function getPhilippineTime() {
    return new Date().toLocaleString('en-PH', { timeZone: 'Asia/Manila' });
}

// Update current date and time every second
function updateDateTime() {
    const now = getPhilippineTime();
    document.getElementById('currentDateTime').textContent = now;
}

// On page load, display email and role
document.addEventListener('DOMContentLoaded', () => {
    const userEmail = getCookie('email');
    if (userEmail) {
        document.getElementById('userEmail').textContent = `Welcome, ${userEmail}`;
    }
    updateDateTime();
    setInterval(updateDateTime, 1000);
});

// Logout button functionality
document.getElementById('logoutButton').addEventListener('click', async () => {
    const userEmail = getCookie('email');
    const userRole = getCookie('role');

    const logRef = ref(database, 'Logs');
    const philippineTime = getPhilippineTime();

    try {
        await push(logRef, {
            action: 'logout',
            user: userEmail,
            role: userRole,
            timestamp: philippineTime
        });

        await signOut(auth);

        deleteCookie('email');
        deleteCookie('role');

        showFloatingMessage('You have logged out successfully.');
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 2500);
    } catch (error) {
        console.error('Error during logout:', error);
    }
});
</script>
