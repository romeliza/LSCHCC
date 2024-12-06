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
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Patient</h5>
          </div>
          <div class="card-body mt-4">
            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>
           
            <form action="<?= base_url() ?>patient/edit" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="PatientID" value="<?= set_value('PatientID', $PatientDetails->PatientID); ?>">

              <div class="col-md-12 mb-3">
                  <label for="HostipalCaseNo" class="form-label">Hospital Case No.</label>
                  <input type="text" class="form-control <?= isset($validation) && $validation->getError('HostipalCaseNo') ? 'is-invalid' : '' ?>" id="HostipalCaseNo" name="HostipalCaseNo" value="<?= set_value('HostipalCaseNo', $PatientDetails->HostipalCaseNo) ?>">
                  <?php if (isset($validation) && $validation->getError('HostipalCaseNo')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('HostipalCaseNo') ?></div>
                  <?php endif; ?>
                </div>
              <!-- Personal Information -->
<div class="row mb-3">
    <div class="col-md-4">
        <label for="lastname" class="form-label">Last Name</label>
        <input type="text" class="form-control <?= isset($validation) && $validation->getError('Lastname') ? 'is-invalid' : '' ?>" 
               id="lastname" name="Lastname" 
               value="<?= set_value('Lastname', $PatientDetails->Lastname) ?>" required>
        <?php if (isset($validation) && $validation->getError('Lastname')): ?>
            <div class="invalid-feedback"><?= $validation->getError('Lastname') ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-4">
        <label for="firstname" class="form-label">First Name</label>
        <input type="text" class="form-control <?= isset($validation) && $validation->getError('Firstname') ? 'is-invalid' : '' ?>" 
               id="firstname" name="Firstname" 
               value="<?= set_value('Firstname', $PatientDetails->Firstname) ?>" required>
        <?php if (isset($validation) && $validation->getError('Firstname')): ?>
            <div class="invalid-feedback"><?= $validation->getError('Firstname') ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-4">
        <label for="middlename" class="form-label">Middle Name</label>
        <input type="text" class="form-control <?= isset($validation) && $validation->getError('Middlename') ? 'is-invalid' : '' ?>" 
               id="middlename" name="Middlename" 
               value="<?= set_value('Middlename', $PatientDetails->Middlename) ?>" required>
        <?php if (isset($validation) && $validation->getError('Middlename')): ?>
            <div class="invalid-feedback"><?= $validation->getError('Middlename') ?></div>
        <?php endif; ?>
    </div>
</div>

<!-- Address -->
<div class="row g-2 mb-3">
    <div class="col-md-6">
        <label for="region" class="form-label">Region</label>
        <select id="region" name="region" 
                class="form-select form-select-sm <?= isset($validation) && $validation->getError('region') ? 'is-invalid' : '' ?>" 
                data-initial-value="<?= set_value('region', $PatientDetails->region); ?>" required>
            <option value="">Select Region</option>
        </select>
        <?php if (isset($validation) && $validation->getError('region')): ?>
            <div class="invalid-feedback"><?= $validation->getError('region') ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <label for="province" class="form-label">Province</label>
        <select id="province" name="province" 
                class="form-select form-select-sm <?= isset($validation) && $validation->getError('province') ? 'is-invalid' : '' ?>" 
                data-initial-value="<?= set_value('province', $PatientDetails->province); ?>" required>
            <option value="">Select Province</option>
        </select>
        <?php if (isset($validation) && $validation->getError('province')): ?>
            <div class="invalid-feedback"><?= $validation->getError('province') ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="row g-2 mb-3">
    <div class="col-md-6">
        <label for="municipality" class="form-label">Municipality/City</label>
        <select id="municipality" name="municipality" 
                class="form-select form-select-sm <?= isset($validation) && $validation->getError('municipality') ? 'is-invalid' : '' ?>" 
                data-initial-value="<?= set_value('municipality', $PatientDetails->municipality); ?>" required>
            <option value="">Select Municipality/City</option>
        </select>
        <?php if (isset($validation) && $validation->getError('municipality')): ?>
            <div class="invalid-feedback"><?= $validation->getError('municipality') ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <label for="Barangay" class="form-label">Barangay</label>
        <select id="Barangay" name="barangay" 
                class="form-select form-select-sm <?= isset($validation) && $validation->getError('barangay') ? 'is-invalid' : '' ?>" 
                data-initial-value="<?= set_value('barangay', $PatientDetails->barangay); ?>" required>
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
        <label for="religion" class="form-label">Religion</label>
        <input type="text" class="form-control <?= isset($validation) && $validation->getError('Religion') ? 'is-invalid' : '' ?>" 
               id="religion" name="Religion" 
               value="<?= set_value('Religion', $PatientDetails->Religion) ?>" required>
        <?php if (isset($validation) && $validation->getError('Religion')): ?>
            <div class="invalid-feedback"><?= $validation->getError('Religion') ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <label for="sex" class="form-label">Sex</label>
        <select class="form-control <?= isset($validation) && $validation->getError('Sex') ? 'is-invalid' : '' ?>" 
                id="sex" name="Sex" required>
            <option value="">Select Gender</option>
            <option value="Male" <?= set_select('Sex', 'Male', $PatientDetails->Sex == 'Male'); ?>>Male</option>
            <option value="Female" <?= set_select('Sex', 'Female', $PatientDetails->Sex == 'Female'); ?>>Female</option>
        </select>
        <?php if (isset($validation) && $validation->getError('Sex')): ?>
            <div class="invalid-feedback"><?= $validation->getError('Sex') ?></div>
        <?php endif; ?>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="occupation" class="form-label">Occupation</label>
        <input type="text" class="form-control <?= isset($validation) && $validation->getError('Occupation') ? 'is-invalid' : '' ?>" 
               id="occupation" name="Occupation" 
               value="<?= set_value('Occupation', $PatientDetails->Occupation) ?>" required>
        <?php if (isset($validation) && $validation->getError('Occupation')): ?>
            <div class="invalid-feedback"><?= $validation->getError('Occupation') ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <label for="civilstatus" class="form-label">Civil Status</label>
        <select class="form-control <?= isset($validation) && $validation->getError('CivilStatus') ? 'is-invalid' : '' ?>" 
                id="civilstatus" name="CivilStatus" required>
            <option value="">Select Civil Status</option>
            <option value="Single" <?= set_select('CivilStatus', 'Single', $PatientDetails->CivilStatus == 'Single'); ?>>Single</option>
            <option value="Married" <?= set_select('CivilStatus', 'Married', $PatientDetails->CivilStatus == 'Married'); ?>>Married</option>
            <option value="Divorced" <?= set_select('CivilStatus', 'Divorced', $PatientDetails->CivilStatus == 'Divorced'); ?>>Divorced</option>
            <option value="Widowed" <?= set_select('CivilStatus', 'Widowed', $PatientDetails->CivilStatus == 'Widowed'); ?>>Widowed</option>
            <option value="Separated" <?= set_select('CivilStatus', 'Separated', $PatientDetails->CivilStatus == 'Separated'); ?>>Separated</option>
            <option value="Other" <?= set_select('CivilStatus', 'Other', $PatientDetails->CivilStatus == 'Other'); ?>>Other</option>
        </select>
        <?php if (isset($validation) && $validation->getError('CivilStatus')): ?>
            <div class="invalid-feedback"><?= $validation->getError('CivilStatus') ?></div>
        <?php endif; ?>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="phonenumber" class="form-label">Phone Number</label>
        <input type="tel" class="form-control <?= isset($validation) && $validation->getError('ContactNumber') ? 'is-invalid' : '' ?>" 
               id="contactnumber" name="ContactNumber" 
               value="<?= set_value('ContactNumber', $PatientDetails->ContactNumber) ?>" 
               pattern="^\d{11}$" maxlength="11" required>
        <?php if (isset($validation) && $validation->getError('ContactNumber')): ?>
            <div class="invalid-feedback"><?= $validation->getError('ContactNumber') ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <label for="physician" class="form-label">Physician</label>
        <select name="PhysicianID" id="PhysicianID" class="form-control" required>
            <option value="">-- Select Physician --</option>
            <?php foreach ($physicians as $physician): ?>
                <option value="<?= $physician->PhysicianID; ?>" 
                    <?= set_select('PhysicianID', $physician->PhysicianID, $physician->PhysicianID == $PhysicianID); ?>>
                    <?= esc($physician->Lastname . ', ' . $physician->Firstname . ' ' . $physician->Middlename . ' - '. $physician->Specialization); ?>
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
        <input type="text" class="form-control <?= isset($validation) && $validation->getError('PlaceofBirth') ? 'is-invalid' : '' ?>" 
               id="PlaceofBirth" name="PlaceofBirth" 
               value="<?= set_value('PlaceofBirth', $PatientDetails->PlaceofBirth) ?>" required>
        <?php if (isset($validation) && $validation->getError('PlaceofBirth')): ?>
            <div class="invalid-feedback"><?= $validation->getError('PlaceofBirth') ?></div>
        <?php endif; ?>
    </div>
    <div class="col-md-6">
        <label for="dateofbirth" class="form-label">Date of Birth</label>
        <input type="date" class="form-control <?= isset($validation) && $validation->getError('DateofBirth') ? 'is-invalid' : '' ?>" 
               id="dateofbirth" name="DateofBirth" 
               value="<?= set_value('DateofBirth' , $PatientDetails->DateofBirth) ?>" required>
        <?php if (isset($validation) && $validation->getError('DateofBirth')): ?>
            <div class="invalid-feedback"><?= $validation->getError('DateofBirth') ?></div>
        <?php endif; ?>
    </div>
</div>

<!-- Adult History and Pediatric History -->

<div class="row mb-3">
  <!-- Adult History -->
  <div class="col-md-6">
    <label for="AdultHistory" class="form-label">Adult History</label>
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="AdultHistoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Select options
      </button>
      <ul class="dropdown-menu w-100" aria-labelledby="AdultHistoryDropdown">
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="HPN" name="AdultHistory[]" <?= in_array('HPN', explode(',', $PatientDetails->AdultHistory)) ? 'checked' : '' ?>> HPN
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="DM" name="AdultHistory[]" <?= in_array('DM', explode(',', $PatientDetails->AdultHistory)) ? 'checked' : '' ?>> DM
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="ASTHMA" name="AdultHistory[]" <?= in_array('ASTHMA', explode(',', $PatientDetails->AdultHistory)) ? 'checked' : '' ?>> ASTHMA
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="PTB" name="AdultHistory[]" <?= in_array('PTB', explode(',', $PatientDetails->AdultHistory)) ? 'checked' : '' ?>> PTB
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="ALLERGIES" name="AdultHistory[]" <?= in_array('ALLERGIES', explode(',', $PatientDetails->AdultHistory)) ? 'checked' : '' ?>> ALLERGIES
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="CVS" name="AdultHistory[]" <?= in_array('CVS', explode(',', $PatientDetails->AdultHistory)) ? 'checked' : '' ?>> CVS
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="OTHERS" id="AdultHistoryOthers" name="AdultHistory[]" <?= in_array('OTHERS', explode(',', $PatientDetails->AdultHistory)) ? 'checked' : '' ?> onclick="toggleOtherInput('AdultHistory')"> OTHERS
            <input type="text" id="AdultHistoryOtherInput" class="form-control mt-2" placeholder="Please specify" style="<?= in_array('OTHERS', explode(',', $PatientDetails->AdultHistory)) ? 'display:block;' : 'display:none;' ?>" value="<?= in_array('OTHERS', explode(',', $PatientDetails->AdultHistory)) ? $PatientDetails->AdultHistory : '' ?>">
          </label>
        </li>
      </ul>
    </div>
    <?php if (isset($validation) && $validation->getError('AdultHistory')): ?>
      <div class="invalid-feedback"><?= $validation->getError('AdultHistory') ?></div>
    <?php endif; ?>
  </div>

  <!-- Pediatric History -->
  <div class="col-md-6">
    <label for="PediatricHistory" class="form-label">Pediatric History</label>
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" id="PediatricHistoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        Select options
      </button>
      <ul class="dropdown-menu w-100" aria-labelledby="PediatricHistoryDropdown">
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="Allergies" name="PediatricHistory[]" <?= in_array('Allergies', explode(',', $PatientDetails->PediatricHistory)) ? 'checked' : '' ?>> Allergies
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="ASTHMA" name="PediatricHistory[]" <?= in_array('ASTHMA', explode(',', $PatientDetails->PediatricHistory)) ? 'checked' : '' ?>> ASTHMA
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="G6PD" name="PediatricHistory[]" <?= in_array('G6PD', explode(',', $PatientDetails->PediatricHistory)) ? 'checked' : '' ?>> G6PD
          </label>
        </li>
        <li>
          <label class="dropdown-item">
            <input type="checkbox" value="OTHERS" id="PediatricHistoryOthers" name="PediatricHistory[]" <?= in_array('OTHERS', explode(',', $PatientDetails->PediatricHistory)) ? 'checked' : '' ?> onclick="toggleOtherInput('PediatricHistory')"> OTHERS
            <input type="text" id="PediatricHistoryOtherInput" class="form-control mt-2" placeholder="Please specify" style="<?= in_array('OTHERS', explode(',', $PatientDetails->PediatricHistory)) ? 'display:block;' : 'display:none;' ?>" value="<?= in_array('OTHERS', explode(',', $PatientDetails->PediatricHistory)) ? $PatientDetails->PediatricHistory : '' ?>">
          </label>
        </li>
      </ul>
    </div>
    <?php if (isset($validation) && $validation->getError('PediatricHistory')): ?>
      <div class="invalid-feedback"><?= $validation->getError('PediatricHistory') ?></div>
    <?php endif; ?>
  </div>
</div>




<!-- Head of Family -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="HeadofFamily" class="form-label">Head of Family / Guardian</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('HeadofFamily') ? 'is-invalid' : '' ?>" 
           id="HeadofFamily" 
           name="HeadofFamily" 
           value="<?= set_value('HeadofFamily', $PatientDetails->HeadofFamily) ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('HeadofFamily')): ?>
      <div class="invalid-feedback"><?= $validation->getError('HeadofFamily') ?></div>
    <?php endif; ?>
  </div>

  <!-- Chief Complaint -->
  <div class="col-md-6">
    <label for="ChiefComplaint" class="form-label">Chief Complaint</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('ChiefComplaint') ? 'is-invalid' : '' ?>" 
           id="ChiefComplaint" 
           name="ChiefComplaint" 
           value="<?= set_value('ChiefComplaint', isset($PatientDetails) ? $PatientDetails->ChiefComplaint : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('ChiefComplaint')): ?>
      <div class="invalid-feedback"><?= $validation->getError('ChiefComplaint') ?></div>
    <?php endif; ?>
  </div>
</div>

<!-- Initial Diagnosis and Treatment -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="InitialDiagnosis" class="form-label">Initial Diagnosis</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('InitialDiagnosis') ? 'is-invalid' : '' ?>" 
           id="InitialDiagnosis" 
           name="InitialDiagnosis" 
           value="<?= set_value('InitialDiagnosis', isset($PatientDetails) ? $PatientDetails->InitialDiagnosis : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('InitialDiagnosis')): ?>
      <div class="invalid-feedback"><?= $validation->getError('InitialDiagnosis') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="Treatment" class="form-label">Treatment</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('Treatment') ? 'is-invalid' : '' ?>" 
           id="Treatment" 
           name="Treatment" 
           value="<?= set_value('Treatment', isset($PatientDetails) ? $PatientDetails->Treatment : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('Treatment')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Treatment') ?></div>
    <?php endif; ?>
  </div>
</div>

<!-- Vitals: BP, Temperature, CR, RR -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="Bp" class="form-label">Blood Pressure (BP)</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('Bp') ? 'is-invalid' : '' ?>" 
           id="Bp" 
           name="Bp" 
           value="<?= set_value('Bp', isset($PatientDetails) ? $PatientDetails->Bp : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('Bp')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Bp') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="T" class="form-label">Temperature (T)</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('T') ? 'is-invalid' : '' ?>" 
           id="T" 
           name="T" 
           value="<?= set_value('T', isset($PatientDetails) ? $PatientDetails->T : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('T')): ?>
      <div class="invalid-feedback"><?= $validation->getError('T') ?></div>
    <?php endif; ?>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="CR" class="form-label">Capillary Refill (CR)</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('CR') ? 'is-invalid' : '' ?>" 
           id="CR" 
           name="CR" 
           value="<?= set_value('CR', isset($PatientDetails) ? $PatientDetails->CR : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('CR')): ?>
      <div class="invalid-feedback"><?= $validation->getError('CR') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="RR" class="form-label">Respiratory Rate (RR)</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('RR') ? 'is-invalid' : '' ?>" 
           id="RR" 
           name="RR" 
           value="<?= set_value('RR', isset($PatientDetails) ? $PatientDetails->RR : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('RR')): ?>
      <div class="invalid-feedback"><?= $validation->getError('RR') ?></div>
    <?php endif; ?>
  </div>
</div>


<!-- Oxygen Saturation, Weight, Height -->
<div class="row mb-3">
  <div class="col-md-6">
    <label for="O2Sat" class="form-label">Oxygen Saturation (O2Sat)</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('O2Sat') ? 'is-invalid' : '' ?>" 
           id="O2Sat" 
           name="O2Sat" 
           value="<?= set_value('O2Sat', isset($PatientDetails) ? $PatientDetails->O2Sat : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('O2Sat')): ?>
      <div class="invalid-feedback"><?= $validation->getError('O2Sat') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="Wt" class="form-label">Weight (Wt)</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('Wt') ? 'is-invalid' : '' ?>" 
           id="Wt" 
           name="Wt" 
           value="<?= set_value('Wt', isset($PatientDetails) ? $PatientDetails->Wt : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('Wt')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Wt') ?></div>
    <?php endif; ?>
  </div>
</div>

<div class="row mb-3">
  <div class="col-md-6">
    <label for="Ht" class="form-label">Height (Ht)</label>
    <input type="text" 
           class="form-control <?= isset($validation) && $validation->hasError('Ht') ? 'is-invalid' : '' ?>" 
           id="Ht" 
           name="Ht" 
           value="<?= set_value('Ht', isset($PatientDetails) ? $PatientDetails->Ht : '') ?>" 
           required>
    <?php if (isset($validation) && $validation->hasError('Ht')): ?>
      <div class="invalid-feedback"><?= $validation->getError('Ht') ?></div>
    <?php endif; ?>
  </div>
  <div class="col-md-6">
    <label for="PatientStatus" class="form-label">Patient Status</label>
    <select class="form-control <?= isset($validation) && $validation->getError('PatientStatus') ? 'is-invalid' : '' ?>" 
            id="PatientStatus" 
            name="PatientStatus" 
            required>
      <option value="" disabled <?= empty($PatientDetails->PatientStatus) ? 'selected' : '' ?>>Select Status</option>
      <option value="OPD" <?= set_select('PatientStatus', 'OPD', $PatientDetails->PatientStatus == 'OPD'); ?>>OPD</option>
      <option value="ADMISSION" <?= set_select('PatientStatus', 'ADMISSION', $PatientDetails->PatientStatus == 'ADMISSION'); ?>>ADMISSION</option>
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
    // Uncheck all other checkboxes except "OTHERS"
    checkboxes.forEach((checkbox) => {
      if (checkbox !== othersCheckbox) {
        checkbox.checked = false;
      }
    });
    othersInput.style.display = 'block'; // Show input field for "OTHERS"
    othersInput.setAttribute('name', `${historyType}OtherInput`); // Add name attribute for submission
  } else {
    othersInput.style.display = 'none'; // Hide input field for "OTHERS"
    othersInput.removeAttribute('name'); // Remove name attribute to prevent submission
    othersInput.value = ''; // Clear the value
  }
}

