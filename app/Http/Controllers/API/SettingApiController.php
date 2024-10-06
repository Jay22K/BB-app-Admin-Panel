<?php

// namespace App\Http\Controllers\Api\Customer;
namespace App\Http\Controllers\API\Customer;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Repository\CategoryRepository;
use App\Http\Repository\ProductRepository;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\City;
use App\Models\Favorite;
use App\Models\ProductImages;
use App\Models\Seller;
use App\Models\Setting;
use App\Models\SocialMedia;
use App\Models\Tax;
use App\Models\TimeSlot;
use App\Models\Transaction;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use function App\Models\Setting;
use function PHPUnit\Framework\isJson;

class SettingApiController extends Controller
{
    public function getSettings(Request $request)
    {
        $variables = array(
            "app_name",
            "support_number",
            "support_email",

            "is_version_system_on",
            "required_force_update",
            "current_version",
            "ios_is_version_system_on",
            "ios_required_force_update",
            "ios_current_version",

            "store_address",
            "map_latitude",
            "map_longitude",
            "currency",
            "currency_code",
            "decimal_point",
            "system_timezone",
            "default_city_id",
            "max_cart_items_count",
            "min_order_amount",
            "area_wise_delivery_charge",
            "min_amount",
            "delivery_charge",
            "is_refer_earn_on",
            "min_refer_earn_order_amount",
            "refer_earn_bonus",
            "refer_earn_method",
            "max_refer_earn_amount",
            "minimum_withdrawal_amount",
            "max_product_return_days",
            "delivery_boy_bonus_percentage",
            "user_wallet_refill_limit",
            "tax_name",
            "tax_number",
            "low_stock_limit",
            "generate_otp",

            "app_mode_customer",
            "app_mode_customer_remark",

            "app_mode_seller",
            "app_mode_seller_remark",

            "app_mode_delivery_boy",
            "app_mode_delivery_boy_remark",


            "contact_us",
            "about_us",
            "privacy_policy",
            "returns_and_exchanges_policy",
            "shipping_policy",
            "cancellation_policy",
            "terms_conditions",
            "privacy_policy_delivery_boy",
            "terms_conditions_delivery_boy",
            "privacy_policy_manager_app",
            "terms_conditions_manager_app",
            "privacy_policy_seller",
            "terms_conditions_seller",
            "common_meta_keywords",
            "common_meta_description",
            "color",
            "show_color_picker_in_website",
            "screenshots",
            "google_play",
            "favicon",
            "web_logo",
            "loading",
            "time_slots_is_enabled",
            "time_slots_delivery_starts_from",
            "time_slots_allowed_days",
            "google_place_api_key",

            "popup_enabled",
            "popup_always_show_home",
            "popup_type",
            "popup_type_id",
            "popup_url",
            "popup_image"

        );
        $data = CommonHelper::getSettings($variables);

        if (isset($data['default_city_id']) && $data['default_city_id']) {
            $data["default_city"] = CommonHelper::getDefaultCity();
        }

        $user_id = $request->user('api-customers') ? $request->user('api-customers')->id : '';
        $favorite = Favorite::select('favorites.product_id')->from('favorites')->join("products", "favorites.product_id", "=", "products.id")->where('favorites.user_id', $user_id)->get()->toArray();
        if (!empty($favorite)) {
            $favorite_product_ids = array_column($favorite, 'product_id');
            $data["favorite_product_ids"] = $favorite_product_ids;
        } else {
            $data["favorite_product_ids"] = [];
        }

        if (isset($request->is_web_setting) && $request->is_web_setting == 1) {
            $webVariables = array(
                "site_title",
                "website_url",
                "color",
                "light_color",
                "dark_color",

                "app_title",
                "app_tagline",
                "app_short_description",

                "is_android_app",
                "android_app_url",
                "play_store_logo",

                "is_ios_app",
                "ios_app_url",
                "ios_store_logo",

                "copyright_details",

                "common_meta_keywords",
                "common_meta_description",

                "show_color_picker_in_website",
                "favicon",
                "web_logo",
                "loading",
            );
            $web_settings = CommonHelper::getSettings($webVariables);
            $data["web_settings"] = $web_settings;
            $firebase = CommonHelper::getFirebaseKeys();
            $data["firebase"] = CommonHelper::convertSettingsInArray($firebase);
            $data["social_media"] = SocialMedia::orderBy('id', 'ASC')->get();
        }
        /* $data = json_decode('{
                "app_name": "eGrocer",
                "support_number": "916355104724",
                "support_email": "support@wrteam.in",
                "current_version": "1.0.0",
                "is_version_system_on": "1",
                "store_address": "280, 18th Cross Sampige Road, Malleshwaram, Bangalore, Karnataka, 560003, India",
                "map_latitude": "20.5937",
                "map_longitude": "78.9629",
                "currency": "₹",
                "currency_code": "INR",
                "decimal_point": "2",
                "system_timezone": "Asia\/Kolkata",
                "max_cart_items_count": "10",
                "min_order_amount": "1",
                "area_wise_delivery_charge": "1",
                "min_amount": "100",
                "delivery_charge": "100",
                "is_refer_earn_on": "0",
                "min_refer_earn_order_amount": "100",
                "refer_earn_bonus": "100",
                "refer_earn_method": "percentage",
                "max_refer_earn_amount": "20",
                "minimum_withdrawal_amount": "100",
                "max_product_return_days": "100",
                "delivery_boy_bonus_percentage": "20",
                "user_wallet_refill_limit": "1000",
                "tax_name": "GST",
                "tax_number": "1236549873200",
                "low_stock_limit": "20",
                "generate_otp": "0",
                "app_mode_customer": "0",
                "app_mode_seller": "0",
                "app_mode_delivery_boy": "0",
                "google_place_api_key": "AIzaSyBT3LL_VaQavGOX8hV8kRSLpWrkbBKX8io",
                "time_slots_is_enabled": "true",
                "time_slots_delivery_starts_from": "6",
                "time_slots_allowed_days": "7",
                "privacy_policy": "<h1>Privacy Policy for eGrocer<\/h1>\n<p>At eGrocer, accessible from https:\/\/egrocer.wrteam.in, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by eGrocer and how we use it.<\/p>\n<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.<\/p>\n<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and\/or collect in eGrocer. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the <a href=\"https:\/\/www.privacypolicygenerator.info\/\">Free Privacy Policy Generator<\/a>.<\/p>\n<h2>Consent<\/h2>\n<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.<\/p>\n<h2>Information we collect<\/h2>\n<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.<\/p>\n<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and\/or attachments you may send us, and any other information you may choose to provide.<\/p>\n<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.<\/p>\n<h2>How we use your information<\/h2>\n<p>We use the information we collect in various ways, including to:<\/p>\n<ul>\n<li>Provide, operate, and maintain our website<\/li>\n<li>Improve, personalize, and expand our website<\/li>\n<li>Understand and analyze how you use our website<\/li>\n<li>Develop new products, services, features, and functionality<\/li>\n<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes<\/li>\n<li>Send you emails<\/li>\n<li>Find and prevent fraud<\/li>\n<\/ul>\n<h2>Log Files<\/h2>\n<p>eGrocer follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services\' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring\/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users\' movement on the website, and gathering demographic information.<\/p>\n<h2>Advertising Partners Privacy Policies<\/h2>\n<p>You may consult this list to find the Privacy Policy for each of the advertising partners of eGrocer.<\/p>\n<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on eGrocer, which are sent directly to users\' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and\/or to personalize the advertising content that you see on websites that you visit.<\/p>\n<p>Note that eGrocer has no access to or control over these cookies that are used by third-party advertisers.<\/p>\n<h2>Third Party Privacy Policies<\/h2>\n<p>eGrocer\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.<\/p>\n<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers\' respective websites.<\/p>\n<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)<\/h2>\n<p>Under the CCPA, among other rights, California consumers have the right to:<\/p>\n<p>Request that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.<\/p>\n<p>Request that a business delete any personal data about the consumer that a business has collected.<\/p>\n<p>Request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.<\/p>\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.<\/p>\n<h2>GDPR Data Protection Rights<\/h2>\n<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:<\/p>\n<p>The right to access &ndash; You have the right to request copies of your personal data. We may charge you a small fee for this service.<\/p>\n<p>The right to rectification &ndash; You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.<\/p>\n<p>The right to erasure &ndash; You have the right to request that we erase your personal data, under certain conditions.<\/p>\n<p>The right to restrict processing &ndash; You have the right to request that we restrict the processing of your personal data, under certain conditions.<\/p>\n<p>The right to object to processing &ndash; You have the right to object to our processing of your personal data, under certain conditions.<\/p>\n<p>The right to data portability &ndash; You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.<\/p>\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.<\/p>\n<h2>Children\'s Information<\/h2>\n<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and\/or monitor and guide their online activity.<\/p>\n<p>eGrocer does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.<\/p>",
                "returns_and_exchanges_policy": "<h1>Return and Exchange Policy<\/h1>\n<p>Last updated: November 17, 2022<\/p>\n<p>Thank you for shopping at eGrocer.<\/p>\n<p>If, for any reason, You are not completely satisfied with a purchase We invite You to review our policy on refunds and returns. This Return and Refund Policy has been created with the help of the <a href=\"https:\/\/www.termsfeed.com\/return-refund-policy-generator\/\" target=\"_blank\" rel=\"noopener\">TermsFeed Return and Refund Policy Generator<\/a>.<\/p>\n<p>The following terms are applicable for any products that You purchased with Us.<\/p>\n<h1>Interpretation and Definitions<\/h1>\n<h2>Interpretation<\/h2>\n<p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.<\/p>\n<h2>Definitions<\/h2>\n<p>For the purposes of this Return and Refund Policy:<\/p>\n<ul>\n<li>\n<p><strong>Application<\/strong> means the software program provided by the Company downloaded by You on any electronic device, named eGrocer<\/p>\n<\/li>\n<li>\n<p><strong>Company<\/strong> (referred to as either \"the Company\", \"We\", \"Us\" or \"Our\" in this Agreement) refers to eGrocer.<\/p>\n<\/li>\n<li>\n<p><strong>Goods<\/strong> refer to the items offered for sale on the Service.<\/p>\n<\/li>\n<li>\n<p><strong>Orders<\/strong> mean a request by You to purchase Goods from Us.<\/p>\n<\/li>\n<li>\n<p><strong>Service<\/strong> refers to the Application.<\/p>\n<\/li>\n<li>\n<p><strong>You<\/strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.<\/p>\n<\/li>\n<\/ul>\n<h1>Your Order Cancellation Rights<\/h1>\n<p>You are entitled to cancel Your Order within 45 days without giving any reason for doing so.<\/p>\n<p>The deadline for cancelling an Order is 45 days from the date on which You received the Goods or on which a third party you have appointed, who is not the carrier, takes possession of the product delivered.<\/p>\n<p>In order to exercise Your right of cancellation, You must inform Us of your decision by means of a clear statement. You can inform us of your decision by:<\/p>\n<ul>\n<li>\n<p>By email: info@egrocer.com<\/p>\n<\/li>\n<li>\n<p>By visiting this page on our website: <a href=\"https:\/\/egrocer.wrteam.in\/\" target=\"_blank\" rel=\"external nofollow noopener\">https:\/\/egrocer.wrteam.in\/<\/a><\/p>\n<\/li>\n<li>\n<p>By phone number: +919876543210<\/p>\n<\/li>\n<li>\n<p>By mail: 1 Infinite Loop Cupertino, CA 95014 USA<\/p>\n<\/li>\n<\/ul>\n<p>We will reimburse You no later than 14 days from the day on which We receive the returned Goods. We will use the same means of payment as You used for the Order, and You will not incur any fees for such reimbursement.<\/p>\n<h1>Conditions for Returns<\/h1>\n<p>In order for the Goods to be eligible for a return, please make sure that:<\/p>\n<ul>\n<li>The Goods were purchased in the last 45 days<\/li>\n<li>The Goods are in the original packaging<\/li>\n<\/ul>\n<p>The following Goods cannot be returned:<\/p>\n<ul>\n<li>The supply of Goods made to Your specifications or clearly personalized.<\/li>\n<li>The supply of Goods which according to their nature are not suitable to be returned, deteriorate rapidly or where the date of expiry is over.<\/li>\n<li>The supply of Goods which are not suitable for return due to health protection or hygiene reasons and were unsealed after delivery.<\/li>\n<li>The supply of Goods which are, after delivery, according to their nature, inseparably mixed with other items.<\/li>\n<\/ul>\n<p>We reserve the right to refuse returns of any merchandise that does not meet the above return conditions in our sole discretion.<\/p>\n<p>Only regular priced Goods may be refunded. Unfortunately, Goods on sale cannot be refunded. This exclusion may not apply to You if it is not permitted by applicable law.<\/p>\n<h1>Returning Goods<\/h1>\n<p>You are responsible for the cost and risk of returning the Goods to Us. You should send the Goods at the following address:<\/p>\n<p>1 Infinite Loop<br \/>Cupertino, CA 95014<br \/>USA<\/p>\n<p>We cannot be held responsible for Goods damaged or lost in return shipment. Therefore, We recommend an insured and trackable mail service. We are unable to issue a refund without actual receipt of the Goods or proof of received return delivery.<\/p>\n<h1>Gifts<\/h1>\n<p>If the Goods were marked as a gift when purchased and then shipped directly to you, You\'ll receive a gift credit for the value of your return. Once the returned product is received, a gift certificate will be mailed to You.<\/p>\n<p>If the Goods weren\'t marked as a gift when purchased, or the gift giver had the Order shipped to themselves to give it to You later, We will send the refund to the gift giver.<\/p>\n<h2>Contact Us<\/h2>\n<p>If you have any questions about our Returns and Refunds Policy, please contact us:<\/p>\n<ul>\n<li>\n<p>By email: info@egrocer.com<\/p>\n<\/li>\n<li>\n<p>By visiting this page on our website: <a href=\"https:\/\/egrocer.wrteam.in\/\" target=\"_blank\" rel=\"external nofollow noopener\">https:\/\/egrocer.wrteam.in\/<\/a><\/p>\n<\/li>\n<li>\n<p>By phone number: +919876543210<\/p>\n<\/li>\n<li>\n<p>By mail: 1 Infinite Loop Cupertino, CA 95014 USA<\/p>\n<\/li>\n<\/ul>",
                "shipping_policy": "<div>\n<div style=\"line-height: 1.5;\"><span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"heading_1\"><strong>DO YOU DELIVER INTERNATIONALLY?<\/strong><\/span><\/span><\/span><\/div>\n<div style=\"line-height: 1.5;\">&nbsp;<\/div>\n<div style=\"line-height: 1.5;\"><span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"body_text\">We offer worldwide shipping.<span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"body_text\"><span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"body_text\"> Free __________ shipping is not valid on international orders.<\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/div>\n<div style=\"line-height: 1.5;\">&nbsp;<\/div>\n<div style=\"line-height: 1.5;\">&nbsp;<\/div>\n<div style=\"line-height: 1.5;\"><span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"body_text\"><span style=\"font-size: 15px; color: #595959;\"><span style=\"font-size: 15px; color: #595959;\"><span data-custom-class=\"body_text\"><span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"body_text\">For information about customs process:<\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/div>\n<ul>\n<li style=\"line-height: 1.5;\"><span style=\"font-size: 15px; color: #595959;\"><span style=\"font-size: 15px; color: #595959;\"><span data-custom-class=\"body_text\">Visit __________<\/span><\/span><\/span><\/li>\n<\/ul>\n<div>&nbsp;<\/div>\n<ul>\n<li><span style=\"font-size: 15px; color: #595959;\"><span style=\"font-size: 15px; color: #595959;\"><span data-custom-class=\"body_text\">Email __________<\/span><\/span><\/span><\/li>\n<\/ul>\n<div>&nbsp;<\/div>\n<ul>\n<li><span style=\"font-size: 15px; color: #595959;\"><span style=\"font-size: 15px; color: #595959;\"><span data-custom-class=\"body_text\">Call toll free at __________<\/span><\/span><\/span><\/li>\n<\/ul>\n<div>&nbsp;<\/div>\n<ul>\n<li><span style=\"font-size: 15px; color: #595959;\"><span style=\"font-size: 15px; color: #595959;\"><span data-custom-class=\"body_text\">__________<\/span><\/span><\/span><\/li>\n<\/ul>\n<div>&nbsp;<\/div>\n<div style=\"line-height: 1.4;\"><span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"body_text\"><span style=\"font-size: 15px; color: #595959;\"><span style=\"font-size: 15px; color: #595959;\"><span data-custom-class=\"body_text\"><span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"body_text\"><span style=\"color: #7f7f7f;\"><span style=\"color: #595959; font-size: 15px;\"><span data-custom-class=\"body_text\">Please note, we may be subject to various rules and restrictions in relation to some international deliveries and you may be subject to additional taxes and duties over which we have no control. If such cases apply, you are responsible for complying with the laws applicable to the country where you live and will be responsible for any such additional costs or taxes.<\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/span><\/div>\n<div style=\"line-height: 1.5;\">&nbsp;<\/div>\n<\/div>",
                "cancellation_policy": "<h1>Return and Exchange Policy<\/h1>\n<p>Last updated: November 17, 2022<\/p>\n<p>Thank you for shopping at eGrocer.<\/p>\n<p>If, for any reason, You are not completely satisfied with a purchase We invite You to review our policy on refunds and returns. This Return and Refund Policy has been created with the help of the&nbsp;<a href=\"https:\/\/www.termsfeed.com\/return-refund-policy-generator\/\" target=\"_blank\" rel=\"noopener\">TermsFeed Return and Refund Policy Generator<\/a>.<\/p>\n<p>The following terms are applicable for any products that You purchased with Us.<\/p>\n<h1>Interpretation and Definitions<\/h1>\n<h2>Interpretation<\/h2>\n<p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.<\/p>\n<h2>Definitions<\/h2>\n<p>For the purposes of this Return and Refund Policy:<\/p>\n<ul>\n<li>\n<p><strong>Application<\/strong>&nbsp;means the software program provided by the Company downloaded by You on any electronic device, named eGrocer<\/p>\n<\/li>\n<li>\n<p><strong>Company<\/strong>&nbsp;(referred to as either \"the Company\", \"We\", \"Us\" or \"Our\" in this Agreement) refers to eGrocer.<\/p>\n<\/li>\n<li>\n<p><strong>Goods<\/strong>&nbsp;refer to the items offered for sale on the Service.<\/p>\n<\/li>\n<li>\n<p><strong>Orders<\/strong>&nbsp;mean a request by You to purchase Goods from Us.<\/p>\n<\/li>\n<li>\n<p><strong>Service<\/strong>&nbsp;refers to the Application.<\/p>\n<\/li>\n<li>\n<p><strong>You<\/strong>&nbsp;means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.<\/p>\n<\/li>\n<\/ul>\n<h1>Your Order Cancellation Rights<\/h1>\n<p>You are entitled to cancel Your Order within 45 days without giving any reason for doing so.<\/p>\n<p>The deadline for cancelling an Order is 45 days from the date on which You received the Goods or on which a third party you have appointed, who is not the carrier, takes possession of the product delivered.<\/p>\n<p>In order to exercise Your right of cancellation, You must inform Us of your decision by means of a clear statement. You can inform us of your decision by:<\/p>\n<ul>\n<li>\n<p>By email: info@egrocer.com<\/p>\n<\/li>\n<li>\n<p>By visiting this page on our website:&nbsp;<a href=\"https:\/\/egrocer.wrteam.in\/\" target=\"_blank\" rel=\"external nofollow noopener\">https:\/\/egrocer.wrteam.in\/<\/a><\/p>\n<\/li>\n<li>\n<p>By phone number: +919876543210<\/p>\n<\/li>\n<li>\n<p>By mail: 1 Infinite Loop Cupertino, CA 95014 USA<\/p>\n<\/li>\n<\/ul>\n<p>We will reimburse You no later than 14 days from the day on which We receive the returned Goods. We will use the same means of payment as You used for the Order, and You will not incur any fees for such reimbursement.<\/p>\n<h1>Conditions for Returns<\/h1>\n<p>In order for the Goods to be eligible for a return, please make sure that:<\/p>\n<ul>\n<li>The Goods were purchased in the last 45 days<\/li>\n<li>The Goods are in the original packaging<\/li>\n<\/ul>\n<p>The following Goods cannot be returned:<\/p>\n<ul>\n<li>The supply of Goods made to Your specifications or clearly personalized.<\/li>\n<li>The supply of Goods which according to their nature are not suitable to be returned, deteriorate rapidly or where the date of expiry is over.<\/li>\n<li>The supply of Goods which are not suitable for return due to health protection or hygiene reasons and were unsealed after delivery.<\/li>\n<li>The supply of Goods which are, after delivery, according to their nature, inseparably mixed with other items.<\/li>\n<\/ul>\n<p>We reserve the right to refuse returns of any merchandise that does not meet the above return conditions in our sole discretion.<\/p>\n<p>Only regular priced Goods may be refunded. Unfortunately, Goods on sale cannot be refunded. This exclusion may not apply to You if it is not permitted by applicable law.<\/p>\n<h1>Returning Goods<\/h1>\n<p>You are responsible for the cost and risk of returning the Goods to Us. You should send the Goods at the following address:<\/p>\n<p>1 Infinite Loop<br \/>Cupertino, CA 95014<br \/>USA<\/p>\n<p>We cannot be held responsible for Goods damaged or lost in return shipment. Therefore, We recommend an insured and trackable mail service. We are unable to issue a refund without actual receipt of the Goods or proof of received return delivery.<\/p>\n<h1>Gifts<\/h1>\n<p>If the Goods were marked as a gift when purchased and then shipped directly to you, You\'ll receive a gift credit for the value of your return. Once the returned product is received, a gift certificate will be mailed to You.<\/p>\n<p>If the Goods weren\'t marked as a gift when purchased, or the gift giver had the Order shipped to themselves to give it to You later, We will send the refund to the gift giver.<\/p>\n<h2>Contact Us<\/h2>\n<p>If you have any questions about our Returns and Refunds Policy, please contact us:<\/p>\n<ul>\n<li>\n<p>By email: info@egrocer.com<\/p>\n<\/li>\n<li>\n<p>By visiting this page on our website:&nbsp;<a href=\"https:\/\/egrocer.wrteam.in\/\" target=\"_blank\" rel=\"external nofollow noopener\">https:\/\/egrocer.wrteam.in\/<\/a><\/p>\n<\/li>\n<li>\n<p>By phone number: +919876543210<\/p>\n<\/li>\n<li>\n<p>By mail: 1 Infinite Loop Cupertino, CA 95014 USA<\/p>\n<\/li>\n<\/ul>",
                "terms_conditions": "<h2><strong>Terms and Conditions<\/strong><\/h2>\n<p>Welcome to eGrocer!<\/p>\n<p>These terms and conditions outline the rules and regulations for the use of eGrocer\'s Website, located at info@egrocer.com.<\/p>\n<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use eGrocer if you do not agree to take all of the terms and conditions stated on this page.<\/p>\n<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company&rsquo;s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client&rsquo;s needs in respect of provision of the Company&rsquo;s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and\/or he\/she or they, are taken as interchangeable and therefore as referring to same.<\/p>\n<h3><strong>Cookies<\/strong><\/h3>\n<p>We employ the use of cookies. By accessing eGrocer, you agreed to use cookies in agreement with the eGrocer\'s Privacy Policy.<\/p>\n<p>Most interactive websites use cookies to let us retrieve the user&rsquo;s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate\/advertising partners may also use cookies.<\/p>\n<h3><strong>License<\/strong><\/h3>\n<p>Unless otherwise stated, eGrocer and\/or its licensors own the intellectual property rights for all material on eGrocer. All intellectual property rights are reserved. You may access this from eGrocer for your own personal use subjected to restrictions set in these terms and conditions.<\/p>\n<p>You must not:<\/p>\n<ul>\n<li>Republish material from eGrocer<\/li>\n<li>Sell, rent or sub-license material from eGrocer<\/li>\n<li>Reproduce, duplicate or copy material from eGrocer<\/li>\n<li>Redistribute content from eGrocer<\/li>\n<\/ul>\n<p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the <a href=\"https:\/\/www.termsandconditionsgenerator.com\/\">Free Terms and Conditions Generator<\/a>.<\/p>\n<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. eGrocer does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of eGrocer,its agents and\/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, eGrocer shall not be liable for the Comments or for any liability, damages or expenses caused and\/or suffered as a result of any use of and\/or posting of and\/or appearance of the Comments on this website.<\/p>\n<p>eGrocer reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.<\/p>\n<p>You warrant and represent that:<\/p>\n<ul>\n<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;<\/li>\n<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;<\/li>\n<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy<\/li>\n<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.<\/li>\n<\/ul>\n<p>You hereby grant eGrocer a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.<\/p>\n<h3><strong>Hyperlinking to our Content<\/strong><\/h3>\n<p>The following organizations may link to our Website without prior written approval:<\/p>\n<ul>\n<li>Government agencies;<\/li>\n<li>Search engines;<\/li>\n<li>News organizations;<\/li>\n<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and<\/li>\n<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.<\/li>\n<\/ul>\n<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and\/or services; and (c) fits within the context of the linking party&rsquo;s site.<\/p>\n<p>We may consider and approve other link requests from the following types of organizations:<\/p>\n<ul>\n<li>commonly-known consumer and\/or business information sources;<\/li>\n<li>dot.com community sites;<\/li>\n<li>associations or other groups representing charities;<\/li>\n<li>online directory distributors;<\/li>\n<li>internet portals;<\/li>\n<li>accounting, law and consulting firms; and<\/li>\n<li>educational institutions and trade associations.<\/li>\n<\/ul>\n<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of eGrocer; and (d) the link is in the context of general resource information.<\/p>\n<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party&rsquo;s site.<\/p>\n<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to eGrocer. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.<\/p>\n<p>Approved organizations may hyperlink to our Website as follows:<\/p>\n<ul>\n<li>By use of our corporate name; or<\/li>\n<li>By use of the uniform resource locator being linked to; or<\/li>\n<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party&rsquo;s site.<\/li>\n<\/ul>\n<p>No use of eGrocer\'s logo or other artwork will be allowed for linking absent a trademark license agreement.<\/p>\n<h3><strong>iFrames<\/strong><\/h3>\n<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.<\/p>\n<h3><strong>Content Liability<\/strong><\/h3>\n<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.<\/p>\n<h3><strong>Your Privacy<\/strong><\/h3>\n<p>Please read Privacy Policy<\/p>\n<h3><strong>Reservation of Rights<\/strong><\/h3>\n<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it&rsquo;s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.<\/p>\n<h3><strong>Removal of links from our website<\/strong><\/h3>\n<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.<\/p>\n<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.<\/p>\n<h3><strong>Disclaimer<\/strong><\/h3>\n<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:<\/p>\n<ul>\n<li>limit or exclude our or your liability for death or personal injury;<\/li>\n<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;<\/li>\n<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or<\/li>\n<li>exclude any of our or your liabilities that may not be excluded under applicable law.<\/li>\n<\/ul>\n<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.<\/p>\n<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.<\/p>",
                "privacy_policy_delivery_boy": "<h1>Privacy Policy for eGrocer<\/h1>\n<p>At eGrocer, accessible from https:\/\/egrocer.wrteam.in, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by eGrocer and how we use it.<\/p>\n<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.<\/p>\n<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and\/or collect in eGrocer. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the&nbsp;<a href=\"https:\/\/www.privacypolicygenerator.info\/\">Free Privacy Policy Generator<\/a>.<\/p>\n<h2>Consent<\/h2>\n<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.<\/p>\n<h2>Information we collect<\/h2>\n<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.<\/p>\n<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and\/or attachments you may send us, and any other information you may choose to provide.<\/p>\n<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.<\/p>\n<h2>How we use your information<\/h2>\n<p>We use the information we collect in various ways, including to:<\/p>\n<ul>\n<li>Provide, operate, and maintain our website<\/li>\n<li>Improve, personalize, and expand our website<\/li>\n<li>Understand and analyze how you use our website<\/li>\n<li>Develop new products, services, features, and functionality<\/li>\n<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes<\/li>\n<li>Send you emails<\/li>\n<li>Find and prevent fraud<\/li>\n<\/ul>\n<h2>Log Files<\/h2>\n<p>eGrocer follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting service\'s analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring\/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking user\'s movement on the website, and gathering demographic information.<\/p>\n<h2>Advertising Partners Privacy Policies<\/h2>\n<p>You may consult this list to find the Privacy Policy for each of the advertising partners of eGrocer.<\/p>\n<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on eGrocer, which are sent directly to user\'s browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and\/or to personalize the advertising content that you see on websites that you visit.<\/p>\n<p>Note that eGrocer has no access to or control over these cookies that are used by third-party advertisers.<\/p>\n<h2>Third Party Privacy Policies<\/h2>\n<p>eGrocer\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.<\/p>\n<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browser\'s respective websites.<\/p>\n<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)<\/h2>\n<p>Under the CCPA, among other rights, California consumers have the right to:<\/p>\n<p>Request that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.<\/p>\n<p>Request that a business delete any personal data about the consumer that a business has collected.<\/p>\n<p>Request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.<\/p>\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.<\/p>\n<h2>GDPR Data Protection Rights<\/h2>\n<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:<\/p>\n<p>The right to access &ndash; You have the right to request copies of your personal data. We may charge you a small fee for this service.<\/p>\n<p>The right to rectification &ndash; You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.<\/p>\n<p>The right to erasure &ndash; You have the right to request that we erase your personal data, under certain conditions.<\/p>\n<p>The right to restrict processing &ndash; You have the right to request that we restrict the processing of your personal data, under certain conditions.<\/p>\n<p>The right to object to processing &ndash; You have the right to object to our processing of your personal data, under certain conditions.<\/p>\n<p>The right to data portability &ndash; You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.<\/p>\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.<\/p>\n<h2>Children\'s Information<\/h2>\n<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and\/or monitor and guide their online activity.<\/p>\n<p>eGrocer does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.<\/p>",
                "terms_conditions_delivery_boy": "<h2><strong>Terms and Conditions<\/strong><\/h2>\n<p>Welcome to eGrocer!<\/p>\n<p>These terms and conditions outline the rules and regulations for the use of eGrocer\'s Website, located at info@egrocer.com.<\/p>\n<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use eGrocer if you do not agree to take all of the terms and conditions stated on this page.<\/p>\n<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company&rsquo;s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client&rsquo;s needs in respect of provision of the Company&rsquo;s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and\/or he\/she or they, are taken as interchangeable and therefore as referring to same.<\/p>\n<h3><strong>Cookies<\/strong><\/h3>\n<p>We employ the use of cookies. By accessing eGrocer, you agreed to use cookies in agreement with the eGrocer\'s Privacy Policy.<\/p>\n<p>Most interactive websites use cookies to let us retrieve the user&rsquo;s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate\/advertising partners may also use cookies.<\/p>\n<h3><strong>License<\/strong><\/h3>\n<p>Unless otherwise stated, eGrocer and\/or its licensors own the intellectual property rights for all material on eGrocer. All intellectual property rights are reserved. You may access this from eGrocer for your own personal use subjected to restrictions set in these terms and conditions.<\/p>\n<p>You must not:<\/p>\n<ul>\n<li>Republish material from eGrocer<\/li>\n<li>Sell, rent or sub-license material from eGrocer<\/li>\n<li>Reproduce, duplicate or copy material from eGrocer<\/li>\n<li>Redistribute content from eGrocer<\/li>\n<\/ul>\n<p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the&nbsp;<a href=\"https:\/\/www.termsandconditionsgenerator.com\/\">Free Terms and Conditions Generator<\/a>.<\/p>\n<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. eGrocer does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of eGrocer,its agents and\/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, eGrocer shall not be liable for the Comments or for any liability, damages or expenses caused and\/or suffered as a result of any use of and\/or posting of and\/or appearance of the Comments on this website.<\/p>\n<p>eGrocer reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.<\/p>\n<p>You warrant and represent that:<\/p>\n<ul>\n<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;<\/li>\n<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;<\/li>\n<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy<\/li>\n<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.<\/li>\n<\/ul>\n<p>You hereby grant eGrocer a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.<\/p>\n<h3><strong>Hyperlinking to our Content<\/strong><\/h3>\n<p>The following organizations may link to our Website without prior written approval:<\/p>\n<ul>\n<li>Government agencies;<\/li>\n<li>Search engines;<\/li>\n<li>News organizations;<\/li>\n<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and<\/li>\n<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.<\/li>\n<\/ul>\n<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and\/or services; and (c) fits within the context of the linking party&rsquo;s site.<\/p>\n<p>We may consider and approve other link requests from the following types of organizations:<\/p>\n<ul>\n<li>commonly-known consumer and\/or business information sources;<\/li>\n<li>dot.com community sites;<\/li>\n<li>associations or other groups representing charities;<\/li>\n<li>online directory distributors;<\/li>\n<li>internet portals;<\/li>\n<li>accounting, law and consulting firms; and<\/li>\n<li>educational institutions and trade associations.<\/li>\n<\/ul>\n<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of eGrocer; and (d) the link is in the context of general resource information.<\/p>\n<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party&rsquo;s site.<\/p>\n<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to eGrocer. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.<\/p>\n<p>Approved organizations may hyperlink to our Website as follows:<\/p>\n<ul>\n<li>By use of our corporate name; or<\/li>\n<li>By use of the uniform resource locator being linked to; or<\/li>\n<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party&rsquo;s site.<\/li>\n<\/ul>\n<p>No use of eGrocer\'s logo or other artwork will be allowed for linking absent a trademark license agreement.<\/p>\n<h3><strong>iFrames<\/strong><\/h3>\n<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.<\/p>\n<h3><strong>Content Liability<\/strong><\/h3>\n<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.<\/p>\n<h3><strong>Your Privacy<\/strong><\/h3>\n<p>Please read Privacy Policy<\/p>\n<h3><strong>Reservation of Rights<\/strong><\/h3>\n<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it&rsquo;s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.<\/p>\n<h3><strong>Removal of links from our website<\/strong><\/h3>\n<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.<\/p>\n<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.<\/p>\n<h3><strong>Disclaimer<\/strong><\/h3>\n<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:<\/p>\n<ul>\n<li>limit or exclude our or your liability for death or personal injury;<\/li>\n<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;<\/li>\n<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or<\/li>\n<li>exclude any of our or your liabilities that may not be excluded under applicable law.<\/li>\n<\/ul>\n<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.<\/p>\n<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.<\/p>",
                "privacy_policy_seller": "<h1>Privacy Policy for eGrocer<\/h1>\n<p>At eGrocer, accessible from https:\/\/egrocer.wrteam.in, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by eGrocer and how we use it.<\/p>\n<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.<\/p>\n<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and\/or collect in eGrocer. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the&nbsp;<a href=\"https:\/\/www.privacypolicygenerator.info\/\">Free Privacy Policy Generator<\/a>.<\/p>\n<h2>Consent<\/h2>\n<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.<\/p>\n<h2>Information we collect<\/h2>\n<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.<\/p>\n<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and\/or attachments you may send us, and any other information you may choose to provide.<\/p>\n<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.<\/p>\n<h2>How we use your information<\/h2>\n<p>We use the information we collect in various ways, including to:<\/p>\n<ul>\n<li>Provide, operate, and maintain our website<\/li>\n<li>Improve, personalize, and expand our website<\/li>\n<li>Understand and analyze how you use our website<\/li>\n<li>Develop new products, services, features, and functionality<\/li>\n<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes<\/li>\n<li>Send you emails<\/li>\n<li>Find and prevent fraud<\/li>\n<\/ul>\n<h2>Log Files<\/h2>\n<p>eGrocer follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring\/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking user\'s movement on the website, and gathering demographic information.<\/p>\n<h2>Advertising Partners Privacy Policies<\/h2>\n<p>You may consult this list to find the Privacy Policy for each of the advertising partners of eGrocer.<\/p>\n<p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on eGrocer, which are sent directly to user\'s browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and\/or to personalize the advertising content that you see on websites that you visit.<\/p>\n<p>Note that eGrocer has no access to or control over these cookies that are used by third-party advertisers.<\/p>\n<h2>Third Party Privacy Policies<\/h2>\n<p>eGrocer\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options.<\/p>\n<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browser\'s respective websites.<\/p>\n<h2>CCPA Privacy Rights (Do Not Sell My Personal Information)<\/h2>\n<p>Under the CCPA, among other rights, California consumers have the right to:<\/p>\n<p>Request that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.<\/p>\n<p>Request that a business delete any personal data about the consumer that a business has collected.<\/p>\n<p>Request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.<\/p>\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.<\/p>\n<h2>GDPR Data Protection Rights<\/h2>\n<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:<\/p>\n<p>The right to access &ndash; You have the right to request copies of your personal data. We may charge you a small fee for this service.<\/p>\n<p>The right to rectification &ndash; You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.<\/p>\n<p>The right to erasure &ndash; You have the right to request that we erase your personal data, under certain conditions.<\/p>\n<p>The right to restrict processing &ndash; You have the right to request that we restrict the processing of your personal data, under certain conditions.<\/p>\n<p>The right to object to processing &ndash; You have the right to object to our processing of your personal data, under certain conditions.<\/p>\n<p>The right to data portability &ndash; You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.<\/p>\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.<\/p>\n<h2>Children\'s Information<\/h2>\n<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and\/or monitor and guide their online activity.<\/p>\n<p>eGrocer does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.<\/p>",
                "terms_conditions_seller": "<h2><strong>Terms and Conditions<\/strong><\/h2>\n<p>Welcome to eGrocer!<\/p>\n<p>These terms and conditions outline the rules and regulations for the use of eGrocer\'s Website, located at info@egrocer.com.<\/p>\n<p>By accessing this website we assume you accept these terms and conditions. Do not continue to use eGrocer if you do not agree to take all of the terms and conditions stated on this page.<\/p>\n<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: \"Client\", \"You\" and \"Your\" refers to you, the person log on this website and compliant to the Company&rsquo;s terms and conditions. \"The Company\", \"Ourselves\", \"We\", \"Our\" and \"Us\", refers to our Company. \"Party\", \"Parties\", or \"Us\", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client&rsquo;s needs in respect of provision of the Company&rsquo;s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and\/or he\/she or they, are taken as interchangeable and therefore as referring to same.<\/p>\n<h3><strong>Cookies<\/strong><\/h3>\n<p>We employ the use of cookies. By accessing eGrocer, you agreed to use cookies in agreement with the eGrocer\'s Privacy Policy.<\/p>\n<p>Most interactive websites use cookies to let us retrieve the user&rsquo;s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate\/advertising partners may also use cookies.<\/p>\n<h3><strong>License<\/strong><\/h3>\n<p>Unless otherwise stated, eGrocer and\/or its licensors own the intellectual property rights for all material on eGrocer. All intellectual property rights are reserved. You may access this from eGrocer for your own personal use subjected to restrictions set in these terms and conditions.<\/p>\n<p>You must not:<\/p>\n<ul>\n<li>Republish material from eGrocer<\/li>\n<li>Sell, rent or sub-license material from eGrocer<\/li>\n<li>Reproduce, duplicate or copy material from eGrocer<\/li>\n<li>Redistribute content from eGrocer<\/li>\n<\/ul>\n<p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the&nbsp;<a href=\"https:\/\/www.termsandconditionsgenerator.com\/\">Free Terms and Conditions Generator<\/a>.<\/p>\n<p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. eGrocer does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of eGrocer,its agents and\/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, eGrocer shall not be liable for the Comments or for any liability, damages or expenses caused and\/or suffered as a result of any use of and\/or posting of and\/or appearance of the Comments on this website.<\/p>\n<p>eGrocer reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.<\/p>\n<p>You warrant and represent that:<\/p>\n<ul>\n<li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;<\/li>\n<li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;<\/li>\n<li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy<\/li>\n<li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.<\/li>\n<\/ul>\n<p>You hereby grant eGrocer a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.<\/p>\n<h3><strong>Hyperlinking to our Content<\/strong><\/h3>\n<p>The following organizations may link to our Website without prior written approval:<\/p>\n<ul>\n<li>Government agencies;<\/li>\n<li>Search engines;<\/li>\n<li>News organizations;<\/li>\n<li>Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and<\/li>\n<li>System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.<\/li>\n<\/ul>\n<p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and\/or services; and (c) fits within the context of the linking party&rsquo;s site.<\/p>\n<p>We may consider and approve other link requests from the following types of organizations:<\/p>\n<ul>\n<li>commonly-known consumer and\/or business information sources;<\/li>\n<li>dot.com community sites;<\/li>\n<li>associations or other groups representing charities;<\/li>\n<li>online directory distributors;<\/li>\n<li>internet portals;<\/li>\n<li>accounting, law and consulting firms; and<\/li>\n<li>educational institutions and trade associations.<\/li>\n<\/ul>\n<p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of eGrocer; and (d) the link is in the context of general resource information.<\/p>\n<p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party&rsquo;s site.<\/p>\n<p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to eGrocer. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.<\/p>\n<p>Approved organizations may hyperlink to our Website as follows:<\/p>\n<ul>\n<li>By use of our corporate name; or<\/li>\n<li>By use of the uniform resource locator being linked to; or<\/li>\n<li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party&rsquo;s site.<\/li>\n<\/ul>\n<p>No use of eGrocer\'s logo or other artwork will be allowed for linking absent a trademark license agreement.<\/p>\n<h3><strong>iFrames<\/strong><\/h3>\n<p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.<\/p>\n<h3><strong>Content Liability<\/strong><\/h3>\n<p>We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.<\/p>\n<h3><strong>Your Privacy<\/strong><\/h3>\n<p>Please read Privacy Policy<\/p>\n<h3><strong>Reservation of Rights<\/strong><\/h3>\n<p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it&rsquo;s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.<\/p>\n<h3><strong>Removal of links from our website<\/strong><\/h3>\n<p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.<\/p>\n<p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.<\/p>\n<h3><strong>Disclaimer<\/strong><\/h3>\n<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will:<\/p>\n<ul>\n<li>limit or exclude our or your liability for death or personal injury;<\/li>\n<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;<\/li>\n<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or<\/li>\n<li>exclude any of our or your liabilities that may not be excluded under applicable law.<\/li>\n<\/ul>\n<p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.<\/p>\n<p>As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.<\/p>",
                "about_us": "<h2>About Us!fbgthb<\/h2>\n<h3 style=\"text-align: center;\">Welcome To <span id=\"W_Name1\">eGrocer<\/span><\/h3>\n<p><span id=\"W_Name2\">eGrocer<\/span> is a Professional <span id=\"W_Type1\">eCommerce<\/span> Platform. Here we will provide you with only interesting content, which you will like very much. We\'re dedicated to providing you with the best of <span id=\"W_Type2\">eCommerce<\/span>, with a focus on dependability and <span id=\"W_Spec\">Online Shopping<\/span>. We\'re working to turn our passion for <span id=\"W_Type3\">eCommerce<\/span> into a booming <a style=\"color: inherit; text-decoration: none;\" href=\"https:\/\/www.blogearns.com\/2021\/05\/free-about-us-page-generator.html\" rel=\"do-follow\">online website<\/a>. We hope you enjoy our <span id=\"W_Type4\">eCommerce<\/span> as much as we enjoy offering them to you.<\/p>\n<p>I will keep posting more important posts on my Website for all of you. Please give your support and love.<\/p>\n<p style=\"font-weight: bold; text-align: center;\">Thanks For Visiting Our Site<br \/><br \/><span style=\"color: blue; font-size: 16px; font-weight: bold; text-align: center;\">Have a nice day!<\/span><\/p>",
                "contact_us": "<h1 style=\"text-align: center;\">Contact Us !<\/h1>\n<h2 style=\"text-align: center;\">Welcome to <span id=\"W_Name\">eGrocer<\/span>!<\/h2>\n<p style=\"font-size: 17px; text-align: center;\">Please email us if you have any queries about the site, advertising, or anything else.<\/p>\n<div style=\"text-align: center;\"><br \/>\n<p style=\"margin-left: 25%; text-align: center;\">&nbsp;<\/p>\n<h3 style=\"color: #3e005d;\">We will revert you as soon as possible...!<\/h3>\n<p style=\"color: #3e005d; text-align: center;\">Thank you for contacting us! <br \/><strong>Have a great day<\/strong><\/p>\n<span style=\"font-size: 1px; opacity: 0;\">This page is generated with the help of <a style=\"color: inherit;\" href=\"https:\/\/www.blogearns.com\/2021\/06\/free-contact-us-page-generator.html\">Contact Us Page Generator<\/a><\/span><\/div>",
                "default_city_id": "31",
                "app_mode_customer_remark": " ",
                "app_mode_seller_remark": " ",
                "app_mode_delivery_boy_remark": " ",
                "popup_enabled": "0",
                "popup_always_show_home": "0",
                "popup_type": "popup_url",
                "popup_type_id": "",
                "popup_url": "https:\/\/codecanyon.net\/item\/egrocer-online-grocery-store-ecommerce-marketplace-flutter-full-app-with-admin-panel\/41423150",
                "popup_image": "https:\/\/egrocer.wrteam.me\/storage\/offers\/1703944737_popup_46290.png",
                "required_force_update": "1",
                "ios_is_version_system_on": "1",
                "ios_required_force_update": "1",
                "ios_current_version": "1.0.0",
                "color": "#55ae7b",
                "common_meta_keywords": "",
                "common_meta_description": "",
                "show_color_picker_in_website": "false",
                "loading": "",
                "favicon": "https:\/\/egrocer.wrteam.me\/storage\/front_end\/favicon\/1688975187_21701.png",
                "web_logo": "https:\/\/egrocer.wrteam.me\/storage\/front_end\/web_logo\/1706781676_69625.png",
                "default_city": {
                  "id": 31,
                  "name": "Bhuj",
                  "state": "Gujarat",
                  "formatted_address": "Bhuj, Gujarat, India",
                  "latitude": "23.2419997",
                  "longitude": "69.6669324"
                },
                "favorite_product_ids": [
                  
                ]
              }');*/
        if (!empty($data)) {
            return CommonHelper::responseWithData($data);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getPaymentMethods(Request $request)
    {
        $variables = array(
            "payment_method_settings",
            "cod_payment_method",
            "cod_mode",

            "paypal_payment_method",

            "razorpay_payment_method",
            "razorpay_key",
            "razorpay_secret_key",

            "paystack_payment_method",
            "paystack_public_key",
            "paystack_secret_key",
            "paystack_currency_code",

            "stripe_payment_method",
            "stripe_publishable_key",
            "stripe_secret_key",
            "stripe_currency_code",
            "stripe_mode",

            "paytm_payment_method",
            "paytm_mode",
            "paytm_merchant_key",
            "paytm_merchant_id"

        );
        $settings = Setting::whereIn('variable', $variables)->get();
        $data = array();
        foreach ($settings as $setting) {
            $data[$setting->variable] = $setting->value ?? "";
        }

        if (!empty($data)) {

            $data = json_encode($data);
            $data = base64_encode($data);

            /*$data = base64_decode($data);
            $data = json_decode($data);*/

            return CommonHelper::responseWithData($data);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
        /*$payment_methods = Setting::get_value('payment_methods');
        if (!empty($payment_methods)) {
            $payment_methods = json_decode($payment_methods);
            if (!isset($payment_methods->paytm_payment_method)) {
                $payment_methods->paytm_payment_method = 0;
                $payment_methods->paytm_mode = "sandbox";
                $payment_methods->paytm_merchant_key = "";
                $payment_methods->paytm_merchant_id = "";
            }
            $payment_methods->cod_mode = !isset($payment_methods->cod_mode) || empty($payment_methods->cod_mode) ? 'global' : $payment_methods->cod_mode;
            return CommonHelper::responseWithData($payment_methods);
        }else{
            return  CommonHelper::responseError('No settings found!');
        }*/
    }

    public function getPrivacy()
    {

        $privacy_policy = Setting::get_value('privacy_policy');
        if (!empty($privacy_policy)) {
            return CommonHelper::responseWithData($privacy_policy);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getTerms()
    {

        $terms_conditions = Setting::get_value('terms_conditions');
        if (!empty($terms_conditions)) {
            return CommonHelper::responseWithData($terms_conditions);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getLogo()
    {

        $logo = Setting::get_value('logo');
        if (!empty($logo)) {
            $logo = asset('/storage/' . $logo);
            return CommonHelper::responseWithData($logo);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getContact()
    {

        $contact_us = Setting::get_value('contact_us');
        if (!empty($contact_us)) {
            return CommonHelper::responseWithData($contact_us);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getAboutUs()
    {

        $about_us = Setting::get_value('about_us');
        if (!empty($about_us)) {
            return CommonHelper::responseWithData($about_us);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getTimezone()
    {

        $system_timezone = Setting::get_value('system_timezone');
        if (!empty($system_timezone)) {

            $system_timezone = json_decode($system_timezone, true);
            $system_timezone['tax_name'] = isset($system_timezone['tax_name']) && !empty($system_timezone['tax_name']) ? $system_timezone['tax_name'] : "";
            $system_timezone['tax_number'] = isset($system_timezone['tax_number']) && !empty($system_timezone['tax_number']) ? $system_timezone['tax_number'] : "0";
            $system_timezone['currency'] = Setting::get_value('currency');

            return CommonHelper::responseWithData($system_timezone);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getFcmKey()
    {

        $fcm_server_key = Setting::get_value('fcm_server_key');
        if (!empty($fcm_server_key)) {

            return CommonHelper::responseWithData($fcm_server_key);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getTimeSlotConfig()
    {

        $time_slot_config = Setting::get_value('time_slot_config');
        if (!empty($time_slot_config)) {
            $time_slot_config = json_decode($time_slot_config, true);
            return CommonHelper::responseWithData($time_slot_config);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getFrontEndSettings()
    {

        $front_end_settings = Setting::get_value('front_end_settings');

        if ($front_end_settings) {

            $data = array();
            $data['favicon'] = Setting::get_value('favicon') ? asset('storage/' . Setting::get_value('favicon')) : '';
            $data['screenshots'] = Setting::get_value('screenshots') ? Setting::get_value('screenshots') : '';
            $data['google_play'] = Setting::get_value('google_play') ? Setting::get_value('google_play') : '';
            $data['show_color_picker_in_website'] = Setting::get_value('show_color_picker_in_website') ? Setting::get_value('show_color_picker_in_website') : '';

            return CommonHelper::responseWithData($data);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getTimeSlots()
    {
        $timeSlots = TimeSlot::where('status', 1)->orderBy('last_order_time')->get();
        if (count($timeSlots)) {
            $responce["time_slots_is_enabled"] = Setting::get_value('time_slots_is_enabled') ?? '';
            $responce["time_slots_delivery_starts_from"] = Setting::get_value('time_slots_delivery_starts_from') ?? '';
            $responce["time_slots_allowed_days"] = Setting::get_value('time_slots_allowed_days') ?? '';
            $responce["time_slots"] = $timeSlots;
            return CommonHelper::responseWithData($responce);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }

    public function getShippingType()
    {

        $shipping_type = (Setting::get_value('local_shipping') == 1) ? 'local' : 'standard';

        if ($shipping_type) {

            return CommonHelper::responseWithData($shipping_type);
        } else {
            return  CommonHelper::responseError('No settings found!');
        }
    }
}
