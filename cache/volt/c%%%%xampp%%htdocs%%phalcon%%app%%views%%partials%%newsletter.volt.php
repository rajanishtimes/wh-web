<?php echo $this->tag->form(array('index/newsletter', 'id' => 'searchForm', 'onbeforesubmit' => 'return false')); ?>
	<div class="input-group subscribe">
		<?php echo $newsletterform->render('email', array('class' => 'form-control', 'id' => 'newslettertextinput', 'placeholder' => 'Your email address')); ?>
		<span class="input-group-btn">
			<button class="btn btn-primary" type="button">SIGN UP</button>
		</span>
	</div>
</form>