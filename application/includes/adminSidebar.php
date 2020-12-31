   
        <!--Left Managing Sidebar-->
        <section class="knight-manage-bar">
            <ul>
                <?php if (empty($_SESSION['super_admin'])): ?>
                    <li><a href="<?php echo BASE_URL . '/private/posts/index2.php'; ?>">Manage Posts</a></li>
                    <li><a href="<?php echo BASE_URL . '/private/users/index2.php'; ?>">View Users</a></li>
                <?php else: ?>
                    <li><a href="<?php echo BASE_URL . '/private/posts/index.php'; ?>">Manage Posts</a></li>
                    <li><a href="<?php echo BASE_URL . '/private/users/index.php'; ?>">Manage Users</a></li>
                <?php endif; ?>
                <li><a href="<?php echo BASE_URL . '/private/topics/index.php'; ?>">Manage Topics</a></li>
            </ul>
        </section>
        <!--//Left Managing Sidebar-->

       