
    <!-- View Physician Modal -->
    <div class="modal fade" id="viewPhysicianModal" tabindex="-1" aria-labelledby="viewPhysicianModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPhysicianModalLabel">Physician Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Full Name:</strong>
                            <p id="viewFullname"></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Contact Number:</strong>
                            <p id="viewContactNumber"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Specialization:</strong>
                            <p id="viewSpecialization"></p>
                        </div>
                        <div class="col-md-6">
                            <strong>Email:</strong>
                            <p id="viewEmail"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    // Script to populate the view modal with physician details
    const viewPhysicianModal = document.getElementById('viewPhysicianModal');
    viewPhysicianModal.addEventListener('show.bs.modal', (event) => {
        const button = event.relatedTarget;
        const physicianID = button.getAttribute('data-physicianID');
        const fullname = button.getAttribute('data-fullname');
        const contactNumber = button.getAttribute('data-contactnumber');
        const specialization = button.getAttribute('data-specialization');
        const email = button.getAttribute('data-email');
        
        // Set the modal content
        document.getElementById('viewFullname').textContent = fullname;
        document.getElementById('viewContactNumber').textContent = contactNumber;
        document.getElementById('viewSpecialization').textContent = specialization;
        document.getElementById('viewEmail').textContent = email;
    });
</script>