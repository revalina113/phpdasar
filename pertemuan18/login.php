<?php
session_start();
require 'functions.php';

// Periksa koneksi database
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Ambil username berdasarkan ID
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    // Cek kecocokan cookie dan username
    if (!empty($row['username']) && $key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

// Redirect jika sudah login
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

// Proses login
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;

                if (isset($_POST['remember'])) {
                    setcookie('id', $row['id'], time() + (7 * 24 * 60 * 60), '/', '', false, true);
                    setcookie('key', hash('sha256', $row['username']), time() + (7 * 24 * 60 * 60), '/', '', false, true);
                }

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
