<header>
        <div class="logo">
            <a href="https://rastot.com/"><img src="<?php echo BASE_URL . '/assets/images/logolight.png'; ?>" alt="logo-img"></a>
            <h1 class="logo-title"><a href=<?php echo BASE_URL . '/index.php' ?>><span>Rastot</span> Insight</a></h1>
        </div>
        <i class="fa fa-bars menu-toggle"></i>
        <!--Navigation-->
        <ul class="nav">
            <li><a href=<?php echo BASE_URL . '/index.php' ?>>Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Disclaimer</a></li>

        <?php //if(isset($_SESSION['id'])): ?>
            <!--<li>
                <a href="#"><i class="fa fa-user"></i> -->
                    <?php //echo $_SESSION['userName']; ?>
                <!--<i class="fa fa-chevron-down" style="font-size: 0.7em;"></i></a>
                <ul class="nav">-->
                    <?php //if($_SESSION['admin']): ?>
                        <!--<li><a href="<?php //echo BASE_URL . 'admin/admin-dashboard.php'; ?>">Admin Dashboard</a></li>-->
                    <?php //else: ?>
                        <!--<li><a href="<?php //echo BASE_URL . 'admin/author-dashboard.php'; ?>">Author Dashboard</a></li>-->
                    <?php //endif; ?>
                    <!--<li class="logout"><a href="<?php //echo BASE_URL . '/application/controllers/logout.php'; ?>">Sign Out</a></li>
                </ul> 
            </li>-->
        <?php //else: ?>
            <!--<li><a href="<?php //echo BASE_URL . '/public/register.php'; ?>">Sign Up</a></li>
            <li><a href="<?php //echo BASE_URL . '/public/login.php'; ?>">Sign in</a></li> 
        <?php //endif; ?> -->
 
        </ul>
        <!--//Navigation-->
    </header>