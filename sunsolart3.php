<?php
$SN = "localhost";
$DBuser = "root";
$DBpass = "";
$DBname = "sunsolart3";

$conn = new mysqli($SN, $DBuser, $DBpass, $DBname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$FN = $_POST["Fname"] ?? "";
$LN = $_POST["Lname"] ?? "";
$MN = $_POST["Mname"] ?? "";
$BD = $_POST["Bday"] ?? "";
$GD = $_POST["Gender"] ?? "";
$EM = $_POST["EmAdd"] ?? "";
$PHN = $_POST["PhNo"] ?? "";
$AD = $_POST["Addrs"] ?? "";
$UN = $_POST["Uname"] ?? "";
$PW = $_POST["Pwd"] ?? "";
$DPTS = $_POST["Departments"]?? "";

$sql = "INSERT INTO users (FirstName, LastName, MiddleName, BirthDate, Gender, EmailAddress, PhoneNumber, Address, Username, Password, Departments) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database Error: " . $conn->error);
}

$stmt->bind_param("sssssssssss", $FN, $LN, $MN, $BD, $GD, $EM, $PHN, $AD, $UN, $PW, $DPTS);

if ($stmt->execute()) {
    echo "<p style='color:green;'>Registration successful!</p>";
} else {
    echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
}

$stmt->close();
$conn->close();
?>