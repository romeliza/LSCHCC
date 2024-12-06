<main id="main" class="main">
    <div class="pagetitle">
        <h1>Medication Intake Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>report">Report</a></li>
                <li class="breadcrumb-item active">Medication Intake</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">List of Medication Intakes</h4>

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
                            <div id="medication-table" class="table-responsive mt-4"></div> <!-- Container for Grid.js -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
    /* Smaller font for the page */
    .small-font {
        font-size: 0.85rem;
    }

    /* Smaller font for table */
    .gridjs-table {
        font-size: 0.85rem;
    }

    /* Adjusting padding and font size for the table header */
    .gridjs-th {
        font-size: 0.85rem;
        padding: 8px;
    }

    /* Adjusting padding and font size for table cells */
    .gridjs-td {
        font-size: 0.85rem;
        padding: 8px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Use the correctly passed variable (ensure it's correctly encoded in PHP)
    const rowData = <?= json_encode($completedMedicationIntakeData); ?>;

    // Check if rowData is an array and contains data
    if (!Array.isArray(rowData) || rowData.length === 0) {
        console.error('rowData is not an array or is empty.', rowData);
        return;
    }

    // Map data into Grid.js format with relevant fields for medication status
    let gridData = rowData.map(status => [
        status.PatientName,               // Patient Name
        status.MedicationName,            // Medication Name
        status.Remark,                    // Medication Status or Remark
        status.Date,                      // Status Date
        status.Time,                      // Separate Time
        formatDate(status.created_at),    // Created At
    ]);

    // Function to initialize Grid.js with configurable data limit
    function initializeGrid(data, limit) {
        return new gridjs.Grid({
            columns: ['Patient Name', 'Medication Name', 'Remark/Status', 'Status Date', 'Time', 'Created At'], // Added Created At as a new column
            data: data,
            sort: true,
            search: true,
            pagination: limit === 'all' ? false : { limit: limit },
            height: '100%',
            language: { search: { placeholder: 'Search...' } }
        }).render(document.getElementById('medication-table'));
    }

    // Initialize with default 10 entries per page
    let grid = initializeGrid(gridData, 10);

    // Event listener for "Show Entries" dropdown change
    const entriesPerPageElement = document.getElementById('entriesPerPage');
    if (entriesPerPageElement) {
        entriesPerPageElement.addEventListener('change', function (e) {
            const selectedValue = e.target.value;
            const limit = selectedValue === 'all' ? 'all' : parseInt(selectedValue, 10);

            // Destroy the existing Grid.js instance and reinitialize with the new limit
            grid.destroy();
            grid = initializeGrid(gridData, limit);
        });
    } else {
        console.error('Element #entriesPerPage not found!');
    }

    // Initialize flatpickr date pickers only if the elements are present
    const dateFromElement = document.getElementById('dateFrom');
    const dateToElement = document.getElementById('dateTo');
    if (dateFromElement && dateToElement) {
        flatpickr("#dateFrom", { dateFormat: "Y-m-d", onChange: filterData });
        flatpickr("#dateTo", { dateFormat: "Y-m-d", onChange: filterData });
    } else {
        console.error('Date pickers not found!');
    }

    // Filter data based on date range (optional)
    function filterData() {
        const dateFrom = document.getElementById('dateFrom').value;
        const dateTo = document.getElementById('dateTo').value;
        const filteredData = rowData.filter(status => {
            const statusDate = status.Date; // Use Status Date directly
            if (dateFrom && statusDate < dateFrom) return false;
            if (dateTo && statusDate > dateTo) return false;
            return true;
        }).map(status => [
            status.PatientName,               // Patient Name
            status.MedicationName,            // Medication Name
            status.Remark,                    // Remark/Status
            status.Date,                      // Status Date
            status.Time,                      // Separate Time
            formatDate(status.created_at),    // Created At (separate)
        ]);

        grid.updateConfig({ data: filteredData }).forceRender();
    }

    // Format the date into a more readable format
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const month = monthNames[date.getMonth()];
        const day = ('0' + date.getDate()).slice(-2);
        const year = date.getFullYear();
        return `${month} ${day}, ${year}`;
    }

    // Print the table data
    function printTable() {
        let printContent = '<html><head><title>Print Table</title>';
        printContent += '<style>body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; line-height: 1.6; }';
        printContent += 'table { width: 100%; border-collapse: collapse; }';
        printContent += 'th, td { padding: 8px; border: 1px solid #ddd; text-align: left; font-size: 0.85rem; }';
        printContent += 'th { background-color: #f4f4f4; }</style></head><body>';
        printContent += '<h1>List of Medication Status</h1><table><thead><tr>';
        printContent += '<th>Patient Name</th><th>Medication Name</th><th>Remark/Status</th><th>Status Date</th><th>Time</th><th>Created At</th></tr></thead><tbody>';

        gridData.forEach(row => {
            printContent += '<tr>';
            row.forEach(cell => {
                printContent += `<td>${cell}</td>`;
            });
            printContent += '</tr>';
        });

        printContent += '</tbody></table></body></html>';

        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write(printContent);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    // Event listener for print button
    const printButton = document.getElementById('print-button');
    if (printButton) {
        printButton.addEventListener('click', printTable);
    } else {
        console.error('Print button #print-button not found!');
    }
});
</script>
