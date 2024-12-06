<main id="main" class="main">
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Patient Status</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('patient') ?>">Patient</a></li>
                <li class="breadcrumb-item active">Status</li>
            </ol>
        </nav>
    </div>

    <!-- Main Container -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header ">
                        <h4 class="card-title mb-0">Update Patient Status</h4>
                    </div>
                    <?php
                    // Get the Date of Birth from the patient details
                    $dateOfBirth = $patientDetails->DateofBirth;

                    // Convert the Date of Birth to a DateTime object
                    $dob = new DateTime($dateOfBirth);
                    $today = new DateTime(); // Current date

                    // Calculate the difference between today and the Date of Birth
                    $age = $today->diff($dob)->y; // Get the age in years
                    ?>

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Patient Information -->
                        <div class="mb-4">
    <h5>Patient Name: <strong>
        <?= isset($patientDetails) 
            ? htmlspecialchars($patientDetails->Lastname . ', ' . $patientDetails->Firstname . ' ' . $patientDetails->Middlename)
            : 'Unknown Patient' ?>
        / Age: <?= isset($patientDetails->DateofBirth) ? $today->diff(new DateTime($patientDetails->DateofBirth))->y : 'Unknown' ?>
        / Sex: <?= isset($patientDetails->Sex) ? htmlspecialchars($patientDetails->Sex) : 'Unknown' ?>
        / Hospital Case No: <?= htmlspecialchars($patientDetails->HostipalCaseNo) ?>
    </strong></h5>
</div>


                        <!-- Fixed Status Dropdown -->
                        <div class="mb-4">
                            <label for="statusSelect" class="form-label">Status</label>
                            <select id="statusSelect" class="form-select" disabled>
                                <option value="DISCHARGED" selected>DISCHARGED</option>
                            </select>
                        </div>

                        <!-- Discharge Form -->
                        <h5 class="text-primary">Discharge Summary</h5>
                        <hr>

                        <form method="POST" action="<?= base_url('patient/status') ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="PatientID" value="<?= set_value('PatientID', $patientDetails->PatientID); ?>">
                        <div class="row g-3 mb-4">
                                <!-- Date of Discharge -->
                                <div class="col-md-6">
                                    <label for="chiefComplaint" class="form-label">Chief Complaint</label>
                                    <input type="text" class="form-control <?= isset($validation) && $validation->getError('ChiefComplaint') ? 'is-invalid' : '' ?>" id="ChiefComplaint" name="ChiefComplaint" value="<?= set_value('ChiefComplaint', $patientDetails->ChiefComplaint ?? '') ?>">
                                    <?php if (isset($validation) && $validation->getError('ChiefComplaint')): ?>
                                        <div class="invalid-feedback"><?= $validation->getError('ChiefComplaint') ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
    <label for="medicationid" class="form-label">Medication</label>
    <select class="form-control select2" name="Medication[]" multiple="multiple" id="medicationid" required>
        <option value="">Select Medication</option>
        <?php foreach ($MedicationData as $medication): ?>
            <option value="<?= esc($medication->MedicationName) ?>" <?= set_value('Medication') && in_array($medication->MedicationName, (array) set_value('Medication')) ? 'selected' : '' ?>>
                <?= esc($medication->MedicationName) . ' - '. esc($medication->Dosage) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <!-- Input for other medication -->
    <div id="medicationOtherInputContainer" class="mt-2" style="display:none;">
        <input type="text" id="medicationOtherInput" class="form-control" placeholder="Please specify" />
    </div>

    <?php if (isset($validation) && $validation->getError('Medication')): ?>
        <div class="invalid-feedback"><?= $validation->getError('Medication') ?></div>
    <?php endif; ?>
