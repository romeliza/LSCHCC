<main id="main" class="main">
    <div class="pagetitle">
        <h1>User Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url() ?>user">User Management</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Edit User</h4>
                    </div>
                    <div class="card-body">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('error'); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('user/edit') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="UserID" value="<?= set_value('UserID', $UserDetails->UserID); ?>">
                            <div class="row">
                                <?php
                                $fields = [
                                    'LastName' => 'Last Name',
                                    'FirstName' => 'First Name',
                                    'MiddleName' => 'Middle Name'
                                ];
                                foreach ($fields as $field => $label) : ?>
                                    <div class="col-md-4 mb-3">
                                        <label for="<?= strtolower($field) ?>" class="form-label"><?= $label ?></label>
                                        <input type="text" class="form-control <?= isset($validation) && $validation->getError($field) ? 'is-invalid' : '' ?>" 
                                               id="<?= strtolower($field) ?>" name="<?= $field ?>" value="<?= set_value($field, $UserDetails->{$field}) ?>">
                                        <?php if (isset($validation) && $validation->getError($field)) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError($field) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="editUsername" class="form-label">Username</label>
                                <input type="text" class="form-control <?= isset($validation) && $validation->getError('Username') ? 'is-invalid' : '' ?>" id="editUsername" name="Username" value="<?= set_value('Username', $UserDetails->Username) ?>">
                                <div class="invalid-feedback"><?= validation_show_error('Username') ?></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="editPhoneNumber" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control <?= isset($validation) && $validation->getError('PhoneNumber') ? 'is-invalid' : '' ?>" id="editPhoneNumber" name="PhoneNumber" maxlength="11" value="<?= set_value('PhoneNumber', $UserDetails->PhoneNumber) ?>">
                                <div class="invalid-feedback"><?= validation_show_error('PhoneNumber') ?></div>
                            </div>
                            <div class="col-md-4">
    <label for="role" class="form-label">Role</label>
    <select 
        class="form-control <?= isset($validation) && $validation->getError('Role') ? 'is-invalid' : '' ?>" 
        id="role" 
        name="Role" 
        required>
        <option value="">Select Role</option>
        <option value="Administrator" <?= set_select('Role', 'Administrator', $UserDetails->Role === 'Administrator') ?>>Administrator</option>
        <option value="Registered Nurse" <?= set_select('Role', 'Registered Nurse', $UserDetails->Role === 'Registered Nurse') ?>>Registered Nurse</option>
    </select>
    <?php if (isset($validation) && $validation->getError('Role')): ?>
        <div class="invalid-feedback"><?= $validation->getError('Role') ?></div>
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
                                    <select id="region" name="region" class="form-select form-select-sm <?= isset($validation) && $validation->getError('region') ? 'is-invalid' : '' ?>" data-initial-value="<?= set_value('region', $UserDetails->region); ?>">
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
                                    <select id="province" name="province" class="form-select form-select-sm <?= isset($validation) && $validation->getError('province') ? 'is-invalid' : '' ?>" data-initial-value="<?= set_value('province', $UserDetails->province); ?>">
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
                                    <select id="municipality" name="municipality" class="form-select form-select-sm <?= isset($validation) && $validation->getError('municipality') ? 'is-invalid' : '' ?>" data-initial-value="<?= set_value('municipality', $UserDetails->municipality); ?>">
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
                                    <select id="Barangay" name="barangay" class="form-select form-select-sm <?= isset($validation) && $validation->getError('barangay') ? 'is-invalid' : '' ?>" data-initial-value="<?= set_value('barangay', $UserDetails->barangay); ?>">
                                        <option value="">Select Barangay</option>
                                    </select>
                                    <?php if (isset($validation) && $validation->getError('barangay')): ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('barangay') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-warning me-2" type="submit">Save Changes</button>
                                <a class="btn btn-danger" href="<?= base_url() ?>user">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script>
  document.getElementById('editPhoneNumber').addEventListener('input', function (e) {
    this.value = this.value.replace(/\D/g, '').slice(0, 11);
  });

  // Optional: Client-side validation for passwords matching
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirm_password');
  confirmPassword.addEventListener('input', function() {
    if (password.value !== confirmPassword.value) {
      confirmPassword.setCustomValidity('Passwords do not match');
    } else {
      confirmPassword.setCustomValidity('');
    }
  });
  document.getElementById('editRole').addEventListener('change', function () {
        var selectElement = this;
        var options = selectElement.options;

        // Disable "Select Role" option when a role is selected
        options[0].disabled = selectElement.value !== '';
    });

    // Trigger change event on page load to set the initial state correctly
    document.getElementById('editRole').dispatchEvent(new Event('change'));
</script>

