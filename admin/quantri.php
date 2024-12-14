<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

require_once '../config/dbcon.php';

// Function to retrieve user list from the database
function getUserList($conn) {
    $userList = array();

    // SQL query to retrieve user data
    $lietke_sql = 'SELECT * FROM users ORDER BY email, password';

    // Execute the SQL query
    $result = mysqli_query($conn, $lietke_sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Loop through the results and add each user to the list
    while ($r = mysqli_fetch_assoc($result)) {
        $userList[] = $r;
    }

    return $userList;
}

// Retrieve the list of users
$userList = getUserList($conn);
?>

<div class="container">
    <br>
    <h1>Tài khoản quản trị</h1>
    <div class="panel-heading">
    </div>
    <br>
    <table class="table" style="text-align:center">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tên tài khoản</th>
                <th>Mật khẩu</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userList as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <?php if ($_SESSION['role_as'] == 0) : ?>
                            <span class="password" data-password="<?php echo $user['password']; ?>">****</span>
                            <i class="toggle-password fas fa-eye" style="cursor: pointer;"></i>
                        <?php else : ?>
                            Bạn không có quyền xem mật khẩu
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="editquantri.php?sid=<?php echo $user['id']; ?>" class="btn btn-primary">Sửa</a>
                        <a onclick="return confirm('Bạn có muốn xóa tài khoản này không ?');" href="xoaquantri.php?sid=<?php echo $user['id']; ?>" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const passwordSpan = this.previousElementSibling;
                const password = passwordSpan.dataset.password;
                const type = passwordSpan.textContent === '****' ? 'text' : 'password';
                passwordSpan.textContent = type === 'text' ? password : '****';
                this.classList.toggle('fa-eye-slash');
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include('includes/footer.php'); ?>
