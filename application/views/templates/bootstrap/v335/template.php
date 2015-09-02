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
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <a class="navbar-brand" href="<?= base_url() ?>"><?= $this->config->item('APP_NAME'); ?></a>
                </div>

                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                       
                        <li class="dropdown">
                        	
                        	
                        	
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown">
                            	<?= $this->lang->line('cms_general_label_menu'). ' - '.$this->user->name;?> <b class="caret"></b>
                            </a>
                        
                                <?php 					       												       			
					       			 echo menu_ul('', '<ul class="dropdown-menu"> '); 
					       		?> 
					       		
                        </li>
                    </ul>

               
                    
                    <form class="navbar-form navbar-right" role="search">
			        <div class="form-group">
			         	<div class="input-group">
				          	<input type="text" class="form-control" placeholder="<?= $this->lang->line('cms_general_label_search'); ?>...">
				          	<span class="input-group-btn">
						        <button type="submit" class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span> </button>
						    </span>
					    </div>
			        </div>
			        	
			      	</form>
                    
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php foreach($_warning as $_msg): ?>
                        <div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?=$_msg?></div>
                    <?php endforeach;?>

                    <?php foreach($_success as $_msg): ?>
                        <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?=$_msg?></div>
                    <?php endforeach;?>

                    <?php foreach($_error as $_msg): ?>
                        <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?=$_msg?></div>
                    <?php endforeach;?>

                    <?php foreach($_info as $_msg): ?>
                        <div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?=$_msg?></div>
                    <?php endforeach;?>

                    <?php foreach($_content as $_view): ?>
                      <?php include $_view;?>
                    <?php endforeach; ?>                
                </div>
            
                <div class="col-md-4">
       
           	
                 
                </div>
            </div>

        </div> <!-- /container -->
        
		
 <div id="footer" style="position: absolute;  bottom: 0;  width: 100%; padding: 20px; /* Set the fixed height of the footer here */ height: 60px;  background-color: #f5f5f5;" > 
      <div class="container" >
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
    </div>




    </body>
</html>

