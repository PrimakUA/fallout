<?php
function strips(&$el) {
    if (is_array($el))
    foreach($el as $k=>$v)
    strips($el[$k]);
    else $el = stripslashes($el);
    }
    if (get_magic_quotes_gpc()) {
    strips($_GET);
    strips($_POST);
    strips($_COOKIE);
    strips($_REQUEST);
    if (isset($_SERVER['PHP_AUTH_USER'])) strips($_SERVER['PHP_AUTH_USER']);
    if (isset($_SERVER['PHP_AUTH_PW']))   strips($_SERVER['PHP_AUTH_PW']);
}
