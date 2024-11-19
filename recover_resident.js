function recoverResident(residentId) {
    // Show confirmation dialog
    const confirmation = document.createElement('div');
    confirmation.innerHTML = `
        <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center max-w-sm w-full">
                <h3 class="text-lg font-semibold mb-4">Are you sure you want to recover this resident?</h3>
                <div class="flex justify-center space-x-4">
                    <button id="confirmYes" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Yes</button>
                    <button id="confirmNo" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">No</button>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(confirmation);

    // Set up the "Yes" button to confirm the recovery action
    document.getElementById('confirmYes').onclick = () => {
        const archivedRef = firebase.database().ref('Archived_Resident/' + residentId);
        const residentsRef = firebase.database().ref('Residents/' + residentId);

        // Capture current date and time in Philippine Time (en-PH format)
        const now = new Date();
        const formattedDate = new Date(now.toLocaleString("en-PH", { timeZone: "Asia/Manila" }))
            .toLocaleString('en-PH', { 
                timeZone: 'Asia/Manila', 
                hour12: true, 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit', 
                year: 'numeric', 
                month: '2-digit', 
                day: '2-digit' 
            });

        // Retrieve the logged-in user's email and role (stored in cookies)
        const email = getCookie('email');  
        const role = getCookie('role');    

        console.log(`Starting to recover resident with ID: ${residentId}`);

        // Retrieve the resident data from Archived_Resident table
        archivedRef.once('value').then(snapshot => {
            const residentData = snapshot.val();

            if (residentData) {
                console.log(`Resident data found for ID: ${residentId}`, residentData);

                // Add recovery timestamp, email, and role to resident data
                residentData.recovered_at = formattedDate;
                residentData.recovered_by = email;
                residentData.recovered_role = role;

                // Move data back to Residents table
                residentsRef.set(residentData).then(() => {
                    console.log(`Successfully moved resident data to Residents for ID: ${residentId}`);

                    // After moving the data, remove it from the Archived_Resident table
                    archivedRef.remove().then(() => {
                        // Log the recovery action
                        const logRef = firebase.database().ref('Logs'); // Assuming 'Logs' node exists
                        logRef.push({
                            action: 'recover',
                            residentId: residentId,
                            recoveredBy: email,
                            role: role,
                            recoveredAt: formattedDate
                        }).then(() => {
                            showFloatingMessage('Resident recovered successfully.');
                            console.log(`Successfully removed resident from Archived_Resident for ID: ${residentId}`);
                            window.location.reload();
                        }).catch(error => {
                            console.error('Error logging the action:', error);
                            alert('Failed to log the recovery action.');
                        });
                    }).catch(error => {
                        console.error('Error removing resident from Archived_Resident table:', error);
                        alert('Failed to remove resident from the Archived_Resident table.');
                    });
                }).catch(error => {
                    console.error('Error recovering resident to Residents table:', error);
                    alert('Failed to recover resident.');
                });
            } else {
                alert('Resident not found.');
                console.log(`Resident with ID: ${residentId} not found.`);
            }
        }).catch(error => {
            console.error('Error retrieving resident data:', error);
            alert('Failed to retrieve resident data.');
        });

        // Remove the confirmation dialog
        document.body.removeChild(confirmation);
    };

    // Set up the "No" button to cancel the action and close the dialog
    document.getElementById('confirmNo').onclick = () => {
        document.body.removeChild(confirmation);
    };
}

// Function to display a floating success message
function showFloatingMessage(message) {
    const messageDiv = document.createElement('div');
    messageDiv.innerText = message;
    messageDiv.className = 'fixed top-10 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-2 px-4 rounded shadow-lg z-50';
    document.body.appendChild(messageDiv);

    // Remove the message after 5 seconds
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}

// Helper function to get the value of a cookie
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
