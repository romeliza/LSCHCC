<main id="main" class="main">
    <div class="pagetitle">
    <h1>User Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
                <li class="breadcrumb-item active">User Management</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">List of Users</h4>
                        <a class="btn btn-success" href="<?= base_url() ?>user/add">Add User</a>
                    </div>
                    <div class="card-body">
                        <div class="container mt-3">
                            <?php if (session()->getFlashdata('success')): ?>
                                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <script>
                                    setTimeout(function() {
                                        const successAlert = document.getElementById('successAlert');
                                        if (successAlert) {
                                            successAlert.style.transition = 'opacity 1s';
                                            successAlert.style.opacity = '0';
                                            setTimeout(function() {
                                                successAlert.style.display = 'none';
                                            }, 1000);
                                        }
                                    }, 2000);
                                </script>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('error')): ?>
                                <div id="errorAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('error'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <script>
                                    setTimeout(function() {
                                        const errorAlert = document.getElementById('errorAlert');
                                        if (errorAlert) {
                                            errorAlert.style.transition = 'opacity 1s';
                                            errorAlert.style.opacity = '0';
                                            setTimeout(function() { 
                                                errorAlert.style.display = 'none';
                                            }, 1000);
                                        }
                                    }, 2000);
                                </script>
                            <?php endif; ?>

                            <div class="table-responsive mt-3">
                                <table class="table table-hover table-bordered" id="SISTable">
                                    <thead class="table">
                                        <tr>
                                            <th class="text-center fs-6">Full Name</th>
                                            <th class="text-center fs-6">Username</th>
                                            <th class="text-center fs-6">Phone Number</th>
                                            <th class="text-center fs-6" colspan="2">Status</th>
                                            <th class="text-center fs-6">Role</th>
                                            <th class="text-center fs-6">Date Added</th>
                                            <th class="text-center fs-6">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($UserData as $User): ?>
                                    <tr>
                                        <td class="text-center fs-6"><?= $User->LastName ?>, <?= $User->FirstName ?> <?= $User->MiddleName ?></td>
                                        <td class="text-center fs-6"><?= $User->Username ?></td>
                                        <td class="text-center fs-6"><?= $User->PhoneNumber ?></td>
                                        <td class="text-center fs-6">
                                            <?php if ($User->Status == 0): ?>
                                                <span class="badge bg-danger text-light">Diactive</span>
                                            <?php elseif ($User->Status == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php endif; ?>
                                        </td>
                                     <td class="text-center">
                                            <form action="<?= base_url('user/toggleStatus'); ?>" method="post" style="display: inline;">
                                                <input type="hidden" name="UserID" value="<?= $User->UserID; ?>">
                                                <?php 
                                                $userData = (object) session()->get('userData'); 
                                                $isCurrentUser = ($userData->UserID == $User->UserID); 
                                                ?>
                                                <button type="submit" class="btn btn-warning btn-sm" <?= $isCurrentUser ? 'disabled' : ''; ?>>
                                                    <i class="bi bi-arrow-repeat"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center fs-6">
                                        <?php
                                            switch ($User->Role) {
                                                case 'Administrator':
                                                    echo '<span class="badge bg-primary">Administrator</span>';
                                                    break;
                                                case 'Registered Nurse':
                                                    echo '<span class="badge bg-info">Registered Nurse</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge bg-secondary">Unknown Role</span>';
                                            }
                                        ?>
                                    </td>
                                        <td class="text-center fs-6"><?= $User->Created_at ?></td>
                                        <td class="text-center fs-6" style="width: 200px;">
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-warning btn-sm me-1" href="#" data-bs-toggle="modal" data-bs-target="#userDetailModal"
                                                data-userid="<?= $User->UserID; ?>"
                                                data-lastname="<?= $User->LastName; ?>"
                                                data-firstname="<?= $User->FirstName; ?>"
                                                data-middlename="<?= $User->MiddleName; ?>"
                                                data-region="<?= $User->region; ?>"
                                                data-province="<?= $User->province; ?>"
                                                data-municipality="<?= $User->municipality; ?>"
                                                data-barangay="<?= $User->barangay; ?>"
                                                data-username="<?= $User->Username; ?>"
                                                data-phonenumber="<?= $User->PhoneNumber; ?>"
                                                data-role="<?= $User->Role; ?>">
                                                <i class="bi bi-eye"></i> 
                                            </a>
                                            <a class="btn btn-primary btn-sm me-1" href="<?= base_url('user/edit?id=' . md5($User->UserID . "edit")); ?>">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <?php $isCurrentUser = ((object) session()->get('userData'))->UserID == $User->UserID; ?>
                                           
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteUserModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var userID = button.getAttribute('data-userid');
            var username = button.getAttribute('data-username');
            var modalUserID = deleteModal.querySelector('#deleteUserID');
            var modalUsername = deleteModal.querySelector('#deleteUsername');
            modalUserID.value = userID;
            modalUsername.textContent = username;
        });
    });
</script>
