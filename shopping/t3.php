<html>

<head>
<script type="text/javascript" src="http://www.w3schools.com/jquery/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("p").click(function(){

      var str;
      str = $("#txtarea").val();
      alert(str);


  });
});
</script>
</head>

<body>
<p>If you click on me, I will disappear.</p>
<textarea rows="5" cols="10" name="txtarea" id="txtarea"></textarea>
</body>

</html>