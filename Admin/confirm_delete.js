// This file makes the delete buttons work properly

function confirmDelete(type, id) {
    // Ask user if they're sure they want to delete
    var message = "Are you sure you want to delete this " + type + "?\n\nThis cannot be undone!";
    
    if (confirm(message)) {
        // If user clicks OK, go to delete page
        window.location.href = 'delete_' + type + '.php?id=' + id;
    }
    
    return false; // Don't follow the link normally
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