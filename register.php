<?php
require_once 'config/db.php';

if (isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $tel = $_POST['tel'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];

    $equery = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    $enum = mysqli_num_rows($equery);

    $uquery = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    $unum = mysqli_num_rows($uquery);

    if ($enum == 0 && $unum == 0) {
        $query = mysqli_query($conn, "INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `tel`, `role`, `password`) VALUES (NULL, '$firstname', '$lastname', '$email', '$username', '$tel', '$role', '$password');");
        header('location: login.php?action=success');
        exit();
    } else if ($enum == 1 && $unum == 0) {
        header('location: register.php?action=emailerror');
        exit();
    } else if ($enum == 0 && $unum == 1) {
        header('location: register.php?action=usernameerror');
        exit();
    } else {
        header('location: register.php?action=emailerror');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>

<body>
    <a href="index.php"><button>กลับสู่หน้าแรก</button></a>
    <h1>สมัครสมาชิก</h1>
    <?php if ($_GET['action'] == 'emailerror') { ?>
        <p>มีอีเมลนี้ในระบบแล้ว</p>
    <?php } ?>
    <?php if ($_GET['action'] == 'usernameerror') { ?>
        <p>ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว</p>
    <?php } ?>
    <form action="register.php" method="post">
        <div>
            <label for="firstname">ชื่อจริง</label>
            <input type="text" name="firstname" required>
        </div>
        <div>
            <label for="lastname">นามสกุล</label>
            <input type="text" name="lastname" required>
        </div>
        <div>
            <label for="email">อีเมล</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="username">ชื่อผู้ใช้</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="tel">เบอร์โทรศัพท์</label>
            <input type="tel" name="tel" pattern="[0-9]{10}" required>
        </div>
        <div>
            <label for="role">สิทธิผู้ใช้งาน</label>
            <select name="role" required>
                <option value="">เลือกสิทธิผู้ใช้งาน</option>
                <option value="buyer">ผู้ซื้อสินค้า</option>
                <option value="seller">ผู้ขายสินค้า</option>
                <option value="user">ผู้ซื้อและผู้ขายสินค้า</option>
            </select>
        </div>
        <div>
            <label for="password">รหัสผ่าน</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="confirm password">ยืนยันรหัสผ่าน</label>
            <input type="password" name="c_password" required>
        </div>
        <button type="submit" name="register">สมัครสมาชิก</button>
    </form>
    <p>เป็นสมาชิกแล้วใช่ไหม คลิ๊กที่นี่เพื่อ <a href="login.php">ลงชื่อเข้าใช้</a></p>
</body>

</html>