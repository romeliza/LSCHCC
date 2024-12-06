<main id="main" class="main">
    <!-- Page Title -->
    <div class="pagetitle">
        <h1>Patient</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Patient</li>
            </ol>
        </nav>
    </div>

    <!-- Main Container -->
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">List of Patients</h4>
                        <a class="btn btn-success" href="<?= base_url('patient/add') ?>">
                            <i class="bi bi-person-plus"></i> Add Patient
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
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
                        <!-- Table -->
                        <div class="table-responsive mt-3">
                            <table class="table table-hover table-bordered" id="MIMTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">Case Number</th>
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($PatientData as $patient): ?>
                                        <tr>
                                            <td class="text-center"><?= htmlspecialchars($patient->HostipalCaseNo ?? 'N/A') ?></td>
                                            <td class="text-center">
                                                <?= htmlspecialchars(
                                                    ($patient->Lastname ?? '') . ', ' .
                                                    ($patient->Firstname ?? '') . ' ' .
                                                    ($patient->Middlename ?? '')
                                                ) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars(
                                                    ($patient->barangay ?? '') . ', ' .
                                                    ($patient->municipality ?? '') . ', ' .
                                                    ($patient->province ?? '') . ', ' .
                                                    ($patient->region ?? '')
                                                ) ?>
                                            </td>
                                            <td class="text-center">
                                            <?php 
                                            // Determine the badge color based on the patient status
                                            $badgeClass = '';
                                            $status = htmlspecialchars($patient->PatientStatus ?? 'N/A');  // Get patient status
                                            // Set badge class based on the patient status
                                            if ($status == 'OPD') {
                                                $badgeClass = 'btn btn-primary btn-sm';  // Blue for OPD
                                            } elseif ($status == 'ADMISSION') {
                                                $badgeClass = 'btn btn-warning btn-sm';  // Yellow for ADMISSION
                                            } elseif ($status == 'DISCHARGED') {
                                                $badgeClass = 'btn btn-success btn-sm';  // Green for DISCHARGED
                                            } else {
                                                $badgeClass = 'btn btn-secondary btn-sm';  // Default gray if not found
                                            }
                                            ?>
                                            <!-- Status Button -->
                                            <a class="<?= $badgeClass ?>" href="<?= base_url('patient/status?id=' . md5($patient->PatientID . 'status')) ?>">
                                                <?= $status ?>
                                            </a>
                                        </td>
                                            <td class="text-center">
                                            <a class="btn btn-primary btn-sm me-1" 
                                                href="<?= base_url('patient/edit?id=' . md5($patient->PatientID . 'edit')) ?>">
                                                <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-warning btn-sm me-2" title="View" data-bs-toggle="modal" data-bs-target="#patientDetailsModal"
                                                data-patient-full-name="<?= htmlspecialchars($patient->Lastname ?? '') . ', ' . htmlspecialchars($patient->Firstname ?? '') . ' ' . htmlspecialchars($patient->Middlename ?? '') ?>"
                                                data-patient-sex="<?= htmlspecialchars($patient->Sex ?? 'N/A') ?>"
                                                data-patient-contact="<?= htmlspecialchars($patient->ContactNumber ?? 'N/A') ?>"
                                                data-patient-address="<?= htmlspecialchars(($patient->barangay ?? '') . ', ' . ($patient->municipality ?? '') . ', ' . ($patient->province ?? '') . ', ' . ($patient->region ?? '')) ?>"
                                                data-patient-civil-status="<?= htmlspecialchars($patient->CivilStatus ?? 'N/A') ?>"
                                                data-patient-religion="<?= htmlspecialchars($patient->Religion ?? 'N/A') ?>"
                                                data-patient-dob="<?= htmlspecialchars($patient->DateofBirth ?? 'N/A') ?>"
                                                data-patient-place-of-birth="<?= htmlspecialchars($patient->PlaceofBirth ?? 'N/A') ?>"
                                                data-patient-occupation="<?= htmlspecialchars($patient->Occupation ?? 'N/A') ?>"
                                                data-patient-status="<?= htmlspecialchars($patient->PatientStatus ?? 'N/A') ?>"
                                                data-patient-case-no="<?= htmlspecialchars($patient->HostipalCaseNo ?? 'N/A') ?>"
                                                data-patient-physician="<?= htmlspecialchars($patient->PhysicianName ?? 'Unknown') ?>"
                                                data-patient-specialization="<?= htmlspecialchars($patient->Specialization ?? 'N/A') ?>"
                                                data-patient-head-of-family="<?= htmlspecialchars($patient->HeadofFamily ?? 'N/A') ?>"
                                                data-patient-adult-history="<?= htmlspecialchars($patient->AdultHistory ?? 'N/A') ?>"
                                                data-patient-pediatric-history="<?= htmlspecialchars($patient->PediatricHistory ?? 'N/A') ?>"
                                                data-patient-date-time="<?= htmlspecialchars($patient->PatientDateTime ?? 'N/A') ?>"
                                                data-patient-chief-complaint="<?= htmlspecialchars($patient->ChiefComplaint ?? 'N/A') ?>"
                                                data-patient-initial-diagnosis="<?= htmlspecialchars($patient->InitialDiagnosis ?? 'N/A') ?>"
                                                data-patient-treatment="<?= htmlspecialchars($patient->Treatment ?? 'N/A') ?>"
                                                data-patient-bp="<?= htmlspecialchars($patient->Bp ?? 'N/A') ?>"
                                                data-patient-temperature="<?= htmlspecialchars($patient->T ?? 'N/A') ?>"
                                                data-patient-pulse-rate="<?= htmlspecialchars($patient->CR ?? 'N/A') ?>"
                                                data-patient-respiratory-rate="<?= htmlspecialchars($patient->RR ?? 'N/A') ?>"
                                                data-patient-oxygen-saturation="<?= htmlspecialchars($patient->O2Sat ?? 'N/A') ?>"
                                                data-patient-weight="<?= htmlspecialchars($patient->Wt ?? 'N/A') ?>"
                                                data-patient-height="<?= htmlspecialchars($patient->Ht ?? 'N/A') ?>">
                                                <i class="bi bi-eye"></i> 
                                            </button>
                                              
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
</main>