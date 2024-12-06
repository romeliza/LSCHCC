<main id="main" class="main">
    <!-- Page Title -->
    <div class="pagetitle">
        <h1><?= esc($title) ?></h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Medication Intake</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
            <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Medication Intake Details</h5>
                    <a href="<?= base_url('medicationIntake/add') ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Add Intake
                    </a>
                </div>
                    <div class="card-body mt-4">
                        <!-- Alerts -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <script>
                                setTimeout(() => {
                                    const successAlert = document.getElementById('successAlert');
                                    if (successAlert) {
                                        successAlert.style.opacity = '0';
                                        setTimeout(() => { successAlert.style.display = 'none'; }, 1000);
                                    }
                                }, 2000);
                            </script>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <script>
                                setTimeout(() => {
                                    const errorAlert = document.getElementById('errorAlert');
                                    if (errorAlert) {
                                        errorAlert.style.opacity = '0';
                                        setTimeout(() => { errorAlert.style.display = 'none'; }, 1000);
                                    }
                                }, 2000);
                            </script>
                        <?php endif; ?>
                        <?php
// Sort medication intakes by status: Started -> During -> Ended
usort($medicationIntakes, function($a, $b) {
    $statusOrder = ['Started' => 1, 'During' => 2, 'Ended' => 3];
    return $statusOrder[$a->MedicationStatus] <=> $statusOrder[$b->MedicationStatus];
});
?>

                        <!-- Table to display medication intake data -->
                        <table class="table table-hover table-bordered" id="MIMTable">
    <thead>
        <tr>
            <th class="text-center">Medication Name/s</th>.
            <th class="text-center">Patient Name</th>
            <th class="text-center">Physician Name</th>
            <th class="text-center">Date/s</th>
            <th class="text-center">Intake Time/s</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($medicationIntakes)): ?>
            <?php foreach ($medicationIntakes as $intake): ?>
                <tr>
                    <!-- Display Medications -->
                    <td class="text-center">
                        <?= esc($intake->Medications) ?>
                    </td>
                    
                    <!-- Display Patient Name -->
                    <td class="text-center">
                        <?= esc($intake->PatientFirstname) . ' ' . esc($intake->PatientLastname) ?>
                    </td>
                    <!-- Display Physician Name -->
                    <td class="text-center">
                        <?= esc($intake->PhysicianFirstname) . ' ' . esc($intake->PhysicianLastname) ?>
                    </td>
                    <!-- Display Intake Times -->
                         <!-- Table Row -->
                         <td class="text-center">
                                                <?php 
                                                $dates = explode(',', $intake->IntakeDates);
                                                if (strlen(implode(', ', $dates)) > 30): // Check if concatenated string exceeds 30 characters ?>
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#intakeDatesModal" data-dates="<?= esc(implode(',', $dates)) ?>">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                <?php else: 
                                                    $formattedDates = array_map(function($date) {
                                                        return (new DateTime($date))->format('M d, Y');
                                                    }, $dates);
                                                    echo implode(', ', $formattedDates); // Show values if not exceeding
                                                endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <?php if (strlen($intake->IntakeTimes) > 25): // Check if string length exceeds 5 ?>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#intakeTimesModal" data-times="<?= esc($intake->IntakeTimes) ?>">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                <?php else: 
                                                    echo esc($intake->IntakeTimes); // Show values if not exceeding
                                                endif; ?>
                                            </td>

                    <!-- Display Medication Status -->
                    <td class="text-center">
                        <?php if ($intake->MedicationStatus === 'Started'): ?>
                            <span class="badge bg-success"><?= esc($intake->MedicationStatus) ?></span>
                        <?php elseif ($intake->MedicationStatus === 'During'): ?>
                            <span class="badge bg-warning"><?= esc($intake->MedicationStatus) ?></span>
                        <?php elseif ($intake->MedicationStatus === 'Ended'): ?>
                            <span class="badge bg-danger"><?= esc($intake->MedicationStatus) ?></span>
                        <?php else: ?>
                            <span class="badge bg-secondary"><?= esc($intake->MedicationStatus) ?></span> <!-- Default for unexpected statuses -->
                        <?php endif; ?>
                    </td>

                    <!-- Action Buttons -->
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <!-- View Button (Trigger Modal) -->
                  <button class="btn btn-success btn-sm me-1"  
    data-bs-toggle="modal" data-bs-target="#viewMedicationModal"
    onclick="viewMedicationDetails(
        '<?= esc($intake->Medications) ?>', 
        '<?= esc($intake->PhysicianFirstname) . ' ' . esc($intake->PhysicianLastname) ?>', 
        '<?= esc($intake->PatientFirstname) . ' ' . esc($intake->PatientLastname) ?>', 
        '<?= esc($intake->IntakeTimes) ?>', 
        '<?= esc($intake->MedicationStatus) ?>', 
        '<?= esc($intake->Remarks) ?>', 
        '<?= esc($intake->MedicationIntakeID) ?>',  
        '<?= esc(implode(",", $intake->MedicationIDs)) ?>'
    )">
    <i class="bi bi-plus"></i>
