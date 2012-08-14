<html>

    <head>

      <title>My Great Website</title>
    <link rel="stylesheet" href="js/themes/base/jquery.ui.all.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.position.js"></script>
	<script src="js/jquery.ui.autocomplete.js"></script>
    </head>

    <body>


       <meta charset="utf-8">

	<style>
	#project-label {
		display: block;
		font-weight: bold;
		margin-bottom: 1em;
	}
	#project-icon {
		float: left;
		height: 32px;
		width: 32px;
	}
	#project-description {
		margin: 0;
		padding: 0;
	}
	</style>
	<script>
	$(function() {
		var projects = [
			{
				value: "jquery",
				label: "jQuery",
				desc: "the write less, do more, JavaScript library",
				icon: "jquery_32x32.png"
			},
			{
				value: "jquery-ui",
				label: "jQuery UI",
				desc: "the official user interface library for jQuery",
				icon: "jqueryui_32x32.png"
			},
			{
				value: "sizzlejs",
				label: "Sizzle JS",
				desc: "a pure-JavaScript CSS selector engine",
				icon: "sizzlejs_32x32.png"
			}
		];

$('#project').keyup(function (evt) {
        if(evt.keyCode === 50) {

            alert(evt.keyCode);
		//autocomplete.simulate("keydown", { keyCode: $.ui.keyCode.DOWN });

		$( "#project" ).autocomplete({
			minLength: 0,
			source: projects,
			focus: function( event, ui ) {
				$( "#project" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				$( "#project" ).val( ui.item.label );
				$( "#project-id" ).val( ui.item.value );
				$( "#project-description" ).html( ui.item.desc );
				$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );

				return false;
			}
		})

		.data( "autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li></li>" )
				.data( "item.autocomplete", item )
				.append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
				.appendTo( ul );
		};




            }
        });



	});
	</script>






<div class="demo">
	<div id="project-label">Select a project (type "j" for a start):</div>
	<img id="project-icon" src="images/transparent_1x1.png"  class="ui-state-default"//>
	<input id="project"/>
	<input type="hidden" id="project-id"/>
	<p id="project-description"></p>
</div><!-- End demo -->



<div class="demo-description">
<p>You can use your own custom data formats and displays by simply overriding the default focus and select actions.</p>
<p>Try typing "j" to get a list of projects or just press the down arrow.</p>
</div><!-- End demo-description -->

    </body>

 </html>