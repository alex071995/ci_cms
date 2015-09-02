<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__).'/Acl.php';

class User
{
    private $CI;
    private $table = 'users';
    private $lang;
    private $acl;
    private $errors = array();
    private $user_id;
    private $user_user;
    private $user_name;
    private $user_email;
    private $user_status;
    private $user_active;
    private $pattern = "/^([-a-z0-9_-])+$/i";
    
    public function __construct($options = array()) 
    {
        $this->CI =& get_instance();
		
        $this->_set_language(isset($options['lang']) ? $options['lang'] : null);
        
        $row = null;
        
        if(isset($options['id']) && (int)$options['id'] > 0)
        {
            $row = $this->_row(array('id' => (int)$options['id']));
            
            if(sizeof($row) == 0)
            {
                show_error($this->CI->lang->line('user_error_invalid_user'));
            }
        }
        elseif((int) $this->CI->session->userdata('user_id') > 0)
        {
            $row = $this->_row(array('id' => $this->CI->session->userdata('user_id')));
            
            if(sizeof($row) == 0 || $row->active != 1 || $row->status != 1)
            {
                $this->CI->session->sess_destroy();
                $this->_load(null);
                return;
            }
        }
        
        $this->_load($row);
    }
    
    public function __get($name)
    {
        $property = 'user_' . $name;
        
        if(isset($this->$property))
        {
            return $this->$property;
        }
    }
    
    public function errors()
    {
        return $this->errors;
    }

    public function permissions()
    {
        return $this->acl->permissions;
    }
    
    public function site_permissions()
    {
        return $this->acl->site_permissions;
    }
    
    public function has_permission($name)
    {
        return $this->acl->has_permission($name);
    }
    
    public function is_logged_in()
    {
        if($this->user_id > 0)
        {
            return $this->user_id == (int) $this->CI->session->userdata('user_id');
        }
        
        return FALSE;
    }

    public function login($user, $password, $hash = 'sha256')
    {
        if(empty($user) || ! preg_match($this->pattern, $user))
        {
            $this->errors[] = $this->CI->lang->line('user_error_username');
        }
        
        if(empty($password))
        {
            $this->errors[] = $this->CI->lang->line('user_error_empty_password');
        }
        
        if(count($this->errors))
        {
            return FALSE;
        }
        
        $this->CI->load->library('encrypt');
        
        $row = $this->_row(array('user' => $user, 'password' => $this->CI->encrypt->password($password, $hash)));
        
        if(sizeof($row) == 0 || $row->active != 1 || $row->status != 1)
        {
            $this->errors[] = $this->CI->lang->line('user_error_wrong_credentials');
            return FALSE;
        }
        
        $this->_load($row);
		$this->_set_last_login($this->user_id);
        return TRUE;
    }