</button>



                            
                            <!-- Edit Button -->
                            <a class="btn btn-primary btn-sm me-1" 
                               href="<?= base_url('medicationIntake/edit?id=' . md5($intake->MedicationIntakeID . "edit")); ?>">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">No medication intake records found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Modal for Viewing Medication Intake Details -->
<div class="modal fade" id="viewMedicationModal" tabindex="-1" aria-labelledby="viewMedicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewMedicationModalLabel">Medication Intake Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Table to display medication intake data -->
                <div class="table-responsive">
                    <form id="medicationForm" action="<?=site_url('medicationIntake/mark')?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" id="medicationIntakeID" name="medicationIntakeID">
                        <input type="hidden" id="selectedMedications" name="selectedMedications">
                        <input type="hidden" id="medicationStatus" name="medicationStatus">
                        <input type="hidden" id="remarks" name="remarks">

                        <table class="table table-hover table-bordered" id="MedicationIntakeTable">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" id="selectAllCheckbox" class="checkbox-lg" /> <!-- Select All Checkbox -->
                                    </th>
                                    <th class="text-center">Medication Name</th>
                                    <th class="text-center">Patient Name</th>
                                    <th class="text-center">Physician Name</th>
                                    <th class="text-center">Intake Time</th>
                                    <th class="text-center">Intake Status</th>
                                    <th class="text-center">Remarks</th>
                                </tr>
                            </thead>
                            <tbody id="medicationTableBody">
                                <!-- Medication rows will be populated here dynamically -->
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" form="medicationForm">Submit Status</button>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
function viewMedicationDetails(medicationNames, physicianName, patientName, intakeTimes, medicationStatus, remarks, medicationIntakeID, medicationIDs) {
    // Ensure medicationIDs is defined and is a valid string
    if (!medicationIDs || typeof medicationIDs !== 'string') {
        console.error('Invalid medicationIDs:', medicationIDs);
        return; // Exit the function early if medicationIDs is invalid
    }

    // Set the hidden input for MedicationIntakeID
    document.getElementById('medicationIntakeID').value = medicationIntakeID;

    // Clear any previous rows
    const medicationTableBody = document.getElementById('medicationTableBody');
    medicationTableBody.innerHTML = '';

    // Split medicationIDs into an array (only if valid)
    const medicationNamesArray = medicationNames.split(',');
    const remarksArray = remarks ? remarks.split(',') : []; // Handle remarks if provided
    const medicationIDsArray = medicationIDs.split(','); // Split medication IDs into an array

    medicationNamesArray.forEach(function (medication, index) {
        const row = document.createElement('tr');

        // Use the medication ID from the array for this row
        const medicationID = medicationIDsArray[index]; // This is the actual medication ID (e.g., 1, 2, ...)

        // Selection Checkbox
        const selectionCell = document.createElement('td');
        const selectionCheckbox = document.createElement('input');
        selectionCheckbox.type = 'checkbox';
        selectionCheckbox.classList.add('rowCheckbox', 'checkbox-lg'); // Add class for large checkbox
        selectionCheckbox.setAttribute('data-medication-id', medicationID); // Use the actual medication ID
        selectionCell.appendChild(selectionCheckbox);
        row.appendChild(selectionCell);

        // Medication Name
        const medicationCell = document.createElement('td');
        medicationCell.textContent = medication.trim(); // Remove extra spaces if any
        row.appendChild(medicationCell);

        // Patient Name
        const patientCell = document.createElement('td');
        patientCell.textContent = patientName;
        row.appendChild(patientCell);

        // Physician Name
        const physicianCell = document.createElement('td');
        physicianCell.textContent = physicianName;
        row.appendChild(physicianCell);

        // Intake Times
        const intakeTimesCell = document.createElement('td');
        intakeTimesCell.textContent = intakeTimes;
        row.appendChild(intakeTimesCell);

        // Status Dropdown
        const statusCell = document.createElement('td');
        const statusDropdown = document.createElement('select');
        statusDropdown.classList.add('form-select');
        statusDropdown.setAttribute('data-medication-id', medicationID); // Set actual medication ID
        const statuses = ['Yes', 'No']; // Dropdown options
        statuses.forEach(function (status) {
            const option = document.createElement('option');
            option.value = status;
            option.textContent = status;
            if (status === medicationStatus) {
                option.selected = true; // Select the current status
            }
            statusDropdown.appendChild(option);
        });
        statusCell.appendChild(statusDropdown);
        row.appendChild(statusCell);

        // Remarks Textarea
        const remarksCell = document.createElement('td');
        const remarksTextarea = document.createElement('textarea');
        remarksTextarea.classList.add('form-control');
        remarksTextarea.rows = 2;
        remarksTextarea.placeholder = 'Add remarks here...';
        remarksTextarea.setAttribute('data-medication-id', medicationID); // Set actual medication ID
        remarksTextarea.textContent = remarksArray[index] ? remarksArray[index].trim() : ''; // Populate with existing remark if available
        remarksCell.appendChild(remarksTextarea);
        row.appendChild(remarksCell);

        // Append the row to the table body
        medicationTableBody.appendChild(row);

        // Log the MedicationID on checkbox selection
        selectionCheckbox.addEventListener('change', function () {
            const selectedMedicationID = selectionCheckbox.getAttribute('data-medication-id');
            console.log('Selected MedicationID:', selectedMedicationID);
        });
    });

    // Handle Select All functionality
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const rowCheckboxes = document.querySelectorAll('.rowCheckbox');

    // Add event listener for "Select All"
    selectAllCheckbox.addEventListener('change', function () {
        const isChecked = selectAllCheckbox.checked;
        rowCheckboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });

    // Update "Select All" checkbox if all individual checkboxes are manually checked/unchecked
    rowCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (!this.checked) {
                selectAllCheckbox.checked = false; // Uncheck Select All if any checkbox is unchecked
            } else if (Array.from(rowCheckboxes).every(cb => cb.checked)) {
                selectAllCheckbox.checked = true; // Check Select All if all checkboxes are checked
            }
        });
    });
}


