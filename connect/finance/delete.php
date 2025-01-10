<?php
include '../mysql_borrow.php';

// รับค่า finance_Id อย่างปลอดภัย
$finance_Id = isset($_GET['finance_Id']) ? intval($_GET['finance_Id']) : 0;

if ($finance_Id > 0) {
    // ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare("DELETE FROM `finance` WHERE finance_Id = ?");
    $stmt->bind_param("i", $finance_Id);

    if ($stmt->execute()) {
        echo "<script>
            alert('ลบข้อมูลสำเร็จ');
            window.location.href = '../../../satit_borrw/pages/admin_finance.php';
        </script>";
    } else {
        echo "<script>
            alert('เกิดข้อผิดพลาด: " . $stmt->error . "');
            window.location.href = '../../../satit_borrw/pages/admin_finance.php';
        </script>";
    }

    $stmt->close();
} else {
    echo "<script>
        alert('ไม่พบข้อมูล finance_Id ที่ต้องการลบ');
        window.location.href = '../../../satit_borrw/pages/admin_finance.php';
    </script>";
}

$conn->close();
?>