    public function new_user($user, $password, $name, $email, $role, $hash = 'sha256')
    {
        if(empty($user) || ! preg_match($this->pattern, $user))
        {
            $this->errors[] = $this->CI->lang->line('user_error_username');
        }
        
        if(empty($password))
        {
            $this->errors[] = $this->CI->lang->line('user_error_empty_password');
        }
		
		if(empty($name))
        {
            $this->errors[] = $this->CI->lang->line('user_error_empty_name');
        }
		
		if(empty($email))
        {
            $this->errors[] = $this->CI->lang->line('user_error_empty_email');
        }
		
		$row = $this->_row(array('email' => $email));
        if(sizeof($row)>0)
        {
        	$this->errors[] = $this->CI->lang->line('user_error_email_exist');
        }
		
		$row = $this->_row(array('user' => $user));
        if(sizeof($row)>0)
        {
        	$this->errors[] = $this->CI->lang->line('user_error_exist');
        }
		
		
	    if(count($this->errors))
        {
            return FALSE;
        }
		
        $this->CI->load->library('encrypt');
		$code = rand(1782598471, 9999999999);
		$data = array(
  			 	'name' => $name,
   				'email' => $email,
   				'user' => $user,
   				'password' => $this->CI->encrypt->password($password, $hash),
   				'role' => $role,
  				'created' => $this->user_id,
   				'created_at' => date('Y-m-d H:s:i'),
   				'code' => $code		
				);

		$this->CI->db->insert($this->table, $data); 
		
		//$this->errors[] = mdate('%Y-%m-%d %H:%s:%i', now()); ;//date('Y-m-d H:s:i');
		//return TRUE;
		//enviar email if true
		
		if($this->send_email_register($user, $name, $code, $password, $email) === TRUE)
		 	return TRUE;
		else
			{
			$this->errors[] = 'error '.$this->send_email_register($user, $name, $code, $password, $email);
			return FALSE;
			} 
	     /*
        $row = $this->_row(array('user' => $user, 'password' => $this->CI->encrypt->password($password, $hash)));
        
        if(sizeof($row) == 0 || $row->active != 1 || $row->status != 1)
        {
            $this->errors[] = $this->CI->lang->line('user_error_wrong_credentials');
            return FALSE;
        }
        
        $this->_load($row);
		 * */
		 
    }

 public function update_user($user, $password, $name, $email, $hash = 'sha256')
    {
        if(empty($user) || ! preg_match($this->pattern, $user))
        {
            $this->errors[] = $this->CI->lang->line('user_error_username');
        }      
		
		if(empty($name))
        {
            $this->errors[] = $this->CI->lang->line('user_error_empty_name');
        }
		
		if(empty($email))
        {
            $this->errors[] = $this->CI->lang->line('user_error_empty_email');
        }
		
		$row = $this->_row(array('email' => $email));
        if(sizeof($row)>0 && $this->user_email!= $email)
        {
        	$this->errors[] = $this->CI->lang->line('user_error_email_exist');
        }
		
		$row = $this->_row(array('user' => $user));
        if(sizeof($row)>0 && $this->user_user != $user)
        {
        	$this->errors[] = $this->CI->lang->line('user_error_exist');
        }
		
		
	    if(count($this->errors))
        {
            return FALSE;
        }
		
        $this->CI->load->library('encrypt');
		//$code = rand(1782598471, 9999999999);
		
		if(empty($password))
        {
            //$this->errors[] = $this->CI->lang->line('user_error_empty_password');
			$data = array(
  			 	'name' => $name,
   				'email' => $email,
   				'user' => $user,
   				//'password' => $this->CI->encrypt->password($password, $hash),
   				//'role' => $role,
  				'modified' => $this->user_id,
   				'modified_at' => date('Y-m-d H:s:i'),
   				//'code' => $code		
				);
        }else{
        	$data = array(
  			 	'name' => $name,
   				'email' => $email,
   				'user' => $user,
   				'password' => $this->CI->encrypt->password($password, $hash),
   				//'role' => $role,
  				'modified' => $this->user_id,
   				'modified_at' => date('Y-m-d H:s:i'),
   				//'code' => $code		
				);			
        }
		$this->CI->db->where('id', $this->user_id);
		$this->CI->db->update($this->table, $data); 
		
		//$this->errors[] = mdate('%Y-%m-%d %H:%s:%i', now()); ;//date('Y-m-d H:s:i');
		//return TRUE;
		//enviar email if true
		
		if($this->send_email_update($user, $name, $password, $email) === TRUE)
		 	return TRUE;
		else
			{
			//$this->errors[] = 'error '.$this->send_email_register($user, $name, $code, $password, $email);
			return FALSE;
			} 
	     /*
        $row = $this->_row(array('user' => $user, 'password' => $this->CI->encrypt->password($password, $hash)));
        
        if(sizeof($row) == 0 || $row->active != 1 || $row->status != 1)
        {
            $this->errors[] = $this->CI->lang->line('user_error_wrong_credentials');
            return FALSE;
        }
        
        $this->_load($row);
		 * */
		 
    }

