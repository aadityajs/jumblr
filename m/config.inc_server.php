<?php
error_reporting(0);
//define("SITE_URL","http://localhost/getdeals/");

define("SITE_URL","http://unifiedinfotech.net/getdeals/");

define('TITLE', "GetDeals.com");
define('DB_SERVER', "localhost");
define('DB_USER', "root");
//define('DB_PASS', "");
define('DB_PASS', "unified2010");

define('UPLOAD_PATH',"http://unifiedinfotech.net/getdeals/upload_files/files/");
//define('UPLOAD_PATH',"http://localhost/getdeals/upload_files/files/");
define('PROFILE_IAMGE_PATH',"upload_files/profile_image/");

define('DB_DATABASE', "get_deals");
define('TABLE_ADMIN', "getdeals_admin");
define('TABLE_SETTING', "wakadeal_setting");
define('TABLE_MERCHANTS', "getdeals_merchants");
define('TABLE_STORES', "getdeals_merchant_store");
define('TABLE_STORE_CATEGORIES', "getdeals_merchant_store_categories");
define('TABLE_STORES_PROFILEIMG', "getdeals_merchant_store_profileimage");
define('TABLE_STORES_LOCATION', "getdeals_merchant_store_location");
define('TABLE_STORES_REVIEW', "getdeals_merchant_store_sitereview");
define('TABLE_STORES_FOLLOWED', "getdeals_user_storefollowed");
define('TABLE_COUPON', "getdeals_coupons");
define('TABLE_MERCHANT_IMAGES', "getdeals_merchant_images");
define('TABLE_ORDER_DETAILS', "getdeals_orders");
define('TABLE_DEALS', "getdeals_deals");
define('TABLE_DEAL_IMAGES', "getdeals_deal_images");
define('TABLE_DEALS_ITEM', "getdeals_deal_item");
define('TABLE_DEALS_USER_REF', "getdeals_user_referal_deal");
define('TABLE_DEALS_MERCHANT', "getdeals_merchant_deals");
define('TABLE_DEALS_MERCHANT_LOCATION', "getdeals_merchant_deal_store_locations");

define('TABLE_USER_SUBSCRIPTION', "getdeals_user_subscriptions");
define('TABLE_USER_PREFERENCE', "getdeals_user_preference");
define('TABLE_UPCOMING_DEALS', "getdeals_upcoming_deals");
define('TABLE_TESTMONIALS', "getdeals_testimonials");
define('TABLE_CATEGORIES', "getdeals_categories");
define('TABLE_CITIES', "getdeals_cities");
define('TABLE_COUNTRIES', "getdeals_countries");
define('TABLE_FAQS', "getdeals_faqs");
define('TABLE_FAQS_CATEGORY', "getdeals_faqs_category");
define('TABLE_FAQS_VOTE', "getdeals_votefaq");
define('TABLE_TRANSACTION', "getdeals_transaction");
define('TABLE_PAGES', "getdeals_pages");
define('TABLE_USERS', "getdeals_users");
define('TABLE_REFERRAL', "getdeals_referral_amount");
define('TABLE_SUBSCRIPTIONS', "getdeals_deal_subscriptions");
define('TABLE_NEWSLETTER_SUBSCRIPTIONS', "getdeals_newsletter_subscriptions");
define('TABLE_GIFT_CODES', "getdeals_gift_codes");
define('TABLE_COUPONS', "getdeals_coupons");
define('TABLE_NEWSLETTERS', "getdeals_newsletters");
define('TABLE_LANGUAGES', "getdeals_languages");
define('TABLE_FEATURED_BUSINESSES', "getdeals_featured_businesses");
define('TABLE_DAILY_SUBSCRIPTIONS', "getdeals_daily_subscriptions");
define('TABLE_ADVERTISEMENTS', "getdeals_advertisements");
define('TABLE_GIFT_ORDERS', "getdeals_gift_cards");
define('TABLE_MERCHANT_COMMISSIONS', "getdeals_commissions");
define('TABLE_DISCUSSIONS', "getdeals_discussions");
define('TABLE_API', "getdeals_gateway_setting");
define('TABLE_BUCK_TRACKER', "getdeals_buck_tracker");
define('TABLE_BUCK_VAULT', "getdeals_buck_vault");
define('TABLE_BUCK_TRANSACTION', "getdeals_buck_transaction");
define('TABLE_BUCK_PERCENT', "getdeals_buck_percent");
define('TABLE_CITY_IMAGES', "getdeals_cities_image");



require("include/functions.php");
?>