<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Official Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <style>
        /* Main Container Styling */
        .main-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        /* Form Container Styling */
        #editForm {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Section Container Styling */
        .form-section {
            background-color: #f8fafc;
            padding: 16px;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Label Styling */
        label {
            font-weight: 600;
            color: #374151;
        }

        /* Input and Select Styling */
        .input-text, .input-select {
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            width: 100%;
            transition: border-color 0.3s;
        }

        .input-text:focus, .input-select:focus {
            border-color: #10b981;
            outline: none;
            box-shadow: 0 0 4px rgba(16, 185, 129, 0.4);
        }

        /* Button Styling */
        .btn-submit {
            background-color: #10b981;
            color: #ffffff;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #059669;
        }

        /* Title Styling */
        h2, h3 {
            color: #1f2937;
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header and Navbar -->
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/admin-navbar.php'; ?>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Page Title and Description -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-2xl font-bold text-center">Barangay Official Edit</h2>
            <p class="text-center text-gray-600">Fill in the details of the Barangay officials below.</p>
        </div>

        <!-- Form Wrapper -->
        <div class="form-wrapper">
            <!-- Form -->
            <form id="editForm" class="space-y-6">
                <!-- Dynamic Form Sections -->
                <div id="form-sections" class="space-y-6"></div>

                <div class="text-center">
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
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
        const app = firebase.initializeApp(firebaseConfig);
        const database = firebase.database();

        // List of positions (titles)
        const positions = [
            "Punong Barangay",
            "Chairman Committee on Appropriation Disaster & Rescue",
            "Chairman Committee on Social Services/Women and Family",
            "Chairman Committee on Health & Sanitation / Environmental Protection & Natural Resources",
            "Chairman Committee on Education Laws and Ordinances",
            "Chairman Committee on Market & Livelihood/Tourism Development",
            "Chairman Committee on Barangay Affair/ Ways & Means/ Infrastructure",
            "Chairman Committee on Peace & Order / Human Rights",
            "SK Chairman / Committee on Youth & Sports Development",
            "Barangay Secretary",
            "Barangay Treasurer"
        ];

        const formContainer = document.getElementById("form-sections");

        // Create a template for form sections
        const createSectionTemplate = (title) => {
            return `
                <div class="form-section">
                    <h3>${title}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label>First Name *</label>
                            <input type="text" class="input-text mt-1" required>
                        </div>
                        <div>
                            <label>Middle Initial *</label>
                            <input type="text" class="input-text mt-1" required>
                        </div>
                        <div>
                            <label>Last Name *</label>
                            <input type="text" class="input-text mt-1" required>
                        </div>
                        <div>
                            <label>Suffix (Optional)</label>
                            <select class="input-select mt-1">
                                <option value="">Select</option>
                                <option value="Jr.">Jr.</option>
                                <option value="Sr.">Sr.</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;
        };

        // Render form sections dynamically based on the positions array
        positions.forEach(position => {
            formContainer.innerHTML += createSectionTemplate(position);
        });

        // Handle form submission
        document.getElementById("editForm").addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            // Collect data from all the input fields
            const formData = [];
            const inputs = document.querySelectorAll(".input-text, .input-select");

            // Loop through the inputs and check the required fields
            let valid = true;
            inputs.forEach(input => {
                if (input.required && input.value === "") {
                    valid = false;
                }
                formData.push(input.value); // Add input value to the form data array
            });

            // If there are invalid fields, show an alert
            if (!valid) {
                alert("Please fill in all required fields.");
                return;
            }

            // Insert data into Firebase for each position section
            positions.forEach((position, index) => {
                const officialRef = database.ref('BrgyOfficials').push();
                const officialId = officialRef.key;

                officialRef.set({
                    position: position,
                    first_name: formData[index * 4], // First Name
                    middle_initial: formData[index * 4 + 1], // Middle Initial
                    last_name: formData[index * 4 + 2], // Last Name
                    suffix: formData[index * 4 + 3] || null // Suffix is optional, will be null if not selected
                }).then(() => {
                    console.log(`Barangay Official data for ${position} saved successfully!`);
                }).catch((error) => {
                    console.error("Error inserting data:", error);
                    alert("There was an error saving the data. Please try again.");
                });
            });

            alert("All Barangay Official data saved successfully!");
            document.getElementById("editForm").reset(); // Optionally reset the form after submission
        });
    </script>

    <?php include 'Includes/footer.php'; ?>

</body>

</html>
