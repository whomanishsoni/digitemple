<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//Front pages
$route['about-us']= 'front/about_us';
$route['contact-us']= 'front/contact_us';
$route['news']= 'front/news';
$route['gallery']= 'front/gallery';
$route['our-team']= 'front/team';
$route['campaign']= 'front/campaign';
$route['volunteer']= 'front/volunteer';
$route['privacy-policy']= 'front/privacy_policy';
$route['terms-and-conditions']= 'front/terms_and_conditions';

$route['events']= 'front/event';
$route['event-details']= 'front/event_details';

$route['causes']="front/causes";
$route['cause-details/(:num)']= 'front/cause_details/$1';

$route['projects']="front/projects";
$route['project-details/(:num)']= 'front/project_details/$1';

$route['events']="front/events";
$route['event-details/(:num)']= 'front/event_details/$1';

$route['save-contact-us']='front/save_contact_us';

$route['news']="front/news";
$route['news-details/(:num)']= 'front/news_details/$1';

//Donation Page
$route['donate'] = 'front/donate';
$route['donate-action'] = 'front/donate_action';
$route['success'] = 'front/donation_success';


$route['razorpay-success'] = 'front/razorpay_success';
$route['razorpay-cancel'] = 'front/razorpay_cancel';

$route['paypal_cancel'] = 'front/paypal_cancel';
$route['paypal_success'] = 'front/paypal_success';

//Cause donation
$route['save-cause-donation'] = 'front/save_cause_donation';
$route['cause_paypal_cancel'] = 'front/cause_paypal_cancel';
$route['cause_paypal_success'] = 'front/cause_paypal_success';

$route['cause-razorpay-success'] = 'front/cause_razorpay_success';
$route['cause-razorpay-cancel'] = 'front/cause_razorpay_cancel';


//Admin Routes
$route['admin/upload-summernote-image'] = 'admin/content/upload_summernote_image';

$route['admin'] = 'admin/content/login';
$route['admin/login'] = 'admin/content/login';
$route['admin/landing'] = 'admin/content/landing';
$route['admin/logout'] = 'admin/content/logout';
$route['admin/register'] = 'admin/content/register';
$route['admin/login-action'] = 'admin/content/login_action';
$route['admin/register-save'] = 'admin/content/register_save';
$route['admin/vendor-register'] = 'admin/content/vendor_register';
$route['admin/vendor-register-save'] = 'admin/content/vendor_register_save';
$route['admin/forgot-password'] = 'admin/content/forgot_password';
$route['admin/forgot-password-action'] = 'admin/content/forgot_password_action';
$route['admin/reset-password/(:any)/(:any)'] = 'admin/content/reset_password';
$route['admin/reset-password-action'] = 'admin/content/reset_password_action';
$route['admin/change-password'] = 'admin/dashboard/update_password';
$route['admin/update-password-action'] = 'admin/dashboard/update_password_action';
$route['admin/dashboard'] = 'admin/dashboard/index';
$route['admin/profile'] = 'admin/dashboard/profile';
$route['admin/profile-save'] = 'admin/dashboard/profile_save';
$route['admin/lang'] = 'admin/dashboard/lang';

$route['admin/report'] = 'admin/report/index';
$route['admin/coin-report'] = 'admin/report/coin';
$route['admin/item-report'] = 'admin/report/item';
$route['admin/expense-report'] = 'admin/report/expense';

$route['admin/expense-print']='admin/report/expense_print';
$route['admin/donation-print']='admin/report/donation_print';

//Donation Module
$route['admin/donation'] = 'admin/donation/index';
$route['admin/add-donation'] = 'admin/donation/add_donation';
$route['admin/update-donation/(:num)'] = 'admin/donation/update_donation/$1';
$route['admin/save-donation'] = 'admin/donation/save_donation';
$route['admin/delete-donation/(:num)'] = 'admin/donation/delete_donation/$1';
$route['admin/donation-receipt/(:num)'] = 'admin/donation/donation_receipt/$1';
$route['admin/donation-export'] = 'admin/donation/donation_export/';


//Admin Module
$route['admin/staff'] = 'admin/staff/index';
$route['admin/add-staff'] = 'admin/staff/add_staff';
$route['admin/update-staff/(:num)'] = 'admin/staff/update_staff/$1';
$route['admin/save-staff'] = 'admin/staff/save_staff';
$route['admin/delete-staff/(:num)'] = 'admin/staff/delete_staff/$1';

// Department
$route['admin/donation-category'] = 'admin/donation_category/index';
$route['admin/add-donation-category'] = 'admin/donation_category/add_department';
$route['admin/update-donation-category/(:num)'] = 'admin/donation_category/update_department/$1';
$route['admin/save-donation-category'] = 'admin/donation_category/save_department';
$route['admin/delete-donation-category/(:num)'] = 'admin/donation_category/delete_department/$1';