function uncheckOthersOnSelection(historyType) {
  const othersCheckbox = document.getElementById(historyType + 'Others');
  const checkboxes = document.querySelectorAll(`input[name="${historyType}[]"]`);

  checkboxes.forEach((checkbox) => {
    if (checkbox !== othersCheckbox && !checkbox.dataset.listenerAdded) {
      checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
          othersCheckbox.checked = false; // Uncheck "OTHERS"
          const othersInput = document.getElementById(historyType + 'OtherInput');
          othersInput.style.display = 'none'; // Hide "OTHERS" input field
          othersInput.removeAttribute('name'); // Remove name attribute to prevent submission
          othersInput.value = ''; // Clear the value
        }
      });
      checkbox.dataset.listenerAdded = true; // Mark listener added
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  // Initialize "OTHERS" visibility and set up event listeners
  ['AdultHistory', 'PediatricHistory'].forEach((historyType) => {
    const othersCheckbox = document.getElementById(historyType + 'Others');
    const othersInput = document.getElementById(historyType + 'OtherInput');
    const checkboxes = document.querySelectorAll(`input[name="${historyType}[]"]`);

    // Handle pre-checked "OTHERS"
    if (othersCheckbox.checked) {
      othersInput.style.display = 'block'; // Show input for "OTHERS"
      othersInput.setAttribute('name', `${historyType}OtherInput`); // Add name for submission
      checkboxes.forEach((checkbox) => {
        if (checkbox !== othersCheckbox) {
          checkbox.checked = false; // Uncheck all others
        }
      });
    } else {
      othersInput.style.display = 'none'; // Hide input
      othersInput.removeAttribute('name'); // Remove name
    }

    uncheckOthersOnSelection(historyType); // Set up event listeners
  });
});
</script>
