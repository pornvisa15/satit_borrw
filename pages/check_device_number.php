<script>
    function checkDeviceNumder() {
        const deviceNumder = document.getElementById('device_Numder').value;
        const errorElement = document.getElementById('deviceNumderError');
        const deviceNumderInput = document.getElementById('device_Numder');

        // ใช้ fetch เพื่อส่งคำขอไปยัง check_device_number.php
        fetch(`check_device_number.php?device_Numder=${deviceNumder}`)
            .then(response => response.json())
            .then(data => {
                // ถ้ามีเลขพัสดุซ้ำในระบบ ให้แสดงข้อความผิดพลาด
                if (data.exists) {
                    errorElement.style.display = 'inline'; // แสดงข้อความผิดพลาด
                    deviceNumderInput.classList.add('is-invalid'); // เพิ่มคลาส error ให้กับช่องกรอก

                    // เพิ่มการเล่นเสียงเตือนเมื่อเลขพัสดุซ้ำ
                    const audio = new Audio('path_to_alert_sound.mp3'); // ใช้ไฟล์เสียงที่คุณต้องการ
                    audio.play();
                } else {
                    // ถ้าไม่ซ้ำ ซ่อนข้อความผิดพลาด
                    errorElement.style.display = 'none'; // ซ่อนข้อความผิดพลาด
                    deviceNumderInput.classList.remove('is-invalid'); // ลบคลาส error
                }
            })
            .catch(error => {
                console.error('เกิดข้อผิดพลาด:', error);
            });
    }
</script>
