<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Patients <span>| <a href="<?= base_url() ?>patient">View</a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" data-toggle="tooltip" title="Total number of Events">
                                        <!-- Updated icon for Patients -->
                                        <i class="ri-calendar-event-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $PatientData ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Patients Card -->

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title">Physician <span>| <a href="<?= base_url() ?>physician">View</a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" data-toggle="tooltip" title="Total number of Coaches">
                                        <!-- Updated icon for Physician -->
                                        <i class="ri-user-2-line"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $PhysicianData ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Physician Card -->

                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Medication <span>| <a href="<?= base_url() ?>medication">View</a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" data-toggle="tooltip" title="Total number of Dancers">
                                        <!-- Updated icon for Medication -->
                                        <i class="bi bi-capsule"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $MedicationData ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Medication Card -->
                </div>
           
                    </div>
            </div>
          
            <!-- Right side columns -->
         
        </div>
    </section>
</main>

e