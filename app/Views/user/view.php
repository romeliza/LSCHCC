<!-- User Detail View Modal -->
<div class="modal fade" id="userDetailModal" tabindex="-1" aria-labelledby="userDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userDetailModalLabel">User Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Display User Details in a Structured Row and Column Layout -->
        <div class="row mb-3">
          <div class="col-4"><strong>Last Name:</strong></div>
          <div class="col-8" id="modalLastName"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>First Name:</strong></div>
          <div class="col-8" id="modalFirstName"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>Middle Name:</strong></div>
          <div class="col-8" id="modalMiddleName"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>Region:</strong></div>
          <div class="col-8" id="modalRegion"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>Province:</strong></div>
          <div class="col-8" id="modalProvince"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>Municipality:</strong></div>
          <div class="col-8" id="modalMunicipality"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>Barangay:</strong></div>
          <div class="col-8" id="modalBarangay"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>Username:</strong></div>
          <div class="col-8" id="modalUsername"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>Phone Number:</strong></div>
          <div class="col-8" id="modalPhoneNumber"></div>
        </div>
        <div class="row mb-3">
          <div class="col-4"><strong>Role:</strong></div>
          <div class="col-8" id="modalRole"></div>
        </div>
        <!-- Password and confirm password fields are removed for view-only -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var userDetailModal = document.getElementById('userDetailModal');
        
        userDetailModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var userID = button.getAttribute('data-userid');
            var lastName = button.getAttribute('data-lastname');
            var firstName = button.getAttribute('data-firstname');
            var middleName = button.getAttribute('data-middlename');
            var region = button.getAttribute('data-region');
            var province = button.getAttribute('data-province');
            var municipality = button.getAttribute('data-municipality');
            var barangay = button.getAttribute('data-barangay');
            var username = button.getAttribute('data-username');
            var phoneNumber = button.getAttribute('data-phonenumber');
            var role = button.getAttribute('data-role');

            // Set modal fields with user data
            document.getElementById('modalLastName').innerText = lastName;
            document.getElementById('modalFirstName').innerText = firstName;
            document.getElementById('modalMiddleName').innerText = middleName;
            document.getElementById('modalRegion').innerText = region;
            document.getElementById('modalProvince').innerText = province;
            document.getElementById('modalMunicipality').innerText = municipality;
            document.getElementById('modalBarangay').innerText = barangay;
            document.getElementById('modalUsername').innerText = username;
            document.getElementById('modalPhoneNumber').innerText = phoneNumber;
            document.getElementById('modalRole').innerText = role;
        });
    });
</script>
