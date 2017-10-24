<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
- Name:  eHealth Lang - English
- Description:  English language file for eHealth App
*/

/* ||||||||||||||||||||| HEADER ||||||||||||||||||||| */
/* ------------------ Main Menu ------------------ */
$lang['toggle_navigation']				= 'Toggle Navigation';
$lang['nav_home']						= 'Home';
$lang['nav_all_users']					= 'All Users';
$lang['nav_profile']					= 'Profile';
$lang['nav_credits']					= 'Credits';
$lang['nav_admin']						= 'Admin';
$lang['nav_login']						= 'Login';
$lang['nav_logout']						= 'Logout';
$lang['nav_back']						= 'Back';

/* ||||||||||||||||||||| GENERAL ||||||||||||||||||||| */
$lang['gen_total_users']				= 'Total Users :';

/* ||||||||||||||||||||| USER PROFILE DETAILS FOR ALL PAGES ||||||||||||||||||||| */
$lang['profile_you_are_online']			= 'You are online';
$lang['profile_user_picture']			= 'User Profile Picture';
$lang['profile_rel_accounts']			= 'Related Accounts';
$lang['profile_rel_accounts_warning']	= '<strong>Info!</strong> There is no related social accounts!';
$lang['profile_deactivated_alert']		= 'This account <b>deactivated</b> by Administrator.';
$lang['profile_title_go_profile']		= 'Go To Profile';
$lang['profile_title_profile']			= 'Profile';
$lang['profile_title_image']			= 'Image';
$lang['profile_title_activation']		= 'Activation';
$lang['profile_button_active']			= 'Active';
$lang['profile_button_deactive']		= 'Deactive';
$lang['profile_deactive_tooltip']		= 'Click For Deactivate';
$lang['profile_active_tooltip']			= 'Click For Activate';
$lang['profile_provider']				= 'Provider';
$lang['profile_identifier']				= 'Identifier';
$lang['profile_user_name']				= 'User Name';
$lang['profile_first_name']				= 'First Name';
$lang['profile_last_name']				= 'Last Name';
$lang['profile_email']					= 'Email';
$lang['profile_phone']					= 'Phone';
$lang['profile_gender']					= 'Gender';
$lang['profile_language']				= 'Language';
$lang['profile_age']					= 'Age';
$lang['profile_birth_day']				= 'Birth Day';
$lang['profile_birth_month']			= 'Birth Month';
$lang['profile_birth_year']				= 'Birth Year';
$lang['profile_job_title']				= 'Job Title';
$lang['profile_organization']			= 'Organization';
$lang['profile_web_site']				= 'Web Site';
$lang['profile_city']					= 'City';
$lang['profile_region']					= 'Region';
$lang['profile_country']				= 'Country';
$lang['profile_zip']					= 'Zip Code';
$lang['profile_account_url']			= 'Profile URL';
$lang['profile_address']				= 'Address';
$lang['profile_description']			= 'Description';
$lang['profile_referrer']				= 'Referrer';
$lang['profile_platform']				= 'Platform';
$lang['profile_mobile']					= 'Mobile';
$lang['profile_browser']				= 'Browser';
$lang['profile_browser_ver']			= 'Browser Version';
$lang['profile_created_time']			= 'Created Time';
$lang['profile_modified_time']			= 'Last Login';
$lang['profile_ip_address']				= 'Ip Address';
$lang['profile_gl_status']				= 'Geolocation Status';
$lang['profile_gl_city']				= 'City';
$lang['profile_gl_area_code']			= 'Area Code';
$lang['profile_gl_dma_code']			= 'DMA Code';
$lang['profile_gl_country_code']		= 'Country Code';
$lang['profile_gl_country_name']		= 'Country Name';
$lang['profile_gl_continent_code']		= 'Continent Code';
$lang['profile_gl_latitude']			= 'Latitude';
$lang['profile_gl_longitude']			= 'Longitude';
$lang['profile_gl_region']				= 'Region';
$lang['profile_gl_region_code']			= 'Region Code';
$lang['profile_gl_region_name']			= 'Region Name';
$lang['profile_gl_curr_code']			= 'Curr. Code';
$lang['profile_gl_curr_symbol']			= 'Curr. Symbol';
$lang['profile_gl_curr_convert']		= 'Curr. Convert';

/* ||||||||||||||||||||| 404 PAGE ||||||||||||||||||||| */
$lang['headline_404']					= '404 Error';
$lang['headline_404_explanation']		= 'For Some Reason The Page You Requested Could Not Be Found On Our Server';

