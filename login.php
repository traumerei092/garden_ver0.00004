<?php
    session_start();

    // DB接続
    $dbn ='mysql:dbname=gs_d15_10;charset=utf8mb4;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        $pdo = new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // ユーザー情報の取得
        $sql = "SELECT id, password FROM garden_user WHERE mail = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // 認証成功
            $_SESSION['user_id'] = $user['id'];
            header("Location: mypage.php");
            exit();
        } else {
            // 認証失敗
            header("Location: index.php?error=invalid_credentials");
            exit();
        }
    }
?>
