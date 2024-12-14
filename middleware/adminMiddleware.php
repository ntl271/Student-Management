<?php 
if(isset($_SESSION['auth']))
{
    $role_as = $_SESSION['role_as'] ?? null;
    if($role_as != 0)
    {
        $_SESSION['message'] = "Bạn không có quyền truy cập trang này";
        header('Location: ../index.php');   
    }
}
else 
{
    $_SESSION['message'] = "Login to continue";
    header('Location: ../login.php');
}

?>