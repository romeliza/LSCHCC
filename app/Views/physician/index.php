<main id="main" class="main">
    <div class="pagetitle">
        <h1>Physician</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item active">Physician</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">List of Physicians</h4>
                        
                        <a class="btn btn-success" href="<?= base_url() ?>physician/add">
                            <i class="bi bi-person-plus"></i> Add Physician
                        </a>
                    </div>

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
                                        <th class="text-center">Full Name</th>
                                        <th class="text-center">Contact Number</th>
                                        <th class="text-center">Specialization</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($PhysicianData as $physician): ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= htmlspecialchars($physician->Lastname . ', ' . $physician->Firstname . ' ' . $physician->Middlename) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars($physician->ContactNumber) ?>
                                            </td>
                                          
                                            <td class="text-center">
                                                <?= htmlspecialchars($physician->Specialization) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars($physician->Email) ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <!-- View Button -->
                                                    <button class="btn btn-warning btn-sm me-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#viewPhysicianModal"
                                                            data-physicianID="<?= $physician->PhysicianID ?>"
                                                            data-fullname="<?= htmlspecialchars($physician->Lastname . ', ' . $physician->Firstname . ' ' . $physician->Middlename) ?>"
                                                            data-contactnumber="<?= htmlspecialchars($physician->ContactNumber) ?>"
                                                            data-specialization="<?= htmlspecialchars($physician->Specialization) ?>"
                                                            data-email="<?= htmlspecialchars($physician->Email) ?>">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <!-- Edit and Delete Buttons -->
                                                    <a class="btn btn-primary btn-sm me-1" 
                                                       href="<?= base_url('physician/edit?id=' . md5($physician->PhysicianID . "edit")); ?>">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                </div>
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