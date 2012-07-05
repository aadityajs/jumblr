<!--start footer-->
  <footer>

     <div class="footer">

        <div class="company_logos">
            <img src="images/com_01.png" alt="">
            <img src="images/com_02.png" alt="">
            <img src="images/com_03.png" alt="">
            <img src="images/com_04.png" alt="">
            <img src="images/com_05.png" alt="">
            <img src="images/com_06.png" alt="">
            <img src="images/com_07.png" alt="">
            <img src="images/com_08.png" alt="">
      </div>
      <div class="map">
       	 <div style="width:310px; padding-top:20px;"><img src="images/map.png" alt=""></div>
       	 <div style="width:320px; margin:0 20px 0 20px; padding-top:35px;">Why not visit our store at <br> 292 St kilda Road, St Kilda VIC 3182</div>
         <div class="payment_bg">
         	<img src="images/paypal_01.png" alt="">
            <img src="images/paypal_02.png" alt="">
            <img src="images/paypal_03.png" alt="">
         </div>
      </div>
      <div class="clear"></div>
      <div class="copy_right">
      	 <ul>
         	 <li><img src="images/social_06.png" alt=""> <img src="images/social_07.png" alt=""></li>
         </ul>
         <ul>
         	 <li class="center_align">Copyright &copy; <?php echo date('Y'); ?> Belliniholdings.com</li>
         </ul>
         <ul>
         	 <li class="center_align"><a href="<?php echo SITE_URL; ?>page.php?page=Privacy Policy">Privacy  Terms & Conditions</a></li>
         </ul>
      </div>
    </div>
  </footer>
<!--end footer-->

<script>
$("div#click").click(function () {
$("div#locations").slideToggle(300);
});



$(document).ready(function(){
$("div#locations").ready(function() {
	$("div#locations").hide(0);
});
});
</script>

<script>
$("span#subscribe_close").click(function() {
	$("div#subscribe_succ").slideUp(300);

});

</script>

<script>
$("span#close").click(function() {
	$("div.register_Main").slideUp(300);

});

$("img#close").click(function() {
	$("div.register_Main1").slideUp(300);

});

$("li#close").click(function() {
	$("div.register_Main").slideUp(300);

});
</script>

<script type="text/javascript" >
/* $(document).ready(function(){
  setTimeout(function(){
  $("div#subscribe").fadeOut("slow", function () {
  $("div#subscribe").remove();
      }); }, 5000);
 }); */
</script>


<script type="text/javascript">

$("span#myacc").click(function () {

		$("div#menu").slideDown("slow")
		$('div#menu').animate({
		    opacity: 1.0
		  }, 5000, function() {
		    // Animation complete.
		  });

});
$("div#menu").mouseout(function () {
	$("div#menu").slideUp("slow");			// slideToggle() / toggle()
});

$("div#menu").ready(function() {
	$("div#menu").hide();
});



/*$("span#myacc").mouseenter(function () {
	$("div#menu").slideDown("slow");			// slideToggle() / toggle()
}).mouseleave(function () {
	$("div#menu").slideUp("slow");
	$("div#menu").hide();		// slideToggle() / toggle()
});

$("div#menu").ready(function() {
	$("div#menu").hide();

});*/
</script>


<script type="text/javascript">
			var curr_lb_div;
			var is_modal = false;
			function ShowLightBox(lb_div, isModal)

			{
				document.getElementById(lb_div).style.display='block';
				document.getElementById('fade').style.display='block';
				curr_lb_div = lb_div;

				if (isModal)
					is_modal = true;
				else is_modal = false;
			}
			function HideLightBox()
			{
				if (document.getElementById(curr_lb_div))

				{
					document.getElementById(curr_lb_div).style.display='none';
					document.getElementById('fade').style.display='none';
					curr_lb_div = '';
				}
			}
</script>

<script type='text/javascript'>
$(document).ready(function() {


    $('.tips').tipsy({
    	//title: function() { return this.getAttribute('original-title').toUpperCase(); }
    	delayIn: 500,      	// delay before showing tooltip (ms)
        delayOut: 1000,     // delay before hiding tooltip (ms)
        fade: true,     	// fade tooltips in/out?
        fallback: '',    	// fallback text to use when no tooltip text
        gravity: 's',    	// gravity  nw | n | ne | w | e | sw | s | se | $.fn.tipsy.autoNS
        html: true,     	// is tooltip content HTML?
        live: true,     	// use live event support?
        offset: 0,       	// pixel offset of tooltip from element
        opacity: 0.8,    	// opacity of tooltip
        title: 'title',  	// attribute/callback containing tooltip text
        trigger: 'hover' 	// how tooltip is triggered - hover | focus | manual
    });

     $('.tips-right').tipsy({
        	delayIn: 500,      	// delay before showing tooltip (ms)
            delayOut: 1000,     // delay before hiding tooltip (ms)
            fade: true,     	// fade tooltips in/out?
            fallback: '',    	// fallback text to use when no tooltip text
            gravity: 'w',    	// gravity  nw | n | ne | w | e | sw | s | se | $.fn.tipsy.autoNS
            html: true,     	// is tooltip content HTML?
            live: true,     	// use live event support?
            offset: 0,       	// pixel offset of tooltip from element
            opacity: 0.8,    	// opacity of tooltip
            title: 'title',  	// attribute/callback containing tooltip text
            trigger: 'hover' 	// how tooltip is triggered - hover | focus | manual
        }).css({
            margin:'0px 0 0 0',
            border: '0px solid red',
            height: 'auto'
           });

  });
</script>

</body>
</html>






