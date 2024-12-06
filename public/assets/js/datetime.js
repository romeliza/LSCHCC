document.getElementById('currentYear').textContent = new Date().getFullYear();
function updateDateTime() {
  const now = new Date();

  // Date and Time options
  const dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
  const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };

  const dateString = now.toLocaleDateString('en-US', dateOptions);
  const timeString = now.toLocaleTimeString('en-US', timeOptions);
  // Combine date and time
  const dateTimeString = `${dateString} | ${timeString}`;

  // Update the element
  document.getElementById('currentDateTime').textContent = dateTimeString;
}
// Update date and time every second
setInterval(updateDateTime, 1000);

// Initial update
updateDateTime();

