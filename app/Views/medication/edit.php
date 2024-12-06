<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Medication</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url() ?>medication">Medication</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div>

  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card shadow-sm border-0">
          <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Medication</h5>
          </div>
          <div class="card-body mt-4">
            <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <form action="<?= base_url() ?>medication/edit" method="POST" novalidate>
              <?= csrf_field() ?>

              <!-- Hidden MedicationID -->
              <input type="hidden" name="MedicationID" value="<?= $MedicationDetails->MedicationID; ?>">

              <!-- Medication Name -->
              <div class="mb-1">
                <label for="medicationname" class="form-label">Medication Name</label>
                <input type="text" class="form-control <?= isset($MedicationDetails->validationErrors['MedicationName']) ? 'is-invalid' : '' ?>" id="medicationname" name="MedicationName" value="<?= set_value('MedicationName', $MedicationDetails->MedicationName) ?>" required>
                <?php if (isset($MedicationDetails->validationErrors['MedicationName'])): ?>
                  <div class="invalid-feedback"><?= $MedicationDetails->validationErrors['MedicationName'] ?></div>
                <?php endif; ?>
              </div>

              <!-- Dosage -->
              <div class="mb-1">
                <label for="dosage" class="form-label">Dosage</label>
                <input type="text" class="form-control <?= isset($MedicationDetails->validationErrors['Dosage']) ? 'is-invalid' : '' ?>" id="dosage" name="Dosage" value="<?= set_value('Dosage', $MedicationDetails->Dosage) ?>" required>
                <?php if (isset($MedicationDetails->validationErrors['Dosage'])): ?>
                  <div class="invalid-feedback"><?= $MedicationDetails->validationErrors['Dosage'] ?></div>
                <?php endif; ?>
              </div>

              <!-- Buttons -->
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">Save Changes</button>
                <a href="<?= base_url() ?>medication" class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
