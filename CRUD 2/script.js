// Load users on page load
document.addEventListener('DOMContentLoaded', loadUsers);
document.getElementById('userForm').addEventListener('submit', saveUser);

function loadUsers() {
    fetch('api.php?action=read')
        .then(res => res.json())
        .then(users => {
            let html = '';
            users.forEach(user => {
                html += `<tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.phone}</td>
                    <td>
                        <button onclick="editUser(${user.id},'${user.name}','${user.email}','${user.phone}')">Edit</button>
                        <button onclick="deleteUser(${user.id})">Delete</button>
                    </td>
                </tr>`;
            });
            document.getElementById('userList').innerHTML = html;
        });
}

function editUser(id, name, email, phone) {
    document.getElementById('userId').value = id;
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
}

function resetForm() {
    document.getElementById('userForm').reset();
    document.getElementById('userId').value = '';
}


function saveUser(e) {
    e.preventDefault();
    const id = document.getElementById('userId').value;
    const data = {
        id: id,
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value
    };
    
    fetch(`api.php?action=${id ? 'update' : 'create'}`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            resetForm();
            loadUsers();
        } else {
            alert('Error: ' + data.message);
        }
    });
}



function deleteUser(id) {
    if(confirm('Delete this user?')) {
        fetch('api.php?action=delete', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({id: id})
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) loadUsers();
            else alert('Error: ' + data.message);
        });

        let sure = prompt("are u sure?");
        alert("okay lest continue, " + sure);

    }
}   