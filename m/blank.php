<!DOCTYPE html>
<html>
<head>
<style>
p { background:#dad;
font-weight:bold;
font-size:16px; }
</style>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
  <button id="click">Toggle 'em</button>
    <p id="click">Toggle 'em</p>

<div id="locations" style="border:1px solid red; ">Hiya</div>


<script>
$("p#click").click(function () {

	$("div#locations").slideToggle("slow");			// slideToggle() / toggle()
});    

$("div#locations").ready(function() {
	$("div#locations").hide();
});
</script>


<script type="text/javascript">

$(document).ready(function() {
	  var toggle = function(direction, display) {
	    return function() {
	      var self = this;
	      var ul = $("ul", this);
	      if( ul.css("display") == display && !self["block" + direction] ) {
	        self["block" + direction] = true;
	        ul["slide" + direction]("slow", function() {
	          self["block" + direction] = false;
	        });
	      }
	    };
	  }
	  $("span.menu").hover(toggle("Down", "none"), toggle("Up", "block"));
	  $("span.menu ul").hide();
	});

</script>


<ul id="menu">
  <span class="menu">Sub 1
    <ul>
      <li>test 1</li>
      <li>test 2</li>
      <li>test 3</li>
      <li>test 4</li>
    </ul>
  </span>
</ul>






<span id="myacc">Acc</span>
	
		<div id="menu">		
    <div class="menubox">
	<div><img src="images/drop_top.png" alt="" width="141" height="16" border="0"/></div>
	<div class="drop_menu">
	<ul>
      <li><a href="#">My Order</a></li>
      <li><a href="#">My Credit</a></li>
      <li><a href="#">General</a></li>
      <li><a href="#">Security</a></li>
    </ul>
   </div>
	</div>
      </div>

 <script type="text/javascript">
$("span#myacc").click(function () {

	$("div#menu").slideToggle("slow");			// slideToggle() / toggle()
});    

$("div#menu").ready(function() {
	$("div#menu").hide();
});
</script>
 
</body>
</html>