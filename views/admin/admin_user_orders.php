<?php require_once ROOT . "/views/header/header.php";  ?> 
<?php require_once ROOT . "/views/admin_menu/index.php";  ?> 				 
 
	<div class="admin_rigt">	 
	 <p class="adm_orders_search_title">Найти заказы пользователя с id:<?= $id_user ?>:</p> 
<form action="" id="adm_orders_form_filter" method="POST" class="admin_orders_form">
	<div class="admin_orders_form_row">
		<label   class="admin_orders_form_label">По номеру заказа:</label> 
		<input   type="text" name="adm_ord_search_num" 
		value="<?= isset($_POST['adm_ord_search_num'])&&!empty($_POST['adm_ord_search_num'])?trim($_POST['adm_ord_search_num']):'' ?>" class="admin_orders_form_input">
	</div>

	<div class="admin_orders_form_row">
		<label   class="admin_orders_form_label">По дате оформления:</label> 
		<input   type="text" name="adm_ord_search_date"
		value="<?= isset($_POST['adm_ord_search_date'])&&!empty($_POST['adm_ord_search_date'])?trim($_POST['adm_ord_search_date']):'' ?>"
		 placeholder="xxxx-xx-xx" class="admin_orders_form_input">
	</div>

<input type="hidden" name="admin_orders_form_submit">
<button type="submit" class="admin_orders_form_btn">Найти</button> 
</form>

 
<?php if (isset($orders) && !empty($orders)) : ?>

<?php foreach ($orders as $key => $order) : ?>

<div class="admin_one_order">
	<p class="admin_one_order_title">Заказ <span class="admin_one_order_title_num">№ <?= $order['id'] ?></span> 
		от <?= $order['date_add'] ?></p>
	<div class="admin_one_order_info">
		<div class="admin_one_order_info_left">
		<p class="adm_one_order_info_title">Информация о получателе:</p>
		<p class="adm_one_order_info_body"><?= $order['surname'] ?>  <?= $order['name'] ?>  <?= $order['patronymic'] ?></p>
		<p class="adm_one_order_info_body"><?= $order['mobile_number'] ?></p>
		<p class="adm_one_order_info_body"><?= $order['email'] ?></p>
		<p class="adm_one_order_info_title">Адрес доставки:</p>			 
		<p class="adm_one_order_info_body"><?= $order['city'] ?> <?= $order['region'] ?> обл.</p>
		<?php if (empty($order['post_office_number'])) : ?>
		<p class="adm_one_order_info_body"><?= $order['delivery_service'] ?>, <?= $order['delivery_method'] ?></p>
		<p class="adm_one_order_info_body">ул. <?= $order['street'] ?> дом <?= $order['house_number'] ?> кв. <?= $order['apartment_number'] ?></p>	
		<?php else: ?>
		<p class="adm_one_order_info_body"><?= $order['delivery_service'] ?>, <?= $order['delivery_method'] ?> № <?= $order['post_office_number'] ?></p>
	    <?php endif ?>
		<p class="adm_one_order_info_title">Оплата:</p>
		<p class="adm_one_order_info_body"><?= $order['checkout_payment'] ?></p>
		 
		</div> <!-- admin_one_order_info_left -->

		<div class="admin_one_order_info_rigt">
			<p class="adm_one_order_info_title">Информация о пользователе:</p>
			<p class="adm_one_order_info_body">id: <?= $order['id_user'] ?></p>
			<p class="adm_one_order_info_body"><?= $order['user']['surname'] ?> <?= $order['user']['name'] ?>
			 <?= $order['user']['patronymic'] ?></p>
			 <p class="adm_one_order_info_body"><?= $order['user']['date_of_birth'] ?></p>
			<p class="adm_one_order_info_body"><?= $order['user']['mobile_number'] ?></p>
			<p class="adm_one_order_info_body"><?= $order['user']['email'] ?></p>
			<p class="adm_one_order_info_body">Заблокирован: 
				<?php if (isset($order['user']['is_ban']) && $order['user']['is_ban']) {
					echo 'да';
				}else{
					echo 'нет';
				} ?>
			</p>
			<p class="adm_one_order_info_body">Администратор: 
				<?php if (isset($order['user']['admin']) && $order['user']['admin']
						 || isset($order['user']['super_admin']) && $order['user']['super_admin']) {
					echo 'да';
				}else{
					echo 'нет';
				} ?></p>
			
		</div> <!-- admin_one_order_info_rigt -->		

	</div> <!-- admin_one_order_info -->
	<?php if (!empty($order['comment'])) : ?>
	<p class="adm_one_order_info_title">Комментарий клиента к заказу:</p>
		<p class="adm_one_order_info_body"><?= $order['comment'] ?></p>
