<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="printable.css"> <!-- Link to external CSS file -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="printable.js"></script> <!-- Link to external JS file -->
</head>
<body>

    <?php
    // Function to add the ordinal suffix to a day
    function getOrdinalSuffix($day) {
        if (!in_array(($day % 100), [11, 12, 13])) {
            switch ($day % 10) {
                case 1: return 'st';
                case 2: return 'nd';
                case 3: return 'rd';
            }
        }
        return 'th';
    }

    $day = date('j');
    $suffix = getOrdinalSuffix($day);
    $month = date('F');
    $year = date('Y');
    $dateOfIssuance = "{$day}{$suffix} of {$month} {$year}";

    // Retrieve the official receipt number, purpose, resident_id, and document type from the GET request
    $or_number = isset($_GET['or_number']) ? htmlspecialchars($_GET['or_number']) : '________________________';
    $purpose = isset($_GET['purpose']) ? htmlspecialchars($_GET['purpose']) : '________________________';
    $resident_id = isset($_GET['resident_id']) ? htmlspecialchars($_GET['resident_id']) : '1';
    $document_type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : 'clearance'; // Default to clearance if no type is provided

    $name = "________________________";
    $age = "____";
    $civilStatus = "________________";
    $gender = "______";
    $birthDate = "________________";
    $birthPlace = "________________";
    ?>

    <!-- Hidden inputs to pass data to JavaScript -->
    <input type="hidden" id="residentId" value="<?php echo $resident_id; ?>">
    <input type="hidden" id="documentType" value="<?php echo $document_type; ?>">

    <div class="logo">
        <img class="left-logo" src="barangay8logo.png" alt="Left Logo">
        <div class="logo-text">
            <h5>Republic of the Philippines</h5>
            <h4><strong>OFFICE OF THE SANGGUNIANG BARANGAY</strong></h4>
            <h5>South Capitol Road, Ayala Malls Capitol Central</h5>
            <h5>Barangay 8, Bacolod City</h5>
            <h5>Cell No. 0919-560-5949/0995-073-6808</h5>
            <br>
        </div>
    </div>

    <div class="clearfix centered-logo-wrapper">
        <!-- Officers Content -->
        <div class="officers content">
            <br><br>
            <strong>HON. EVELYN F. DONESA</strong><br>
            Punong Barangay<br><br><br>
            
            <strong>KAGAWAD</strong><br><br>
            <strong>HON. JIMMY D. MARANON</strong><br>
            Chairman Committee on<br>
            Appropriation Disaster & Rescue<br><br><br>
            
            <strong>HON. CRISTY P. BAUTISTA</strong><br>
            Chairman Committee on<br>
            Social Services/Women and Family<br><br><br>
            
            <strong>HON. JOHNRY V. MALONGAYON</strong><br>
            Chairman Committee on<br>
            Health & Sanitation / Environmental<br>
            Protection & Natural Resources<br><br><br>
            
            <strong>HON. HELEN S. MAMOM</strong><br>
            Chairman Committee on<br>
            Education Laws and Ordinances<br><br><br>
            
            <strong>HON. NOMER S. EDRAMA SR.</strong><br>
            Chairman Committee on<br>
            Market & Livelihood/Tourism Development<br><br><br>
            
            <strong>JAYCO FRANCISCO L. DOCTORA</strong><br>
            Chairman Committee on<br>
            Barangay Affair/ Ways & Means/ Infrastructure<br><br><br>
            
            <strong>JOENITO Q. TALEON</strong><br>
            Chairman Committee on<br>
            Peace & Order / Human Rights<br><br><br>
            
            <strong>JOEKAILLAH A. TALEON</strong><br>
            Sk Chairman / Committee on<br>
            Youth & Sports Development<br><br><br>
            
            <strong>DARYLL LYN O. TOLOSA</strong><br>
            Barangay Secretary<br><br><br>
            
            <strong>JAMES G. TORRES</strong><br>
            Barangay Treasurer<br><br>
        </div>

        <!-- Dynamic Summary Section -->
        <div class="summary content">
            <br><br><br>
            <?php
            if ($document_type == 'clearance') {
                echo "
                <h2 class='barangay-title'><strong>BARANGAY CLEARANCE</strong></h2><br><br><br>
                <p>
                    TO WHOM IT MAY CONCERN:<br><br><br>
                    This is to CERTIFY that <strong id='residentName'>{$name}</strong>, 
                    <strong id='age'>{$age}</strong> years old, 
                    <strong id='civilStatus'>{$civilStatus}</strong>, 
                    <strong id='gender'>{$gender}</strong>, born on 
                    <strong id='birthDate'>{$birthDate}</strong> at <strong id='birthPlace'>{$birthPlace}</strong>, 
                    is a bonafide resident of Barangay 8, Bacolod City.<br><br>
                    This certification is issued upon the request of the above-named person for 
                    <strong>{$purpose}</strong> and for whatever lawful purpose/s it may serve best.<br><br>
                    Issued this <strong>{$dateOfIssuance}</strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br><br>
                    <strong>HON. EVELYN F. DONESA</strong><br>
                    Punong Barangay<br><br><br><br><br>
                </p>";
            } elseif ($document_type == 'residency') {
                echo "
                <h2 class='barangay-title'><strong>CERTIFICATE OF RESIDENCY</strong></h2><br><br><br>
                <p>
                    TO WHOM IT MAY CONCERN:<br><br><br>
                    This is to CERTIFY that <strong id='residentName'>{$name}</strong>, 
                    <strong id='age'>{$age}</strong> years old, 
                    <strong id='civilStatus'>{$civilStatus}</strong>, 
                    <strong id='gender'>{$gender}</strong>, born on 
                    <strong id='birthDate'>{$birthDate}</strong>, 
                    is a resident of Barangay 8, Bacolod City whose means of livelihood is barely<br><br>
                    This certification is issued upon the request of the above-named person for 
                    <strong>{$purpose}</strong> and for whatever lawful purpose/s it may serve best.<br><br>
                    Issued this <strong>{$dateOfIssuance}</strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br><br>
                    <strong>HON. EVELYN F. DONESA</strong><br>
                    Punong Barangay<br><br><br><br><br>
                </p>";
            } elseif ($document_type == 'indigency') {
                echo "
                <h2 class='barangay-title'><strong>CERTIFICATE OF INDIGENCY</strong></h2><br><br><br>
                <p>
                    TO WHOM IT MAY CONCERN:<br><br><br>
                    This is to CERTIFY that <strong id='residentName'>{$name}</strong>, is a 
                    resident of Barangay 8, Bacolod City whose means of livelihood is barely 
                    enough to support the daily needs of their family and is therefore considered indigent.<br><br>
                    This certification is issued upon the request of the above-named person for 
                    <strong>{$purpose}</strong> and for whatever lawful purpose/s it may serve best.<br><br>
                    Issued this <strong>{$dateOfIssuance}</strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br><br>
                    <strong>HON. EVELYN F. DONESA</strong><br>
                    Punong Barangay<br><br><br><br><br>
                </p>";
            } elseif ($document_type == 'certification') {
                echo "
                <h2 class='barangay-title'><strong>CERTIFICATION</strong></h2><br><br><br>
                <p>
                    TO WHOM IT MAY CONCERN:<br><br><br>
                    This is to CERTIFY that <strong id='residentName'>{$name}</strong>, 
                    <strong id='age'>{$age}</strong> years old, 
                    <strong id='civilStatus'>{$civilStatus}</strong>, 
                    <strong id='gender'>{$gender}</strong>, born on 
                    <strong id='birthDate'>{$birthDate}</strong>,  
                    is a resident of Barangay 8, Bacolod City whose means of livelihood is barely 
                    enough to support the daily needs of their family and is therefore considered indigent.<br><br>
                    This certification is issued upon the request of the above-named person for 
                    <strong>{$purpose}</strong> and for whatever lawful purpose/s it may serve best.<br><br>
                    Issued this <strong>{$dateOfIssuance}</strong> at Barangay 8, Bacolod City, Philippines.<br><br><br><br><br>
                    <strong>HON. EVELYN F. DONESA</strong><br>
                    Punong Barangay<br><br><br><br><br>
                </p>";
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div>
            <span>Official Receipt No.: <strong><?php echo $or_number; ?></strong></span>
        </div>
    </footer>

    <!-- Optional Bootstrap JS and jQuery for dynamic behavior -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
