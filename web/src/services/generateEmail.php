<?php

function generateEmail($templatePath, $context) {
  $template = file_get_contents($templatePath);
  foreach($context as $key => $value)
  {
    $template = str_replace('{{'.$key.'}}', $value, $template);
  }

  return $template;
}