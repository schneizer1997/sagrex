<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div class="links">
    <a class="openpop" href="http://getbootstrap.com/">Link 1</a>
    <a class="openpop" href="http://www.jsfiddle.net">Link 2</a>
    <a class="openpop" href="http://www.w3schools.com">Link 3</a>
</div>
<center>
<div class="wrapper" style="">
    <div class="popup" style="background-color: rgba(255, 255, 255, 0.9);filter: alpha(opacity=90);">
        <iframe src="" style="width: 800px;height: 500px;margin-right: 300px;" allowtransparency="true">
            <p>Your browser does not support iframes.</p>
        </iframe>
<a href="#" class="close">X</a>
    </div>
</div>
</center>
<script src="../../vendor/jquery/jquery.min.js"></script>
<script src="../../vendor/jquery/jquery.js"></script>
<!-- <script src="../../jquery/jquery-1.8.3.min.js" charset="UTF-8"></script> -->
<!-- <script src="../../vendor/js/bootstrap.min.js"></script> -->
<!-- <script src="../../vendor/jquery/karma.conf.js"></script> -->
<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../../js/sb-admin.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
    $(".popup").hide();
    $(".openpop").click(function (e) {
        e.preventDefault();
        $("iframe").attr("src", $(this).attr('href'));
        $(".links").fadeOut('slow');
        $(".popup").fadeIn('slow');
    });

    $(".close").click(function () {
        $(this).parent().fadeOut("slow");
        $(".links").fadeIn("slow");
    });
});
</script>
</body>
</html>