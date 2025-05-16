<?php

require_once("dbConnection.php");

if (!isset($mysqli)) {
    die("Database connection error. Please check your 'dbConnection.php' file.");
}

$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <div class="position-relative mb-4">
        <h1 class="display-4 text-center">Royal University of Phnom Penh</h1>
        <button type="button" class="btn btn-light position-absolute top-0 end-0" data-bs-toggle="modal" data-bs-target="#aboutMeModal">
            <span class="bi bi-list" style="font-size: 1.5rem;"></span>
        </button>
        <p class="lead text-center">Mini Student Information System</p>
    </div>


    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4">Student List</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Add New User
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($res = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($res['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($res['age']) . "</td>";
                    echo "<td>" . htmlspecialchars($res['email']) . "</td>";
                    echo "<td>
                            <button class='btn btn-primary btn-sm btn-edit' 
                                data-id='" . $res['id'] . "' 
                                data-name='" . htmlspecialchars($res['name']) . "' 
                                data-age='" . htmlspecialchars($res['age']) . "' 
                                data-email='" . htmlspecialchars($res['email']) . "'>
                                Edit
                            </button>
                            <a href=\"delete.php?id=" . $res['id'] . "\" class=\"btn btn-danger btn-sm\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No users found</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="addAction.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="editAction.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editUserId" name="id">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editAge" class="form-label">Age</label>
                        <input type="number" class="form-control" id="editAge" name="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update" class="btn btn-primary">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="aboutMeModal" tabindex="-1" aria-labelledby="aboutMeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutMeModalLabel">About Me</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">

                    <li class="list-group-item"><strong>My Name:</strong> Nim Rataknak</li>
                    <li class="list-group-item"><strong>School Email:</strong> nim.rataknak.1222@rupp.edu.kh</li>
                    <li class="list-group-item"><strong>Class / Year :</strong> Information Technology, Year 3-A4(RUPP)</li>
                    <li class="list-group-item"><strong>Project Name :</strong> Mini Student Information System</li>
                    <li class="list-group-item"><strong>Project Type :</strong> PHP CRUD Web App with MySQL.</li>
                    <li class="list-group-item"><strong>Tools Used :</strong> PHP, HTML/Bootstrap, MySQL, GitHub, InfinityFree.</li>
                    <li class="list-group-item"><strong>Supervisor :</strong> Mr. Meng Hann</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.btn-edit').on('click', function () {
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            const userAge = $(this).data('age');
            const userEmail = $(this).data('email');

            $('#editUserId').val(userId);
            $('#editName').val(userName);
            $('#editAge').val(userAge);
            $('#editEmail').val(userEmail);

            $('#editUserModal').modal('show');
        });
    });
</script>
</body>
</html>