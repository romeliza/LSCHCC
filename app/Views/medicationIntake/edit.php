<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Medication Intake</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>medication_intake">Medication Intake</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Medication Intake</h5>
          </div>
          <div class="card-body mt-4">
            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <form action="<?= base_url() ?>medicationIntake/edit" method="POST" novalidate>
              <?= csrf_field() ?>

              <!-- Hidden Input for Medication Intake ID -->
              <input type="hidden" name="MedicationIntakeID" value="<?= esc($MedicationDetails->MedicationIntakeID) ?>">
  <!-- Patient ID -->
  <div class="mb-1">
                <label for="patientid" class="form-label">Patient</label>
                <select class="form-control <?= isset($validation) && $validation->getError('PatientID') ? 'is-invalid' : '' ?>" id="patientid" name="PatientID" required>
                  <option value="">Select Patient</option>
                  <?php foreach ($PatientData as $patient): ?>
                    <option value="<?= esc($patient->PatientID) ?>" <?= $MedicationDetails->PatientID == $patient->PatientID ? 'selected' : '' ?>>
                      <?= esc($patient->Firstname) . ' ' . esc($patient->Lastname) . ' - ' . esc($patient->HostipalCaseNo) ?>
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
                  <?php foreach ($MedicationData as $medication): ?>
                    <option value="<?= esc($medication->MedicationID) ?>" 
                      <?= in_array($medication->MedicationID, explode(',', $MedicationDetails->MedicationID)) ? 'selected' : '' ?>>
                      <?= esc($medication->MedicationName) . ' - ' . esc($medication->Dosage) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
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
                    $selectedTimes = explode(',', $MedicationDetails->IntakeTimes);
                    foreach ($timeSlots as $timeSlot) {
                      $selected = in_array($timeSlot, $selectedTimes) ? 'selected' : '';
                      echo '<option value="' . esc($timeSlot) . '" ' . $selected . '>' . esc($timeSlot) . '</option>';
                    }
                  ?>
                </select>
                <div id="intakeTimesOtherInputContainer" class="mt-2" style="display:none;">
                  <input type="text" id="intakeTimesOtherInput" class="form-control" placeholder="Please specify" />
                </div>
                <?php if (isset($validation) && $validation->getError('IntakeTimes')): ?>
                  <div class="invalid-feedback"><?= $validation->getError('IntakeTimes') ?></div>
                <?php endif; ?>
              </div>

              <!-- Intake Dates -->
              <div class="mb-3">
                <label for="intakeDates" class="form-label">Date/s</label>
                <input type="text" id="IntakeDates" class="form-control <?= isset($validation) && $validation->getError('IntakeDates') ? 'is-invalid' : '' ?>" name="IntakeDates" value="<?= esc($MedicationDetails->IntakeDates) ?>" placeholder="Select Dates" required>
                <?php if (isset($validation) && $validation->getError('IntakeDates')): ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('IntakeDates') ?>
                    </div>
                <?php endif; ?>
              </div>

              <!-- Buttons -->
              <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-success me-2">Update</button>
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
    // Convert PHP dates into a valid JavaScript array
    const defaultDatesRaw = <?= json_encode($MedicationDetails->IntakeDates) ?>; // String from the database
    const defaultDates = defaultDatesRaw 
        ? (defaultDatesRaw.includes(',') ? defaultDatesRaw.split(',') : [defaultDatesRaw]) 
        : []; // Ensure it's always an array

    console.log('Default Dates:', defaultDates); // Debugging: Check array output

    // Initialize Flatpickr
    flatpickr("#IntakeDates", {
        mode: "multiple", // Allows multiple date selection
        altInput: true,
        altFormat: "F j, Y", // Human-readable format
        dateFormat: "Y-m-d", // Matches database format
        defaultDate: defaultDates, // Pass the array of dates
    });
});


</script>




<script>
$(document).ready(function() {
    $('#medicationid').select2({
        placeholder: "Select Medication",
        allowClear: true,
        width: '100%'
    });
    $('#intakeTimesDropdown').select2({
        placeholder: "Select Intake Time",
        allowClear: true,
        width: '100%'
    });
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
