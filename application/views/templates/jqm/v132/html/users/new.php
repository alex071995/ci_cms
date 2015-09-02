<h2><?= ($title) ?></h2>
        <?= form_open(base_url('users/new_user'), array('id' => 'form_new_user', 'name' => 'frm'), array('login' => 1)) ?>
                 <?= form_label($this->lang->line('cms_general_label_name'), 'name') ?>
               	 <?= form_input(array(
                        'id' => 'name',
                        'name' => 'name',
                        'maxlength' => 150,
                        'placeholder' => $this->lang->line('cms_general_label_name')
                      ), set_value('name'), 'required') ?>
               
                  <?= form_label($this->lang->line('cms_general_label_email'), 'email') ?>
               	 <?= form_input(array(
                        'id' => 'email',
                        'name' => 'email',
                        'type' => 'email',                        
                        'maxlength' => 150,                    
                        'placeholder' => $this->lang->line('cms_general_label_email')
                      ), set_value('email'), 'required') ?>
                      
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
                    
                    <?= form_label($this->lang->line('cms_general_label_confirmation_password'), 'confirmation_password') ?>
                    <?= form_password(array(
                        'id' => 'confirmation_password',
                        'name' => 'confirmation_password',
                        'maxlength' => 30,
                        'placeholder' => $this->lang->line('cms_general_label_confirmation_password')                     
                    ), '', 'required') ?>
       				<br />
       				
                    <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">                  
                    <?= form_button(array(
                    	'id' => 'registro',
                    	'data-icon'=>"plus",
                        'content' => '' . $this->lang->line('cms_general_label_button_register'),
                        'type' => 'submit', 
                        'data-theme'=>"b"
                    )) ?>
                    <?= form_button(array(
                    	'id' => 'login',
                    	'data-icon'=>"check",
                        'content' => '' . $this->lang->line('cms_general_label_button_access'),
                        'type' => 'button', 
                        'data-theme'=>"b"
                    )) ?>
                    </fieldset>
                    
                    <div  id="msg"></div>
                    
          <?= form_close() ?>
 
<script>

	$(function(){
		
		var password1 = document.getElementById('password');
		var password2 = document.getElementById('confirmation_password');
		
		var checkPasswordValidity = function() {
		    if (password1.value != password2.value) {
		        password1.setCustomValidity('<?= $this->lang->line('user_error_same_password') ?>');
		    } else {
		        password1.setCustomValidity('');
		    }        
		};
		
		password1.addEventListener('change', checkPasswordValidity, false);
		password2.addEventListener('change', checkPasswordValidity, false);
		
		var base_url = '<?=base_url()?>';
		//alert(base_url);
		$('#login').click(function() {
			window.location = base_url + 'users/login';		
		});
	
		$('#form_new_user').submit(function(){
			$('#msg').html('');
			$.mobile.loading( 'show');
				$.post( $('#form_new_user').attr('action'), $('#form_new_user').serialize(), function(json) {
				//alert(json.st);
				$('#msg').html('');
				$.mobile.loading( 'hide');
				if(json.st == 0)
					//$('#msg').html('<p class="ui-body-e" style="padding:1em;">'+json.msg+'</p>');
					$('#msg').html('<div class="alert alert-danger">'+json.msg+'</div>');
				else if(json.st == 2)
				   $('#msg').html(''+json.msg+'');
				else if(json.st == 1){
					//alert(json.msg);
					//$('#msg').html('<p class="ui-body-e ui-icon-check" style="padding:1em;">'+json.msg+'</p>');
					$('#msg').html('<div class="alert alert-success">'+json.msg+'</div>');
					setTimeout(function(){ window.location = base_url; }, 2000);
					
					//window.location = '../';
					}		
			}, "json")
			return false;

	});
	
	});
</script>