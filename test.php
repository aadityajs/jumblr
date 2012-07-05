<html>

    <head>

      <title>My Great Website</title>

    </head>

    <body>

      <div id="fb-root"></div>

		<script src="http://connect.facebook.net/en_US/all.js"></script>
		
		<script>
		
		FB.init
		(
			{
				appId: '192309027517422', 
				status: true,
				cookie: true, xfbml: true
			}
		);
		
		FB.Event.subscribe('auth.login', function(response) 
		{
			window.location.reload();
		});
		
		</script>

       

       <?php

		function get_facebook_cookie($app_id, $app_secret) 
		{
			$args = array();
			parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
			ksort($args);
			$payload = '';
			
			foreach ($args as $key => $value) 
			{
				if ($key != 'sig') 
				{
					$payload .= $key . '=' . $value;
				}
			}
			
			if (md5($payload . $app_secret) != $args['sig']) 
			{
				return null;
			}
			
			return $args;
		}

	   	$cookie = get_facebook_cookie('192309027517422', '7f1eb32e301277d025d35b77b06dd863');	

	  ?>

          <?php if ($cookie) 
		  { 

		  $user = json_decode(file_get_contents('https://graph.facebook.com/me?access_token=' .$cookie['access_token']));
			
	
		   //var_dump($user);
		   //echo '<pre>'.print_r($user,true).'</pre>';
		  
		  ?>

      Welcome <?php echo $user->name;
      				echo $user->first_name;
      				echo $user->gender;
      				echo $user->timezone;
      			
      				echo $user->location->name;	

	  				echo $user->email;
	  				
	  				echo $user->hometown->name;

	   ?>

   

	  <fb:login-button perms="email" autologoutlink="true" onlogin="window.location.reload()"></fb:login-button> 

       <!--  <script>window.location.reload()</script>-->

	
    <?php } else { ?>

    

  <fb:login-button perms="email" autologoutlink="true">Login</fb:login-button> 
      
      
<!--     <a id="fb-login" class="" href="javascript:void(0);">
<img src="fb_login.png">
</a> -->
<script>


document.getElementById("fb-login").onclick = function()
	{ 
	FB.login(function(response)
		{
		window.location.href = "http://nuwaytechnologies.com/armadealz/receiver3.php";
		},
		{
		perms : "email,share_item"
		}
	);
};

</script>

     <!-- <script>window.location.reload()</script>-->

    <?php }

	



	 ?>

  <!--         <div align="center">

           <img id="image"/>

           <div id="name"></div>

            <div id="email"></div>

           </div>
-->
    </body>

 </html>