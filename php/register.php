<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shiroo Pet Store - Register</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/register.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Inria+Sans" rel="stylesheet" />
</head>

<body class="register-page" style="background: url('../img/menu-bg.png') no-repeat center center fixed;
    background-size: cover; overflow: hidden; ">
    <div class=" register-wrapper">
        <div class="register-card">
            <img src="../img/logo1.png" alt="Logo" class="register-logo">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" name="submit">Daftar</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Login disini!</a>.</p>
        </div>
    </div>

    <?php
  if (isset($_POST['submit'])) {
      $conn = new mysqli("localhost", "root", "", "shiroo_db");
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $username = $conn->real_escape_string($_POST['username']);
      $email = $conn->real_escape_string($_POST['email']);
      $password = $_POST['password'];
      $confirm = $_POST['confirm_password'];

      if ($password !== $confirm) {
          echo "<script>alert('Password tidak cocok.');</script>";
      } else {
          $hashed = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed')";
          if ($conn->query($sql) === TRUE) {
              echo "<script>alert('Registrasi berhasil.'); window.location='login.php';</script>";
          } else {
              echo "<script>alert('Gagal mendaftar: " . $conn->error . "');</script>";
          }
      }

      $conn->close();
  }
  ?>
</body>

</html>