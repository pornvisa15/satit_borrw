<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Login</title>
    
</head>
<body>

    <div class="login-container">
        <div>
    <img src="img/1.png" alt="Image not found" class="img-fluid">
</div>

        <h2>เข้าสู่ระบบ</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <input type="text" id="username" name="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
            </div>
            <div class="d-grid gap-2">
                <input type="submit" class="btn btn-custom" value="Login">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (Optional for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
