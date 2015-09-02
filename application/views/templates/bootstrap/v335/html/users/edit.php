<h2><?= ($title) ?></h2>
<hr>
<div class="row">
    <?= validation_errors(
            '<div class="alert alert-danger alert-dismissable">', 
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>'
            ) ?>
    
  <div>
        <?= form_open(base_url('users/edit_user'), array('class' => 'form-horizontal', 'id' => 'form_edit_user', 'name' => 'frm', 'role' => 'form'), array('login' => 1)) ?>
        
                <div class="form-group">
                 <?= form_label($this->lang->line('cms_general_label_name'), 'name', array('class' => 'col-sm-3 control-label')) ?>
                  <div class="col-sm-8">
               	 <?= form_input(array(
                        'id' => 'name',
                        'name' => 'name',
                        'maxlength' => 150,
                        'placeholder' => $this->lang->line('cms_general_label_name'),
                         'class' => 'form-control',
                         'value' => $this->user->name
                      ), set_value('name'), 'required') ?>
                      </div>
               </div>
               <div class="form-group">
                  <?= form_label($this->lang->line('cms_general_label_email'), 'email', array('class' => 'col-sm-3 control-label')) ?>
                   <div class="col-sm-8">
               	 <?= form_input(array(
                        'id' => 'email',
                        'name' => 'email',
                        'type' => 'email',                        
                        'maxlength' => 150,                    
                        'placeholder' => $this->lang->line('cms_general_label_email'),
                        'class' => 'form-control',
                        'value' => $this->user->email
                      ), set_value('email'), 'required') ?>
                      </div>
               </div>
               <div class="form-group">       
                 <?= form_label($this->lang->line('cms_general_label_user'), 'user', array('class' => 'col-sm-3 control-label')) ?>     
                  <div class="col-sm-8">      
                    <?= form_input(array(
                        'id' => 'user',
                        'name' => 'user',
                        'maxlength' => 30,
                        'placeholder' => $this->lang->line('cms_general_label_user'),
                        'class' => 'form-control',
                        'value' => $this->user->user
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
                    ), '', '') ?>
                    </div>
               </div>
           	   <div class="form-group">     
                    <?= form_label($this->lang->line('cms_general_label_confirmation_password'), 'confirmation_password', array('class' => 'col-sm-3 control-label')) ?>
                     <div class="col-sm-8">
                    <?= form_password(array(
                        'id' => 'confirmation_password',
                        'name' => 'confirmation_password',
                        'maxlength' => 30,
                        'placeholder' => $this->lang->line('cms_general_label_confirmation_password'),
                        'class' => 'form-control'                     
                    ), '', '') ?>
                    </div>
       			</div>
       				<br />
       				
                <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">            
                    <?= form_button(array(
                    	'id' => 'registro',                    
                        'content' => '<span class="glyphicon glyphicon-check"></span> ' . $this->lang->line('cms_general_label_button_save'),
                        'type' => 'submit', 
                        'data-theme'=>"b",
                        'class' => 'btn btn-primary'
                    )) ?>
                    <?= form_button(array(
                    	'id' => 'home',
                        'content' => '<span class="glyphicon glyphicon-home"></span> ' . $this->lang->line('cms_general_label_button_home'),
                        'type' => 'button', 
                        'data-theme'=>"b",
                        'class' => 'btn btn-primary'
                    )) ?>
                    </div>
                   </div>
                    
                    
          <?= form_close() ?>
          </div>
       </div>
 <div  id="msg"></div>
                    
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
		$('#home').click(function() {
			window.location = base_url ;		
		});
	
		$('#form_edit_user').submit(function(){
			$('#msg').html('');
			//$.mobile.loading( 'show');
			$('#msg').html('<div class="alert alert-info"><?= $this->lang->line('cms_general_label_loading') ?></div>');
				$.post( $('#form_edit_user').attr('action'), $('#form_edit_user').serialize(), function(json) {
				//alert(json.st);
				$('#msg').html('');
				//$.mobile.loading( 'hide');
				if(json.st == 0)
					//$('#msg').html('<p class="ui-body-e" style="padding:1em;">'+json.msg+'</p>');
					$('#msg').html('<div class="alert alert-danger">'+json.msg+'</div>');
				else if(json.st == 2)
				   $('#msg').html(''+json.msg+'');
				else if(json.st == 1){
					//alert(json.msg);
					//$('#msg').html('<p class="ui-body-e ui-icon-check" style="padding:1em;">'+json.msg+'</p>');
					$('#msg').html('<div class="alert alert-success">'+json.msg+'</div>');
					//setTimeout(function(){ window.location = base_url; }, 2000);
					
					//window.location = '../';
					}		
			}, "json")
			return false;

	});
	
	});
</script>