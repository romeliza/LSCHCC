<main id="main" class="main">
  <div class="pagetitle">
    <h1>Add Medication Intake</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>medication_intake">Medication Intake</a></li>
        <li class="breadcrumb-item active">Add</li>
      </ol>
    </nav>
  </div>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Create Medication Intake</h5>
          </div>
          <div class="card-body mt-4">
            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <form action="<?= base_url() ?>medicationIntake/add" method="POST" novalidate>
              <?= csrf_field() ?>
        <!-- Patient ID -->
        <div class="mb-1">
                <label for="patientid" class="form-label">Patient</label>
                <select class="form-control <?= isset($validation) && $validation->getError('PatientID') ? 'is-invalid' : '' ?>" id="patientid" name="PatientID" required>
                  <option value="">Select Patient</option>
                  <?php foreach ($PatientData as $patient): ?>
                    <option value="<?= esc($patient->PatientID) ?>" <?= set_value('PatientID') == $patient->PatientID ? 'selected' : '' ?>>
                      <?= esc($patient->Firstname) . ' ' . esc($patient->Lastname) . ' - '.esc($patient->HostipalCaseNo) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php if (isset($validation) && $validation->getError('PatientID')): ?>
                  <div class="invalid-feedback"><?= $validation->getError('PatientID') ?></div>
                <?php endif; ?>
              </div>

              <!-- Medication ID -->
              <div class="mb-1">
                <label for="medicationid" class="form-label">Medication</label>
                <select class="form-control select2" name="MedicationID[]" multiple="multiple" id="medicationid" required>
    <option value="">Select Medication</option>
    <?php foreach ($MedicationData as $medication): ?>
        <option value="<?= esc($medication->MedicationID) ?>" <?= set_value('MedicationID[]') && in_array($medication->MedicationID, (array) set_value('MedicationID[]')) ? 'selected' : '' ?>>
            <?= esc($medication->MedicationName) . ' - '. esc($medication->Dosage) ?>
        </option>
    <?php endforeach; ?>
</select>

                <!-- Input for other medication -->
                <div id="medicationOtherInputContainer" class="mt-2" style="display:none;">
                  <input type="text" id="medicationOtherInput" class="form-control" placeholder="Please specify" />
                </div>

                <?php if (isset($validation) && $validation->getError('MedicationID')): ?>
                  <div class="invalid-feedback"><?= $validation->getError('MedicationID') ?></div>
                <?php endif; ?>
              </div>

      
              <!-- Intake Times -->
              <div class="mb-1">
                <label for="intaketimes" class="form-label">Intake Times</label>
                <select class="form-control select2" name="IntakeTimes[]" multiple="multiple" id="intakeTimesDropdown" required>
                  <?php
                    $timeSlots = [
                      '06:00 AM', '07:00 AM', '08:00 AM', '09:00 AM', '10:00 AM', 
                      '10:30 AM','11:00 AM','11:30 AM',
                      '12:00 PM', '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM', '05:00 PM',
                      '06:00 PM', '07:00 PM', '08:00 PM', '09:00 PM', '10:00 PM', '10:30 PM',
                      '11:00 PM', '11:30 PM', '12:00 AM', '12:30 AM', 
                    ];

                    // Get the selected times from the form input (make sure it's an array)
                    $selectedTimes = set_value('IntakeTimes[]') ? (array) set_value('IntakeTimes[]') : [];

                    foreach ($timeSlots as $timeSlot) {
                      // Check if the current timeSlot is in the selected times array
                      $selected = in_array($timeSlot, $selectedTimes) ? 'selected' : '';
                      echo '<option value="' . esc($timeSlot) . '" ' . $selected . '>' . esc($timeSlot) . '</option>';
                    }
                  ?>
                </select>
             

                <?php if (isset($validation) && $validation->getError('IntakeTimes')): ?>
                  <div class="invalid-feedback"><?= $validation->getError('IntakeTimes') ?></div>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="intakeDates" class="form-label">Date/s</label>
                <input type="text" id="IntakeDates" class="form-control <?= isset($validation) && $validation->getError('IntakeDates') ? 'is-invalid' : '' ?>" name="IntakeDates" value="<?= set_value('IntakeDates') ?>" placeholder="Select Dates">
                <?php if (isset($validation) && $validation->getError('IntakeDates')): ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('IntakeDates') ?>
                    </div>
                <?php endif; ?>
            </div>
              <!-- Buttons -->
              <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-success me-2">Save</button>
                <a href="<?= base_url() ?>medicationIntake" class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize Flatpickr for multiple date selection
    flatpickr("#IntakeDates", {
        mode: "multiple",
        minDate: "today",
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        // You can add other options here as needed
    });
  });
</script>
<!-- JavaScript for handling 'OTHERS' and initializing Select2 -->
<script>
$(document).ready(function() {
    $('#medicationid').select2({
        placeholder: "Select Medication",
        allowClear: true,
        width: '100%' // Make sure it fills the container
    });
    // Initialize Select2 for the intake times dropdown
    $('#intakeTimesDropdown').select2({
      placeholder: "Select Intake Time",
      allowClear: true,
      width: '100%' // Make sure it fills the container
    });

    // Show the "OTHERS" input field when the "OTHERS" option is selected for Intake Times
    $('#intakeTimesDropdown').on('change', function() {
      var selectedValues = $(this).val();
      if (selectedValues && selectedValues.includes('OTHERS')) {
        $('#intakeTimesOtherInputContainer').show();
      } else {
        $('#intakeTimesOtherInputContainer').hide();
      }
    });
  });
</script>
