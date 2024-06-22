<?php

  function formatAmountForItaly($amount, $isSign = false, $currency = '€', $decimal = 5, $pre = true){ 
    if($isSign){
      return ($pre?$currency:'').rtrim(rtrim(number_format($amount, $decimal, ',', '.'), '0'), ',').(!$pre?$currency:'');
    } else {
      return rtrim(rtrim(number_format($amount, $decimal, ',', '.'), '0'), ',');
    }
  }
