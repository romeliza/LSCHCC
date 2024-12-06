document.addEventListener('DOMContentLoaded', function() {
    const filterButton = document.getElementById('filterButton');
    const cancelButton = document.getElementById('cancelButton');

    filterButton.addEventListener('click', function() {
        const schoolID = document.getElementById('SchoolID').value;
        const gradeID = document.getElementById('GradeID').value;
        
        const rows = document.querySelectorAll('#studentTable tbody tr');

        rows.forEach(row => {
            const rowSchoolID = row.getAttribute('data-school-id');
            const rowGradeID = row.getAttribute('data-grade-id');

            if ((schoolID === '' || rowSchoolID === schoolID) &&
                (gradeID === '' || rowGradeID === gradeID)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    cancelButton.addEventListener('click', function() {
const rows = document.querySelectorAll('#studentTable tbody tr');
rows.forEach(row => {
    row.style.display = '';
});

// Reset School and Grade select boxes
$('#SchoolID').select2('val', ''); // Use the val method to set the selected value to an empty string
$('#GradeID').select2('val', ''); // Use the val method to set the selected value to an empty string
});
});