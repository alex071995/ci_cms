<!DOCTYPE html>
<html lang="en">
    <head>
          <?php //$this->CI =& get_instance(); ?>
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <meta name="description" content="<?= $this->config->item('APP_META_DESCRIPTION'); ?>">
		  <meta name="keywords" content="<?= $this->config->item('APP_META_KEYWORDS'); ?>">
		  <meta name="author" content="<?= $this->config->item('APP_META_AUTHOR'); ?>">
          <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		  <meta http-equiv="Pragma" content="no-cache" />
		  <meta http-equiv="Expires" content="0" />
        <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">
        
        
        <title><?= $title.' - '.$this->config->item('APP_NAME'); ?></title>
        
        <!-- JQM core CSS -->
        <?=$_css?>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
                
        <!-- JQM core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?=$_js?>
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <?= $this->config->item('GOOGLE_ANALYTICS'); ?>
    </head>

    <body>
       
       <div data-role="page" class="jqm-demos jqm-home">
       	
        <div data-role="header" class="jqm-header">
            <? //= $header ?>
            <h2 class="jqm-logo">
	            <a href="<?= base_url()  ?>">
	            	<img src="<?= base_url('assets/images/logo.png'); ?>"  alt="<?= $this->config->item('APP_NAME'); ?>">
	            </a>
            </h2>                   
            <p>Version <span class="jqm-version"></span></p>	
		<a href="#" class="jqm-navmenu-link ui-btn ui-btn-icon-notext ui-corner-all ui-icon-bars ui-nodisc-icon ui-alt-icon ui-btn-left">Menu</a>
		<a href="#" class="jqm-search-link ui-btn ui-btn-icon-notext ui-corner-all ui-icon-search ui-nodisc-icon ui-alt-icon ui-btn-right">Search</a>
           
             

         </div> <!-- header -->

        <div role="main" class="ui-content jqm-content">
       
        
        
                    <?php foreach($_warning as $_msg): ?>
                        <div class="alert alert-warning"><?=$_msg?></div>
                    <?php endforeach;?>

                    <?php foreach($_success as $_msg): ?>
                        <div class="alert alert-success"><?=$_msg?></div>
                    <?php endforeach;?>

                    <?php foreach($_error as $_msg): ?>
                        <div class="alert alert-error"><?=$_msg?></div>
                    <?php endforeach;?>

                    <?php foreach($_info as $_msg): ?>
                        <div class="alert alert-info"><?=$_msg?></div>
                    <?php endforeach;?>
		
		
		<!-- end notifications -->
												
                    <?php foreach($_content as $_view): ?>
                      <?php include $_view;?>
                    <?php endforeach; ?>    
		              
            
        </div> <!-- /container -->        
		<div data-role="panel" class="jqm-navmenu-panel" data-position="left" data-display="overlay" >	    	     
       		<?php       			 
				 //print_r($CI->config->item('navigation')); exit;
       			 $menu = '<ul data-divider-theme="a" class="jqm-list ui-alt-icon ui-nodisc-icon">
       			 <li data-role ="list-divider"> - '. $this->lang->line('cms_general_label_menu'). ' - '.$this->user->name;'</li>';
       			 echo menu_ul('inicio', $menu); 
       			 ?>	 
       	</div>   <!-- /panel --> 
       	      	    
         <div data-role="footer" data-position="fixed" data-tap-toggle="false" class="jqm-footer" >
          
           	<p style="font-family:Arial; font-size: 12px;">
	           <?= $this->lang->line('cms_general_slapsed_time') ?>: <strong>{elapsed_time}</strong> seg. - 
	         	<?php 
	         	echo $this->lang->line('cms_general_language').':';
				$lenguas = $this->config->item('cms_languages');
				foreach($lenguas as $lengua) {
					echo ' <a onclick="window.location=\''.base_url('language/change/'.$lengua).'\'; return false;" href="#">'.ucwords($lengua).'</a> - ';
				}	
				
				echo $this->lang->line('cms_general_templates').':';				
				$this->db->select('name');
				$this->db->where('panel', 'f');
				$this->db->where('status', '1');
				$templates = $this->db->get('templates')->result();
				foreach($templates as $template) {
					echo ' <a onclick="window.location=\''.base_url('templates/change/'.$template->name).'\'; return false;" href="#">'.ucwords($template->name).'</a> - ';
				}
				echo 'CI Version: '.CI_VERSION;						
				?>
			</p>
         </div> <!-- footer -->     
         
         <div data-role="panel" class="jqm-search-panel" data-position="right" data-display="overlay" data-theme="a">
			<div class="jqm-search">
				
			<form id="form_busqueda" method="post" action="<?= site_url('search/');?>" >
           		<input type="search" name="search" id="search" placeholder="<?= $this->lang->line('cms_general_label_search'); ?>..." class="ui-input-tex ui-body-c" />          			
            </form>   
					
			</div>
		</div>
         
      </div> <!-- page -->
      
    </body>
</html>