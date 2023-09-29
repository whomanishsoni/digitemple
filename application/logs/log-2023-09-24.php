<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-09-24 21:02:38 --> Could not find the language line "enter_valid_mobile"
ERROR - 2023-09-24 21:02:38 --> Could not find the language line "mobile"
ERROR - 2023-09-24 21:02:58 --> Could not find the language line "transfer"
ERROR - 2023-09-24 21:02:58 --> Could not find the language line "account"
ERROR - 2023-09-24 21:02:58 --> Could not find the language line "balance"
ERROR - 2023-09-24 21:03:05 --> Could not find the language line "transfer"
ERROR - 2023-09-24 21:03:05 --> Could not find the language line "account"
ERROR - 2023-09-24 21:03:05 --> Could not find the language line "ref_no/receipt_no"
ERROR - 2023-09-24 21:03:05 --> Could not find the language line "payment_type"
ERROR - 2023-09-24 21:03:05 --> Could not find the language line "collected_by"
ERROR - 2023-09-24 21:03:07 --> Could not find the language line "receipt"
ERROR - 2023-09-24 21:03:07 --> Could not find the language line "payment type"
ERROR - 2023-09-24 21:03:07 --> Could not find the language line "collected by"
ERROR - 2023-09-24 21:03:07 --> Could not find the language line "ref_no/receipt_no"
ERROR - 2023-09-24 21:03:07 --> Could not find the language line "payment_type"
ERROR - 2023-09-24 21:03:07 --> Could not find the language line "collected_by"
ERROR - 2023-09-24 21:03:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 6 - Invalid query: SELECT app_donation.*, app_donation_category.title, concat(app_admin.first_name, ' ', app_admin.last_name) as collected_by, app_accounts.name as account_name
FROM `app_donation`
INNER JOIN `app_donation_category` ON `app_donation_category`.`id`=`app_donation`.`category_id`
LEFT JOIN `app_accounts` ON `app_accounts`.`id`=`app_donation`.`account_id`
LEFT JOIN `app_admin` ON `app_admin`.`id`=`app_donation`.`created_by`
WHERE 1 =  
ERROR - 2023-09-24 21:03:08 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\wamp64\www\donate\application\models\Model_customer.php 130
ERROR - 2023-09-24 21:03:33 --> Could not find the language line "transfer"
ERROR - 2023-09-24 21:03:33 --> Could not find the language line "account"
ERROR - 2023-09-24 21:03:33 --> Could not find the language line "ref_no/receipt_no"
ERROR - 2023-09-24 21:03:33 --> Could not find the language line "payment_type"
ERROR - 2023-09-24 21:03:33 --> Could not find the language line "collected_by"
ERROR - 2023-09-24 21:03:35 --> Could not find the language line "receipt"
ERROR - 2023-09-24 21:03:35 --> Could not find the language line "payment type"
ERROR - 2023-09-24 21:03:35 --> Could not find the language line "collected by"
ERROR - 2023-09-24 21:03:35 --> Could not find the language line "ref_no/receipt_no"
ERROR - 2023-09-24 21:03:35 --> Could not find the language line "payment_type"
ERROR - 2023-09-24 21:03:35 --> Could not find the language line "collected_by"
