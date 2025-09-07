// This file makes the delete buttons work properly

function confirmDelete(type, user_id) {
    if (confirm("Are you sure you want to delete this " + type + "?")) {
        window.location.href = "delete_employee.php?user_id=" + user_id;
    }
}


// Show success messages nicely
function showMessage(message, type) {
    var messageDiv = document.createElement('div');
    messageDiv.className = 'message ' + type;
    messageDiv.textContent = message;
    
    // Add to top of main content
    var main = document.querySelector('main');
    main.insertBefore(messageDiv, main.firstChild);
    
    // Remove message after 3 seconds
    setTimeout(function() {
        messageDiv.remove();
    }, 3000);
}