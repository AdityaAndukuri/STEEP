<?php  if (count($errors_fac) > 0) : ?>
  <div class="error">
  	<?php foreach ($errors_fac as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>