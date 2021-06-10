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
        <ul class="t1 horizontal-menu t11">
            <li class="t2">
                <div class="btn-group"> <a data-toggle="dropdown" type="button" class="btn btn-default" href="#"><img src="assets/images/en_US.png"></img> English</a>
                    <ul class="dropdown-menu dml t1" role="menu">
                        <li class="t2"><a href="#"><img src="assets/images/en_US.png"></img> English</a>
                        </li>
                        <li class="t2"><a href="#"><img src="assets/images/ms_MY.png"> Malayu</a>
                        </li>
                        <li class="t2"><a href="#"><img src="assets/images/zh_CN.png"> Chinese</a>
                        </li>
                    </ul>
                </div>
            </li>
        <ul>
        <!--- <ul class="horizontal-menu">
            <li class="horz-menu-item lang">
                <select name="change_language">
                    <option value="en" <?php echo ($_SESSION['language'] == "en") ? "selected" : "" ?>>&nbsp;</option>
                    <option value="my" <?php echo ($_SESSION['language'] == "my") ? "selected" : "" ?>>&nbsp;</option>
                    <option value="cn" <?php echo ($_SESSION['language'] == "cn") ? "selected" : "" ?>>&nbsp;</option>
                </select>
            </li>
        </ul> --->
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

<style>
ul.t1 {
    list-style-type: none;
    margin: 0;
    padding: 0;
    float: left;
}
ul.t1 li.t2 {
    display: inline-block;
}
.btn-group, .btn-group-vertical {
    display: inline-block;
    position: relative;
    vertical-align: text-bottom;
}
.btn-group a.btn {
    display: inline-block;
    padding:0;
    margin:0;
    border-width: 0;
    font-size: initial !important;
    text-shadow: none !important;
    background-color:inherit !important;
    font-size: inherit !important;
    line-height: initial !important;
}

.t11{
    font-size : 15px !important;
    padding: 5px 0px !important;
}

.dml{
    min-width : 110px !important;
}
</style>
