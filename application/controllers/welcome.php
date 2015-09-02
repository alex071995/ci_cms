<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CMS_Controller
{
    public function index()
    {
        $this->load->library('user', array('id' => 1));
		$this->template->add_message(array('error' => $this->lang->line('cms_general_label_error')));
		$this->template->add_message(array('warning' => $this->lang->line('cms_general_label_warning')));
		$this->template->add_message(array('info' => $this->lang->line('cms_general_label_info')));
		$this->template->add_message(array('success' => $this->lang->line('cms_general_label_success')));
		
        $this->template->set('title', $this->lang->line('cms_general_label_button_home'));
        $this->template->render('welcome/index');
    }
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */