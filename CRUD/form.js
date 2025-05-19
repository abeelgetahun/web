// Get user ID from URL if present (for edit mode)
const urlParams = new URLSearchParams(window.location.search);
const userId = urlParams.get('id');

// If userId exists, we're in edit mode
if (userId) {
    document.getElementById('formTitle').textContent = 'Edit User';
    loadUserData(userId);
}

// Load user data for editing
function loadUserData(id) {
    fetch(`read_single.php?id=${id}`)
        .then(response => response.json())
        .then(user => {
            document.getElementById('userId').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('phone').value = user.phone;
        })
        .catch(error => console.error('Error loading user data:', error));
}

// Handle form submission
document.getElementById('userForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const userData = {
        id: formData.get('id'),
        name: formData.get('name'),
        email: formData.get('email'),
        phone: formData.get('phone')
    };
    
    const url = userData.id ? 'update.php' : 'create.php';
    const method = userData.id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(userData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'index.html';
        } else {
            alert('Error saving user data');
        }
    })
    .catch(error => console.error('Error:', error));
});