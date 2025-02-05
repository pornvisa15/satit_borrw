<?php
include "../mysql_borrow.php";

// ตรวจสอบว่ามีการส่งค่าผ่านฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $bank_Id = $_POST['bank_Id'] ?? '';
    $bank_Name = $_POST['bank_name'] ?? '';
    $account_Number = $_POST['account_number'] ?? '';
    $account_Name = $_POST['account_name'] ?? '';
    $bank_Details = $_POST['account_detail'] ?? '';
    $other_Bank_Name = $_POST['other_bank_name'] ?? '';  // รับค่าธนาคารอื่นๆ

    // ถ้าผู้ใช้เลือก "อื่นๆ" ให้ใช้ค่าจากฟิลด์ other_bank_name
    if ($bank_Name == 'อื่นๆ' && !empty($other_Bank_Name)) {
        $bank_Name = $other_Bank_Name;  // ใช้ค่าที่กรอกเอง
    }

    // ตรวจสอบค่าที่ได้รับมาจากฟอร์ม
    if (empty($bank_Id) || empty($bank_Name) || empty($account_Number) || empty($account_Name) || empty($bank_Details)) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
        exit();
    }

// ตรวจสอบรูปแบบของหมายเลขบัญชี
// (มีการคั่นเครื่องหมาย - ทุก 3 หลัก และตัวสุดท้ายเป็น 1 ตัว)
if (!preg_match("/^\d{3}-\d{3}-\d{3}-\d{1}$/", $account_Number)) {
    echo "กรุณากรอกหมายเลขบัญชีให้ครบ 10 ตัว";
   
    exit();
}

    

    // เตรียมคำสั่ง SQL ด้วย prepared statement สำหรับการอัพเดต
    $stmt = $conn->prepare("UPDATE `bank` 
                            SET `bank_Name` = ?, `account_Number` = ?, `account_Name` = ?, `bank_Details` = ? 
                            WHERE `bank_Id` = ?");

    // ผูกค่าตัวแปรกับ prepared statement
    $stmt->bind_param("sssss", $bank_Name, $account_Number, $account_Name, $bank_Details, $bank_Id);

    // ตรวจสอบการดำเนินการ
    if ($stmt->execute()) {
        echo "success"; // คืนค่าผลลัพธ์เมื่อการอัพเดตสำเร็จ
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
}
?>
