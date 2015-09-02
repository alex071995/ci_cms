<h2><?= ($title) ?></h2>
       <?= form_open(base_url('users/login'), array('id' => 'form_login', 'name' => 'frm'), array('login' => 1)) ?>
                 <?= form_label($this->lang->line('cms_general_label_user'), 'user') ?>
               
                    <?= form_input(array(
                        'id' => 'user',
                        'name' => 'user',
                        'maxlength' => 30,
                        'placeholder' => $this->lang->line('cms_general_label_user')
                      ), set_value('user'), 'required') ?>
               
                 <?= form_label($this->lang->line('cms_general_label_password'), 'password') ?>
                    <?= form_password(array(
                        'id' => 'password',
                        'name' => 'password',
                        'maxlength' => 30,
                        'placeholder' => $this->lang->line('cms_general_label_password')                     
                    ), '', 'required') ?>
       				<br />
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
                    <?= form_button(array(
                    	'id' => 'submit',
                    	'data-icon'=>"check",
                        'content' => '' . $this->lang->line('cms_general_label_button_access'),
                        'type' => 'submit', 
                        'data-theme'=>"b"
                    )) ?>
                    <?= form_button(array(
                    	'id' => 'registro',
                    	'data-icon'=>"plus",
                        'content' => '' . $this->lang->line('cms_general_label_button_register'),
                        'type' => 'button', 
                        'data-theme'=>"b"
                    )) ?>
                    </fieldset>
                    
                    <div  id="msg"></div>
                    
          <?= form_close() ?>
 
<script>

	$(function(){
		
		var base_url = '<?=base_url()?>';
	
		$('#registro').click(function() {
			window.location = base_url +'users/new_user';		
		});
	
		$('#form_login').submit(function(){
			$.mobile.loading( 'show');
		$.post( $('#form_login').attr('action'), $('#form_login').serialize(), function(json) {
			//alert(json.st);
			$('#msg').html('');
			$.mobile.loading( 'hide');
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