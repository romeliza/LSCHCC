<main id="main" class="main">
    <div class="pagetitle">
        <h1>Discharged Patients</h1> <!-- Changed title to Discharged Patients -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>report">Report</a></li>
                <li class="breadcrumb-item active">Discharged Patients</li> <!-- Changed breadcrumb to Discharged Patients -->
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 ">Discharged Patients</h4> <!-- Changed to Discharged Patients -->
                            
                            <!-- Date Filters and Entries Selection -->
                            <div class="d-flex flex-wrap align-items-center">
                                <!-- Date Filter Inputs -->
                                <div class="me-3">
                                    <label for="dateFrom" class="form-label mb-1 small-font">Date From:</label>
                                    <input type="text" id="dateFrom" class="form-control form-control-sm" placeholder="YYYY-MM-DD">
                                </div>
                                
                                <div class="me-3">
                                    <label for="dateTo" class="form-label mb-1 small-font">Date To:</label>
                                    <input type="text" id="dateTo" class="form-control form-control-sm" placeholder="YYYY-MM-DD">
                                </div>

                                <!-- Entries Selection -->
                                <div class="me-3">
                                    <label for="entriesPerPage" class="form-label mb-1 small-font">Show Entries:</label>
                                    <select id="entriesPerPage" class="form-select form-select-sm">
                                        <option value="5">5</option>
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>

                                <!-- Print Button -->
                                <button id="print-button" class="btn btn-sm btn-success ms-auto mt-4 small-font">Print</button>
                            </div>
                        </div>

                        <div class="card-body pt-3 small-font">
                            <!-- Flash messages for success or error -->
                            <?php if (session()->getFlashdata('success')): ?>
                                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('error'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Grid.js table container -->
                            <table class="table table-bordered">
    <thead>
        <tr>
            <th>Patient Name</th>
            <th>Occupation</th>
            <th>Sex</th>
            <th>Contact Number</th>
            <th>Location</th>
            <th>Date Added</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($DischargedData as $patient): ?>
            <tr>
                <td><?= $patient->Lastname . ', ' . $patient->Firstname ?></td>
                <td><?= $patient->Occupation ?></td>
                <td><?= $patient->Sex ?></td>
                <td><?= $patient->ContactNumber ?></td>
                <td><?= $patient->region . ', ' . $patient->province . ', ' . $patient->municipality . ', ' . $patient->barangay ?></td>
                <td><?= (new DateTime($patient->created_at))->format('F d, Y') ?></td>
                <td>
                    <button class="btn btn-sm btn-info print-row-btn" data-patient-id="<?= $patient->PatientID ?>">Print</button>
                </td>
            </tr>
           
        <?php endforeach; ?>
    </tbody>
</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const patients = <?= json_encode($DischargedData) ?>;

    // Format date helper function
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const month = monthNames[date.getMonth()];
        const day = ('0' + date.getDate()).slice(-2);
        const year = date.getFullYear();
        return `${month} ${day}, ${year}`;
    }

    // Print individual patient details
    function printRow(patientId) {
        const patient = patients.find(p => p.PatientID === patientId);
        if (!patient) return;
 // Format the 'updated_at' field
 const updatedAt = new Date(patient.updated_at);
        const formattedDate = updatedAt.toLocaleString('en-US', {
            weekday: 'long', // "Monday"
            year: 'numeric', // "2024"
            month: 'long', // "December"
            day: 'numeric', // "3"
            hour: 'numeric', // "12"
            minute: 'numeric', // "30"
            second: 'numeric', // "45"
            hour12: true // 12-hour clock (AM/PM)
        });
        let printContent = '<html><head><title>Print Patient Details</title>';
        printContent += `
            <style>
                @media print {
                    img { display: block !important; max-width: 100%; height: auto; }
                }
                body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; line-height: 1.6; }
                table { width: 100%; border-collapse: collapse; }
                th, td { padding: 8px; border: 1px solid #ddd; text-align: left; font-size: 0.85rem; }
                th { background-color: #f4f4f4; }
                .header { text-align: center; margin-bottom: 20px; }
                .header img { width: 100px; height: auto; margin-right: 10px; vertical-align: middle; }
                .header h2 { display: inline; margin: 0; vertical-align: middle; }
            </style>
        </head><body>`;

        // Add header with company logo
        printContent += ` 
    <div class="header" style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
        <img src="<?= base_url() ?>public/image/LSCHCC.png" alt="Company Logo" style="width: 100px; height: auto; margin-right: 10px;">
        <h2 style="margin: 0;">LAKE SEBU COMMUNITY HEALTH CARE COMPLEX</h2>
    </div>`;


        // Add patient details
        printContent += `<h1>Patient Details: ${patient.Lastname}, ${patient.Firstname}</h1><table><thead><tr>`;
        printContent += '<th>Field</th><th>Details</th></tr></thead><tbody>';
        printContent += `<tr><td>Patient Name</td><td>${patient.Lastname}, ${patient.Firstname}</td></tr>`;
        printContent += `<tr><td>Occupation</td><td>${patient.Occupation}</td></tr>`;
        printContent += `<tr><td>Sex</td><td>${patient.Sex}</td></tr>`;
        printContent += `<tr><td>Contact Number</td><td>${patient.ContactNumber}</td></tr>`;
        printContent += `<tr><td>Region</td><td>${patient.region}</td></tr>`;
        printContent += `<tr><td>Province</td><td>${patient.province}</td></tr>`;
        printContent += `<tr><td>Municipality</td><td>${patient.municipality}</td></tr>`;
        printContent += `<tr><td>Barangay</td><td>${patient.barangay}</td></tr>`;
        printContent += `<tr><td>Date Added</td><td>${formatDate(patient.created_at)}</td></tr>`;        
        printContent += `<tr><td>Headof Family</td><td>${patient.HeadofFamily}</td></tr>`;
        printContent += `<tr><td>Adult History</td><td>${patient.AdultHistory}</td></tr>`;
        printContent += `<tr><td>Pediatric History</td><td>${patient.PediatricHistory}</td></tr>`;
        printContent += `<tr><td>Chief Complaint</td><td>${patient.ChiefComplaint}</td></tr>`;
        printContent += `<tr><td>Initial Diagnosis</td><td>${patient.InitialDiagnosis}</td></tr>`;
        printContent += `<tr><td>Treatment</td><td>${patient.Treatment}</td></tr>`;
        printContent += `<tr><td>Blood Pressure (Bp)</td><td>${patient.Bp}</td></tr>`;
        printContent += `<tr><td>Temperature (T)</td><td>${patient.T}</td></tr>`;
        printContent += `<tr><td>Pulse Rate (CR)</td><td>${patient.CR}</td></tr>`;
        printContent += `<tr><td>Respiratory Rate (RR)</td><td>${patient.RR}</td></tr>`;
        printContent += `<tr><td>Oxygen Saturation (O2Sat)</td><td>${patient.O2Sat}</td></tr>`;
        printContent += `<tr><td>Weight (Wt)</td><td>${patient.Wt}</td></tr>`;
        printContent += `<tr><td>Height (Ht)</td><td>${patient.Ht}</td></tr>`;
        printContent += `<tr><td>Medication</td><td>${patient.Medication}</td></tr>`;
        printContent += `<tr><td>Laboratory Findings</td><td>${patient.LaboratoryFindings}</td></tr>`;
        printContent += `<tr><td>Final Diagnosis</td><td>${patient.FinalDiagnosis}</td></tr>`;
        printContent += `<tr><td>Disposition</td><td>${patient.Disposition}</td></tr>`;
        printContent += `<tr><td>Admitted Date</td><td>${formattedDate}</td></tr>`;
        printContent += `<tr><td>Discharged Date</td><td>${formatDate(patient.DischargedDate)}</td></tr>`;

        printContent += '</tbody></table></body></html>';

        // Open a new window for printing and write the content
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    // Print all rows (patient table)
    function printTable() {
        let printContent = '<html><head><title>Print Patient Table</title>';
        printContent += `
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; line-height: 1.6; }
                table { width: 100%; border-collapse: collapse; }
                th, td { padding: 8px; border: 1px solid #ddd; text-align: left; font-size: 0.85rem; }
                th { background-color: #f4f4f4; }
                .header { text-align: center; margin-bottom: 20px; }
                .header img { width: 100px; height: auto; margin-right: 10px; vertical-align: middle; }
                .header h2 { display: inline; margin: 0; vertical-align: middle; }
            </style>
        </head><body>`;

        // Add header with company logo
        printContent += ` 
            <div class="header">
                <img src="<?= base_url() ?>public/image/LSCHCC.png" alt="Company Logo" style="width: 100px; height: auto; margin-right: 10px;">
                <h2>LAKE SEBU COMMUNITY HEALTH CARE COMPLEX</h2>
            </div>`;

        // Add table of patients
        printContent += '<h1 style="text-align: center;">Discharged Patients</h1>';
        printContent += '<table><thead><tr><th>Patient Name</th><th>Occupation</th><th>Sex</th><th>Contact Number</th><th>Location</th><th>Date Added</th><th>Action</th></tr></thead><tbody>';
        
        patients.forEach(patient => {
            printContent += `<tr>
                <td>${patient.Lastname}, ${patient.Firstname}</td>
                <td>${patient.Occupation}</td>
                <td>${patient.Sex}</td>
                <td>${patient.ContactNumber}</td>
                <td>${patient.region}, ${patient.province}, ${patient.municipality}, ${patient.barangay}</td>
                <td>${formatDate(patient.created_at)}</td>
             
            </tr>`;
        });

        printContent += '</tbody></table></body></html>';

        // Open a new window for printing and write the content
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    // Attach print event listeners to individual patient print buttons
    document.querySelectorAll('.print-row-btn').forEach(button => {
        button.addEventListener('click', function() {
            const patientId = this.getAttribute('data-patient-id');
            printRow(patientId);
        });
    });

    // Event listener for the print all table button
    document.getElementById('print-button').addEventListener('click', printTable);
});
</script>

