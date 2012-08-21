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
       	<!-- <div style="width:310px; padding-top:20px;"><img src="images/map.png" alt=""></div>
       	 <div style="width:320px; margin:0 20px 0 20px; padding-top:35px;">Why not visit our store at <br> 292 St kilda Road, St Kilda VIC 3182</div>-->
         <div class="payment_bg" style="float: right;">
         	<img src="images/paypal_01.png" alt="">
            <img src="images/paypal_02.png" alt="">
            <img src="images/paypal_03.png" alt="">
         </div>
      </div>
      <div class="clear"></div>
      <div class="copy_right">
      	 <ul>
         	 <li>
         	 	<a href="<?php echo SITE_FB_PROFILE; ?>"><img src="images/social_06.png" alt=""></a>
         	 	<a href="<?php echo SITE_TWITTER_PROFILE; ?>"><img src="images/social_07.png" alt=""></a>
         	 </li>
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
<?php if ($_GET['recommend'] == 'import' && isset($_SESSION['recomEmails'])) { ?>
<script type="text/javascript">
	$('document').ready(function() {
		recomEmailGet();
		});
</script>
<?php } ?>

<script>
$("div#click").click(function () {
$("div#locations").slideToggle(300);
});

$("a#locateDealMap").click(function () {
	$("div#dealMap").slideToggle(300);
	initialize();
});




/* Date search code
 */
 
 $("#openDateSearch").click(function () {
		$("#search_date").slideToggle(300);
		//var dt = jQuery.noConflict();
		// Multi date selection
		$('#date_srch_cal').multiDatesPicker();
		$('#date_srch_cal').focus(function() {
			$('#date_srch_cal').css('background-color','#707070');
			$('#date_srch_cal').css('color','#efefef');
		});

		//$('#date_srch').datetimepicker();
		$('#date_srch').focus(function() {
			$('#date_srch').css('background-color','#707070');
			$('#date_srch').css('color','#efefef');
		});

		//var dt = jQuery.noConflict();
		//$('#date_srch1').datetimepicker();
		$('#date_srch1').focus(function() {
			$('#date_srch1').css('background-color','#707070');
			$('#date_srch1').css('color','#efefef');
		});
	});


$("#submit").click(function () {

//window.loca
});

$(document).ready(function(){
//$("div#locations").ready(function() {
	$("div#locations").hide(0);
	$("#dropBox").hide(0);
	$("#search_date").hide(0);

	//$("div#dealMap").hide(0);
//});
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
		$("div#menu").css("margin","20px 0px 0 90px");

});
$("div#menu").mouseout(function () {
	$("div#menu").slideUp("fast");			// slideToggle() / toggle()
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


<script type="text/javascript">
//$j = jQuery.noConflict(true);
			$(document).ready(function() {

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$("#invite").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$("#various2").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$("#various3").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$("#various4").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$("#various5").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});
			$("#gift").fancybox({
			//alert("dsfdsfdsf");
				'titlePosition'		: 'inside',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade'
			});


			$("#nodeal_info").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});

			$("#nodeal_info_btn").fancybox({
				'titlePosition'		: 'inside',
				'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'hideOnOverlayClick' : false
			});


			$("#variousall").fancybox({
				'padding':          0,
			    'cyclic':       true,
			    'width':        625,
			    'height':       350,
			    'padding':      0,
			    'margin':      0,
			    'speedIn':      300,
			    'speedOut':     300,
			    'transitionIn': 'elastic',
			    'transitionOut': 'elastic',
			    'autoDimensions': 'true',
			    'easingIn':     'swing',
			    'easingOut':    'swing',
			    'scrolling' : 'no',
	            'hideOnContentClick' : true,
	            'onCleanup' : gohome,
			    'titleShow' : false,
			    'hideOnOverlayClick' : false

			});
			$("#ref_various1").fancybox({
							'titlePosition'		: 'inside',
							'speedIn':      300,
							'speedOut':     300,
							'easingIn':     'swing',
							'easingOut':    'swing',
							'hideOnOverlayClick' : false
						});



		});
	</script>

<script type="text/javascript">
	//$q = jQuery.noConflict();

	function recomEmailGet() {
		//$(document).ready(function() {
			$("#various4").fancybox({
					'titlePosition'		: 'inside',
					'transitionIn'		: 'none',
					'transitionOut'		: 'none',
					'hideOnOverlayClick' : false
				}).trigger('click');
	       //});
    	 }

	function NewsSucc() {
		$(document).ready(function() {
					$("#various3").fancybox({
							'titlePosition'		: 'inside',
							'transitionIn'		: 'none',
							'autoDimensions': 'true',
							'transitionOut'		: 'none',
							'hideOnOverlayClick' : false
						}).trigger('click');
			       });
	}

	function Gift() {
		$(document).ready(function() {
					$("#gift").fancybox({
						//alert("dsfdsfdsf");
						'titlePosition'		: 'inside',
						'transitionIn'		: 'fade',
						'transitionOut'		: 'fade'
						}).trigger('click');
			       });
	}
	   </script>
</body>
</html>