		public function send_email_register($user, $name, $code, $pass, $email)
		{
    	
    	//$this->CI->load->library('email');
    	$subject = $this->CI->lang->line('cms_general_subject_email_register').' '.$this->CI->config->item('APP_NOMBRE').'';
     	$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
			    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			    <title>'.htmlspecialchars($subject, ENT_QUOTES, $this->CI->email->charset).'</title>
			    <style type="text/css">
							body{
			    		 	font-family: Arial, Verdana, Helvetica, sans-serif;
            				font-size: 14px;							
							}
			    </style>
				</head>			    		
    			<body>
			    <a href='.base_url().'><img weight=90px height=90px src='.base_url('assets/images/logo.png').'></a>	
     			<p>'.$this->CI->lang->line('cms_general_hello').' <strong>' . ucwords(strtolower($name)) . '</strong>, ' .
    			'<br><br>'.$this->CI->lang->line('cms_general_welcome_to').'<strong> ' .$this->CI->config->item('APP_WEB'). '</strong>'.
    			' '.$this->CI->lang->line('cms_general_link_active_account').' <br><br>' .  			
    			'<a href='. base_url() .'users/activate/' .$user. '/' . $code.'>'.$this->CI->lang->line('cms_general_link_active_button').'</a>'.
				'<br><br>'.
				$this->CI->lang->line('cms_general_remember_dates').'<br><strong>'.
				$this->CI->lang->line('cms_general_label_user').': '.$user.'<br>'.
				$this->CI->lang->line('cms_general_label_password').': '.$pass.
				'</strong><br><br>'.$this->CI->lang->line('cms_general_thanks').'.<br><br>'.
				'<a href=http://'.$this->CI->config->item('APP_WEB').' >'.$this->CI->config->item('APP_WEB').'</a></p>
    			
				</body>
				</html>
						';
				
     	$this->CI->email->set_newline("\r\n");
		
     	$result = $this->CI->email
     	->from($this->CI->config->item('APP_EMAIL'))
     	->reply_to($this->CI->config->item('APP_EMAIL'))    // Optional, an account where a human being reads.
     	->to($email)
     	->subject($subject)
     	->message($body)
     	->send();
     	//var_dump($this->CI->email->print_debugger());
     	if(!$result) {
     		return 	FALSE;
     	}else{
     		return 	TRUE;
     	}
    }

		public function send_email_update($user, $name, $pass, $email)
		{
    	
    	//$this->CI->load->library('email');
    	$subject = $this->CI->lang->line('cms_general_subject_email_register').' '.$this->CI->config->item('APP_NOMBRE').'';
     	$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
			    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			    <title>'.htmlspecialchars($subject, ENT_QUOTES, $this->CI->email->charset).'</title>
			    <style type="text/css">
							body{
			    		 	font-family: Arial, Verdana, Helvetica, sans-serif;
            				font-size: 14px;							
							}
			    </style>
				</head>			    		
    			<body>
			    <a href='.base_url().'><img weight=90px height=90px src='.base_url('assets/images/logo.png').'></a>	
     			<p>'.$this->CI->lang->line('cms_general_hello').' <strong>' . ucwords(strtolower($name)) . '</strong>, ' .
    			'<br><br>'.$this->CI->lang->line('cms_general_update_success').'<strong> ' .$this->CI->config->item('APP_WEB'). '</strong>'.
    			//' <br><br>' .  			
				//'<br><br>'.
				//$this->CI->lang->line('cms_general_remember_dates').'<br><strong>'.
				//$this->CI->lang->line('cms_general_label_user').': '.$user.'<br>'.
				//$this->CI->lang->line('cms_general_label_password').': '.$pass.
				'</strong><br><br>'.$this->CI->lang->line('cms_general_thanks').'.<br><br>'.
				'<a href=http://'.$this->CI->config->item('APP_WEB').' >'.$this->CI->config->item('APP_WEB').'</a></p>
    			
				</body>
				</html>
						';
				
     	$this->CI->email->set_newline("\r\n");
		
     	$result = $this->CI->email
     	->from($this->CI->config->item('APP_EMAIL'))
     	->reply_to($this->CI->config->item('APP_EMAIL'))    // Optional, an account where a human being reads.
     	->to($email)
     	->subject($subject)
     	->message($body)
     	->send();
     	//var_dump($this->CI->email->print_debugger());
     	if(!$result) {
     		return 	FALSE;
     	}else{
     		return 	TRUE;
     	}
    }