document.querySelector('form#medicationForm').addEventListener('submit', function(event) {
    // Collect selected medications
    const selectedMedications = [];
    const checkboxes = document.querySelectorAll('.rowCheckbox:checked');
    checkboxes.forEach(function(checkbox) {
        selectedMedications.push(checkbox.getAttribute('data-medication-id'));
    });

    // Check if any medication is selected
    if (selectedMedications.length === 0) {
        event.preventDefault(); // Prevent form submission
        alert('Please select at least one medication.');
        return;
    }

    // Update hidden input with selected medications
    document.getElementById('selectedMedications').value = selectedMedications.join(',');
    
    // Collect statuses and remarks for submission
    const statuses = [];
    const remarks = [];
    checkboxes.forEach(function(checkbox) {
        const medicationId = checkbox.getAttribute('data-medication-id');
        
        // Find the status and remarks for the selected medication
        const statusDropdown = document.querySelector(`select[data-medication-id="${medicationId}"]`);
        const remarksTextarea = document.querySelector(`textarea[data-medication-id="${medicationId}"]`);
        
        statuses.push(statusDropdown.value); // Get status
        remarks.push(remarksTextarea.value); // Get remarks
    });
    
    // Update hidden inputs for statuses and remarks
    document.getElementById('medicationStatus').value = statuses.join(',');
    document.getElementById('remarks').value = remarks.join(',');
});

</script>

<!-- Modal for Intake Dates -->
<div class="modal fade" id="intakeDatesModal" tabindex="-1" aria-labelledby="intakeDatesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="intakeDatesModalLabel">All Intake Dates</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="intakeDatesContent"></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Intake Times -->
<div class="modal fade" id="intakeTimesModal" tabindex="-1" aria-labelledby="intakeTimesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="intakeTimesModalLabel">All Intake Times</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="intakeTimesContent"></p>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to fill the modals dynamically -->
<script>
    // Script to handle modal content for Intake Dates
    document.getElementById('intakeDatesModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var dates = button.getAttribute('data-dates'); // Get the dates from data-* attribute
        var modalBody = document.getElementById('intakeDatesContent');
        modalBody.textContent = dates; // Insert dates into modal content
    });

    // Script to handle modal content for Intake Times
    document.getElementById('intakeTimesModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var times = button.getAttribute('data-times'); // Get the times from data-* attribute
        var modalBody = document.getElementById('intakeTimesContent');
        modalBody.textContent = times; // Insert times into modal content
    });
</script>

