<?php


/**
* Create a url by prepending the base_url.
*/
function base_url($url) {
  return CRand::Instance()->request->base_url . trim($url, '/');
}

/**
* Return the current url.
*/
function current_url() {
  return CRand::Instance()->request->current_url;
}