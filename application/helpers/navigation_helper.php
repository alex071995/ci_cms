<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * menu_ul()
 * Genera una lista desordenada con la clase current en el elemento seleccionado.
 */
if ( ! function_exists('menu_ul'))
{
    function menu_ul($sel = 'home', $menu = '<ul class="jqm-nav">')
   {
        $CI =& get_instance();
        $items = $CI->config->item('navigation');
		
       if(!$CI->user->is_logged_in())
        	unset($items['usuario'],$items['salir']);
       else
       		unset($items['registro'], $items['login']);
		
        $menu.="\n";
        //$menu = '<ul class="jqm-nav">'."\n"; 
        foreach($items as $item )
        {       
            $current = (in_array($sel, $item)) ? ' class="current"' : '';
            $id = (!empty($item['id'])) ? ' id="'.$item['id'].'"' : '';
            //$menu .= '<li'.$current.'><a href="'.base_url().$item['link'].'"'.$id.'>'.$item['title'].'</a></li>'."\n";
            $menu .= '<li'.$current.'><a onclick="window.location=\''.base_url().$item['link'].'\'; return false;" href="#">'.$item['title'].'</a></li>'."\n";
        }
        $menu .= '</ul>'."\n";
        return $menu;
    }
}

// ------------------------------------------------------------------------

/**
 * menu_p
 * Genera un parrafo con la clase current en el elemento seleccionado
 */
if ( ! function_exists('menu_p'))
{
    function menu_p($sel = 'home', $separator = '')
   {
        $CI =& get_instance();
        $items = $CI->config->item('navigation');

        $count = count($items);
        $i = 0;
        $menu = "\n".'<p class="">';
        foreach($items as $item)
        {
            $current = (in_array($sel, $item)) ? ' class="current"' : '';
            $id = (!empty($item['id'])) ? ' id="'.$item['id'].'"' : '';
            $menu .= '<a'.$current.' href="'.$item['link'].'"'.$id.'>'.$item['title'].'</a>';
            $i++;
            if($count != $i)
            {
                $menu .= ' '.$separator.' ';
            }
        }
        $menu .= '</p>'."\n";
        return $menu;
    }
}


/* End of file navigation_helper.php */
/* Location: ./system/helpers/navigation_helper.php */