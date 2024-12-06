<!-- Patient Details Modal -->
<div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-labelledby="patientDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="patientDetailsModalLabel">Patient Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Personal Information Section -->
                <h6 class="text-muted mb-3">Personal Information</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Full Name:</strong> <span id="patientFullName" class="fw-bold"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Sex:</strong> <span id="patientSex"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Contact Number:</strong> <span id="patientContact"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Address:</strong> <span id="patientAddress"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Civil Status:</strong> <span id="patientCivilStatus"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Religion:</strong> <span id="patientReligion"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Date of Birth:</strong> <span id="patientDOB"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Place of Birth:</strong> <span id="patientPlaceOfBirth"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Occupation:</strong> <span id="patientOccupation"></span>
                    </div>
                </div>
                <hr class="my-4">
                
                <!-- Additional Details Section -->
                <h6 class="text-muted mb-3">Additional Details</h6>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Patient Status:</strong> <span id="patientStatus" ></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Hospital Case No:</strong> <span id="patientCaseNo"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Physician:</strong> <span id="patientPhysician"></span>
                        <small class="text-muted"><span id="patientSpecialization"></span></small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Head of Family / Guardian:</strong> <span id="patientHeadOfFamily"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Adult History:</strong> <span id="patientAdultHistory"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Pediatric History:</strong> <span id="patientPediatricHistory"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Patient DateTime:</strong> <span id="patientDateTime"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Chief Complaint:</strong> <span id="patientChiefComplaint"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Initial Diagnosis:</strong> <span id="patientInitialDiagnosis"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Treatment:</strong> <span id="patientTreatment"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Blood Pressure:</strong> <span id="patientBP"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Temperature:</strong> <span id="patientTemperature"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Pulse Rate:</strong> <span id="patientPulseRate"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Respiratory Rate:</strong> <span id="patientRespiratoryRate"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Oxygen Saturation:</strong> <span id="patientOxygenSaturation"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Weight:</strong> <span id="patientWeight"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Height:</strong> <span id="patientHeight"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var patientDetailsModal = document.getElementById('patientDetailsModal');
        patientDetailsModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            
            // Retrieve data attributes
            var patientFullName = button.getAttribute('data-patient-full-name');
            var patientSex = button.getAttribute('data-patient-sex');
            var patientContact = button.getAttribute('data-patient-contact');
            var patientAddress = button.getAttribute('data-patient-address');
            var patientCivilStatus = button.getAttribute('data-patient-civil-status');
            var patientReligion = button.getAttribute('data-patient-religion');
            var patientDOB = button.getAttribute('data-patient-dob');
            var patientPlaceOfBirth = button.getAttribute('data-patient-place-of-birth');
            var patientOccupation = button.getAttribute('data-patient-occupation');
            var patientStatus = button.getAttribute('data-patient-status');
            var patientCaseNo = button.getAttribute('data-patient-case-no');
            var patientPhysician = button.getAttribute('data-patient-physician');
            var patientSpecialization = button.getAttribute('data-patient-specialization');
            var patientHeadOfFamily = button.getAttribute('data-patient-head-of-family');
            var patientAdultHistory = button.getAttribute('data-patient-adult-history');
            var patientPediatricHistory = button.getAttribute('data-patient-pediatric-history');
            var patientDateTime = button.getAttribute('data-patient-date-time');
            var patientChiefComplaint = button.getAttribute('data-patient-chief-complaint');
            var patientInitialDiagnosis = button.getAttribute('data-patient-initial-diagnosis');
            var patientTreatment = button.getAttribute('data-patient-treatment');
            var patientBP = button.getAttribute('data-patient-bp');
            var patientTemperature = button.getAttribute('data-patient-temperature');
            var patientPulseRate = button.getAttribute('data-patient-pulse-rate');
            var patientRespiratoryRate = button.getAttribute('data-patient-respiratory-rate');
            var patientOxygenSaturation = button.getAttribute('data-patient-oxygen-saturation');
            var patientWeight = button.getAttribute('data-patient-weight');
            var patientHeight = button.getAttribute('data-patient-height');
            
            // Populate modal fields
            document.getElementById('patientFullName').textContent = patientFullName;
            document.getElementById('patientSex').textContent = patientSex;
            document.getElementById('patientContact').textContent = patientContact;
            document.getElementById('patientAddress').textContent = patientAddress;
            document.getElementById('patientCivilStatus').textContent = patientCivilStatus;
            document.getElementById('patientReligion').textContent = patientReligion;
            document.getElementById('patientDOB').textContent = patientDOB;
            document.getElementById('patientPlaceOfBirth').textContent = patientPlaceOfBirth;
            document.getElementById('patientOccupation').textContent = patientOccupation;
            document.getElementById('patientStatus').textContent = patientStatus;
            document.getElementById('patientCaseNo').textContent = patientCaseNo;
            document.getElementById('patientPhysician').textContent = patientPhysician;
            document.getElementById('patientSpecialization').textContent = patientSpecialization;
            document.getElementById('patientHeadOfFamily').textContent = patientHeadOfFamily;
            document.getElementById('patientAdultHistory').textContent = patientAdultHistory;
            document.getElementById('patientPediatricHistory').textContent = patientPediatricHistory;
            document.getElementById('patientDateTime').textContent = patientDateTime;
            document.getElementById('patientChiefComplaint').textContent = patientChiefComplaint;
            document.getElementById('patientInitialDiagnosis').textContent = patientInitialDiagnosis;
            document.getElementById('patientTreatment').textContent = patientTreatment;
            document.getElementById('patientBP').textContent = patientBP;
            document.getElementById('patientTemperature').textContent = patientTemperature;
            document.getElementById('patientPulseRate').textContent = patientPulseRate;
            document.getElementById('patientRespiratoryRate').textContent = patientRespiratoryRate;
            document.getElementById('patientOxygenSaturation').textContent = patientOxygenSaturation;
            document.getElementById('patientWeight').textContent = patientWeight;
            document.getElementById('patientHeight').textContent = patientHeight;
        });
    });
</script>
<style>
    /* Prevent overflow and ensure text is wrapped */
.modal-body span {
    white-space: normal; /* Allow text to wrap */
    word-wrap: break-word; /* Break long words if necessary */
    overflow-wrap: break-word; /* Ensure long text breaks into multiple lines */
    display: block; /* Make each span take up a full line */
    word-break: break-word; /* Prevent words from overflowing the container */
}

/* Optional: Apply a max-width to the columns to prevent excessive width */
.modal-body .col-md-6 {
    max-width: 100%; /* Ensure each column takes up available space */
    word-wrap: break-word; /* Wrap text inside columns */
}

</style>