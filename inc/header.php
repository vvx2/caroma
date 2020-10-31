<div class="container">
    <div class="top-bar left">
        <ul class="horizontal-menu">
            <li><a href="mailto:info@caromacafe.com"><i class="fa fa-envelope" aria-hidden="true"></i>info@caromacafe.com</a></li>
            <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>+603 6272 5229</a></li></a></li>
            <li><a href="#"><i class="fa fa-fax" aria-hidden="true"></i>+603 6273 5229</a></li></a></li>
        </ul>
    </div>
    <div class="top-bar right">
        <ul class="social-list">
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        </ul>
        <ul class="horizontal-menu">
            <li class="horz-menu-item lang">
                <select name="language">
                    <option value="en" selected>EN</option>
                    <option value="my">MY</option>
                    <option value="cn">CN</option>
                </select>
            </li>
        </ul>
        <?php
        if ($login == 1) {
        ?>
            <ul class="social-list">
                <li><a href="api/logout.php"><i class="" aria-hidden="true">Logout</i></a></li>

            </ul>
        <?php
        }
        ?>
    </div>
</div>
