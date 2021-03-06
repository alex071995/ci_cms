<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CMS Encrypt Class 
 * 
 * @package	CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 */
class CMS_Encrypt extends CI_Encrypt
{
    /**
     * Constructor
     *
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Hash
     *
     * @param   string $data
     * @param   string $algo
     * @return	string
     */
    public function password($data, $algo = "sha256")
    {
        if( ! $this->CI->config->item("encryption_key"))
        {
            show_error('Encryption key not found');
        }
        
        $hash = hash_init($algo, HASH_HMAC, $this->CI->config->item("encryption_key"));
        hash_update($hash, $data);
        return hash_final($hash);
    }
}


/* End of file CMS_Encrypt.php */
/* Location: ./application/libraries/CMS_Encrypt.php */