<?php endif ?>
<p class="adm_one_order_info_title">Товары:</p>
<ol class="admin_one_order_products">
	 <?php if (isset($order['PRODUCT']) && !empty($order['PRODUCT'])) : ?>
	 
	 	<?php for ($i=0; $i < count($order['PRODUCT']); $i++) : ?>
	 	 
	<li class="adm_one_order_prod_li">
			 <?= isset($order['PRODUCT'][$i]['name'])?$order['PRODUCT'][$i]['name']:'' ?> /
			 <?= isset($order['PRODUCT'][$i]['model'])?$order['PRODUCT'][$i]['model']:'' ?> /			 
			 <?= isset($order['PRODUCT'][$i]['code'])?$order['PRODUCT'][$i]['code']:'' ?> /
			 р. <?= isset($order['PRODUCT'][$i]['size'])?$order['PRODUCT'][$i]['size']:'' ?> /
			 <?= isset($order['PRODUCT'][$i]['count'])?$order['PRODUCT'][$i]['count']:'' ?> шт. /
			 <?= isset($order['PRODUCT'][$i]['price_one'])?$order['PRODUCT'][$i]['price_one']:'' ?> грн.  	
	</li>
 
<?php endfor ?>
<?php endif ?>
	 
	 
</ol>
<p class="adm_one_order_info_title">Итого:</p>
<p class="adm_one_order_info_body">количество товаров: <?= $order['quantity_products'] ?> на сумму: <?= $order['total_cost'] ?> грн.</p>

<p class="adm_one_order_info_title">Статус заказа:</p> 
<p class="<?= $order['id'] . '_cl' ?>  adm_one_order_info_body up_none   
<?php if (isset($order['date_update_status']) && !empty($order['date_update_status'])) {
echo 'up_active';
}?>"><a href="/admin/order/manager/<?= $order['id_manager_update_status'] ?>" target="_blank" class="<?= $order['id'] . '_s' ?>">изменен <span class="<?= $order['id'] . '_a' ?>"><?= $order['date_update_status'] ?></span></a></p> 

<form action="" id="<?= $order['id'] . '_st' ?>" method="POST" class="admin_orders_form_status" >
<div class="adm_orders_form_status_row">
<label for="" class="adm_orders_form_status_label">Статус заказа:</label>
<select name="adm_or_status_name" class="adm_orders_form_status_select">
	<?php foreach ($statuses as   $status) : ?>	 
	<option value="<?= $status['id'] ?>"   
	<?php if ($status['id']==$order['status_id'] ) {
		echo "selected";
	} ?>><?= $status['name'] ?></option>
	<?php endforeach ?>
</select>					
</div>

<div class="adm_orders_form_status_row">
<label for="" class="adm_orders_form_status_label">Комментарий менеджера:</label>	 
<textarea name="adm_or_status_comment" id="" class="adm_orders_form_status_input"><?php 
if (isset($order['manager_comment']) && !empty($order['manager_comment'])) {
		echo $order['manager_comment'];
	} ?>
</textarea>
</div> 
 
<input type="hidden" name="admin_orders_form_status_submit" value="<?= $order['id'] ?>"> 
<button type="button" class="admin_orders_form_status_btn" id="<?= $order['id'] ?>">Изменить</button> 
</form>				 
			 
</div> <!-- admin_one_order -->
<?php endforeach ?> 

<?php else: ?>
	<p class="adm_orders_empty">Пользователь не сделал ни одного заказа!</p>
<?php endif ?>	  
	 
	</div> <!-- admin_rigt -->											
	</div> <!-- admin_container -->			
	</div> <!-- content -->
	</div> <!-- wrap_admin -->

</main>


<?php require_once ROOT . "/views/footer/footer.php";  ?> 