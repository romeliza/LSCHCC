<main id="main" class="main">
  <div class="pagetitle">
    <h1>User Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>user">User Management</a></li>
        <li class="breadcrumb-item active">Add</li>
      </ol>
    </nav>
  </div>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Create User</h5>
          </div>
          <div class="card-body mt-4">
            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <form action="<?= base_url() ?>user/add" method="POST" novalidate>
              <?= csrf_field() ?>

              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="lastname" class="form-label">Last Name</label>
                  <input type="text" class="form-control <?= isset($validation) && $validation->getError('LastName') ? 'is-invalid' : '' ?>" id="lastname" name="LastName" value="<?= set_value('LastName') ?>">
                  <?php if (isset($validation) && $validation->getError('LastName')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('LastName') ?></div>
                  <?php endif; ?>
                </div>
                <div class="col-md-4">
                  <label for="firstname" class="form-label">First Name</label>
                  <input type="text" class="form-control <?= isset($validation) && $validation->getError('FirstName') ? 'is-invalid' : '' ?>" id="firstname" name="FirstName" value="<?= set_value('FirstName') ?>">
                  <?php if (isset($validation) && $validation->getError('FirstName')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('FirstName') ?></div>
                  <?php endif; ?>
                </div>
                <div class="col-md-4">
                  <label for="middlename" class="form-label">Middle Name</label>
                  <input type="text" class="form-control <?= isset($validation) && $validation->getError('MiddleName') ? 'is-invalid' : '' ?>" id="middlename" name="MiddleName" value="<?= set_value('MiddleName') ?>">
                  <?php if (isset($validation) && $validation->getError('MiddleName')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('MiddleName') ?></div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control <?= isset($validation) && $validation->getError('Username') ? 'is-invalid' : '' ?>" id="username" name="Username" value="<?= set_value('Username') ?>" pattern="[A-Za-z0-9_]{4,15}" required>
                  <?php if (isset($validation) && $validation->getError('Username')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('Username') ?></div>
                  <?php endif; ?>
                </div>
                <div class="col-md-4">
                  <label for="phonenumber" class="form-label">Phone Number</label>
                  <input type="tel" class="form-control <?= isset($validation) && $validation->getError('PhoneNumber') ? 'is-invalid' : '' ?>" id="phonenumber" name="PhoneNumber" maxlength="11" value="<?= set_value('PhoneNumber') ?>" pattern="^\d{11}$" required>
                  <?php if (isset($validation) && $validation->getError('PhoneNumber')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('PhoneNumber') ?></div>
                  <?php endif; ?>
                </div>
                <div class="col-md-4">
                  <label for="role" class="form-label">Role</label>
                  <select class="form-control <?= isset($validation) && $validation->getError('Role') ? 'is-invalid' : '' ?>" id="role" name="Role" required>
                  <option value="">Select Role</option>
                  <option value="Administrator" <?= set_select('Role', 'Administrator') ?>>Administrator</option>
                  <option value="Registered Nurse" <?= set_select('Role', 'Registered Nurse') ?>>Registered Nurse</option>
               
              </select>
                  <?php if (isset($validation) && $validation->getError('Role')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('Role') ?></div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control <?= isset($validation) && $validation->getError('Password') ? 'is-invalid' : '' ?>" id="password" name="Password" minlength="8" required>
                  <?php if (isset($validation) && $validation->getError('Password')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('Password') ?></div>
                  <?php endif; ?>
                </div>
                <div class="col-md-6">
                  <label for="confirm_password" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control <?= isset($validation) && $validation->getError('ConfirmedPassword') ? 'is-invalid' : '' ?>" id="confirm_password" name="ConfirmedPassword" minlength="8" required>
                  <?php if (isset($validation) && $validation->getError('ConfirmedPassword')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('ConfirmedPassword') ?></div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="region" class="form-label">Region</label>
                  <select id="region" class="form-control <?= isset($validation) && $validation->getError('region') ? 'is-invalid' : '' ?>" name="region">
                    <option value="">Select Region</option>
                  </select>
                  <?php if (isset($validation) && $validation->getError('region')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('region') ?></div>
                  <?php endif; ?>
                </div>
                <div class="col-md-6">
                  <label for="province" class="form-label">Province</label>
                  <select id="province" class="form-control <?= isset($validation) && $validation->getError('province') ? 'is-invalid' : '' ?>" name="province">
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
                  <select id="municipality" class="form-control <?= isset($validation) && $validation->getError('municipality') ? 'is-invalid' : '' ?>" name="municipality">
                    <option value="">Select Municipality/City</option>
                  </select>
                  <?php if (isset($validation) && $validation->getError('municipality')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('municipality') ?></div>
                  <?php endif; ?>
                </div>
                <div class="col-md-6">
                  <label for="barangay" class="form-label">Barangay</label>
                  <select id="barangay" class="form-control <?= isset($validation) && $validation->getError('barangay') ? 'is-invalid' : '' ?>" name="barangay">
                    <option value="">Select Barangay</option>
                  </select>
                  <?php if (isset($validation) && $validation->getError('barangay')): ?>
                    <div class="invalid-feedback"><?= $validation->getError('barangay') ?></div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">Save</button>
                <a href="<?= base_url() ?>user" class="btn btn-secondary">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>


<script>
  document.getElementById('phonenumber').addEventListener('input', function (e) {
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
  document.getElementById('role').addEventListener('change', function () {
        var selectElement = this;
        var options = selectElement.options;
        for (var i = 1; i < options.length; i++) {
            if (options[i].selected) {
                options[0].disabled = true;
                return;
            }
        }
        options[0].disabled = false; 
    });
   
    document.getElementById('role').dispatchEvent(new Event('change'));
</script>
