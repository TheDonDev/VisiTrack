import './bootstrap';

// Function to check visit status
function checkVisitStatus() {
    const visitNumber = document.getElementById('visit_number').value;

    if (!visitNumber) {
        alert('Please enter a visit number.');
        return;
    }

    // Redirect to the visit status page
    window.location.href = `/visit-status/${visitNumber}`;
}

// Attach event listener to the check status button
document.getElementById('check_status_button').addEventListener('click', checkVisitStatus);
