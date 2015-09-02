<h2><?= ($title) ?></h2>
<hr>
<div class="row">
    <?= validation_errors(
            '<div class="alert alert-danger alert-dismissable">', 
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>'
            ) ?>
    
    <div>
        <?= form_open(base_url('users/login'), array('class' => 'form-horizontal', 'id' => 'form_login', 'name' => 'frm', 'role' => 'form'), array('login' => 1)) ?>
            <div class="form-group">
                <?= form_label($this->lang->line('cms_general_label_user'), 'user', array('class' => 'col-sm-3 control-label')) ?>
                <div class="col-sm-8">
                    <?= form_input(array(
                        'id' => 'user',
                        'name' => 'user',
                        'maxlength' => 30,
                        'placeholder' => $this->lang->line('cms_general_label_user'),
                        'class' => 'form-control',
                    ), set_value('user'), 'required') ?>
                </div>
            </div>
			
            <div class="form-group">
                <?= form_label($this->lang->line('cms_general_label_password'), 'password', array('class' => 'col-sm-3 control-label')) ?>
                <div class="col-sm-8">
                    <?= form_password(array(
                        'id' => 'password',
                        'name' => 'password',
                        'maxlength' => 30,
                        'placeholder' => $this->lang->line('cms_general_label_password'),
                        'class' => 'form-control'
                    ), '', 'required') ?>
                </div>
            </div>
			
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">
                    <?= form_button(array(
                        'content' => '<span class="glyphicon glyphicon-lock"></span> ' . $this->lang->line('cms_general_label_button_access'),
                        'type' => 'submit', 
                        'class' => 'btn btn-primary'
                    )) ?>
            
                 
                    <?= form_button(array(
                        'content' => '<span class="glyphicon glyphicon-check"></span> ' . $this->lang->line('cms_general_label_button_register'),
                        'type' => 'button', 
                        'class' => 'btn btn-primary',
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
			$('#msg').html('<div class="alert alert-info"><?= $this->lang->line('cms_general_label_loading') ?></div>');
		$.post( $('#form_login').attr('action'), $('#form_login').serialize(), function(json) {
			//alert(json.st);
			$('#msg').html('');		
			//$.mobile.loading( 'hide');
			if(json.st == 0)
				//$('#msg').html('<p class="ui-body-e" style="padding:1em;">'+json.msg+'</p>');
				$('#msg').html('<div class="alert alert-danger">'+json.msg+'</div>');
			else if(json.st == 2) //error por form_validation
			   $('#msg').html(''+json.msg+'');
			   //$('#msg').html('<div class="error_msj">'+json.msg+'</div>');
			else if(json.st == 1){
				//$('#msg').html('<p class="ui-body-e ui-icon-home" style="color:green; padding:1em;">'+json.msg+'</p>');
				$('#msg').html('<div class="alert alert-success">'+json.msg+'</div>');
				setTimeout(function(){ window.location = base_url; }, 2000);
				}					
		}, "json")
		return false;

	});
	
	});
</script>