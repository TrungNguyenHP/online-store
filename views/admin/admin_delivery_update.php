<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	 <h3 class="admin_info_up_title">Изменение информации об условиях доставки</h3>
	 <?php if (isset($success) && empty($error)) : ?>
		<p class="admin_insert_brand_success"><?= $success ?></p>
	<?php endif ?>

	<form action="" method="POST" enctype="multipart/form-data" class="admin_info_up_form">
		<div class="admin_info_up_form_row">
			<label for="" class="admin_info_up_form_label">Изображение:</label> 
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
 	        <input type="file" name="img" class="admin_info_up_form_input">			 
		</div>
		<div class="admin_info_update_wrap_imgs">
			<img src="/public/img_info/<?= $info['img'] ?>" alt="" class="admin_info_update_img">			 
		</div>

		<div class="admin_info_up_form_row">
			<label for="" class="admin_info_up_form_label">О компании:</label> 
			<textarea name="adm_delivery_txt" id=""   rows="25" class="admin_info_up_form_input"><?=
	isset($_POST['adm_delivery_txt'])?trim($_POST['adm_delivery_txt']):preg_replace('/(<br>){0,100}/iu','', $info['text']);
			 ?></textarea>
		</div>	 
 		 
		<input type="hidden" name="adm_delivery_up_submit">
 		<button type="submit" class="admin_info_up_btn">Сохранить изменения</button> 	
 	</form>	
 	<?php if (isset($error) && !empty($error)) :
			foreach ($error as $key => $value) :?>
			 <p class="registration_error"><?= $value ?></p>
			<?php endforeach;
	              endif; ?>	
	 
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 