<table class="ocpsw_head container">
	<tr>
		<td style="width: 60%;">
			<?php
            	echo '<h1>'.get_option( 'ocpsw_shop_title', 'My Shop' ).'</h1>';
            ?>
		</td>
		<td style="width: 40%;">
			<?php
			$ocpsw_shop_title = get_option( 'ocpsw_shop_title', 'My Shop' );
			$ocpsw_shop_addr = get_option( 'ocpsw_shop_addr' );
			$ocpsw_shop_addr = wpautop($ocpsw_shop_addr);
			?>
			<h2 class="ocpsw_shop_title"><?php echo $ocpsw_shop_title; ?></h2>
			<div class="ocpsw_shop_addr">
				<?php echo $ocpsw_shop_addr; ?>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<h2 class="ocpsw_page_label"><?php echo $pdf_page_label; ?></h2>
		</td>
	</tr>
</table>

<table class="ocpsw_address_data container">
	<tr>
		<td class="ocpsw_shipping_address" style="width: 30%;">
			<?php
				echo $order->get_formatted_shipping_address();

				$ocpsw_pkg_dis_email = get_option( 'ocpsw_pkg_dis_email', 'disable' );
				$ocpsw_pkg_dis_phone = get_option( 'ocpsw_pkg_dis_phone', 'disable' );

				if($ocpsw_pkg_dis_email == 'enable') {
					?>
					<div class="ocpsw_billing_email">
						<?php echo $order->get_billing_email(); ?>
					</div>
					<?php
				}

				if($ocpsw_pkg_dis_phone == 'enable') {
					?>
					<div class="ocpsw_billing_phone">
						<?php echo $order->get_billing_phone(); ?>
					</div>
					<?php
				}
			?>

		</td>
		<?php
			$ocpsw_pkg_dis_bil = get_option( 'ocpsw_pkg_dis_bil', 'enable' );
			if($ocpsw_pkg_dis_bil == 'enable' && !empty($order->get_formatted_billing_address())) {
				?>
				<td class="ocpsw_billing_address" style="width: 30%;">
					<h3><?php _e('Billing Address:', OCPSW_DOMAIN ); ?></h3>
					<?php echo $order->get_formatted_billing_address(); ?>
				</td>
				<?php
			} else {
				?>
				<td style="width: 30%;"></td>
				<?php
			}
		?>
		<td class="ocpsw_order_data" style="width: 40%;">
			<table>
				<tbody>
					<tr>
						<th>
							<?php _e('Order Number:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
						</th>
						<td><?php echo $order->get_order_number(); ?></td>
					</tr>
					<tr>
						<th>
							<?php _e('Order Date:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
						</th>
						<td><?php echo $order->get_date_created()->format ('F j, Y'); ?></td>
					</tr>
					<tr>
						<th>
							<?php _e('Shipping Method:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
						</th>
						<td><?php  echo $order->get_shipping_method(); ?></td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</table>

<table class="ocpsw_order_details container">
	<thead>
		<tr>
			<?php
			$ocpsw_ordtbl_head_bg_color = get_option( 'ocpsw_ordtbl_head_bg_color', '#000' );
			$ocpsw_ordtbl_head_color = get_option( 'ocpsw_ordtbl_head_color', '#fff' );
			?>
			<th class="ocpsw_product" style="background-color: <?php echo $ocpsw_ordtbl_head_bg_color; ?>; color: <?php echo $ocpsw_ordtbl_head_color; ?>;"><?php _e('Product', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></th>
			<th class="ocpsw_quantity" style="background-color: <?php echo $ocpsw_ordtbl_head_bg_color; ?>; color: <?php echo $ocpsw_ordtbl_head_color; ?>;"><?php _e('Quantity', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$order_items = $order->get_items();
		
		if( sizeof( $order_items ) > 0 ) {
			foreach ($order_items as $item) {
				$product = wc_get_product($item->get_product_id());
    			$item_sku = $product->get_sku();

    			$allmeta = $item->get_meta_data();
		?>
		<tr>
			<td class="ocpsw_product">
				<span class="ocpsw_item_name"><?php echo $item['name']; ?></span>
				<span class="ocpsw_item_meta"><?php echo $item['meta']; ?></span>
				<dl class="ocpsw_meta">
					<?php
					if(!empty( $item_sku)) {
						?>
						<dt class="ocpsw_sku"><?php _e( 'SKU:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
						</dt>
						<dd class="ocpsw_sku"><?php echo $item_sku; ?></dd>
						<?php
					}

					if( !empty( $item['weight'] ) ) {
						?>
						<dt class="ocpsw_weight">
							<?php _e( 'Weight:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
						</dt>
						<dd class="ocpsw_weight"><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?>
						</dd>
						<?php
					}
					?>
				</dl>
			</td>

			<td>
				<?php echo  $product = $item['qty'];?>
			</td>
		</tr>
		<?php
			}
		}

		?>
	</tbody>
	<tfoot>
		<tr>
			<td style="width: 60%;">
				<?php
				$ocpsw_pkg_dis_cnotes = get_option( 'ocpsw_pkg_dis_cnotes', 'disable' );
				$ocpsw_customer_note = $order->get_customer_note();

				if($ocpsw_pkg_dis_cnotes == 'enable' && $ocpsw_customer_note != '') {
					?>
					<div class="ocpsw_customer_notice">
						<h3><?php _e( 'Customer Notes', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></h3>
						<?php echo wpautop($ocpsw_customer_note); ?>
					</div>
					<?php
				}
				?>
			</td>
			<td style="width: 40%;">
			</td>
		</tr>
	</tfoot>
</table>

<div id="ocpsw_footer">
	<?php
	$ocpsw_footer_text = get_option( 'ocpsw_footer_text' );
	
	if($ocpsw_footer_text != '') {
		echo wpautop($ocpsw_footer_text);
	}

	?>
</div>