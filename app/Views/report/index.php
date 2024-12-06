 <main id="main" class="main">
    <div class="pagetitle">
        <h1>Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">
        <div class="row">
            
        <div class="col-xxl-4 col-md-6">
                        <div class="card info-card opd-card">
                            <div class="card-body">
                                <h5 class="card-title">OPD <span>| <a href="<?= base_url() ?>report/opd">View</a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" data-toggle="tooltip" title="Total number of OPD">
                                       
                                        <i class="bi bi-hospital"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $OPDData ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card admission-card">
                            <div class="card-body">
                                <h5 class="card-title">Admission <span>| <a href="<?= base_url() ?>report/admission">View</a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" data-toggle="tooltip" title="Total Admissions">
                                        
                                        <i class="bi bi-person-plus"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $AdmissionData ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card discharged-card">
                            <div class="card-body">
                                <h5 class="card-title">Discharged <span>| <a href="<?= base_url() ?>report/discharged">View</a></span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center" data-toggle="tooltip" title="Total Discharged Patients">
                                       
                                        <i class="bi bi-x-circle"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $DischargedData ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                 
                </div>
            </div>
        </div>
    </section>
</main> 
