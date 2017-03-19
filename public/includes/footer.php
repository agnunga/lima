<nav class="navbar-inverse navbar-bottom">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="<?php $_SERVER['PHP_SELF'] ?>?about_us=1"">About Us</a></li>
            <li><a href="<?php $_SERVER['PHP_SELF'] ?>?help=1">Help</a></li>
            <li><a href="<?php $_SERVER['PHP_SELF'] ?>?contact_us=1"">Contact us</a></li>
            <li><a href="<?php $_SERVER['PHP_SELF'] ?>?faqs=1"">FAQs</a></li>
        </ul>
    </div>
    <footer id="main_footer" style="color: brown;text-align: center;">
        <?php echo 'Copyright &copy ' . date('Y') . "  Developed by Agunga Jeff"; ?>
    </footer>
</nav>
</body>
</html>
