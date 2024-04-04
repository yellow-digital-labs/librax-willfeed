<?php

namespace App\Helpers;

use Config;
use Auth;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\CustomerVerified;

class Helpers
{
  public static function appClasses()
  {

    $data = config('custom.custom');


    // default data array
    $DefaultData = [
      'myLayout' => 'vertical',
      'myTheme' => 'theme-default',
      'myStyle' => 'light',
      'myRTLSupport' => true,
      'myRTLMode' => true,
      'hasCustomizer' => true,
      'showDropdownOnHover' => true,
      'displayCustomizer' => true,
      'menuFixed' => true,
      'menuCollapsed' => false,
      'navbarFixed' => true,
      'footerFixed' => false,
      'menuFlipped' => false,
      // 'menuOffcanvas' => false,
      'customizerControls' => [
        'rtl',
        'style',
        'layoutType',
        'showDropdownOnHover',
        'layoutNavbarFixed',
        'layoutFooterFixed',
        'themes',
      ],
      //   'defaultLanguage'=>'en',
    ];

    // if any key missing of array from custom.php file it will be merge and set a default value from dataDefault array and store in data variable
    $data = array_merge($DefaultData, $data);

    // All options available in the template
    $allOptions = [
      'myLayout' => ['vertical', 'horizontal', 'blank'],
      'menuCollapsed' => [true, false],
      'hasCustomizer' => [true, false],
      'showDropdownOnHover' => [true, false],
      'displayCustomizer' => [true, false],
      'myStyle' => ['light', 'dark'],
      'myTheme' => ['theme-default', 'theme-bordered', 'theme-semi-dark'],
      'myRTLSupport' => [true, false],
      'myRTLMode' => [true, false],
      'menuFixed' => [true, false],
      'navbarFixed' => [true, false],
      'footerFixed' => [true, false],
      'menuFlipped' => [true, false],
      // 'menuOffcanvas' => [true, false],
      'customizerControls' => [],
      // 'defaultLanguage'=>array('en'=>'en','fr'=>'fr','de'=>'de','pt'=>'pt'),
    ];

    //if myLayout value empty or not match with default options in custom.php config file then set a default value
    foreach ($allOptions as $key => $value) {
      if (array_key_exists($key, $DefaultData)) {
        if (gettype($DefaultData[$key]) === gettype($data[$key])) {
          // data key should be string
          if (is_string($data[$key])) {
            // data key should not be empty
            if (isset($data[$key]) && $data[$key] !== null) {
              // data key should not be exist inside allOptions array's sub array
              if (!array_key_exists($data[$key], $value)) {
                // ensure that passed value should be match with any of allOptions array value
                $result = array_search($data[$key], $value, 'strict');
                if (empty($result) && $result !== 0) {
                  $data[$key] = $DefaultData[$key];
                }
              }
            } else {
              // if data key not set or
              $data[$key] = $DefaultData[$key];
            }
          }
        } else {
          $data[$key] = $DefaultData[$key];
        }
      }
    }
    //layout classes
    $layoutClasses = [
      'layout' => $data['myLayout'],
      'theme' => $data['myTheme'],
      'style' => $data['myStyle'],
      'rtlSupport' => $data['myRTLSupport'],
      'rtlMode' => $data['myRTLMode'],
      'textDirection' => $data['myRTLMode'],
      'menuCollapsed' => $data['menuCollapsed'],
      'hasCustomizer' => $data['hasCustomizer'],
      'showDropdownOnHover' => $data['showDropdownOnHover'],
      'displayCustomizer' => $data['displayCustomizer'],
      'menuFixed' => $data['menuFixed'],
      'navbarFixed' => $data['navbarFixed'],
      'footerFixed' => $data['footerFixed'],
      'menuFlipped' => $data['menuFlipped'],
      // 'menuOffcanvas' => $data['menuOffcanvas'],
      'customizerControls' => $data['customizerControls'],
    ];

    // sidebar Collapsed
    if ($layoutClasses['menuCollapsed'] == true) {
      $layoutClasses['menuCollapsed'] = 'layout-menu-collapsed';
    }

    // Menu Fixed
    if ($layoutClasses['menuFixed'] == true) {
      $layoutClasses['menuFixed'] = 'layout-menu-fixed';
    }

    // Navbar Fixed
    if ($layoutClasses['navbarFixed'] == true) {
      $layoutClasses['navbarFixed'] = 'layout-navbar-fixed';
    }

    // Footer Fixed
    if ($layoutClasses['footerFixed'] == true) {
      $layoutClasses['footerFixed'] = 'layout-footer-fixed';
    }

    // Menu Flipped
    if ($layoutClasses['menuFlipped'] == true) {
      $layoutClasses['menuFlipped'] = 'layout-menu-flipped';
    }

    // Menu Offcanvas
    // if ($layoutClasses['menuOffcanvas'] == true) {
    //   $layoutClasses['menuOffcanvas'] = 'layout-menu-offcanvas';
    // }

    // RTL Supported template
    if ($layoutClasses['rtlSupport'] == true) {
      $layoutClasses['rtlSupport'] = '/rtl';
    }

    // RTL Layout/Mode
    if ($layoutClasses['rtlMode'] == true) {
      $layoutClasses['rtlMode'] = 'rtl';
      $layoutClasses['textDirection'] = 'rtl';
    } else {
      $layoutClasses['rtlMode'] = 'ltr';
      $layoutClasses['textDirection'] = 'ltr';
    }

    // Show DropdownOnHover for Horizontal Menu
    if ($layoutClasses['showDropdownOnHover'] == true) {
      $layoutClasses['showDropdownOnHover'] = 'true';
    } else {
      $layoutClasses['showDropdownOnHover'] = 'false';
    }

    // To hide/show display customizer UI, not js
    if ($layoutClasses['displayCustomizer'] == true) {
      $layoutClasses['displayCustomizer'] = 'true';
    } else {
      $layoutClasses['displayCustomizer'] = 'false';
    }

    return $layoutClasses;
  }

