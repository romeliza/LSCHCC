<main id="main" class="main">
    <div class="pagetitle">
        <h1>Completed Intake Medication</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Completed Intake Medication</li>
            </ol>
        </nav>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">List of Completed Intake Medication</h4>
                    </div>
                    <div class="card-body">
                        <!-- Table -->
                        <div class="table-responsive mt-3">
                            <table class="table table-hover table-bordered" id="MIMTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">Patient Name</th>
                                        <th class="text-center">Medication Name</th>
                                        <th class="text-center">Dosage</th>
                                        <th class="text-center">Remark</th>
                                        <th class="text-center">Intake Dates</th>
                                        <th class="text-center">Intake Times</th>
                                        <th class="text-center">Date/Time</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($completedIntakes)): ?>
                                        <?php foreach ($completedIntakes as $intake): ?>
                                            <tr>
                                                <td class="text-center">
                                                    <?= esc($intake->Firstname . ' ' . $intake->Lastname) ?>
                                                </td>
                                                <td class="text-center"><?= esc($intake->MedicationName) ?></td>
                                                <td class="text-center"><?= esc($intake->Dosage) ?></td>
                                                <td class="text-center"><?= esc($intake->Remark) ?></td>

                                                <!-- Table Row for Dates -->
                                                <td class="text-center">
                                                    <?php 
                                                    $dates = explode(',', $intake->IntakeDates);
                                                    if (strlen(implode(', ', $dates)) > 30): // Check if concatenated string exceeds 30 characters ?>
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#intakeDatesModal" data-dates="<?= esc(implode(',', $dates)) ?>">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    <?php else: 
                                                        $formattedDates = array_map(function($date) {
                                                            return (new DateTime($date))->format('M d, Y');
                                                        }, $dates);
                                                        echo implode(', ', $formattedDates); // Show values if not exceeding
                                                    endif; ?>
                                                </td>

                                                <!-- Table Row for Times -->
                                                <td class="text-center">
                                                    <?php if (strlen($intake->IntakeTimes) > 25): // Check if string length exceeds 25 ?>
                                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#intakeTimesModal" data-times="<?= esc($intake->IntakeTimes) ?>">
                                                            <i class="bi bi-eye"></i>
                                                        </button>
                                                    <?php else: 
                                                        echo esc($intake->IntakeTimes); // Show values if not exceeding
                                                    endif; ?>
                                                </td>

                                                <!-- Date/Time Column -->
                                                <td class="text-center">
                                                    <?php 
                                                    $formattedDate = date('M d, Y', strtotime($intake->Date));
                                                    $formattedTime = date('h:i A', strtotime($intake->Time));
                                                    echo esc($formattedDate) . ' - ' . esc($formattedTime);
                                                    ?>
                                                </td>

                                                <!-- Status Column -->
                                                <td class="text-center">
                                                    <?= esc($intake->IntakeStatus) ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">No completed intakes found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- Modal for Intake Dates -->
<div class="modal fade" id="intakeDatesModal" tabindex="-1" aria-labelledby="intakeDatesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="intakeDatesModalLabel">All Intake Dates</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="intakeDatesContent"></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Intake Times -->
<div class="modal fade" id="intakeTimesModal" tabindex="-1" aria-labelledby="intakeTimesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="intakeTimesModalLabel">All Intake Times</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="intakeTimesContent"></p>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to fill the modals dynamically -->
<script>
    // Script to handle modal content for Intake Dates
    document.getElementById('intakeDatesModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var dates = button.getAttribute('data-dates'); // Get the dates from data-* attribute
        var modalBody = document.getElementById('intakeDatesContent');
        modalBody.textContent = dates; // Insert dates into modal content
    });

    // Script to handle modal content for Intake Times
    document.getElementById('intakeTimesModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var times = button.getAttribute('data-times'); // Get the times from data-* attribute
        var modalBody = document.getElementById('intakeTimesContent');
        modalBody.textContent = times; // Insert times into modal content
    });
</script>
