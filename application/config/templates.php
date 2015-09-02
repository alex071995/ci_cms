<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['templates']['front']['bootstrap/v335'] = array(
    'regions' => array('header','main_menu','sidebar','footer'),
    'scripts' => array(
        array('type' => 'base', 'value' => 'libraries/jquery/jquery-1.10.2.min'),
        array('type' => 'base', 'value' => 'bootstrap/v335/bootstrap.min')
    ),
    'styles' => array(
        array('type' => 'base', 'value' => 'bootstrap/v335/css/bootstrap.min'),
        array('type' => 'template', 'value' => 'custom')
    )
);

$config['templates']['front']['jqm/v132'] = array(
    'regions' => array('header', 'title','main_menu','sidebar','footer'),
    'scripts' => array(
        array('type' => 'base', 'value' => 'libraries/jquery/jquery-1.10.2.min'),
        array('type' => 'base', 'value' => 'jqm/v132/jquery.mobile-1.3.2.min'),
        array('type' => 'base', 'value' => 'jqm/v132/index')
    ),
    'styles' => array(
        array('type' => 'base', 'value' => 'jqm/v132/css/jquery.mobile-1.3.2.min'),
        array('type' => 'base', 'value' => 'jqm/v132/css/jqm-demos'),
        array('type' => 'base', 'value' => 'jqm/v132/css/custom'),
        //array('type' => 'base', 'value' => 'templates/default/custom'),
        array('type' => 'template', 'value' => 'custom')
    )
);

$config['templates']['front']['jqm/v145'] = array(
    'regions' => array('header', 'title','main_menu','sidebar','footer'),
    'scripts' => array(
        array('type' => 'base', 'value' => 'libraries/jquery/jquery-1.10.2.min'),
        array('type' => 'base', 'value' => 'jqm/v145/index'),
        array('type' => 'base', 'value' => 'jqm/v145/jquery.mobile-1.4.5.min')
        
    ),
    'styles' => array(
        array('type' => 'base', 'value' => 'jqm/v145/css/jquery.mobile-1.4.5.min'),
        array('type' => 'base', 'value' => 'jqm/v145/css/jqm-demos'),
        array('type' => 'base', 'value' => 'jqm/v145/css/custom'),
        //array('type' => 'base', 'value' => 'templates/default/custom'),
        array('type' => 'template', 'value' => 'custom')
    )
);

$config['templates']['front']['metroui/v3'] = array(
    'regions' => array('header', 'title','main_menu','sidebar','footer'),
    'scripts' => array(
        array('type' => 'base', 'value' => 'libraries/jquery/jquery-1.10.2.min'),
        array('type' => 'base', 'value' => 'metroui/v3/metro')
        //array('type' => 'base', 'value' => 'jqm/v145/jquery.mobile-1.4.5.min')
        
    ),
    'styles' => array(
        array('type' => 'base', 'value' => 'metroui/v3/css/metro'),
        array('type' => 'base', 'value' => 'metroui/v3/css/metro-icons'),
        //array('type' => 'base', 'value' => 'jqm/v145/css/custom'),
        //array('type' => 'base', 'value' => 'templates/default/custom'),
        array('type' => 'template', 'value' => 'custom')
    )
);


$config['templates']['admin']['default'] = array(
    'regions' => array('header','main_menu','sidebar','footer')
);

/* End of file templates.php */
/* Location: ./application/config/templates.php */