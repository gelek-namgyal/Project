<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="#">Dashboard</a>
        <a href="#">Manage Buses</a>
        <a href="#">Manage Bookings</a>
        <a href="#">User Management</a>
        <a href="#">Settings</a>
        <!-- Add New User Button -->
        <div class="add-user-btn" onclick="openModal()">Add New User</div>
    </div>

    <div class="dashboard-content">
        <!-- Navbar -->
        <div class="navbar">
            <h1>Welcome, Admin</h1>
            <a href="database/logout.php" class="logout-btn">Logout</a>
        </div>

        <!-- Dashboard Cards -->
        <div class="cards">
            <div class="card">
                <div class="icon">🚍</div>
                <h3>Total Buses</h3>
                <p><?php echo $total_buses; ?></p>
            </div>
            <div class="card">
                <div class="icon">📅</div>
                <h3>Total Bookings</h3>
                <p><?php echo $total_bookings; ?></p>
            </div>
            <div class="card">
                <div class="icon">👥</div>
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?></p>
            </div>
        </div>
        

        <!-- Booking Table -->
        <div class="table-container">
            <h2>Recent Bookings</h2>
            <table>
                <tr>
                    <th>Booking ID</th>
                    <th>User</th>
                    <th>Bus</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>#1023</td>
                    <td>John Doe</td>
                    <td>Bus A</td>
                    <td>2024-11-22</td>
                    <td>Confirmed</td>
                </tr>
                <tr>
                    <td>#1024</td>
                    <td>Jane Smith</td>
                    <td>Bus B</td>
                    <td>2024-11-23</td>
                    <td>Pending</td>
                </tr>
                <tr>
                    <td>#1025</td>
                    <td>Samuel Green</td>
                    <td>Bus C</td>
                    <td>2024-11-24</td>
                    <td>Confirmed</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Modal (Popup) for Add User -->
    <div class="modal" id="userModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form action="adduser.php" method="POST">
                <input type="text" name="full_name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <select name="role" required>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
                <button type="submit">Add User</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('userModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('userModal').style.display = "none";
        }

        // Close the modal if the user clicks outside the modal
        window.onclick = function(event) {
            if (event.target == document.getElementById('userModal')) {
                closeModal();
            }
        }

        function updateCounts() {
    fetch('database/counts.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('.cards .card:nth-child(1) p').textContent = data.total_buses;
            document.querySelector('.cards .card:nth-child(2) p').textContent = data.total_bookings;
            document.querySelector('.cards .card:nth-child(3) p').textContent = data.total_users;
        })
        .catch(error => console.error('Error fetching counts:', error));
}

// Update counts every 5 seconds
setInterval(updateCounts, 5000);

// Initial load
updateCounts();

    </script>
</body>
</html>
