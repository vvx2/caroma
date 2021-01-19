<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Caroma | Administrator Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h2 class="logo-name">CMS</h2>
            </div>
            <h3>Content Management System OF CAROMA</h3>
            <p>Administrator Login in</p>
            <form class="m-t" role="form" action="index.php">
                <div class="form-group">
                    <input type="text" class="form-control" id="uname" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="pword" placeholder="Password" required="">
                </div>
                <div class="form-group">
                    <span class="text-danger" id="error_msg"></span>
                </div>
                <button type="submit" id="btnsubmit" class="btn btn-primary block full-width m-b">Login</button>


            </form>
            <p class="m-t"> <small>© Copyright Caroma 2020. All rights reserved</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>

</html>

<script>
    $('body').on('click', '[data-toggle="modal"]', function() {
        $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
    });

    $('#btnsubmit').click(function(e) {
        var uname = $('#uname').val();
        var pword = $('#pword').val();

        if (uname != "" && pword != "") {
            e.preventDefault();

            $.post('api/login.php', {
                Uname: uname,
                Pword: pword
            }, function(data) {
                data = JSON.parse(data);
                if (data[0]) {
                    window.location.replace('api/routing.php?login_key=' + data[1]);
                } else {
                    $('#error_msg').html('<b>Wrong Username Or Password</b>');
                }
            });

        }

    })
</script>