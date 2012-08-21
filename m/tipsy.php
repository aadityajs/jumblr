<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
<link rel="stylesheet" href="css/tipsy.css" type="text/css" />
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type='text/javascript'>
$(document).ready(function() {

    $('#example-1').tipsy();

    $('#north').tipsy({gravity: 'n'});
    $('#south').tipsy({gravity: 's'});
    $('#east').tipsy({gravity: 'e'});
    $('#west').tipsy({gravity: 'w'});

    $('#auto-gravity').tipsy({gravity: $.fn.tipsy.autoNS});

    $('#example-fade').tipsy({fade: true});

    $('#example-custom-attribute').tipsy({title: 'id'});
    $('#example-callback').tipsy({title: function() { return this.getAttribute('original-title').toUpperCase(); } });
    $('#example-fallback').tipsy({fallback: "Where's my tooltip yo'?" });

    $('#example-html').tipsy({html: true });

  });
</script>



<table id='gravity' cellspacing='5'">
		  <tr>
		    <td>
		      <a id='north' href='#' title='This is an example of north gravity'>North</a>
		    </td>
		    <td>
		      <a id='south' href='#' title='This is an example of south gravity'>South</a>
		    </td>
		  </tr>
		  <tr>
		    <td>
		      <a id='east' href='#' title='This is an example of east gravity'>East</a>
		    </td>
		    <td>
		      <a id='west' href='#' title='This is an example of west gravity'>West</a>
		    </td>
		  </tr>
		</table>
       	<a id='example-1' href='#' title='Hello World'>Hover over me</a>
