<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Login</title>
    <style>
        /* ขอบสีฟ้าด้านบน */
        body {
           border-top: 100px solid #5AC9E4; /* เพิ่มขอบฟ้าขนาด 100px */
            margin: 0; /* ลบ margin ของ body */
            height: 100vh; /* ทำให้ body มีความสูง 100vh */
            overflow: hidden; /* ห้ามเลื่อนหน้าจอ */
        }
        html {
            height: 100%; /* ทำให้ html มีความสูง 100% */
        }
    </style>
</head>
<body>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-container p-4 rounded shadow" style="background-color: #f8f9fa; width: 100%; max-width: 400px;">
            <div class="text-center mb-4">
                <img src="img/1.png" alt="Logo" class="img-fluid" style="width: 150px;">
            </div>
            <h4 class="text-center mb-4">ระบบ ยืม-คืน อุปกรณ์</h4>
            <h5 class="text-center mb-2">เข้าสู่ระบบ</h5>
            <form action="login.php" method="POST">
                <!-- Input for Username with Icon -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text" id="username-icon">
                            <i class="bi bi-person"></i> <!-- ไอคอนสำหรับ username -->
                        </span>
                        <input type="text" id="username" name="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
                    </div>
                </div>

                <!-- Input for Password with Icon -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text" id="password-icon">
                            <i class="bi bi-eye" id="toggle-password" style="cursor: pointer;"></i> <!-- ไอคอนสำหรับแสดง/ซ่อนรหัสผ่าน -->
                        </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
                    </div>
                </div>

                <!-- Add JavaScript to toggle the password visibility -->
                <script>
                    document.getElementById('toggle-password').addEventListener('click', function() {
                        var passwordField = document.getElementById('password');
                        var icon = document.getElementById('toggle-password');

                        // Toggle password visibility
                        if (passwordField.type === 'password') {
                            passwordField.type = 'text';
                            icon.classList.remove('bi-eye');
                            icon.classList.add('bi-eye-slash');  // Change icon to "eye-slash" when password is visible
                        } else {
                            passwordField.type = 'password';
                            icon.classList.remove('bi-eye-slash');
                            icon.classList.add('bi-eye');  // Change icon back to "eye" when password is hidden
                        }
                    });
                </script>

                <div class="d-grid gap-2">
                    <input type="submit" class="btn btn-primary shadow" value="Login" style="background-color: #5AC9E4; border-color: #5AC9E4; color: white; font-size: 1rem; font-weight: 500; padding: 10px 20px; border-radius: 5px; transition: all 0.3s ease; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                </div>

            </form>

            <!-- ข้อความข้อกำหนดอยู่ทางซ้ายมือ -->
            <div class="text-start mt-3" style="font-size: 0.875rem; color: #6c757d;">
                * ลงชื่อเข้าใช้งานด้วย Username และ Password ที่ได้รับจากเจ้าหน้าที่ หากลืมรหัสผ่าน กรุณาติดต่อเจ้าหน้าที่
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (Optional for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
