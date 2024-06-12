<?php

  function formatAmountForItaly($amount, $currency = '€'){ 
    return number_format($amount, 2, ',', '.').$currency;
  }
