<?php
include 'config.php';
if (!empty($_GET['code']) && isset($_GET['code'])) {
    $code = $_GET['code'];
    $sql = mysqli_query($con, "SELECT * FROM users WHERE activationcode='$code'");
    $num = mysqli_fetch_array($sql);
    if ($num > 0) {
        $st = 0;
        $result = mysqli_query($con, "SELECT id FROM users WHERE activationcode='$code' and status='$st'");
        $result4 = mysqli_fetch_array($result);
        if ($result4 > 0) {
            $st = 1;
            $result1 = mysqli_query($con, "UPDATE users SET status='$st' WHERE activationcode='$code'");
            $msg = "Your account is activated";
            header("Location: shop-my-account.php?msg=$msg");
            exit();
        } else {
            $msg = "Your account is already active, no need to activate again";
            header("Location: shop-my-account.php?msg=$msg");
            exit();
        }
    } else {
        $msg = "Wrong activation code.";
        header("Location: shop-my-account.php?msg=$msg");
        exit();
    }
}
?>