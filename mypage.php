<?php
    // セッション開始
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

    // ユーザーIDをセッションから取得
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];


    // ユーザー情報を取得
    $sql = "SELECT profile_image FROM garden_user WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found.";
        exit();
    }

    $profile_image = $user['profile_image'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GARDEN YourPage</title>
    <link rel="stylesheet" type="text/css" href="css/base.css" />
    <link rel="stylesheet" type="text/css" href="css/mypage.css" />
    <script src="js/mypage.js" defer></script>
</head>
<body>
    <div class="container">
        <header>
            <div class="headerLeft">
                <a href="index.php"><img src="img/garden_logo_orkney_font_fixed.png" alt=""></a>
            </div>
            <div class="headerRight">
                <button id="profile-btn"><img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profile Image"></button>
            </div>
        </header>
        <nav class="menu-bar">
            <ul>
                <li><a href="">MyShop</a></li>
                <li><a href="">Community</a></li>
                <li><a href="">TalkRoom</a></li>
                <li><a href="">HogeHoge</a></li>
                <li><a href="">FugaFuga</a></li>
            </ul>
        </nav>
    </div>
    <div id="sidebar" class="sidebar">
        <button id="close-btn">×</button>
        <ul>
            <li><a href="profile.php">プロフィール</a></li>
            <li><a href="#" id="logout-link">ログアウト</a></li>
            <li><a href="#" id="delete-account-link">退会</a></li>
        </ul>
    </div>
</body>
</html>
