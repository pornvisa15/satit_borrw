<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ</title>
    <!-- ใช้ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* สไตล์สำหรับการแสดงฟอร์มให้เด้งขึ้นจากด้านล่าง */
        .login-container {
            animation: slideUp 0.8s ease-out;
            border-top: 5px solid #5AC9E4; /* เพิ่มขอบสีฟ้าที่ด้านบน */
            margin-top: 60px; /* ปรับให้ฟอร์มล็อกอินไม่ชนกับขอบฟ้า */
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px); /* เริ่มต้นจากด้านล่าง */
                opacity: 0; /* ความโปร่งใสเริ่มต้น */
            }
            to {
                transform: translateY(0); /* ปลายทางที่ตำแหน่งปกติ */
                opacity: 1; /* ความโปร่งใสที่ 100% */
            }
        }

        /* สไตล์สำหรับขอบฟ้า */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #5AC9E4;
            border-bottom: 5px solid #5AC9E4;
            z-index: 1050;
            padding: 10px 0;
            text-align: center;
            color: white;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

    <!-- ขอบฟ้า (Header) ที่จะอยู่ที่ด้านบนสุดของหน้า -->
    <div class="header">
       
    </div>

    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-container p-4 rounded shadow" style="background-color: #f8f9fa; width: 100%; max-width: 400px;">
            <div class="text-center mb-4">
                <img src="img/1.png" alt="Logo" class="img-fluid" style="width: 160px;">
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
                    <div class="input-group col-6 mx-auto"> <!-- กำหนดให้ input อยู่ตรงกลาง -->
                        <span class="input-group-text" id="password-icon">
                            <i class="bi bi-eye" id="toggle-password" style="cursor: pointer;"></i>
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

                <!-- Submit Button -->
                <div class="d-grid gap-2 col-3 mx-auto" style="margin-top: 20px;">
                    <input type="submit" class="btn btn-primary shadow" value="Login" 
                        style="background-color: #5AC9E4; border-color: #5AC9E4; color: white; font-size: 1rem; font-weight: 500; 
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;" 
                        onmouseover="this.style.backgroundColor='#4FB8D4'; this.style.borderColor='#4FB8D4'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.15)';"
                        onmouseout="this.style.backgroundColor='#5AC9E4'; this.style.borderColor='#5AC9E4'; this.style.boxShadow='0 2px 4px rgba(0, 0, 0, 0.1)';">
                </div>
            </form>

            <!-- ข้อความข้อกำหนดอยู่ทางซ้ายมือ -->
            <div class="text-start mt-3" style="font-size: 0.875rem; color: #6c757d;">
                * ลงชื่อเข้าใช้งานด้วย Username และ Password ที่ได้รับจากเจ้าหน้าที่ หากลืมรหัสผ่าน กรุณาติดต่อเจ้าหน้าที่
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (include this at the end of your body tag) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
