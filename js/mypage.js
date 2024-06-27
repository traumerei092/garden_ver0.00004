document.addEventListener("DOMContentLoaded", function() {
    const profileBtn = document.getElementById("profile-btn");
    const sidebar = document.getElementById("sidebar");
    const closeBtn = document.getElementById("close-btn");
    const logoutLink = document.getElementById("logout-link");
    const deleteAccountLink = document.getElementById("delete-account-link");

    profileBtn.addEventListener("click", function() {
        sidebar.classList.add("active");
    });

    closeBtn.addEventListener("click", function() {
        sidebar.classList.remove("active");
    });

    logoutLink.addEventListener("click", function(e) {
        e.preventDefault();
        if (confirm("ログアウトしますか？")) {
            window.location.href = "logout.php";
        }
    });

    deleteAccountLink.addEventListener("click", function(e) {
        e.preventDefault();
        if (confirm("本当に退会しますか？")) {
            window.location.href = "delete_account.php";
        }
    });

    // メニューバーのリンクにアクティブクラスを追加する
    const menuLinks = document.querySelectorAll(".menu-bar ul li a");
    menuLinks.forEach(link => {
        link.addEventListener("click", function() {
            // すべてのリンクからアクティブクラスを削除
            menuLinks.forEach(link => link.classList.remove("active"));
            // クリックされたリンクにアクティブクラスを追加
            this.classList.add("active");
        });
    });
});
