<main id="main" class="main">
    <div class="pagetitle">
        <h1>Discharged Summary</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>report">Report</a></li>
                <li class="breadcrumb-item active">Discharged Summary</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Discharged Summary</h4>
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
                            
                            <!-- Discharged Report Table -->
                            <div class="container mt-3">
                                <table class="table table-bordered" id="MIMTable">
                                    <thead>
                                        <tr>
                                            <th>Patient Name</th>
                                            <th>Laboratory Findings</th>
                                            <th>Chief Complaint</th>
                                            <th>Medication</th>
                                            <th>Discharged Date</th>
                                            <th>Final Diagnosis</th>
                                            <th>Disposition</th>
                                            <th>Date Admitted</th>
                                            <th>Action</th> <!-- Action Column for Print Button -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($DischargedData as $patient): ?>
                                            <tr id="patient-<?= $patient->PatientID ?>">
                                                <td><?= $patient->Lastname . ', ' . $patient->Firstname ?></td>
                                                <td><?= $patient->LaboratoryFindings ?></td>
                                                <td><?= $patient->ChiefComplaint ?></td>
                                                <td><?= $patient->Medication ?></td>
                                                <td><?= date('M d, Y', strtotime($patient->DischargedDate)) ?></td> <!-- Proper date formatting -->
                                                <td><?= $patient->FinalDiagnosis ?></td>
                                                <td><?= $patient->Disposition ?></td>
                                                <td><?= date('M d, Y', strtotime($patient->updated_at)) ?></td> <!-- Format for last updated -->
                                                <td>
                                                    <button class="btn btn-sm btn-success print-btn" data-id="<?= $patient->PatientID ?>" onclick="printPatientDetails(<?= $patient->PatientID ?>)">Print</button>
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
        </div>
    </section>
</main>
<!-- Custom Styles -->
<style>
    .small-font {
        font-size: 0.85rem;
    }

    /* Print button styling */
    .print-btn {
        font-size: 0.85rem;
        padding: 5px 10px;
    }

    /* Adjusting padding and font size for the table header */
    .gridjs-th, .gridjs-td {
        font-size: 0.85rem;
        padding: 8px;
    }
</style>
<script>
    function printPatientDetails(patientId) {
        // Get the patient's row by ID
        var patientRow = document.getElementById('patient-' + patientId);
        
        // Extract the details from the row
        var patientName = patientRow.cells[0].innerText;
        var labFindings = patientRow.cells[1].innerText;
        var chiefComplaint = patientRow.cells[2].innerText;
        var medication = patientRow.cells[3].innerText;
        var dischargedDate = patientRow.cells[4].innerText;
        var finalDiagnosis = patientRow.cells[5].innerText;
        var disposition = patientRow.cells[6].innerText;
        var dateAdmitted = patientRow.cells[7].innerText;
        
        // Create a new window for the print view
        var printWindow = window.open('', '', 'height=600, width=900');
        printWindow.document.write('<html><head><title>Patient Discharge Summary</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-family: Arial, sans-serif; margin: 20px; font-size: 14px; color: #333; }');
        printWindow.document.write('h2 { color: #5c5c5c; }');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }');
        printWindow.document.write('th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }');
        printWindow.document.write('th { background-color: #f4f4f4; font-weight: bold; }');
        printWindow.document.write('td { background-color: #f9f9f9; }');
        printWindow.document.write('.patient-details { margin-top: 30px; }');
        printWindow.document.write('button { font-size: 16px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; margin-top: 20px; }');
        printWindow.document.write('button:hover { background-color: #45a049; }');
        printWindow.document.write('@media print { body { font-size: 12px; } button { display: none; } }');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        
        printWindow.document.write('<h2>Discharge Summary for ' + patientName + '</h2>');
        
        // Table for discharge details
        printWindow.document.write('<table>');
        printWindow.document.write('<tr><th>Laboratory Findings</th><td>' + labFindings + '</td></tr>');
        printWindow.document.write('<tr><th>Chief Complaint</th><td>' + chiefComplaint + '</td></tr>');
        printWindow.document.write('<tr><th>Medication</th><td>' + medication + '</td></tr>');
        printWindow.document.write('<tr><th>Discharged Date</th><td>' + dischargedDate + '</td></tr>');
        printWindow.document.write('<tr><th>Final Diagnosis</th><td>' + finalDiagnosis + '</td></tr>');
        printWindow.document.write('<tr><th>Disposition</th><td>' + disposition + '</td></tr>');
        printWindow.document.write('<tr><th>Date Admitted</th><td>' + dateAdmitted + '</td></tr>');
        printWindow.document.write('</table>');
        
        // Print button for the user to trigger printing
        printWindow.document.write('<div class="patient-details">');
        printWindow.document.write('<button onclick="window.print();">Print Summary</button>');
        printWindow.document.write('</div>');
        
        printWindow.document.write('</body></html>');
        
        printWindow.document.close(); // Necessary for IE >= 10
    }
</script>

