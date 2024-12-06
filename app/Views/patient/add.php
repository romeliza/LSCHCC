<style>
  /* Increase the size of the checkboxes */
  .dropdown-menu input[type="checkbox"] {
    transform: scale(1.5); /* Makes the checkbox 1.5 times bigger */
    margin-right: 10px;
  }

  /* Adjust label to align with larger checkboxes */
  .dropdown-menu label {
    font-size: 1.2rem; /* Adjust the font size of the labels */
  }
</style>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Patient</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>patient">Patient</a></li>
        <li class="breadcrumb-item active">Add</li>
      </ol>
    </nav>
  </div>

  <div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Add Patient</h5>
        </div>
        <div class="card-body" style="background-color: #f0f2f5;">
        <p class="text-muted mt-3" style="color: gray !important;">
    <i> Please provide the following information to add a new patient to the system. Ensure all details are correct to avoid any issues in patient management.</i>
</p>


          <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= session()->getFlashdata('error'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <form action="<?= base_url() ?>patient/add" method="POST">
              <?= csrf_field() ?>
              <div class="col-md-12 mb-3">
                  <label for="HostipalCaseNo" class="form-label">Hospital Case No.</label>
                  <input required type="text" class="form-control <?= isset($validation) && $validation->getError('HostipalCaseNo') ? 'is-invalid' : '' ?>" id="HostipalCaseNo" name="HostipalCaseNo" value="<?= set_value('HostipalCaseNo') ?>">
                  <?php if (isset($validation) && $validation->getError('HostipalCaseNo')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('HostipalCaseNo') ?></div>
                  <?php endif; ?>
                </div>
         <!-- Personal Information -->
<div class="row mb-3">
  <div class="col-md-4">
    <label for="lastname" class="form-label">Last Name</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->getError('Lastname') ? 'is-invalid' : '' ?>" id="lastname" name="Lastname" value="<?= set_value('Lastname') ?>">
    <?php if (isset($validation) && $validation->getError('Lastname')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Lastname') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-4">
    <label for="firstname" class="form-label">First Name</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->getError('Firstname') ? 'is-invalid' : '' ?>" id="firstname" name="Firstname" value="<?= set_value('Firstname') ?>">
    <?php if (isset($validation) && $validation->getError('Firstname')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Firstname') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-4">
    <label for="middlename" class="form-label">Middle Name</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->getError('Middlename') ? 'is-invalid' : '' ?>" id="middlename" name="Middlename" value="<?= set_value('Middlename') ?>">
    <?php if (isset($validation) && $validation->getError('Middlename')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Middlename') ?></div>
    <?php endif; ?>
  </div>
</div>


             <!-- Address -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="region" class="form-label">Region</label>
    <select required id="region" class="form-control <?= isset($validation) && $validation->getError('region') ? 'is-invalid' : '' ?>" name="region">
      <option value="">Select Region</option>
    </select>
    <?php if (isset($validation) && $validation->getError('region')): ?>
      <div class="invalid-feedback"><?= $validation->getError('region') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="province" class="form-label">Province</label>
    <select required id="province" class="form-control <?= isset($validation) && $validation->getError('province') ? 'is-invalid' : '' ?>" name="province">
      <option value="">Select Province</option>
    </select>
    <?php if (isset($validation) && $validation->getError('province')): ?>
      <div class="invalid-feedback"><?= $validation->getError('province') ?></div>
    <?php endif; ?>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="municipality" class="form-label">Municipality/City</label>
    <select required id="municipality" class="form-control <?= isset($validation) && $validation->getError('municipality') ? 'is-invalid' : '' ?>" name="municipality">
      <option value="">Select Municipality/City</option>
    </select>
    <?php if (isset($validation) && $validation->getError('municipality')): ?>
      <div class="invalid-feedback"><?= $validation->getError('municipality') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="barangay" class="form-label">Barangay</label>
    <select required id="barangay" class="form-control <?= isset($validation) && $validation->getError('barangay') ? 'is-invalid' : '' ?>" name="barangay">
      <option value="">Select Barangay</option>
    </select>
    <?php if (isset($validation) && $validation->getError('barangay')): ?>
      <div class="invalid-feedback"><?= $validation->getError('barangay') ?></div>
    <?php endif; ?>
  </div>
</div>  


             <!-- Additional Information -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="occupation" class="form-label">Occupation</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->getError('Occupation') ? 'is-invalid' : '' ?>" id="occupation" name="Occupation">
    <?php if (isset($validation) && $validation->getError('Occupation')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Occupation') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="sex" class="form-label">Sex</label>
    <select required class="form-control <?= isset($validation) && $validation->getError('Sex') ? 'is-invalid' : '' ?>" id="sex" name="Sex">
      <option value="">Select Sex</option>
      <option value="Male" <?= set_select('Sex', 'Male', false); ?>>Male</option>
      <option value="Female" <?= set_select('Sex', 'Female', false); ?>>Female</option>
    </select>
    <?php if (isset($validation) && $validation->getError('Sex')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Sex') ?></div>
    <?php endif; ?>
  </div>
</div>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="religion" class="form-label">Religion</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->getError('Religion') ? 'is-invalid' : '' ?>" id="religion" name="Religion" value="<?= set_value('Religion') ?>">
    <?php if (isset($validation) && $validation->getError('Religion')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Religion') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="civilstatus" class="form-label">Civil Status</label>
    <select required class="form-control <?= isset($validation) && $validation->getError('CivilStatus') ? 'is-invalid' : '' ?>" id="civilstatus" name="CivilStatus">
      <option value="">Select Civil Status</option>
      <option value="Single" <?= set_select('CivilStatus', 'Single', false); ?>>Single</option>
      <option value="Married" <?= set_select('CivilStatus', 'Married', false); ?>>Married</option>
      <option value="Divorced" <?= set_select('CivilStatus', 'Divorced', false); ?>>Divorced</option>
      <option value="Widowed" <?= set_select('CivilStatus', 'Widowed', false); ?>>Widowed</option>
      <option value="Separated" <?= set_select('CivilStatus', 'Separated', false); ?>>Separated</option>
      <option value="Other" <?= set_select('CivilStatus', 'Other', false); ?>>Other</option>
    </select>
    <?php if (isset($validation) && $validation->getError('CivilStatus')): ?>
      <div class="invalid-feedback"><?= $validation->getError('CivilStatus') ?></div>
    <?php endif; ?>
  </div>
</div>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="phonenumber" class="form-label">Phone Number</label>
    <input required type="tel" class="form-control <?= isset($validation) && $validation->getError('ContactNumber') ? 'is-invalid' : '' ?>" id="phonenumber" name="ContactNumber" value="<?= set_value('ContactNumber') ?>" pattern="^\d{11}$" maxlength="11">
    <?php if (isset($validation) && $validation->getError('ContactNumber')): ?>
      <div class="invalid-feedback"><?= $validation->getError('ContactNumber') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="physician" class="form-label">Physician</label>
    <select required id="physician" class="form-control <?= isset($validation) && $validation->getError('PhysicianID') ? 'is-invalid' : '' ?>" name="PhysicianID">
      <option value="">Select Physician</option>
      <?php foreach ($physicians as $physician): ?>
        <option value="<?= $physician->PhysicianID ?>" <?= set_select('PhysicianID', $physician->PhysicianID) ?>>
          <?= $physician->Firstname . ' ' . $physician->Lastname ?> - <?= $physician->Specialization ?>
        </option>
      <?php endforeach; ?>
    </select>
    <?php if (isset($validation) && $validation->getError('PhysicianID')): ?>
      <div class="invalid-feedback"><?= $validation->getError('PhysicianID') ?></div>
    <?php endif; ?>
  </div>
</div>
<div class="row mb-3">
  <div class="col-md-6">
    <label for="placeofBirth" class="form-label">Place of Birth</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->getError('PlaceofBirth') ? 'is-invalid' : '' ?>" id="placeofBirth" name="PlaceofBirth">
    <?php if (isset($validation) && $validation->getError('PlaceofBirth')): ?>
      <div class="invalid-feedback"><?= $validation->getError('PlaceofBirth') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="dateofbirth" class="form-label">Date of Birth</label>
    <input required type="date" class="form-control <?= isset($validation) && $validation->getError('DateofBirth') ? 'is-invalid' : '' ?>" id="dateofbirth" name="DateofBirth" value="<?= set_value('DateofBirth') ?>">
    <?php if (isset($validation) && $validation->getError('DateofBirth')): ?>
      <div class="invalid-feedback"><?= $validation->getError('DateofBirth') ?></div>
    <?php endif; ?>
  </div>
</div>



<!-- Adult History -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="AdultHistory" class="form-label">Adult History</label>
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="AdultHistoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Select options
      </button>
      <ul class="dropdown-menu w-100" aria-labelledby="AdultHistoryDropdown">
        <li><label class="dropdown-item"><input type="checkbox" value="HPN" name="AdultHistory[]"> HPN</label></li>
        <li><label class="dropdown-item"><input type="checkbox" value="DM" name="AdultHistory[]"> DM</label></li>
        <li><label class="dropdown-item"><input type="checkbox" value="ASTHMA" name="AdultHistory[]"> ASTHMA</label></li>
        <li><label class="dropdown-item"><input type="checkbox" value="PTB" name="AdultHistory[]"> PTB</label></li>
        <li><label class="dropdown-item"><input type="checkbox" value="ALLERGIES" name="AdultHistory[]"> ALLERGIES</label></li>
        <li><label class="dropdown-item"><input type="checkbox" value="CVS" name="AdultHistory[]"> CVS</label></li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="OTHERS" id="AdultHistoryOthers" name="AdultHistory[]"> OTHERS
            <input type="hidden" name="AdultHistory[]" value="">
            <input type="text" id="AdultHistoryOtherInput" style="display: none;" class="form-control" placeholder="Please specify">
          </label>
        </li>
      </ul>
    </div>
  </div>

  <!-- Pediatric History -->
  <div class="col-md-6">
    <label for="PediatricHistory" class="form-label">Pediatric History</label>
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="PediatricHistoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Select options
      </button>
      <ul class="dropdown-menu w-100" aria-labelledby="PediatricHistoryDropdown">
        <li><label class="dropdown-item"><input type="checkbox" value="Allergies" name="PediatricHistory[]"> Allergies</label></li>
        <li><label class="dropdown-item"><input type="checkbox" value="ASTHMA" name="PediatricHistory[]"> ASTHMA</label></li>
        <li><label class="dropdown-item"><input type="checkbox" value="G6PD" name="PediatricHistory[]"> G6PD</label></li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="OTHERS" id="PediatricHistoryOthers" name="PediatricHistory[]"> OTHERS
            <input type="hidden" name="PediatricHistory[]" value="">
            <input type="text" id="PediatricHistoryOtherInput" style="display: none;" class="form-control" placeholder="Please specify">
          </label>
        </li>
      </ul>
    </div>
  </div>
</div>

 <!-- Head of Family -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="HeadofFamily" class="form-label">Head of Family / Guardian</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('HeadofFamily') ? 'is-invalid' : '' ?>" id="HeadofFamily" name="HeadofFamily" value="<?= set_value('HeadofFamily') ?>">
    <?php if (isset($validation) && $validation->hasError('HeadofFamily')): ?>
      <div class="invalid-feedback"><?= $validation->getError('HeadofFamily') ?></div>
    <?php endif; ?>
  </div>

  <!-- Chief Complaint -->
  <div class="col-md-6">
    <label for="ChiefComplaint" class="form-label">Chief Complaint</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('ChiefComplaint') ? 'is-invalid' : '' ?>" id="ChiefComplaint" name="ChiefComplaint" value="<?= set_value('ChiefComplaint') ?>">
    <?php if (isset($validation) && $validation->hasError('ChiefComplaint')): ?>
      <div class="invalid-feedback"><?= $validation->getError('ChiefComplaint') ?></div>
    <?php endif; ?>
  </div>
</div>

<!-- Initial Diagnosis and Treatment -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="InitialDiagnosis" class="form-label">Initial Diagnosis</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('InitialDiagnosis') ? 'is-invalid' : '' ?>" id="InitialDiagnosis" name="InitialDiagnosis" value="<?= set_value('InitialDiagnosis') ?>">
    <?php if (isset($validation) && $validation->hasError('InitialDiagnosis')): ?>
      <div class="invalid-feedback"><?= $validation->getError('InitialDiagnosis') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="Treatment" class="form-label">Treatment</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('Treatment') ? 'is-invalid' : '' ?>" id="Treatment" name="Treatment" value="<?= set_value('Treatment') ?>">
    <?php if (isset($validation) && $validation->hasError('Treatment')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Treatment') ?></div>
    <?php endif; ?>
  </div>
</div>

<!-- Vitals: BP, Temperature, CR, RR -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="Bp" class="form-label">Blood Pressure (BP)</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('Bp') ? 'is-invalid' : '' ?>" id="Bp" name="Bp" value="<?= set_value('Bp') ?>">
    <?php if (isset($validation) && $validation->hasError('Bp')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Bp') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="T" class="form-label">Temperature (T)</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('T') ? 'is-invalid' : '' ?>" id="T" name="T" value="<?= set_value('T') ?>">
    <?php if (isset($validation) && $validation->hasError('T')): ?>
      <div class="invalid-feedback"><?= $validation->getError('T') ?></div>
    <?php endif; ?>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="CR" class="form-label">Capillary Refill (CR)</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('CR') ? 'is-invalid' : '' ?>" id="CR" name="CR" value="<?= set_value('CR') ?>">
    <?php if (isset($validation) && $validation->hasError('CR')): ?>
      <div class="invalid-feedback"><?= $validation->getError('CR') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="RR" class="form-label">Respiratory Rate (RR)</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('RR') ? 'is-invalid' : '' ?>" id="RR" name="RR" value="<?= set_value('RR') ?>">
    <?php if (isset($validation) && $validation->hasError('RR')): ?>
      <div class="invalid-feedback"><?= $validation->getError('RR') ?></div>
    <?php endif; ?>
  </div>
</div>


<!-- Oxygen Saturation, Weight, Height -->
<div class="row mb-3">
  <!-- Oxygen Saturation -->
  <div class="col-md-6">
    <label for="O2Sat" class="form-label">Oxygen Saturation (O2Sat)</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('O2Sat') ? 'is-invalid' : '' ?>" id="O2Sat" name="O2Sat" value="<?= set_value('O2Sat') ?>">
    <?php if (isset($validation) && $validation->hasError('O2Sat')): ?>
      <div class="invalid-feedback"><?= $validation->getError('O2Sat') ?></div>
    <?php endif; ?>
  </div>

  <!-- Weight -->
  <div class="col-md-6">
    <label for="Wt" class="form-label">Weight (Wt)</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('Wt') ? 'is-invalid' : '' ?>" id="Wt" name="Wt" value="<?= set_value('Wt') ?>">
    <?php if (isset($validation) && $validation->hasError('Wt')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Wt') ?></div>
    <?php endif; ?>
  </div>
</div>

<div class="row mb-3">
  <!-- Height -->
  <div class="col-md-6">
    <label for="Ht" class="form-label">Height (Ht)</label>
    <input required type="text" class="form-control <?= isset($validation) && $validation->hasError('Ht') ? 'is-invalid' : '' ?>" id="Ht" name="Ht" value="<?= set_value('Ht') ?>">
    <?php if (isset($validation) && $validation->hasError('Ht')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Ht') ?></div>
    <?php endif; ?>
  </div>

  <!-- Patient Status -->
  <div class="col-md-6">
    <label for="PatientStatus" class="form-label">Patient Status</label>
    <select required class="form-control <?= isset($validation) && $validation->getError('PatientStatus') ? 'is-invalid' : '' ?>" id="PatientStatus" name="PatientStatus">
      <option value="">Select Status</option>
      <option value="OPD" <?= set_select('PatientStatus', 'OPD', false); ?>>OPD</option>
      <option value="ADMISSION" <?= set_select('PatientStatus', 'ADMISSION', false); ?>>ADMISSION</option>
    </select>
    <?php if (isset($validation) && $validation->getError('PatientStatus')): ?>
      <div class="invalid-feedback"><?= $validation->getError('PatientStatus') ?></div>
    <?php endif; ?>
  </div>
</div>

<!-- Submit Buttons -->
<div class="d-flex justify-content-center mb-3">
  <button type="submit" class="btn btn-success me-2">
    <i class="bi bi-check-circle"></i> Save
  </button>
  <a href="<?= base_url('patient') ?>" class="btn btn-danger">
    <i class="bi bi-x-circle"></i> Cancel
  </a>
</div>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
function toggleOtherInput(historyType) {
  const othersCheckbox = document.getElementById(historyType + 'Others');
  const othersInput = document.getElementById(historyType + 'OtherInput');
  const checkboxes = document.querySelectorAll(`input[name="${historyType}[]"]`);

  if (othersCheckbox.checked) {
    // Show the input field for "OTHERS"
    othersInput.style.display = 'block'; 
    othersInput.setAttribute('name', `${historyType}OtherInput`); // Add name attribute for form submission

    // Uncheck all other checkboxes except "OTHERS"
    checkboxes.forEach((checkbox) => {
      if (checkbox !== othersCheckbox) {
        checkbox.checked = false;
      }
    });
  } else {
    // Hide the input field for "OTHERS"
    othersInput.style.display = 'none'; 
    othersInput.removeAttribute('name'); // Remove name attribute to prevent form submission
    othersInput.value = ''; // Clear the input value
  }
}

function uncheckOthersOnSelection(historyType) {
  const othersCheckbox = document.getElementById(historyType + 'Others');
  const othersInput = document.getElementById(historyType + 'OtherInput');
  const checkboxes = document.querySelectorAll(`input[name="${historyType}[]"]`);

  checkboxes.forEach((checkbox) => {
    if (checkbox !== othersCheckbox && !checkbox.dataset.listenerAdded) {
      checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
          // Uncheck "OTHERS" and hide its input field
          othersCheckbox.checked = false;
          othersInput.style.display = 'none';
          othersInput.removeAttribute('name'); // Remove name attribute
          othersInput.value = ''; // Clear input value
        }
      });
      checkbox.dataset.listenerAdded = true; // Ensure event listener is only added once
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  // Initialize the behavior for "OTHERS" checkboxes
  ['AdultHistory', 'PediatricHistory'].forEach((historyType) => {
    const othersCheckbox = document.getElementById(historyType + 'Others');
    const othersInput = document.getElementById(historyType + 'OtherInput');

    // Show or hide the input field based on the initial state of the "OTHERS" checkbox
    if (othersCheckbox.checked) {
      othersInput.style.display = 'block'; 
      othersInput.setAttribute('name', `${historyType}OtherInput`); // Add name attribute for form submission
    } else {
      othersInput.style.display = 'none';
      othersInput.removeAttribute('name');
    }

    // Set up event listeners for toggling "OTHERS"
    othersCheckbox.addEventListener('change', () => toggleOtherInput(historyType));
    uncheckOthersOnSelection(historyType); // Set up uncheck behavior for other checkboxes
  });
});

</script>
