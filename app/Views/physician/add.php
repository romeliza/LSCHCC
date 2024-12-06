<main id="main" class="main">
  <div class="pagetitle">
    <h1>Physician</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>physician">Physician</a></li>
        <li class="breadcrumb-item active">Add</li>
      </ol>
    </nav>
  </div>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Create Physician</h5>
          </div>
          <div class="card-body mt-4">
            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <form action="<?= base_url() ?>physician/add" method="POST" novalidate>
              <?= csrf_field() ?>
<!-- Last Name -->
<div class="mb-1">
  <label for="lastname" class="form-label">Last Name</label>
  <input type="text" class="form-control <?= isset($validation) && $validation->getError('Lastname') ? 'is-invalid' : '' ?>" id="lastname" name="Lastname" value="<?= set_value('Lastname') ?>" required>
  <?php if (isset($validation) && $validation->getError('Lastname')): ?>
    <div class="invalid-feedback"><?= $validation->getError('Lastname') ?></div>
  <?php endif; ?>
</div>

<!-- First Name -->
<div class="mb-1">
  <label for="firstname" class="form-label">First Name</label>
  <input type="text" class="form-control <?= isset($validation) && $validation->getError('Firstname') ? 'is-invalid' : '' ?>" id="firstname" name="Firstname" value="<?= set_value('Firstname') ?>" required>
  <?php if (isset($validation) && $validation->getError('Firstname')): ?>
    <div class="invalid-feedback"><?= $validation->getError('Firstname') ?></div>
  <?php endif; ?>
</div>

<!-- Middle Name -->
<div class="mb-1">
  <label for="middlename" class="form-label">Middle Name</label>
  <input type="text" class="form-control <?= isset($validation) && $validation->getError('Middlename') ? 'is-invalid' : '' ?>" id="middlename" name="Middlename" value="<?= set_value('Middlename') ?>" required>
  <?php if (isset($validation) && $validation->getError('Middlename')): ?>
    <div class="invalid-feedback"><?= $validation->getError('Middlename') ?></div>
  <?php endif; ?>
</div>

<!-- Phone Number -->
<div class="mb-1">
  <label for="phonenumber" class="form-label">Phone Number</label>
  <input type="tel" class="form-control <?= isset($validation) && $validation->getError('ContactNumber') ? 'is-invalid' : '' ?>" id="phonenumber" name="ContactNumber" value="<?= set_value('ContactNumber') ?>" pattern="^\d{11}$" maxlength="11" required>
  <?php if (isset($validation) && $validation->getError('ContactNumber')): ?>
    <div class="invalid-feedback"><?= $validation->getError('ContactNumber') ?></div>
  <?php endif; ?>
</div>

<!-- Specialization -->
<div class="mb-1">
  <label for="specialization" class="form-label">Specialization</label>
  <input type="text" class="form-control <?= isset($validation) && $validation->getError('Specialization') ? 'is-invalid' : '' ?>" id="specialization" name="Specialization" value="<?= set_value('Specialization') ?>" required>
  <?php if (isset($validation) && $validation->getError('Specialization')): ?>
    <div class="invalid-feedback"><?= $validation->getError('Specialization') ?></div>
  <?php endif; ?>
</div>

<!-- Email -->
<div class="mb-2">
  <label for="email" class="form-label">Email</label>
  <input type="email" class="form-control <?= isset($validation) && $validation->getError('Email') ? 'is-invalid' : '' ?>" id="email" name="Email" value="<?= set_value('Email') ?>" required>
  <?php if (isset($validation) && $validation->getError('Email')): ?>
    <div class="invalid-feedback"><?= $validation->getError('Email') ?></div>
  <?php endif; ?>
</div>


              <!-- Buttons -->
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">Save</button>
                <a href="<?= base_url() ?>physician" class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  // Phone number input handling (ensuring only numbers, limit to 11 digits)
  document.getElementById('phonenumber').addEventListener('input', function (e) {
    this.value = this.value.replace(/\D/g, '').slice(0, 11);
  });
</script>