/* ||||||||||||||||||||| DEACTIVATED ACCOUNT PAGE ||||||||||||||||||||| */
$lang['headline_deactivated']			= 'Deactive Account';
$lang['view_deactivated_alert']			= 'Your account <b>deactivated</b> by Administrator. Please login with different account!';

/* ||||||||||||||||||||| LOGIN PAGE ||||||||||||||||||||| */
$lang['headline_cisociall_login']		= 'eHealth Login';
$lang['view_login_explanation']			= 'Please login to access the application.';

/* ||||||||||||||||||||| LOGGED IN PAGE ||||||||||||||||||||| */
$lang['headline_you_are_loggedin']		= 'You Are Logged In';
$lang['view_loggedin_alert']			= 'You have been successfully logged in!</a>';
$lang['loggedin_delete_my_account']		= 'Delete My Account';
$lang['loggedin_delete_tooltip']		= 'If you login again, system  creates your user account automatically and save in DB!';

/* ||||||||||||||||||||| ALL USERS PAGE ||||||||||||||||||||| */
$lang['headline_all_users']				= 'All Social Users';
$lang['view_all_users_explanation']		= 'After user successfully login, system creates user account and save user datas into the database automatically. Below the line, you can see all successfully authenticated users. User list order by last user and last login time. If you authenticate successfully , your account will be top of the user list and show "<em>You are online</em>" info.';

/* ||||||||||||||||||||| ALL USERS BY PROVIDER PAGE ||||||||||||||||||||| */
$lang['headline_prov_users']			= 'Users';
$lang['view_prov_users_explanation']	= 'After user successfully login, system creates user account and save user datas into the database automatically. Below the line, you can see all successfully authenticated users order by provider name and last login time. If you authenticate successfully , your account will be top of the user list and show "<em>You are online</em>" info.';

/* ||||||||||||||||||||| USER PROFILE PAGE ||||||||||||||||||||| */
$lang['headline_user_profile']			= 'User Profile';
$lang['view_user_profile_explanation']	= 'After user successfully login, system creates user account and save user datas into the database automatically. This datas can be different for Social Network Providers api policies. Below the line, you can see user profile details and related accounts. Related accounts listed by same email address. Some providers does not share users email address. Thats time there is no related social accounts will be listed.';

/* ||||||||||||||||||||| ALL USERS ALERT PAGE ||||||||||||||||||||| */
$lang['headline_all_users_alert']		= 'Please Login!';
$lang['view_all_users_alert']			= 'Please login to access this page content !';




/* ||||||||||||||||||||| ADMIN ALERT PAGE ||||||||||||||||||||| */
$lang['headline_admin_error']			= 'Administrator!';
$lang['view_admin_error']				= 'You must be administrator to access this page! Please login with admin social account.';

/* ||||||||||||||||||||| ADMIN DASHBOARD PAGE ||||||||||||||||||||| */
$lang['btn_admin_all_users']			= 'All Users Page';
$lang['title_admin_social_users']		= 'Social Users';
$lang['title_admin_world_users']		= 'Users Around The World';
$lang['title_google_users']				= 'Google Users';
$lang['title_facebook_users']			= 'Facebook Users';
$lang['title_twitter_users']			= 'Twitter Users';
$lang['title_instagram_users']			= 'Instagram Users';
$lang['title_linkedin_users']			= 'Linkedin Users';
$lang['title_vimeo_users']				= 'Vimeo Users';
$lang['title_foursquare_users']			= 'Foursquare Users';
$lang['title_dribbble_users']			= 'Dribbble Users';
$lang['title_ok_users']					= 'Odnoklassniki Users';
$lang['title_vk_users']					= 'Vkontakte Users';
$lang['title_yandex_users']				= 'Yandex Users';
$lang['title_mailru_users']				= 'Mailru Users';
$lang['title_500px_users']				= '500px Users';
$lang['title_twitch_users']				= 'Twitch Users';
$lang['title_bitbucket_users']			= 'Bitbucket Users';
$lang['title_github_users']				= 'Github Users';
$lang['title_server_details']			= 'Server Details';


/* ||||||||||||||||||||| FOOTER ||||||||||||||||||||| */
/* ------------------ Main Menu ------------------ */
$lang['footer_all_rights_reserved']		= 'All Rights Reserved by';
