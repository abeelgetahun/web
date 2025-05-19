// Load users from the server
function loadUsers() {
    fetch('read.php')
        .then(response => response.json())
        .then(data => {
            const userList = document.getElementById('userList');
            userList.innerHTML = '';
            
            data.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.phone}</td>
                    <td>${user.login_date}</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="editUser(${user.id})">Edit</button>
                        <button class="action-btn delete-btn" onclick="deleteUser(${user.id})">Delete</button>
                    </td>
                `;
                userList.appendChild(row);
            });
        })
        .catch(error => console.error('Error loading users:', error));
}

// Function to handle edit action
function editUser(id) {
    window.location.href = `form.html?id=${id}`;
}

// Function to handle delete action
function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch(`delete.php?id=${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadUsers();
            } else {
                alert('Error deleting user');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Load users when the page loads
document.addEventListener('DOMContentLoaded', loadUsers);