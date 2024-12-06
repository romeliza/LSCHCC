
<div class="container-fluid p-0">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="row justify-content-center w-100">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
          <!-- Card Section -->
          <div class="card mb-3 gradient-border">
            <div class="d-flex justify-content-center">
              <img src="<?= base_url('public/image/LSCHCC.png') ?>" alt="Logo" class="img-fluid" style="max-width: 250px;">
            </div>
            <div class="card-body">
              <div class="pt-4 pb-2">
                <h5 class="card-title gradient-text text-center pb-0 fs-4">LAKE SEBU COMMUNITY HEALTH CARE COMPLEX</h5>
                <h5 class="card-title gradient-text text-center fs-5">GONO MULUNG</h5>
              </div>

              <!-- Success Alert -->
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

              <!-- Error Alert -->
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

              <!-- Login Form -->
              <form action="<?= base_url() ?>login" method="POST" class="row g-3 needs-validation" novalidate>
                <div class="col-12">
                  <label for="username" class="form-label">Username</label>
                  <div class="input-group has-validation">
                    <input type="text" class="form-control input-gradient-border" id="username" name="Username"
                      value="<?= set_value('Username') ?>" placeholder="Enter your username" required>
                    <div class="invalid-feedback">Please enter your username.</div>
                  </div>
                </div>

                <div class="col-12">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control input-gradient-border" id="password" name="Password"
                    value="<?= set_value('Password') ?>" placeholder="Enter your password" required>
                  <div class="invalid-feedback">Please enter your password!</div>
                </div>

                <div class="col-12">
                  <button class="btn gradient-btn w-100" type="submit">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>