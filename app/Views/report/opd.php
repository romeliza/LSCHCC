<main id="main" class="main">
    <div class="pagetitle">
        <h1><?= $title ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>report">Report</a></li>
                <li class="breadcrumb-item active">Out Patient Department</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 ">List of Out Patient Department Patients</h4>
                            
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

                            <!-- Static Table -->
                            <div class="table-responsive mt-4">
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
        <?php foreach ($OPDData as $patient): ?>
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
        </div>
    </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const patients = <?= json_encode($OPDData) ?>;

    // Function to format dates
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const month = monthNames[date.getMonth()];
        const day = ('0' + date.getDate()).slice(-2);
        const year = date.getFullYear();
        return `${month} ${day}, ${year}`;
    }

    // Function to print the entire table
    function printTable() {
        let printContent = '<html><head><title>Print Table</title>';
        printContent += '<style>body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; line-height: 1.6; }';
        printContent += 'table { width: 100%; border-collapse: collapse; }';
        printContent += 'th, td { padding: 8px; border: 1px solid #ddd; text-align: left; font-size: 0.85rem; }';
        printContent += 'th { background-color: #f4f4f4; }</style></head><body>';
        printContent += `
          <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
            <img src="<?= base_url() ?>public/image/LSCHCC.png" alt="Company Logo" style="width: 100px; height: auto; margin-right: 10px;">
            <h2 style="margin: 0;">LAKE SEBU COMMUNITY HEALTH CARE COMPLEX</h2>
            </div>`;
        printContent += '<h1 style="text-align: center;">List of OPD Patients</h1>';
        printContent += '<table><thead><tr>';
        printContent += '<th>Patient Name</th><th>Occupation</th><th>Sex</th><th>Contact Number</th><th>Region</th><th>Province</th><th>Municipality</th><th>Barangay</th><th>Date Added</th></tr></thead><tbody>';

        patients.forEach(patient => {
            printContent += '<tr>';
            printContent += `<td>${patient.Lastname}, ${patient.Firstname}</td>`;
            printContent += `<td>${patient.Occupation}</td>`;
            printContent += `<td>${patient.Sex}</td>`;
            printContent += `<td>${patient.ContactNumber}</td>`;
            printContent += `<td>${patient.region}</td>`;
            printContent += `<td>${patient.province}</td>`;
            printContent += `<td>${patient.municipality}</td>`;
            printContent += `<td>${patient.barangay}</td>`;
            printContent += `<td>${formatDate(patient.created_at)}</td>`;
            printContent += '</tr>';
        });

        printContent += '</tbody></table></body></html>';

        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    // Function to print individual patient details
    function printRow(patientId) {
        const patient = patients.find(p => p.PatientID === patientId);
        if (!patient) return;

        let printContent = '<html><head><title>Print Patient Details</title>';
        printContent += '<style>body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; line-height: 1.6; }';
        printContent += 'table { width: 100%; border-collapse: collapse; }';
        printContent += 'th, td { padding: 8px; border: 1px solid #ddd; text-align: left; font-size: 0.85rem; }';
        printContent += 'th { background-color: #f4f4f4; }</style></head><body>';
        printContent += `
             <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
            <img src="<?= base_url() ?>public/image/LSCHCC.png" alt="Company Logo" style="width: 100px; height: auto; margin-right: 10px;">
            <h2 style="margin: 0;">LAKE SEBU COMMUNITY HEALTH CARE COMPLEX</h2>
            </div>`;
        printContent += `<h1 style="text-align: center;">Patient Details: ${patient.Lastname}, ${patient.Firstname}</h1>`;
        printContent += '<table><thead><tr><th>Field</th><th>Details</th></tr></thead><tbody>';
        printContent += `<tr><td>Patient Name</td><td>${patient.Lastname}, ${patient.Firstname}</td></tr>`;
        printContent += `<tr><td>Occupation</td><td>${patient.Occupation}</td></tr>`;
        printContent += `<tr><td>Sex</td><td>${patient.Sex}</td></tr>`;
        printContent += `<tr><td>Contact Number</td><td>${patient.ContactNumber}</td></tr>`;
        printContent += `<tr><td>Region</td><td>${patient.region}</td></tr>`;
        printContent += `<tr><td>Province</td><td>${patient.province}</td></tr>`;
        printContent += `<tr><td>Municipality</td><td>${patient.municipality}</td></tr>`;
        printContent += `<tr><td>Barangay</td><td>${patient.barangay}</td></tr>`;
        printContent += `<tr><td>Date Added</td><td>${formatDate(patient.created_at)}</td></tr>`;
        printContent += '</tbody></table></body></html>';

        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    // Event listener for print button for the entire table
    document.getElementById('print-button').addEventListener('click', printTable);

    // Event listeners for individual print buttons
    document.querySelectorAll('.print-row-btn').forEach(button => {
        button.addEventListener('click', function () {
            const patientId = this.getAttribute('data-patient-id');
            printRow(patientId);
        });
    });
   // Function to open a print window and close it on cancellation
   function openPrintWindow(title, content) {
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(createPrintContent(title, content));
        printWindow.document.close();
        printWindow.focus();

        // Wait for the print dialog and close the window
        printWindow.onafterprint = function () {
            printWindow.close();
        };

        // Trigger the print dialog
        printWindow.print();
    }

    // Event listener for print button for the entire table
    document.getElementById('print-button').addEventListener('click', printTable);

    // Event listeners for individual print buttons
    document.querySelectorAll('.print-row-btn').forEach(button => {
        button.addEventListener('click', function () {
            const patientId = this.getAttribute('data-patient-id');
            printRow(patientId);
        });
    });
});

</script>
