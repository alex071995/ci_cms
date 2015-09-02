<h2><?= ($title) ?></h2>
<hr>
<div class="row">
    <?= validation_errors(
            '<div class="notify alert alert alert-danger">', 
            '<span class="notify-closer"></span> <span class="notify-title"></span> <span class="notify-text"></span></div>'
            ) ?>

        <?= form_open(base_url('users/login'), array('class' => 'form-horizontal', 'id' => 'form_login', 'name' => 'frm', 'role' => 'form'), array('login' => 1)) ?>
          <div class="grid">
            
                <div class="cell padding5">       	
                	<?= form_label($this->lang->line('cms_general_label_user'), 'user') ?>
                </div>	 
                <div class="cells padding5">                 
		             	<div class="input-control text full-size">
		             	   <span class="mif-user prepend-icon"></span>
		             	   <?= form_input(array(
		                        'id' => 'user',                
		                        'name' => 'user',
		                        'type' => 'text',
		                        'maxlength' => 30,
		                        'placeholder' => $this->lang->line('cms_general_label_user'),
		                        'class' => '',
		                    ), set_value('user'), 'required') ?>
		         		</div>
		        </div>
            	
         		<div class="cell padding5">
                <?= form_label($this->lang->line('cms_general_label_password'), 'password') ?>
              	</div>
              	  <div class="cells padding5">   
		               <div class="input-control password full-size"> 
		               	      <span class="mif-lock prepend-icon"></span>
		               	      <?= form_password(array(
		                        'id' => 'password',
		                        'name' => 'password',
		                        'type' => 'password',
		                        'maxlength' => 30,
		                        'placeholder' => $this->lang->line('cms_general_label_password'),
		                        'class' => ''
		                    ), '', 'required') ?>
		               </div>
            	
					</div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">
                    <?= form_button(array(
                        'content' => '<span class="mif-lock"></span> ' . $this->lang->line('cms_general_label_button_access'),
                        'type' => 'submit', 
                        'class' => 'button success'
                    )) ?>
            
                 
                    <?= form_button(array(
                        'content' => '<span class="mif-user-plus"></span> ' . $this->lang->line('cms_general_label_button_register'),
                        'type' => 'button', 
                        'class' => 'button success',
                        'id' => 'registro'
                    )) ?>
                </div>
                
            </div>                      
            
        <?= form_close() ?>
    </div>
</div>
  <div  id="msg"></div>

<script>

	$(function(){
		
		var base_url = '<?=base_url()?>';
		//alert(base_url);
		$('#registro').click(function() {
			window.location = base_url +'users/new_user';		
		});
	
		$('#form_login').submit(function(){
			//$.mobile.loading( 'show');
			$('#msg').html('<div class="alert notify info alert-info"><?= $this->lang->line('cms_general_label_loading') ?></div>');
		$.post( $('#form_login').attr('action'), $('#form_login').serialize(), function(json) {
			//alert(json.st);
			$('#msg').html('');		
			//$.mobile.loading( 'hide');
			if(json.st == 0)
				//$('#msg').html('<p class="ui-body-e" style="padding:1em;">'+json.msg+'</p>');
				$('#msg').html('<div class="notify alert">'+json.msg+'</div>');
			else if(json.st == 2) //error por form_validation
			   $('#msg').html(''+json.msg+'');
			   //$('#msg').html('<div class="error_msj">'+json.msg+'</div>');
			else if(json.st == 1){
				//$('#msg').html('<p class="ui-body-e ui-icon-home" style="color:green; padding:1em;">'+json.msg+'</p>');
				$('#msg').html('<div class="notify success">'+json.msg+'</div>');
				setTimeout(function(){ window.location = base_url; }, 2000);
				}					
		}, "json")
		return false;

	});
	
	});
</script>