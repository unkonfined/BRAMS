<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script> <!-- Include SheetJS for Excel export -->
    <script src="firebase-resident.js"></script> <!-- Your Firebase config file -->
    <script src="archive_resident.js"></script>
</head>

<body class="bg-gray-100">
    <?php include 'Includes/header.php'; ?>
    <?php include 'Includes/admin-navbar.php'; ?>
    
    <div id="activity-logs" class="tab-content container mx-auto flex items-center justify-center h-screen px-8 py-6 max-w-2xl my-8 bg-white rounded-lg shadow-md">
        <div class="inner-container p-6 bg-gray-50 rounded-lg shadow-lg mb-4">
            <h2 class="text-2xl font-bold">Activity Logs</h2>
            <p>Your activity log content goes here.</p>
        </div>
        <div class="inner-container p-6">
            <!-- Additional content can be added here -->
        </div>
    </div>

    <?php include 'Includes/footer.php'; ?>
    
</body>
</html>