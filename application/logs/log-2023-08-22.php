<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-08-22 19:35:45 --> Could not find the language line "enter_valid_mobile"
ERROR - 2023-08-22 19:35:45 --> Could not find the language line "mobile"
ERROR - 2023-08-22 19:35:57 --> Could not find the language line "enter_valid_mobile"
ERROR - 2023-08-22 19:35:57 --> Could not find the language line "mobile"
ERROR - 2023-08-22 19:36:20 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:20 --> Could not find the language line "account"
ERROR - 2023-08-22 19:36:20 --> Could not find the language line "balance"
ERROR - 2023-08-22 19:36:32 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:32 --> Could not find the language line "account"
ERROR - 2023-08-22 19:36:32 --> Could not find the language line "party_name"
ERROR - 2023-08-22 19:36:32 --> Could not find the language line "party_phone"
ERROR - 2023-08-22 19:36:32 --> Could not find the language line "ref_no"
ERROR - 2023-08-22 19:36:32 --> Could not find the language line "create_by"
ERROR - 2023-08-22 19:36:32 --> Could not find the language line "account"
ERROR - 2023-08-22 19:36:43 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:43 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:43 --> Could not find the language line "account"
ERROR - 2023-08-22 19:36:43 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:43 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:48 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:48 --> Could not find the language line "account"
ERROR - 2023-08-22 19:36:53 --> Could not find the language line "coin"
ERROR - 2023-08-22 19:36:53 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:53 --> Could not find the language line "account"
ERROR - 2023-08-22 19:36:55 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:36:55 --> Could not find the language line "account"
ERROR - 2023-08-22 19:36:55 --> Could not find the language line "paid"
ERROR - 2023-08-22 19:36:55 --> Could not find the language line "total_due"
ERROR - 2023-08-22 19:36:55 --> Could not find the language line "total_donate"
ERROR - 2023-08-22 19:36:55 --> Could not find the language line "due_amount"
ERROR - 2023-08-22 19:36:55 --> Could not find the language line "add_donation"
ERROR - 2023-08-22 19:36:55 --> Could not find the language line "add_donation"
ERROR - 2023-08-22 19:37:03 --> Could not find the language line "account"
ERROR - 2023-08-22 19:37:03 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:37:03 --> Could not find the language line "account"
ERROR - 2023-08-22 19:37:03 --> Could not find the language line "account"
ERROR - 2023-08-22 19:37:03 --> Could not find the language line "account"
ERROR - 2023-08-22 19:39:08 --> Query error: Unknown column 'app_donation.date' in 'order clause' - Invalid query: SELECT app_donation.*, app_donation_category.title, concat(app_admin.first_name, ' ', app_admin.last_name) as collected_by, app_accounts.name as account_name
FROM `app_donation`
INNER JOIN `app_donation_category` ON `app_donation_category`.`id`=`app_donation`.`category_id`
LEFT JOIN `app_accounts` ON `app_accounts`.`id`=`app_donation`.`account_id`
LEFT JOIN `app_admin` ON `app_admin`.`id`=`app_donation`.`created_by`
ORDER BY `app_donation`.`date` DESC
ERROR - 2023-08-22 19:39:08 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\wamp64\www\donate\application\models\Model_customer.php 122
ERROR - 2023-08-22 19:39:11 --> Could not find the language line "account"
ERROR - 2023-08-22 19:39:11 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:39:11 --> Could not find the language line "account"
ERROR - 2023-08-22 19:39:11 --> Could not find the language line "account"
ERROR - 2023-08-22 19:39:11 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:02 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:41:02 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:02 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:02 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:02 --> Could not find the language line "account_name"
ERROR - 2023-08-22 19:41:02 --> Could not find the language line "account_name"
ERROR - 2023-08-22 19:41:06 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:06 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:41:06 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:06 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:06 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:31 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:41:31 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:31 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:31 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:31 --> Could not find the language line "account_name"
ERROR - 2023-08-22 19:41:31 --> Could not find the language line "account_name"
ERROR - 2023-08-22 19:41:34 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:34 --> Could not find the language line "transfer"
ERROR - 2023-08-22 19:41:34 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:34 --> Could not find the language line "account"
ERROR - 2023-08-22 19:41:34 --> Could not find the language line "account"