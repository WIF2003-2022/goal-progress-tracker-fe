<?php

function checkEmpty() {
  $params = func_get_args();
  foreach ($params as $param) {
    if ($param == null) {
      return true;
    }
  }
  return false;
}