</div>

                                        </div>
                            <div class="row g-3">
                                <!-- Date of Discharge -->
                                <div class="col-md-6">
                            <label for="DischargedDate" class="form-label">Date of Discharge</label>
                            <input type="date" class="form-control <?= isset($validation) && $validation->getError('DischargedDate') ? 'is-invalid' : '' ?>" id="dischargedDate" name="DischargedDate" value="<?= set_value('DischargedDate', date('Y-m-d')) ?>">
                            <?php if (isset($validation) && $validation->getError('DischargedDate')): ?>
                                <div class="invalid-feedback"><?= $validation->getError('DischargedDate') ?></div>
                            <?php endif; ?>
                        </div>

                               
                                <!-- Final Diagnosis -->
                                <div class="col-md-6">
                                    <label for="physician" class="form-label">Attending Physician</label>
                                    <select name="PhysicianID" id="PhysicianID" class="form-control">
                                        <option value="">-- Select Physician --</option>
                                        <?php foreach ($physicians as $physician): ?>
                                            <option value="<?= $physician->PhysicianID; ?>" 
                                                <?= set_select('PhysicianID', $physician->PhysicianID, isset($PhysicianID) && $physician->PhysicianID == $PhysicianID); ?>>
                                                <?= esc($physician->Lastname . ', ' . $physician->Firstname . ' ' . $physician->Middlename . ' - ' . $physician->Specialization); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (isset($validation) && $validation->getError('PhysicianID')): ?>
                                        <div class="invalid-feedback"><?= $validation->getError('PhysicianID') ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                             
                                <!-- Date Admitted -->
                                <div class="col-md-6">
                                <label for="dateAdmitted" class="form-label">Date Admitted</label>
                                <input 
                                    type="date" 
                                    class="form-control <?= isset($validation) && $validation->getError('dateAdmitted') ? 'is-invalid' : '' ?>" 
                                    id="dateAdmitted" 
                                    name="dateAdmitted" 
                                    value="<?= set_value('dateAdmitted', isset($patientDetails->updated_at) ? date('Y-m-d', strtotime($patientDetails->updated_at)) : '') ?>"
                                >
                                <?php if (isset($validation) && $validation->getError('dateAdmitted')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('dateAdmitted') ?></div>
                                <?php endif; ?>
                            </div>
                                <div class="col-md-6">
                                    <label for="LaboratoryFindings" class="form-label">Laboratory Findings</label>
                                    <textarea class="form-control <?= isset($validation) && $validation->getError('LaboratoryFindings') ? 'is-invalid' : '' ?>" id="LaboratoryFindings" name="LaboratoryFindings" rows="2"><?= set_value('LaboratoryFindings', $patientDetails->LaboratoryFindings ?? '') ?></textarea>
                                    <?php if (isset($validation) && $validation->getError('LaboratoryFindings')): ?>
                                        <div class="invalid-feedback"><?= $validation->getError('LaboratoryFindings') ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row g-3 mt-3">
                            
                                <div class="col-md-6">
                                    <label for="finalDiagnosis" class="form-label">Final Diagnosis</label>
                                    <textarea class="form-control <?= isset($validation) && $validation->getError('FinalDiagnosis') ? 'is-invalid' : '' ?>" id="FinalDiagnosis" name="FinalDiagnosis" rows="2"><?= set_value('FinalDiagnosis', $patientDetails->FinalDiagnosis ?? '') ?></textarea>
                                    <?php if (isset($validation) && $validation->getError('FinalDiagnosis')): ?>
                                        <div class="invalid-feedback"><?= $validation->getError('FinalDiagnosis') ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="Disposition" class="form-label">Disposition</label>
                                    <textarea class="form-control <?= isset($validation) && $validation->getError('Disposition') ? 'is-invalid' : '' ?>" id="Disposition" name="Disposition" rows="2"><?= set_value('Disposition', $patientDetails->Disposition ?? '') ?></textarea>
                                    <?php if (isset($validation) && $validation->getError('Disposition')): ?>
                                        <div class="invalid-feedback"><?= $validation->getError('Disposition') ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="<?= base_url() ?>patient" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
