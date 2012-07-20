<?php
error_reporting(0);
define("SITE_URL","http://aditya.com/jumblr/");

//define("SITE_URL","http://unifiedinfotech.net/jumblr/");

define('TITLE', "Jumblr.com");
define('DB_SERVER', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
//define('DB_PASS', "unified2010");

//define('UPLOAD_PATH',"http://unifiedinfotech.net/jumblr/upload_files/files/");
define('UPLOAD_PATH',"http://aditya.com/jumblr/upload_files/files/");
define('PROFILE_IAMGE_PATH',"upload_files/profile_image/");

define('SITE_FB_PROFILE',"http://www.facebook.com/jumblr");
define('SITE_TWITTER_PROFILE',"http://www.twitter.com/jumblr");

define('DB_DATABASE', "jumblr");
define('TABLE_ADMIN', "jumblr_admin");
define('TABLE_SETTING', "jumblr_setting");
define('TABLE_MERCHANTS', "jumblr_merchants");
define('TABLE_STORES', "jumblr_merchant_store");
define('TABLE_STORE_CATEGORIES', "jumblr_merchant_store_categories");
define('TABLE_STORES_PROFILEIMG', "jumblr_merchant_store_profileimage");
define('TABLE_STORES_LOCATION', "jumblr_merchant_store_location");
define('TABLE_STORES_REVIEW', "jumblr_merchant_store_sitereview");
define('TABLE_STORES_FOLLOWED', "jumblr_user_storefollowed");
define('TABLE_COUPON', "jumblr_coupons");
define('TABLE_MERCHANT_IMAGES', "jumblr_merchant_images");
define('TABLE_ORDER_DETAILS', "jumblr_orders");
define('TABLE_DEALS', "jumblr_deals");
define('TABLE_DEAL_IMAGES', "jumblr_deal_images");
define('TABLE_DEALS_ITEM', "jumblr_deal_item");
define('TABLE_DEALS_USER_REF', "jumblr_user_referal_deal");
define('TABLE_DEALS_MERCHANT', "jumblr_merchant_deals");
define('TABLE_DEALS_MERCHANT_LOCATION', "jumblr_merchant_deal_store_locations");

define('TABLE_USER_SUBSCRIPTION', "jumblr_user_subscriptions");
define('TABLE_USER_PREFERENCE', "jumblr_user_preference");
define('TABLE_UPCOMING_DEALS', "jumblr_upcoming_deals");
define('TABLE_TESTMONIALS', "jumblr_testimonials");
define('TABLE_CATEGORIES', "jumblr_categories");
define('TABLE_CITIES', "jumblr_cities");
define('TABLE_COUNTRIES', "jumblr_countries");
define('TABLE_FAQS', "jumblr_faqs");
define('TABLE_FAQS_CATEGORY', "jumblr_faqs_category");
define('TABLE_FAQS_VOTE', "jumblr_votefaq");
define('TABLE_TRANSACTION', "jumblr_transaction");
define('TABLE_PAGES', "jumblr_pages");
define('TABLE_USERS', "jumblr_users");
define('TABLE_REFERRAL', "jumblr_referral_amount");
define('TABLE_SUBSCRIPTIONS', "jumblr_deal_subscriptions");
define('TABLE_NEWSLETTER_SUBSCRIPTIONS', "jumblr_newsletter_subscriptions");
define('TABLE_GIFT_CODES', "jumblr_gift_codes");
define('TABLE_COUPONS', "jumblr_coupons");
define('TABLE_NEWSLETTER', "jumblr_newsletter");
define('TABLE_LANGUAGES', "jumblr_languages");
define('TABLE_FEATURED_BUSINESSES', "jumblr_featured_businesses");
define('TABLE_DAILY_SUBSCRIPTIONS', "jumblr_daily_subscriptions");
define('TABLE_ADVERTISEMENTS', "jumblr_advertisements");
define('TABLE_GIFT_ORDERS', "jumblr_gift_cards");
define('TABLE_MERCHANT_COMMISSIONS', "jumblr_commissions");
define('TABLE_DISCUSSIONS', "jumblr_discussions");
define('TABLE_API', "jumblr_gateway_setting");
define('TABLE_BUCK_TRACKER', "jumblr_buck_tracker");
define('TABLE_BUCK_VAULT', "jumblr_buck_vault");
define('TABLE_BUCK_TRANSACTION', "jumblr_buck_transaction");
define('TABLE_BUCK_PERCENT', "jumblr_buck_percent");
define('TABLE_CITY_IMAGES', "jumblr_cities_image");
define('TABLE_TEMP_PASSWORD', "jumblr_temp_password");
define('TABLE_BUSINESS_FAQS', "jumblr_businessfaqs");
define('TABLE_REFUND_REQUEST', "jumblr_refund_request");
define('TABLE_FB_USER', "jumblr_fb_user");
define('TABLE_DEAL_GROUP', "jumblr_deal_group");
define('TABLE_FB_USER_VIOLATION', "jumblr_fb_user_violation");



require("include/functions.php");
?>