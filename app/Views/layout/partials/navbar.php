<!-- views/partials/navbar.php -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="<?= base_url() ?>dashboard" class="navbar-brand">
            LAKE SEBU COMMUNITY HEALTH CARE COMPLEX
        </a>
        <button id="sidebarToggleBtn" class="btn bi bi-list toggle-sidebar-btn d-flex align-items-center justify-content-center" aria-label="Toggle sidebar"></button>
    </div>
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <!-- Time Display -->
            <li class="nav-item d-none d-lg-block ms-1">
                <span id="currentDateTime" class="nav-link"></span>
            </li>
            <!-- Profile Dropdown -->
            <li class="nav-item dropdown pe-3 nav-profile d-flex ms-5">
                <?php $userData = session()->get('userData'); ?>
                <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $userData->Username ?? 'Account' ?> 
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center text-dark" href="<?= base_url() ?>profile">
                            <i class="bi bi-person-fill pe-2"></i> <!-- Profile Icon -->
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center text-dark" href="<?= base_url() ?>logout">
                            <i class="bi bi-box-arrow-right pe-2"></i> <!-- Logout Icon -->
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<aside id="sidebar" class="sidebar" role="navigation" aria-label="Main Navigation">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">| Main</li>

        <!-- Administrator Access -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('dashboard') ?>" aria-current="page">
                <i class="bi bi-house-door-fill" aria-hidden="true"></i> <!-- Dashboard Icon -->
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('patient') ?>">
                <i class="bi bi-person-fill" aria-hidden="true"></i> <!-- Patient Icon -->
                <span>Patients</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('physician') ?>">
                <i class="bi bi-person-badge" aria-hidden="true"></i> <!-- Physician Icon -->
                <span>Physicians</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('medication') ?>">
                <i class="bi bi-capsule"></i>
                <span>Medications</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#medicationIntakeDropdown" aria-expanded="false" aria-controls="medicationIntakeDropdown">
                <i class="bi bi-capsule"></i> <!-- Medication Icon -->
                <span>Medication Intake</span>
                <i class="bi bi-chevron-down ms-auto"></i> <!-- Chevron icon for dropdown -->
            </a>
            <div class="collapse" id="medicationIntakeDropdown">
                <ul class="list-unstyled ms-3">
                    <!-- Add Patient Intake -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('medicationIntake') ?>">
                            <i class="bi bi-person-plus me-2"></i> <!-- Add Patient Icon -->
                            <span>Add Patient Intake</span>
                        </a>
                    </li>
                    <!-- Today's Completed Intakes -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('medicationIntake/completed') ?>">
                            <i class="bi bi-check-circle me-2"></i> <!-- Completed Icon -->
                            <span>Completed Intakes</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('report') ?>">
                <i class="bi bi-file-earmark-text" aria-hidden="true"></i> <!-- Report Icon -->
                <span>Reports</span>
            </a>
        </li>

        <li class="nav-heading">| Account</li>
        <?php if ($userData->Role == 'Administrator'): ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('user') ?>">
                    <i class="bi bi-person-lines-fill" aria-hidden="true"></i> <!-- User Management Icon -->
                    <span>User Management</span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('logout') ?>">
                <i class="bi bi-door-open-fill"></i> <!-- Logout Icon -->
                <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>


<script>
// Get the current URL path
const currentPath = window.location.pathname.split('/').pop();

// Get all navigation links
const navLinks = document.querySelectorAll('.sidebar-nav a');

// Add active class to the link that matches the current path
navLinks.forEach(link => {
  const href = link.getAttribute('href').split('/').pop();

  // Check for "dancer" specific links and match their paths
  if (href === currentPath || 
      (currentPath === '' && href === 'dashboard') || 
      (currentPath.includes('event') && href === 'event/index') || 
      (currentPath.includes('application') && href === 'application/index')) {
    
    link.parentNode.classList.add('active');

    // If the link is inside a dropdown, ensure the parent dropdown is shown
    const collapseElement = link.closest('.collapse');
    if (collapseElement) {
      collapseElement.classList.add('show');
      const parentToggleLink = document.querySelector(`[data-bs-target="#${collapseElement.id}"]`);
      if (parentToggleLink) {
        parentToggleLink.classList.remove('collapsed');
      }
    }
  }
});

// Add event listener to each link to manage active class
navLinks.forEach(link => {
  link.addEventListener('click', event => {
    // Remove active class from all links
    navLinks.forEach(l => l.parentNode.classList.remove('active'));

    // Add active class to the clicked link's parent li element
    event.target.parentNode.classList.add('active');
  });
});

</script>