  public static function updatePageConfig($pageConfigs)
  {
    $demo = 'custom';
    if (isset($pageConfigs)) {
      if (count($pageConfigs) > 0) {
        foreach ($pageConfigs as $config => $val) {
          Config::set('custom.' . $demo . '.' . $config, $val);
        }
      }
    }
  }

  public static function getDaysBetweenDates($startDate, $endDate){
    $datetime1 = new \DateTime($startDate);
    $datetime2 = new \DateTime($endDate);
    $interval = $datetime1->diff($datetime2);
    $days = $interval->format('%r%a');

    return $days;
  }

  public static function isAdmin(){
    $accountType = Auth::user()->accountType;
    if($accountType==0){
      return true;
    }

    return false;
  }

  public static function isBuyer(){
    $accountType = Auth::user()->accountType;
    if($accountType==1){
      return true;
    }

    return false;
  }

  public static function isSeller(){
    $accountType = Auth::user()->accountType;
    if($accountType==2){
      return true;
    }

    return false;
  }

  public static function generateSlug($string) {
    return \Str::slug($string, "-");
  }

  public static function listOfDays(){
    return ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato", "Domenica"];
  }

  public static function listOfMonths(){
    return ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];
  }

  public static function getMonthName($monthNo){
    $months = Helpers::listOfMonths();

    return $months[$monthNo-1];
  }

  public static function calculateEstimateShippingDate($time, $delivery_day, $days_off){
    // if(date("N"))
    if($time){
      $days = Helpers::listOfDays();
      $today_day = $days[date("N")-1];
      $days_off_arr = explode(",", $days_off);

      if(count($days_off_arr)==7){
        return "NA";
      } else {
        if(in_array($today_day, $days_off_arr)){
          return Helpers::getNextWorkingDay($days_off_arr);
        } else {
          if(date("H:i") <= $time){
            return Helpers::getNextWorkingDay($days_off_arr);
          } else {
            return Helpers::getNextWorkingDay($days_off_arr);
          }
        }
      }
    } else {
      return "NA";
    }
  }

  public static function getNextWorkingDay($weekends){
    $numberOfDays = 7-count($weekends); //Next working day after 5 days
    // $weekends     = array('saturday', 'sunday'); //Saturday and sunday are weekends
    $currentDate  = date('Y-m-d');
    $dateObj      = new \DateTime($currentDate);
    $timeStamp    = $dateObj->getTimestamp();

    $days = Helpers::listOfDays();
    $week_of_day = date("N")-1;
    $today_day = $days[date("N")-1];
    $addDay   = 0;
    for ($i = 0; $i < 7; $i++) {
      if(in_array($days[$week_of_day], $weekends)){
        //skip
        $addDay += 86400;
        $week_of_day++;
        if($week_of_day>6){
          $week_of_day = 0;
        }
      } else {
        //return
        $timeStamp = $timeStamp + $addDay;
        $dateObj->setTimestamp($timeStamp);

        return $dateObj->format('d-m-Y');
      }
    }
  }

  public static function getNewTenProducts(){
    $products = Product::where(["active" => "yes"])->orderBy("id", "desc")->take(10)->get();

    return $products;
  }

  public static function getStartDateFromFilter($arg){
    $args = explode(" - ", $arg);
    
    return date("Y-m-d", strtotime($args[0]));
  }

  public static function getEndDateFromFilter($arg){
    $args = explode(" - ", $arg);
    
    return date("Y-m-d", strtotime($args[1]));
  }

  public static function clientActivityList(){
    return [
        "Azienda di trasporto merci su strada",
        "Azienda Edile",
        "Azienda Agricola",
        "Azienda di servizi navali",
        "Azienda di trasporto di persone",
        "Distributore privato",
    ];
  }

  public static function getAvailableCreditLimit($seller_id, $customer_id){
    $record = CustomerVerified::where([
        "customer_id" => $customer_id,
        "seller_id" => $seller_id,
      ])->first();

    return "€".number_format($record->credit_avail, 2);
  }

  public static function updateEmailTemplateValues($data, $html){
    foreach($data as $key => $_data){
      $html = str_replace("{{".$key."}}", $_data, $html);
    }

    return $html;
  }
}