// Clients
$route['admin/donators'] = 'admin/donator/index';
$route['admin/add-donator'] = 'admin/donator/add_donator';
$route['admin/donator-donation/(:num)'] = 'admin/donator/donator_donation/$1';
$route['admin/update-donator/(:num)'] = 'admin/donator/update_donator/$1';
$route['admin/save-donator'] = 'admin/donator/save_donator';
$route['admin/delete-donator/(:num)'] = 'admin/donator/delete_donator/$1';

// item
$route['admin/items'] = 'admin/item/index';
$route['admin/add-item'] = 'admin/item/add_item';
$route['admin/update-item/(:num)'] = 'admin/item/update_item/$1';
$route['admin/save-item'] = 'admin/item/save_item';
$route['admin/delete-item/(:num)'] = 'admin/item/delete_item/$1';


//Donation Module
$route['admin/item-donation'] = 'admin/item_donation/index';
$route['admin/add-item-donation'] = 'admin/item_donation/add_item_donation';
$route['admin/update-item-donation/(:num)'] = 'admin/item_donation/update_item_donation/$1';
$route['admin/save-item-donation'] = 'admin/item_donation/save_item_donation';
$route['admin/delete-item-donation/(:num)'] = 'admin/item_donation/delete_item_donation/$1';
$route['admin/item-receipt/(:num)'] = 'admin/item_donation/item_receipt/$1';
$route['admin/item-donation-export'] = 'admin/item_donation/item_donation_export';

// expense
$route['admin/expense'] = 'admin/expense/index';
$route['admin/add-expense'] = 'admin/expense/add_expense';
$route['admin/update-expense/(:num)'] = 'admin/expense/update_expense/$1';
$route['admin/save-expense'] = 'admin/expense/save_expense';
$route['admin/delete-expense/(:num)'] = 'admin/expense/delete_expense/$1';
$route['admin/expense-export'] = 'admin/expense/expense_export';

// expense-category
$route['admin/expense-category'] = 'admin/expense/expense_category';
$route['admin/add-expense-category'] = 'admin/expense/add_expense_category';
$route['admin/update-expense-category/(:num)'] = 'admin/expense/update_expense_category/$1';
$route['admin/save-expense-category'] = 'admin/expense/save_expense_category';
$route['admin/delete-expense-category/(:num)'] = 'admin/expense/delete_expense_category/$1';


// Events
$route['admin/manage-events'] = 'admin/event/index';
$route['admin/add-event'] = 'admin/event/add_event';
$route['admin/update-event/(:num)'] = 'admin/event/update_event/$1';
$route['admin/save-event'] = 'admin/event/save_event';
$route['admin/delete-event/(:num)'] = 'admin/event/delete_event/$1';

// Project
$route['admin/manage-projects'] = 'admin/project/index';
$route['admin/add-project'] = 'admin/project/add_project';
$route['admin/update-project/(:num)'] = 'admin/project/update_project/$1';
$route['admin/save-project'] = 'admin/project/save_project';
$route['admin/delete-project/(:num)'] = 'admin/project/delete_project/$1';

// coin
$route['admin/coin'] = 'admin/coin/index';
$route['admin/add-coin'] = 'admin/coin/add_coin';
$route['admin/update-coin/(:num)'] = 'admin/coin/update_coin/$1';
$route['admin/save-coin'] = 'admin/coin/save_coin';
$route['admin/delete-coin/(:num)'] = 'admin/coin/delete_coin/$1';

// coin
$route['admin/currency'] = 'admin/currency/index';
$route['admin/add-currency'] = 'admin/currency/add_currency';
$route['admin/update-currency/(:num)'] = 'admin/currency/update_currency/$1';
$route['admin/save-currency'] = 'admin/currency/save_currency';
$route['admin/delete-currency/(:num)'] = 'admin/currency/delete_currency/$1';

//Setting
$route['admin/setting'] = 'admin/setting/index';
$route['admin/save-sitesetting'] = 'admin/setting/save_sitesetting';

//SEO
$route['admin/seo'] = 'admin/setting/seo';
$route['admin/save-seo'] = 'admin/setting/save_seo';

//Comment Box
$route['admin/comment'] = 'admin/setting/comment';
$route['admin/save-comment'] = 'admin/setting/save_comment';

$route['admin/themes'] = 'admin/setting/themes';
$route['admin/save-themes'] = 'admin/setting/save_themes';

$route['admin/email-setting'] = 'admin/setting/email_setting';
$route['admin/save-email-setting'] = 'admin/setting/save_email_setting';

