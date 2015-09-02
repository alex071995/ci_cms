<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/

$config['APP_NAME'] = 'CI CMS';
$config['APP_EMAIL'] = 'cicms@cicms.com';
$config['APP_WEB'] = 'www.cicms.com';
$config['APP_WEB_HTTP'] = 'http://www.cicms.com';

$config['APP_META_DESCRIPTION'] = 'CMS hecho en code igniter basico, con ACL y gestion de usuarios';
$config['APP_META_KEYWORDS'] = 'CMS, CodeIgniter, ACL';
$config['APP_META_AUTHOR'] = 'CI CMS';

$config['GOOGLE_ANALYTICS']="
<script>
if (window.location.hostname !== 'localhost') {
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-30748624-1', 'auto');
  ga('send', 'pageview');
}

</script>";


/* End of file variables.php */
/* Location: ./application/config/variables.php */