<main id="main" class="main">
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <!-- Profile Account Information Card -->
            <div class="card mb-4 col-lg-8 col-md-10 col-12">
                <h5 class="card-header">Profile Account Information</h5>
                <div class="card-body">
                    <!-- Alerts -->
                    <?php if (session()->getFlashdata('success')): ?>
                        <div id="successAlert" class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            <?= session()->getFlashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div id="errorAlert" class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <?= session()->getFlashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('profile/update') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="UserID" value="<?= set_value('UserID', $user->UserID ?? '') ?>">

                        <div class="row mb-4">
                            <div class="form-group col-md-4 mb-3">
                                <label for="lastname" class="form-label fw-bold">Last Name</label>
                                <input type="text" id="lastname" placeholder="Enter Last Name" class="form-control 
                                <?= isset($validation) && $validation->hasError('LastName') ? 'is-invalid' : '' ?>" 
                                name="LastName" aria-label="LastName" value="<?= set_value('LastName', $user->LastName ?? '') ?>">
                                <?php if (isset($validation) && $validation->hasError('LastName')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('LastName') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label for="firstname" class="form-label fw-bold">First Name</label>
                                <input type="text" id="firstname" placeholder="Enter First Name" class="form-control 
                                <?= isset($validation) && $validation->hasError('FirstName') ? 'is-invalid' : '' ?>" 
                                name="FirstName" aria-label="FirstName" value="<?= set_value('FirstName', $user->FirstName ?? '') ?>">
                                <?php if (isset($validation) && $validation->hasError('FirstName')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('FirstName') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label for="middlename" class="form-label fw-bold">Middle Name</label>
                                <input type="text" id="middlename" placeholder="Enter Middle Name" class="form-control 
                                <?= isset($validation) && $validation->hasError('MiddleName') ? 'is-invalid' : '' ?>" 
                                name="MiddleName" aria-label="MiddleName" value="<?= set_value('MiddleName', $user->MiddleName ?? '') ?>">
                                <?php if (isset($validation) && $validation->hasError('MiddleName')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('MiddleName') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="form-group col-6 mb-3">
                                <label for="username" class="form-label fw-bold">Username</label>
                                <input type="text" id="username" placeholder="Enter Username" class="form-control <?= isset($validation) && $validation->hasError('Username') ? 'is-invalid' : '' ?>" name="Username" aria-label="Username" value="<?= set_value('Username', $user->Username ?? '') ?>">
                                <?php if (isset($validation) && $validation->hasError('Username')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('Username') ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-6 mb-3">
                                <label for="PhoneNumber" class="form-label fw-bold">Contact Number</label>
                                <input type="text" id="PhoneNumber" placeholder="Enter Contact Number" class="form-control <?= isset($validation) && $validation->hasError('PhoneNumber') ? 'is-invalid' : '' ?>" name="PhoneNumber" aria-label="Contact Number" value="<?= set_value('PhoneNumber', $user->PhoneNumber ?? '') ?>">
                                <?php if (isset($validation) && $validation->hasError('PhoneNumber')): ?>
                                    <div class="invalid-feedback"><?= $validation->getError('PhoneNumber') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-3">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="editPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="editPassword" name="Password" placeholder="Leave blank to keep current password">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="editConfirmedPassword" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="editConfirmedPassword" name="ConfirmedPassword" placeholder="Leave blank to keep current password">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <label for="region" class="form-label">Region</label>
                                    <select id="region" name="region" class="form-select form-select-sm <?= isset($validation) && $validation->getError('region') ? 'is-invalid' : '' ?>" data-initial-value="<?= set_value('region', $user->region ?? ''); ?>">

                                        <option value="">Select Region</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->getError('region')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('region') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="province" class="form-label">Province</label>
                                    <select id="province" name="province" class="form-select form-select-sm <?= isset($validation) && $validation->getError('province') ? 'is-invalid' : '' ?>" data-initial-value="<?= set_value('province', $user->province); ?>">
                                        <option value="">Select Province</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->getError('province')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('province') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-md-6">
                                    <label for="municipality" class="form-label">Municipality/City</label>
                                    <select id="municipality" name="municipality" class="form-select form-select-sm <?= isset($validation) && $validation->getError('municipality') ? 'is-invalid' : '' ?>" data-initial-value="<?= set_value('municipality', $user->municipality); ?>">
                                        <option value="">Select Municipality/City</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->getError('municipality')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('municipality') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <label for="Barangay" class="form-label">Barangay</label>
                                    <select id="Barangay" name="barangay" class="form-select form-select-sm <?= isset($validation) && $validation->getError('barangay') ? 'is-invalid' : '' ?>" data-initial-value="<?= set_value('barangay', $user->barangay); ?>">
                                        <option value="">Select Barangay</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->getError('barangay')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('barangay') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>



                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary px-4">Update Profile</button>
                            <button type="button" class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#deactivateModal">Deactivate Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Deactivate Modal -->
    <div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactivateModalLabel">Deactivate Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to deactivate your account? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="<?= base_url('profile/deactivate') ?>" method="POST">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Deactivate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    // Hide alerts after a few seconds
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = '0';
            setTimeout(() => { successAlert.style.display = 'none'; }, 1000);
        }, 2000);
    }

    const errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.opacity = '0';
            setTimeout(() => { errorAlert.style.display = 'none'; }, 1000);
        }, 2000);
    }
</script>
