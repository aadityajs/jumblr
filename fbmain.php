<?php
    require("facebook_sdk/facebook.php");

    //facebook application
    $fbconfig['appid' ]     = "256669324448487";
    $fbconfig['secret']     = "0dfe9b5a0b1f1e242a29a55beeafaa0e";
    //$fbconfig['baseurl']    = "http://unifiedinfotech.net/jumblr/customer-register.php";
    $fbconfig['baseurl']    = SITE_URL."customer-register.php";

    /*
     *
		App ID/API Key
		149533141837717

		App Secret
		4a71fe94b6dc627b80f0b1d395262c68
		App Namespace
		adityajyotisaha

		Site URL
		http://unifiedinfotech.net/jumblr/
		Site Domain
		http://unifiedinfotech.net/jumblr

		Contact Email
		aadityajs@facebook.com
		-----------------------------------------------
		App ID: 	256669324448487
		App Secret: 	0dfe9b5a0b1f1e242a29a55beeafaa0e
     */


    //
    if (isset($_GET['request_ids'])){
        //user comes from invitation
        //track them if you need
    }

    $user            =   null; //facebook user uid
    try{
        include_once("facebook_sdk/facebook.php");
    }
    catch(Exception $o){
        error_log($o);
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    //Facebook Authentication part
    $user       = $facebook->getUser();

    // We may or may not have this data based
    // on whether the user is logged in.
    // If we have a $user id here, it means we know
    // the user is logged into
    // Facebook, but we don’t know if the access token is valid. An access
    // token is invalid if the user logged out of Facebook.

    // scoope = email,publish_actions,user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_activities,friends_birthday,friends_checkins,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,friends_work_history,ads_management,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,offline_access,photo_upload,publish_checkins,publish_stream,read_friendlists,read_insights,read_mailbox,read_requests,rsvp_event,share_item,sms,status_update,user_online_presence,video_upload,xmpp_login

    $loginUrl   = $facebook->getLoginUrl(
            array(
                'scope'         => 'email,publish_actions,user_about_me,user_activities,user_birthday,user_checkins,user_education_history,user_events,user_games_activity,user_groups,user_hometown,user_interests,user_likes,user_location,user_notes,user_photos,user_questions,user_relationship_details,user_relationships,user_religion_politics,user_status,user_subscriptions,user_videos,user_website,user_work_history,friends_about_me,friends_activities,friends_birthday,friends_checkins,friends_education_history,friends_events,friends_games_activity,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,friends_notes,friends_photos,friends_questions,friends_relationship_details,friends_relationships,friends_religion_politics,friends_status,friends_subscriptions,friends_videos,friends_website,friends_work_history,ads_management,create_event,create_note,export_stream,friends_online_presence,manage_friendlists,manage_notifications,manage_pages,offline_access,photo_upload,publish_checkins,publish_stream,read_friendlists,read_insights,read_mailbox,read_requests,rsvp_event,share_item,sms,status_update,user_online_presence,video_upload,xmpp_login',
                'redirect_uri'  => $fbconfig['baseurl']
            )
    );

    $logoutUrl  = $facebook->getLogoutUrl();
	//echo $logoutUrl;
	//die;


	/*
	 * if ($user) {
	      try {
	        // Proceed knowing you have a logged in user who's authenticated.
	        $user_profile = $facebook->api('/me');
	      } catch (FacebookApiException $e) {
	        //you should use error_log($e); instead of printing the info on browser
	        d($e);  // d is a debug function defined at the end of this file
	        $user = null;
	      }
	    }
	 */

   //	echo "===========";
	//echo '<pre>'.print_r($user_profile,true).'</pre>';
	//die;


    //if user is logged in and session is valid.
    if ($user){
        //get user basic description
        $userInfo           = $facebook->api("/$user");

        //Retriving movies those are user like using graph api
        try{
            $likes = $facebook->api("/$user/likes");
            $frnds = $facebook->api("/$user/friends");
        }
        catch(Exception $o){
            d($o);
        }

	    function d($d){
	        echo '<pre>';
	        print_r($d,true);
	        echo '</pre>';
	    }

        //print_r($frnds);

   	//echo "===========";
	//echo '<pre>'.print_r($frnds,true).'</pre>';

        	// $userInfo['name'];
        	 $userInfo['id'];
      		 $userInfo['first_name'];
      		 $userInfo['last_name'];
      		 $userInfo['email'];
      		 //$userInfo['birthday'];

      		/* if (!empty($userInfo)) {
      	header('location:'.SITE_URL.'customer-register.php');
      		 }	*/






/**
 * @author Aditya Jyoti Saha
 * @name AadityaJS Fb FQL
 * @version 1.0
 * @return Array
 * @uses Write FQL as in desired format in the $fql variable, and get the array of details.
 */

      		 $code = $_REQUEST["code"];

      		 //auth user
      		 if(empty($code)) {
      		 	$dialog_url = 'https://www.facebook.com/dialog/oauth?client_id='
      		 	. $fbconfig['appid' ] . '&redirect_uri=' . urlencode($fbconfig['baseurl']) ;
      		 	echo("<script>top.location.href='" . $dialog_url . "'</script>");
      		 }


      		 //get user access_token
      		 $token_url = 'https://graph.facebook.com/oauth/access_token?client_id='
      		 . $fbconfig['appid' ] . '&redirect_uri=' . urlencode($fbconfig['baseurl'])
      		 . '&client_secret=' . $fbconfig['secret']
      		 . '&code=' . $code;
      		 $access_token = file_get_contents($token_url);

      		 // Pull all the details of a user
      		 //$fql = str_replace(" ","+","SELECT uid, name, pic_square, pic_big, profile_update_time, timezone, religion, birthday, birthday_date, devices, sex, hometown_location, relationship_status, significant_other_id, current_location, activities, interests, music, tv, movies, books, quotes, about_me, education , work, status, online_presence, locale, proxied_email, profile_url, email_hashes, pic_big_with_logo, pic_square_with_logo, pic_with_logo, pic_cover, verified, profile_blurb, family, website, contact_email, email, sports, inspirational_people, languages, likes_count, friend_count, mutual_friend_count FROM user WHERE uid = ".$userInfo[id]);
      		 $fql = urlencode("SELECT name, pic_square, pic_big, profile_update_time, timezone, religion, birthday, birthday_date, sex, hometown_location, relationship_status, current_location, activities, interests, music, tv, movies, books, quotes, about_me, education , work, status, online_presence, locale, profile_url, pic_big_with_logo, pic_square_with_logo, pic_with_logo, pic_cover, family, website, contact_email, email, sports, languages, likes_count, friend_count, mutual_friend_count FROM user WHERE uid = ".$userInfo[id]);

      		 $fqlUrlLike = urlencode("SELECT url FROM url_like WHERE user_id = ".$userInfo[id]);

      		$fqlLike = urlencode("SELECT page_id,name FROM page WHERE page_id IN (SELECT page_id FROM page_fan WHERE uid=".$userInfo[id].")");	//".$userInfo[id].")

      		 /*
      		  * SELECT page_id,name FROM page WHERE page_id IN (SELECT page_id FROM page_fan WHERE uid=me())
      		  *
      		  * Search with letter:
				SELECT name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1=me() ) AND strpos(lower(name),"a")==0

				Search Birthday:
				SELECT uid, name,pic_square, birthday_date FROM user WHERE (substr(birthday_date, 0, 2) = "07") AND uid IN (SELECT uid2 FROM friend WHERE uid1 = me()) order by name

				Get user fields by uid:
				SELECT uid,name,work_history,wall_count,username,movies FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1= me()) AND uid = '570097966' ORDER BY name ASC

      		  *
      		  */

      		 // Run fql query
      		 $fql_query_url = 'https://graph.facebook.com/'. '/fql?q='.$fql. '&' . $access_token;
      		 $fql_query_url_likes = 'https://graph.facebook.com/'. '/fql?q='.$fqlUrlLike. '&' . $access_token;
      		 $fql_likes = 'https://graph.facebook.com/'. '/fql?q='.$fqlLike. '&' . $access_token;


      		 $fql_query_result = file_get_contents($fql_query_url);
      		 $fql_query_obj = json_decode($fql_query_result, true);

      		 $fql_user_likes_result = file_get_contents($fql_query_url_likes);
      		 $fql_user_likes_obj = json_decode($fql_user_likes_result, true);

      		 $fql_likes_result = file_get_contents($fql_likes);
      		 $fql_likes_obj = json_decode($fql_likes_result, true);

      		 /*
      		  * SELECT url FROM url_like WHERE user_id = me()

				SELECT url, normalized_url, share_count, like_count, comment_count, total_count,
				commentsbox_count, comments_fbid, click_count FROM link_stat WHERE url="http://www.facebook.com/unifieddemos"
      		  *
      		  */

      		 //display results of fql query
      		 //echo '<pre>';
      		 //print_r("query results:");
      		 //print_r($fql_query_obj);
      		 //echo '</pre>';


      		 $i=0;
      		 foreach ($fql_query_obj['data'][0] as $key => $value) {
      		 	if (is_array($value)) {
      		 		$fbUser[$key] = serialize($value);
      		 	} else {
      		 		$fbUser[$key] = $value;
      		 	}
      		 	$i++;
      		 }

      		$j = 0;
    		foreach ($fql_user_likes_obj['data'] as $key => $value) {
    			//echo $value['url'];
    			//break;
      		 	$fbUserLikes['url_likes'][$key] = $value;
      		 	$fbUser['url_likes_str'] .= $value['url'].',';
      		 	$fbUser['url_likes_count'] = $j;
      		 	$j++;
      		 }

    		foreach ($fql_likes_obj['data'] as $key => $value) {
    			//echo $value['name'];
    			//break;
      		 	$fbUser['likes'] .= $value['name'].'~';
      		 	$j++;
      		 }

      		 $fbUser['fb_id'] = $userInfo['id'];

      		 //echo '<pre>'.print_r($likes, true).'</pre>';
      		 //echo '<pre>'.print_r($fbUser, true).'</pre>';


    }	// end if user










?>
