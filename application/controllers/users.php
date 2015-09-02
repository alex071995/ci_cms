<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CMS_Controller
{
    public function login()
    {
    	
        if($this->input->post('login') == 1)
        {
            //$this->load->library('form_validation');
            
            $rules = array(
                array(
                    'field' => 'user',
                    'label' => 'lang:cms_general_label_user',
                    'rules' => 'trim|required|alpha_dash|max_length[30]'
                ),
                array(
                    'field' => 'password',
                    'label' => 'lang:cms_general_label_password',
                    'rules' => 'required|max_length[30]'
                )                
            );
            
            
            $this->form_validation->set_rules($rules);
            
            if($this->form_validation->run() === TRUE)
            {
            		
                if($this->user->login($this->input->post('user'), $this->input->post('password')) === TRUE)
                {
                    $this->session->set_userdata('user_id', $this->user->id);
                    echo json_encode(array('st'=> 1, 'msg' => $this->lang->line('user_success_access'))); exit;
                    //redirect();
                }
				else{
                //$this->template->add_message(array('error' => $this->user->errors()));
				echo json_encode(array('st'=> 0, 'msg' => $this->user->errors())); exit;
				//echo 'errro';
				//echo $this->user->errors();
				}
			}
			else{
			//echo json_encode(array('st'=> 2, 'msg' => validation_errors('<p class="ui-body-e" style="padding:1em;">','</p>'))); exit;
			echo json_encode(array('st'=> 2, 'msg' => validation_errors('<div class="notify alert alert-danger">','</div>'))); exit;
        	}
		}
        
        //$this->load->helper('form');
		$this->template->set('title', $this->lang->line('cms_general_label_button_access'));
        $this->template->render('users/login');
    }
	
	public function edit_user()
    {
    	if($this->user->is_logged_in()===FALSE)
			redirect(base_url());
		
        if($this->input->post('login') == 1)
        {
            //$this->load->library('form_validation');
            
            $rules = array(
                array(
                    'field' => 'user',
                    'label' => 'lang:cms_general_label_user',
                    'rules' => 'trim|required|alpha_dash|max_length[30]'
                ),               
                array(
                    'field' => 'email',
                    'label' => 'lang:cms_general_label_email',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'name',
                    'label' => 'lang:cms_general_label_email',
                    'rules' => 'required'
                ),
                 array(
                    'field' => 'password',
                    'label' => 'lang:cms_general_label_password',
                    'rules' => 'max_length[30]|min_length[6]'
                ),
                array(
                    'field' => 'confirmation_password',
                    'label' => 'lang:cms_general_label_confirmation_password',
                    'rules' => 'max_length[30]|matches[password]'
                )                
            );
            
            
            $this->form_validation->set_rules($rules);
          
		    if($this->form_validation->run() === TRUE)
            {
            	
            	//$em=$this->user->send_email_register('quemao18', 'name', '1234567890', '123', 'alejandro.toba@gmail.com');
            	//echo json_encode(array('st'=> 0, 'msg' => $em)); exit;
            	//echo json_encode(array('st'=> 1, 'msg' => 'Bienvenido')); exit;
				if($this->user->update_user($this->input->post('user'), $this->input->post('password'), $this->input->post('name'), $this->input->post('email')) === TRUE)
				{
					//$this->template->add_message(array('success' => $this->lang->line('user_email_send')));
					//$this->template->render('welcome/index');
					echo json_encode(array('st'=> 1, 'msg' => $this->lang->line('user_edit_success'))); exit;
				}else
				{
					echo json_encode(array('st'=> 0, 'msg' => $this->user->errors())); exit;
				}
				
			}
			else{
			echo json_encode(array('st'=> 2, 'msg' => validation_errors('<div class="alert alert-danger">','</div>'))); exit;
        	}
		}
        
        //$this->load->helper('form');
		$this->template->set('title', $this->lang->line('cms_general_label_button_profile'));
        $this->template->render('users/edit');
    }

	public function new_user($role = 2)
    {
    	if($this->user->is_logged_in()===TRUE)
			redirect(base_url());
		
        if($this->input->post('login') == 1)
        {
            //$this->load->library('form_validation');
            
            $rules = array(
                array(
                    'field' => 'user',
                    'label' => 'lang:cms_general_label_user',
                    'rules' => 'trim|required|alpha_dash|max_length[30]'
                ),
                array(
                    'field' => 'password',
                    'label' => 'lang:cms_general_label_password',
                    'rules' => 'required|max_length[30]|min_length[6]'
                ),
                array(
                    'field' => 'email',
                    'label' => 'lang:cms_general_label_email',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'confirmation_password',
                    'label' => 'lang:cms_general_label_confirmation_password',
                    'rules' => 'required|max_length[30]|matches[password]'
                )
            );
            
            
            $this->form_validation->set_rules($rules);
          
		    if($this->form_validation->run() === TRUE)
            {
            	
            	//$em=$this->user->send_email_register('quemao18', 'name', '1234567890', '123', 'alejandro.toba@gmail.com');
            	//echo json_encode(array('st'=> 0, 'msg' => $em)); exit;
            	//echo json_encode(array('st'=> 1, 'msg' => 'Bienvenido')); exit;
				if($this->user->new_user($this->input->post('user'), $this->input->post('password'), $this->input->post('name'), $this->input->post('email'), $role) === TRUE)
				{
					//$this->template->add_message(array('success' => $this->lang->line('user_email_send')));
					//$this->template->render('welcome/index');
					echo json_encode(array('st'=> 1, 'msg' => $this->lang->line('user_email_send'))); exit;
				}else
				{
					echo json_encode(array('st'=> 0, 'msg' => $this->user->errors())); exit;
				}
				
			}
			else{
			echo json_encode(array('st'=> 2, 'msg' => validation_errors('<div class="alert alert-danger">','</div>'))); exit;
        	}
		}
        
        //$this->load->helper('form');
		$this->template->set('title', $this->lang->line('cms_general_label_button_register'));
        $this->template->render('users/new');
    }

	public function activate($user, $code)
	{
		if($this->user->activate_user($user, $code))
		{
			$this->template->add_message(array('success' => $this->lang->line('user_activate_success')));
			//echo json_encode(array('st'=> 1, 'msg' => $this->lang->line('user_activate_success'))); exit;
		}else 
			$this->template->add_message(array('error' => $this->user->errors()));   	
			//echo json_encode(array('st'=> 0, 'msg' => $this->user->errors())); exit;
		
		$this->template->set('title', $this->lang->line('cms_general_label_button_access'));
        $this->template->render('users/login');
		
    }

    public function logout()
    {
        if($this->user->is_logged_in())
        {
            $this->session->sess_destroy();          
        }
        
        redirect();
    }
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */