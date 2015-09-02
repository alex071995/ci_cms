<?php
$this->CI =& get_instance();

$config['navigation'] 			= array(
		
            'inicio' 			=> array(
                'id'     		=> 'inicio',
                'title'  		=> $this->CI->lang->line('cms_general_label_button_home'),
                'link'   		=> '',
            	'logeado'		=> true,
            	'no_logeado'	=> true
            ),			
            'login' 			=> array(
                'id'     		=> 'login',
                'title'  		=> $this->CI->lang->line('cms_general_label_button_access'),
            	'link'   		=> 'users/login',
            	'logeado'		=> false,
            	'no_logeado'	=> true	
            ),
			'registro' 			=> array(
				'id'     		=> 'registro',
				'title'  		=> $this->CI->lang->line('cms_general_label_button_register'),
				'link'   		=> 'users/new_user',
            	'logeado'		=> false,
            	'no_logeado'	=> true
			),
			'usuario' 			=> array(
				'id'     		=> 'usuario',
				'title'  		=> $this->CI->lang->line('cms_general_label_button_profile'),
				'link'   		=> 'users/edit_user',
				'logeado'		=> true,
				'no_logeado'	=> false
			),
	        'salir' 			=> array(
	        	'id'  			=> 'salir',
            	'title'  		=> $this->CI->lang->line('cms_general_label_button_exit'),
            	'link'   		=> 'users/logout',
            	'logeado'		=> true,
            	'no_logeado'	=> false
            )	
        );

/* End of file navigation.php */
/* Location: ./application/config/navigation.php */