		public function activate_user($user, $code)
	    {
	    	
	    if(empty($code))
		{
        	$this->errors[] = $this->CI->lang->line('user_error_code');
        }
		
		$row = $this->_row(array('code' => $code));
		
        if(sizeof($row)==0)
        {
        	$this->errors[] = $this->CI->lang->line('user_error_code');
        }

		//foreach ($row as $fila) {
			
		if($row->status == 1)
		{
			$this->errors[] = $this->CI->lang->line('user_error_exist_active');
		}
		//}
		
		
	    if(count($this->errors))
        {
            return FALSE;
        }
		else 
		{
		   	   	 
		$data = array(
               'status' => 1,
               'active' => 1
            );
		 
		$this->CI->db->where('user', $user);
		$this->CI->db->where('code', $code);
    	$this->CI->db->update($this->table, $data); 
		
		$row = $this->_row(array('user' => $user));
	    	if($row->status == 0 || $row->active == 0 || sizeof($row)==0)
			{
				$this->errors[] = $this->CI->lang->line('user_error_activating');
				return FALSE;
			}else
			{
				return TRUE;
			}
				
		}
		
		
    }
    
    private function _load($row = null)
    {
        if($row == null || sizeof($row) == 0)
        {
            $this->user_id = 0;
            $this->user_user = $this->CI->lang->line('cms_general_label_site_visitor_user');
            $this->user_name = $this->CI->lang->line('cms_general_label_site_visitor_name');
            $this->user_email = '';
            $this->user_active = 0;
            $this->user_status = 0;
            $this->acl = new Acl(array('lang' => $this->lang));
            
            return;
        }
        
        $this->user_id = $row->id;
        $this->user_user = $row->user;
        $this->user_name = $row->name;
        $this->user_email = $row->email;
        $this->user_active = $row->active;
        $this->user_status = $row->status;
        $this->acl = new Acl(array('id' => $row->id,'lang' => $this->lang));
    }
	
	private function _set_last_login($id)
	{
		$data = array(
               'last_login' => date('Y-m-d H:s:i')		    
            );
		$this->CI->db->where('id', $id);
		$this->CI->db->update($this->table, $data); 
	}
    
    private function _row($where = null, $select = null)
    {
        if(is_array($where))
        {
            $this->CI->db->where($where);
        }
        
        if(is_array($select))
        {
            $this->CI->db->select($select);
        }
        
        return $this->CI->db->get($this->table)->row();
		
    }
	
	private function _new_user($where = null, $select = null)
    {
        if(is_array($where))
        {
            $this->CI->db->where($where);
        }
        
        if(is_array($select))
        {
            $this->CI->db->select($select);
        }
        
        return $this->CI->db->get($this->table)->row();
    }
    
    private function _set_language($lang = null)
    {
        $languages = array('english', 'spanish');
        
        if( ! $lang)
        {
            if(in_array($this->CI->config->item('language'), $languages))
            {
                $lang = $this->CI->config->item('language');
            }
            else
            {
                $lang = $languages[0];
            }
        }
        else
        {
            if( ! in_array($lang, $languages))
            {
                $lang = $languages[0];
            }
        }
        
        $this->lang = $lang;
        $this->CI->load->language('user', $lang);
    }    
}

/* End of file User.php */
/* Location: ./application/libraries/User.php */