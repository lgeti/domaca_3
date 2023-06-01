<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/domaca_3/index.php/group"><img src="\domaca_3\assets\logo.png" alt="Recipe.si Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/domaca_3/index.php/group"><b>All groups</b></a>
                </li>
                <?php if (!isset($_SESSION["authenticated"]) || (!$_SESSION["authenticated"])):?>
                <li class="nav-item">
                    <a class="nav-link" href="/domaca_3/index.php/user/login"><b>Login</b></a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/domaca_3/index.php/user/logout"><b>Logout</b></a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><b>Contact</b></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    /* Customize the appearance of the hamburger menu items */
    .navbar-nav .nav-link {
        color: #fff;
        font-size: 18px;
        padding: 8px 16px;
    }
    .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
</style>
