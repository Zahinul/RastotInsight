<header>
        <div class="logo">
        <a href="https://rastot.com/"><img src="<?php echo BASE_URL . '/assets/images/logolight.png'; ?>" alt="logo-img"></a>
        <h1 class="logo-title"><a href="<?php echo BASE_URL . '/index.php'; ?>"><span>Rastot</span> Insight</a></h1>
        </div>
        <i class="fa fa-bars menu-toggle"></i>
        <!--Navigation-->
        <ul class="nav">
            <?php if(($_SESSION['admin'])): ?>
                <li>
                    <a href="#"><i class="fa fa-user"></i>  
                        <?php echo $_SESSION['userName']; ?>
                    <i class="fa fa-chevron-down" style="font-size: 0.7em;"></i></a>
                    <ul class="nav">
                        <li><a href="<?php echo BASE_URL . '/index.php'; ?>">Homepage</a></li>
                        <li><a href="<?php echo BASE_URL . '/public/posts/index.php'; ?>">My Posts</a></li>
                        <?php //if ($_SESSION['super_admin']): ?>
                            <!--<li class="res-nav"><a href="<?php //echo BASE_URL . '/private/posts/index.php'; ?>">Manage Posts</a></li>
                            <li class="res-nav"><a href="<?php //echo BASE_URL . '/private/users/index.php'; ?>">Manage Users</a></li>
                        <?php //else: ?>
                            <li class="res-nav"><a href="<?php //echo BASE_URL . '/private/posts/index2.php'; ?>">Manage Posts</a></li>
                            <li class="res-nav"><a href="<?php //echo BASE_URL . '/private/users/index2.php'; ?>">Manage Users</a></li>
                        <?php //endif; ?>
                        <li class="res-nav"><a href="<?php //echo BASE_URL . '/private/topics/index.php'; ?>">Manage Topics</a></li>-->
                        <li class="logout"><a href="<?php echo BASE_URL . '/application/controllers/logout.php'; ?>">Sign Out</a></li>
                    </ul> 
                </li>
            <?php endif; ?> 
        </ul>
        <!--//Navigation-->
    </header>