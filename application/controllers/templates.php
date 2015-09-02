<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends CMS_Controller 
{
    public function change($name, $version, $panel = 'f')
    {
    	$this->db->where('panel', $panel);
    	$data = array(
               'default' => 0            
            );		
    	$this->db->where('name != ', $name.'/'.$version);		
		$this->db->update('templates', $data);
		 
		$data = array(
               'default' => 1            
            );		
		$this->db->where('name', $name.'/'.$version);
		$this->db->update('templates', $data); 
		
        redirect('', 'refresh');
		
    }
}

/* End of file templates.php */
/* Location: ./application/controllers/templates.php */