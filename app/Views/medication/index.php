<main id="main" class="main">
      <!-- Page Title -->
      <div class="pagetitle">
        <h1>Medication</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Medication</li>
            </ol>
        </nav>
    </div>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">List of Medication</h4>
                        
                        <a class="btn btn-success" href="<?= base_url() ?>medication/add">
                            <i class="bi bi-person-plus"></i> Add Medication
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
                                        <th class="text-center">Medication Name</th>
                                        <th class="text-center">Dosage</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Updated At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($MedicationData as $medication): ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= htmlspecialchars($medication->MedicationName ) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars($medication->Dosage) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= htmlspecialchars($medication->created_at) ?>
                                            </td> 
                                            <td class="text-center">
                                                <?= htmlspecialchars($medication->updated_at) ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                   
                                                    <a class="btn btn-primary btn-sm me-1" 
                                                       href="<?= base_url('medication/edit?id=' . md5($medication->MedicationID . "edit")); ?>">
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

