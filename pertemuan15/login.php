<?php
require 'functions.php';

if (isset($_POST["login"])) {
    global $conn;

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi!";
    } else {
        // Gunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Cek username
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Cek password
            if (password_verify($password, $row["password"])) {
                // Redirect ke halaman index
                header("Location: index.php");
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
</head>
<body>
    
<h1>Halaman Login</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= $error; ?></p>
<?php endif; ?>

<form action="" method="post">
    <ul>
        <li>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </li>
        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </ul>
</form>

</body>
</html>