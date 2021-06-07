<div class="container">
    <div class="top-bar left">
        <ul class="horizontal-menu">
            <li><a href="mailto:info@caroma.com.my"><i class="fa fa-envelope" aria-hidden="true"></i>info@caroma.com.my</a></li>
            <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>+603 6272 5229</a></li></a></li>
            <li><a href="#"><i class="fa fa-fax" aria-hidden="true"></i>+603 6273 5229</a></li></a></li>
        </ul>
    </div>
    <div class="top-bar right">
        <ul class="social-list">
            <li><a href="https://www.instagram.com/drinkcaroma/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="https://www.facebook.com/caromamalaysia"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
        </ul>
        <ul class="horizontal-menu">
            <li class="horz-menu-item lang">
                <select name="change_language">
                    <option value="en" <?php echo ($_SESSION['language'] == "en") ? "selected" : "" ?>>&nbsp;</option>
                    <option value="my" <?php echo ($_SESSION['language'] == "my") ? "selected" : "" ?>>&nbsp;</option>
                    <option value="cn" <?php echo ($_SESSION['language'] == "cn") ? "selected" : "" ?>>&nbsp;</option>
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
