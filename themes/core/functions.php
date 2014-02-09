<?php


$rd->data['header'] = '<h1>Header: Rand</h1>';

$rd->data['footer'] = '<p>Footer: &copy; Rand by Rickard Liljeros</p>';
/**
* Print debuginformation from the framework.
*/
function get_debug() {
  $rd = CRand::Instance();
  $html = "<h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($rd->config, true)) . "</pre>";
  $html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($rd->data, true)) . "</pre>";
  $html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($rd->request, true)) . "</pre>";
  return $html;
}