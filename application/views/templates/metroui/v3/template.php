<!DOCTYPE html>
<html lang="en">
    <head>
    	<?php   //$this->CI =& get_instance();	?>	
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="description" content="<?= $this->config->item('APP_META_DESCRIPTION'); ?>">
	  	<meta name="keywords" content="<?= $this->config->item('APP_META_KEYWORDS'); ?>">
	  	<meta name="author" content="<?= $this->config->item('APP_META_AUTHOR'); ?>">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
        <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
        
        <title><?= $title.' - '.$this->config->item('APP_NAME'); ?></title>
        
        <!-- Bootstrap core CSS -->
        <?=$_css?>
        
        <!-- Bootstrap core JavaScript
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
   <div class="container">
    <header class="app-bar fixed-top navy" data-role="appbar" >

    <div class="container">
    	<a class="app-bar-element">
        <span id="toggle-tiles-dropdown" class="mif-apps mif-2x"></span>
        <div class="app-bar-drop-container"
                data-role="dropdown"
                data-toggle-element="#toggle-tiles-dropdown"
                data-no-close="false" style="width: 324px;">
            <div class="tile-container bg-white">
                <div class="tile-small bg-cyan">
                    <div class="tile-content iconic">
                        <span class="icon mif-onedrive"></span>
                    </div>
                </div>
                <div class="tile-small bg-yellow">
                    <div class="tile-content iconic">
                        <span class="icon mif-google"></span>
                    </div>
                </div>
                <div class="tile-small bg-red">
                    <div class="tile-content iconic">
                        <span class="icon mif-facebook"></span>
                    </div>
                </div>
                <div class="tile-small bg-green">
                    <div class="tile-content iconic">
                        <span class="icon mif-twitter"></span>
                    </div>
                </div>
            </div>
        </div>
    </a>
       	 <a class="app-bar-element branding" href="<?= base_url() ?>"><?= $this->config->item('APP_NAME'); ?></a>
                   	<ul class="app-bar-menu small-dropdown">
                        	<li>   
                        	
                            <a href="#" class="dropdown-toggle" >
                            	<?= $this->lang->line('cms_general_label_menu'). ' - '.$this->user->name;?> <b class="caret"></b>
                            </a>
                        
                                <?php 					       												       			
					       			 echo menu_ul('', '<ul class="d-menu" data-role="dropdown" data-no-close="true">'); 
					       		?> 
					      	</li> 		
                       
                    </ul>   
                    
                    	<div class="app-bar-element place-right">  
                    		
			
			             <div class="app-bar-element place-right">  
                    		<form>            
				             <input type="search" placeholder="<?= $this->lang->line('cms_general_label_search'); ?>..." />
				             </form>
				   </div>          
                    
			             
      </div>
       
      </header>
      
   <div class="grid">
   	<div class="row">
            <div class="padding10" style="padding-top: 80px">
                <?php foreach($_warning as $_msg): ?>
                    <div class="notify warning"><span class="notify-closer"></span> <span class="notify-title"><?=$_msg?></span> <span class="notify-text"><?=$_msg?></span></div>
                <?php endforeach;?>

                <?php foreach($_success as $_msg): ?>
                    <div class="notify success"><span class="notify-closer"></span> <span class="notify-title"><?=$_msg?></span> <span class="notify-text"><?=$_msg?></span></div>
                <?php endforeach;?>

                <?php foreach($_error as $_msg): ?>
                    <div class="notify alert"><span class="notify-closer"></span> <span class="notify-title"><?=$_msg?></span> <span class="notify-text"><?=$_msg?></span></div>
                <?php endforeach;?>

                <?php foreach($_info as $_msg): ?>
                    <div class="notify info"><span class="notify-closer"></span> <span class="notify-title"><?=$_msg?></span> <span class="notify-text"><?=$_msg?></span></div>
                <?php endforeach;?>

                <?php foreach($_content as $_view): ?>
                  <?php include $_view;?>
                <?php endforeach; ?>                
            </div>
     </div>
     </div>    
  
     
</div>

      
      		
	      	 	

	<footer style="background-color: #EFEAE3"  >
          
                   <div class="container padding10">
	        		<p>
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
	      			</div>
               
          
        </footer>


    </body>
</html>