$route['admin/payment-setting']='admin/setting/payment_setting';
$route['admin/save-payment-setting'] = 'admin/setting/save_payment_setting';

$route['admin/module-setting']='admin/setting/module';
$route['admin/save-module'] = 'admin/setting/save_module';

/* language Setting */
$route['admin/language'] = 'admin/language/index';
$route['admin/add-new-lang-word'] = 'admin/language/add_new_word';
$route['admin/add-language'] = 'admin/language/add_language';
$route['admin/language-translate/(:num)'] = 'admin/language/language_translate/$1';
$route['admin/update-language/(:num)'] = 'admin/language/update_language/$1';
$route['admin/save-language'] = 'admin/language/save_language';
$route['admin/save-translated-language/(:num)'] = 'admin/language/save_translated_language/$1';
$route['admin/delete-language/(:num)'] = 'admin/language/delete_language/$1';


/*Manage Front End*/
$route['admin/manage-home-content']='admin/website/manage_home_content';
$route['admin/save-home-content']='admin/website/save_home_content';

$route['admin/manage-banner']="admin/website/manage_banner";
$route['admin/save-banner']="admin/website/save_banner";

$route['admin/manage-about-us']='admin/website/manage_about_us';
$route['admin/manage-about-us-action']='admin/website/manage_about_us_action';

$route['admin/manage-contact-us']='admin/website/manage_contact_us';
$route['admin/delete-contactus/(:num)']='admin/website/delete_contact_us/$1';

/*Gallery*/
$route['admin/manage-gallery'] = 'admin/website/manage_gallery';
$route['admin/add-gallery'] = 'admin/website/add_gallery';
$route['admin/update-gallery/(:num)'] = 'admin/website/update_gallery/$1';
$route['admin/save-gallery'] = 'admin/website/save_gallery';
$route['admin/delete-gallery/(:num)'] = 'admin/website/delete_gallery/$1';

/*causes*/
$route['admin/manage-causes'] = 'admin/causes/manage_causes';
$route['admin/cause-donation/(:num)'] = 'admin/causes/causes_donation/$1';
$route['admin/add-cause'] = 'admin/causes/add_causes';
$route['admin/update-cause/(:num)'] = 'admin/causes/update_causes/$1';
$route['admin/save-causes'] = 'admin/causes/save_causes';
$route['admin/delete-causes/(:num)'] = 'admin/causes/delete_causes/$1';

/*News*/
$route['admin/manage-news'] = 'admin/news/manage_news';
$route['admin/add-news'] = 'admin/news/add_news';
$route['admin/update-news/(:num)'] = 'admin/news/update_news/$1';
$route['admin/save-news'] = 'admin/news/save_news';
$route['admin/delete-news/(:num)'] = 'admin/news/delete_news/$1';

/*Team*/
$route['admin/manage-team'] = 'admin/website/manage_team';
$route['admin/add-team'] = 'admin/website/add_team';
$route['admin/update-team/(:num)'] = 'admin/website/update_team/$1';
$route['admin/save-team'] = 'admin/website/save_team';
$route['admin/delete-team/(:num)'] = 'admin/website/delete_team/$1';

/*Slider*/
$route['admin/manage-slider'] = 'admin/website/manage_slider';
$route['admin/add-slider'] = 'admin/website/add_slider';
$route['admin/update-slider/(:num)'] = 'admin/website/update_slider/$1';
$route['admin/save-slider'] = 'admin/website/save_slider';
$route['admin/delete-slider/(:num)'] = 'admin/website/delete_slider/$1';

/*Slider*/
$route['admin/manage-pages'] = 'admin/website/manage_page';
$route['admin/add-page'] = 'admin/website/add_page';
$route['admin/update-page/(:num)'] = 'admin/website/update_page/$1';
$route['admin/save-page'] = 'admin/website/save_page';
$route['admin/delete-page/(:num)'] = 'admin/website/delete_page/$1';

//Accounts
$route['admin/account'] = 'admin/account/index';
$route['admin/add-account'] = 'admin/account/add_account';
$route['admin/update-account/(:num)'] = 'admin/account/update_account/$1';
$route['admin/save-account'] = 'admin/account/save_account';
$route['admin/delete-account/(:num)'] = 'admin/account/delete_account/$1';

//Transfer
$route['admin/transfer'] = 'admin/transfer/index';
$route['admin/add-transfer'] = 'admin/transfer/add_transfer';
$route['admin/update-transfer/(:num)'] = 'admin/transfer/update_transfer/$1';
$route['admin/save-transfer'] = 'admin/transfer/save_transfer';
$route['admin/delete-transfer/(:num)'] = 'admin/transfer/delete_transfer/$1';
