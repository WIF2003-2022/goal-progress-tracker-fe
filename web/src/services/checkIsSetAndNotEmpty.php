<?php

function checkIsSetAndNotEmpty($checkFrom, $keys) {
  $res = true;
  foreach ($keys as $key) {
    $res = $res && isset($checkFrom[$key]) && $checkFrom[$key] !== '';
  }

  return $res;
}