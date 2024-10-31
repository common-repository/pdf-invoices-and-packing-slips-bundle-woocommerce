<?php
if (!defined('ABSPATH'))
exit;

use Dompdf\Dompdf as Dompdf;

if (!class_exists('OCPSW_backend')) {

  	class OCPSW_backend {

    	protected static $instance;

	    function OCPSW_submenu_page() {
	    	add_menu_page( 'PDF Packing Slip', 'PDF Packing Slip', 'manage_options', 'pdf-packing-slip',array($this, 'OCPSW_callback'),'dashicons-media-archive');
	    }


	    function OCPSW_callback() {
	     ?>
			<div class="wrap">
				<div class="ocpsw_ratesup_notice_main">
	                <div class="ocpsw_rateus_notice">
	                    <div class="ocpsw_rtusnoti_left">
	                        <h3><?php echo __( 'Rate Us', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></h3>
	                        <label><?php echo __( 'If you like our plugin, ', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
	                        <a target="_blank" href="https://wordpress.org/support/plugin/pdf-invoices-and-packing-slips-bundle-woocommerce/reviews/?filter=5">
	                            <label><?php echo __( 'Please vote us', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
	                        </a>
	                        <label><?php echo __( ', so we can contribute more features for you.', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
	                    </div>
	                    <div class="ocpsw_rtusnoti_right">
	                        <img src="<?php echo OCPSW_PLUGIN_DIR; ?>/images/review.png" class="ocpsw_review_icon">
	                    </div>
	                </div>
	                <div class="ocpsw_support_notice">
	                    <div class="ocpsw_rtusnoti_left">
	                        <h3><?php echo __( 'Having Issues?', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></h3>
	                        <label><?php echo __( 'You can contact us at', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
	                        <a target="_blank" href="https://oceanwebguru.com/contact-us/">
	                            <label><?php echo __( 'Our Support Forum', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
	                        </a>
	                    </div>
	                    <div class="ocpsw_rtusnoti_right">
	                        <img src="<?php echo OCPSW_PLUGIN_DIR; ?>/images/support.png" class="ocpsw_review_icon">
	                    </div>
	                </div>
	            </div>
	            <div class="ocpsw_donate_main">
	               <img src="<?php echo OCPSW_PLUGIN_DIR; ?>/images/coffee.svg">
	               <h3><?php echo __( 'Buy me a Coffee !', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></h3>
	               <p><?php echo __( 'If you like this plugin, buy me a coffee and help support this plugin !', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></p>
	               <div class="ocpsw_donate_form">
	                  <a class="button button-primary ocpsw_donate_btn" href="https://www.paypal.com/paypalme/shayona163/" data-link="https://www.paypal.com/paypalme/shayona163/" target="_blank"><?php echo __( 'Buy me a coffee !', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></a>
	               </div>
	            </div>
				<div class="ocpsw-container">
					<form method="post">
					   <?php wp_nonce_field( 'ocpsw_nonce_action', 'ocpsw_nonce_field' ); ?>
					        <div class="cover_div_ocpsw">
					        	<ul class="ocpsw-tabs">
		                            <li class="ocpsw-tab-link ocpsw-current" data-tab="ocpsw-tab-general">
		                                <?php echo __( 'General Settings', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
		                            </li>
		                            <li class="ocpsw-tab-link" data-tab="ocpsw-tab-invoice">
		                                <?php echo __( 'Invoice Settings', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
		                            </li>
		                            <li class="ocpsw-tab-link" data-tab="ocpsw-tab-packaging">
		                                <?php echo __( 'Packaging Slip Settings', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
		                            </li>
		                        </ul>

		                        <div id="ocpsw-tab-general" class="ocpsw-tab-content ocpsw-current">
	                            	<h3 class="ocpsw-head"><?php echo __( 'General Settings', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></h3>
	                            	<table class="form-table ocpsw_data_table">
						              	<tbody>
							              	<tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'How do you want to view the PDF?', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <?php $ocpsw_pdf_view = get_option( 'ocpsw_pdf_view', 'open_in_new_window' ); ?>
							                        <select name="ocpsw_pdf_view" class="regular-text">
							                          <option value="open_in_new_window" <?php if($ocpsw_pdf_view == 'open_in_new_window') { echo 'selected'; } ?>><?php echo __( 'Open in New Window', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                          <option value="open_in_current_window" <?php if($ocpsw_pdf_view == 'open_in_current_window') { echo 'selected'; } ?>><?php echo __( 'Open in Current Window', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                          <option value="download" <?php if($ocpsw_pdf_view == 'download') { echo 'selected'; } ?>><?php echo __( 'Download', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                        </select>
							                    </td>
							                </tr>
							              	<tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Choose Template', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <?php
							                        $ocpsw_template_pos = get_option( 'ocpsw_template_pos', 'wp-content/plugins/pdf-invoices-and-packing-slips-bundle-woocommerce/templates/Template 1' );

							                        $custom_template_dir = get_stylesheet_directory() . "/woocommerce/pdf/";

													if ( defined('WP_CONTENT_DIR') && strpos( WP_CONTENT_DIR, ABSPATH ) !== false ) {
													  $forwardslash_basepath = str_replace('\\','/', ABSPATH);
													} else {
													  $forwardslash_basepath = str_replace('\\','/', WP_CONTENT_DIR);
													}

													$forwardslash_dir = str_replace('\\','/', $custom_template_dir);
													$custom_template_dir_path = str_replace( $forwardslash_basepath, '', $forwardslash_dir );


							                        ?>
							                        <select name="ocpsw_template_pos" class="regular-text">
							                          <?php
							                          $OCPSW_get_pdf_templates = $this->OCPSW_get_pdf_templates();
							                          foreach ($OCPSW_get_pdf_templates as $key => $value) {
							                            ?>
							                            <option value="<?php echo $key; ?>" <?php if($ocpsw_template_pos == $key) { echo 'selected'; } ?>><?php echo $value; ?></option>
							                            <?php
							                          }
							                          ?>
							                        </select>
							                        <p class="ocpsw_desc"><?php echo __( 'If you want to customize template, you can copy all files from wp-content/plugins/pdf-invoices-and-packing-slips-bundle-woocommerce/templates/Template 1 to your active theme in '.$custom_template_dir_path. ' customtemplate and customize them', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></p>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Paper Size', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <select name="ocpsw_paper_size" class="regular-text">
							                          <option value="A4" selected><?php echo __( 'A4', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                          <option value="A5" disabled><?php echo __( 'A5    Only available in pro version', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                          <option value="Letter" disabled><?php echo __( 'Letter    Only available in pro version', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                        </select>
							                        <label class="ocpsw_pro_link"><?php echo __( 'Only available in pro version ', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?><a href="https://oceanwebguru.com/shop/pdf-invoices-and-packing-slips-bundle-woocommerce-pro/" target="_blank"><?php echo __( 'link', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?></a></label>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Shop Name', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <?php $ocpsw_shop_title = get_option( 'ocpsw_shop_title', 'My Shop' ); ?>
							                        <input type="text" class="regular-text" name="ocpsw_shop_title" value="<?php echo $ocpsw_shop_title; ?>">
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Shop Address', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <?php $ocpsw_shop_addr = get_option( 'ocpsw_shop_addr' ); ?>
							                        <textarea name="ocpsw_shop_addr" class="regular-text" rows="5" cols="40"><?php echo $ocpsw_shop_addr; ?></textarea>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Shop Header/Logo', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text ocpsw_imgup_td">
							                          <div class="ocpsw_upload_image_main">
							                            <a href="#" class="ocpsw_upload_image_button button" disabled><?php echo __( 'Set Image', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></a>
							                            <label class="ocpsw_pro_link"><?php echo __( 'Only available in pro version ', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?><a href="https://oceanwebguru.com/shop/pdf-invoices-and-packing-slips-bundle-woocommerce-pro/" target="_blank"><?php echo __( 'link', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?></a></label>
							                          </div>
							                          <p class="ocpsw_desc"><?php echo __( '(preffered logo size 220px x 40px, please use jpeg or jpg image for best pdf generation.)', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></p>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Header Logo/Image Height', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <input type="number" class="regular-text" name="ocpsw_shop_header_logo_height" value="" min="1" disabled>
							                        <label class="ocpsw_pro_link"><?php echo __( 'Only available in pro version ', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?><a href="https://oceanwebguru.com/shop/pdf-invoices-and-packing-slips-bundle-woocommerce-pro/" target="_blank"><?php echo __( 'link', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?></a></label>
							                        <p class="ocpsw_desc"><?php echo __( '(height is in mm, ex. 10)', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></p>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Footer Text', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <?php $ocpsw_footer_text = get_option( 'ocpsw_footer_text', 'Terms & Conditions Apply' ); ?>
							                        <textarea name="ocpsw_footer_text" class="regular-text" rows="4" cols="50"><?php echo $ocpsw_footer_text; ?></textarea>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Order Table Head Background Color', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <?php $ocpsw_ordtbl_head_bg_color = get_option( 'ocpsw_ordtbl_head_bg_color', '#000' ); ?>
							                        <input type="text" name="ocpsw_ordtbl_head_bg_color" class="ocpsw_colorpicker" value="<?php echo $ocpsw_ordtbl_head_bg_color; ?>">
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Order Table Head Text Color', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                        <?php $ocpsw_ordtbl_head_color = get_option( 'ocpsw_ordtbl_head_color', '#fff' ); ?>
							                        <input type="text" name="ocpsw_ordtbl_head_color" class="ocpsw_colorpicker" value="<?php echo $ocpsw_ordtbl_head_color; ?>">
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Enable Automatic Cleanup', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <input type="checkbox" name="ocpsw_atmclnup_enable" value="enable" disabled>
							                      <?php echo __( 'every', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
							                      <input type="number" class="regular-text" name="ocpsw_atmclnup_days" value="" disabled> 
							                      <?php echo __( 'days', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?>
							                      <label class="ocpsw_pro_link"><?php echo __( 'Only available in pro version ', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?><a href="https://oceanwebguru.com/shop/pdf-invoices-and-packing-slips-bundle-woocommerce-pro/" target="_blank"><?php echo __( 'link', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?></a></label>
							                      <p class="ocpsw_desc"><?php echo __( 'Automatically clean up PDF files saved in plugin folder which used for email attachments.', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></p>
							                    </td>
							                </tr>
						            	</tbody>
					            	</table>
	                        	</div>

	                        	<div id="ocpsw-tab-invoice" class="ocpsw-tab-content">
	                            	<h3 class="ocpsw-head"><?php echo __( 'Invoice Settings', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></h3>
	                            	<table class="form-table ocpsw_data_table">
						              	<tbody>
							              	<tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Enable Invoice', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_invoice_enable = get_option( 'ocpsw_invoice_enable', 'enable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_invoice_enable" value="enable" <?php if($ocpsw_invoice_enable == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Attach to Email:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      	<select id="ocpsw_atch_to_email" name="ocpsw_atch_to_email[]" multiple="multiple" style="width:60%;" disabled>
							                      		<option value="new_order" selected="selected">New order (Admin email)</option><option value="customer_processing_order" selected="selected">Processing order</option>
							                      	</select>
							                      	<label class="ocpsw_pro_link"><?php echo __( 'Only available in pro version ', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?><a href="https://oceanwebguru.com/shop/pdf-invoices-and-packing-slips-bundle-woocommerce-pro/" target="_blank"><?php echo __( 'link', 'pdf-invoices-and-packing-slips-bundle-woocommerce' );?></a></label>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Disable Attachment for Order Status:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_disbl_atch_for_ord_status = get_option( 'ocpsw_disbl_atch_for_ord_status' );

							                      $wc_get_order_statuses = wc_get_order_statuses();
							                      ?>
							                      <p class="ocpsw-select2-p">
							                      	<select id="ocpsw_disbl_atch_for_ord_status" name="ocpsw_disbl_atch_for_ord_status[]" multiple="multiple" style="width:99%;max-width:25em;">
							                      		<?php
							                      		if( !empty($ocpsw_disbl_atch_for_ord_status) ) {
											                foreach( $ocpsw_disbl_atch_for_ord_status as $key => $status ) {
											                	$label = $wc_get_order_statuses[$status];
											                    echo '<option value="' . $status . '" selected="selected">' . $label . '</option>';
											                }
											            }
							                      		?>
							                      	</select>
							                      </p>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Shipping Address:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_invce_dis_ship = get_option( 'ocpsw_invce_dis_ship', 'enable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_invce_dis_ship" value="enable" <?php if($ocpsw_invce_dis_ship == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Email Address:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_invce_dis_email = get_option( 'ocpsw_invce_dis_email', 'disable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_invce_dis_email" value="enable" <?php if($ocpsw_invce_dis_email == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Phone Number:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_invce_dis_phone = get_option( 'ocpsw_invce_dis_phone', 'disable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_invce_dis_phone" value="enable" <?php if($ocpsw_invce_dis_phone == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Customer Notes:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_invce_dis_cnotes = get_option( 'ocpsw_invce_dis_cnotes', 'disable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_invce_dis_cnotes" value="enable" <?php if($ocpsw_invce_dis_cnotes == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Invoice Number:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_invce_dis_invc_num = get_option( 'ocpsw_invce_dis_invc_num', 'no' );
							                      ?>
							                      <select name="ocpsw_invce_dis_invc_num" class="regular-text">
							                      	<option value="no" <?php if($ocpsw_invce_dis_invc_num == 'no') { echo 'selected'; } ?>><?php echo __( 'No', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                      	<option value="invoice_num" <?php if($ocpsw_invce_dis_invc_num == 'invoice_num') { echo 'selected'; } ?>><?php echo __( 'Invoice Number', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                      	<option value="order_num" <?php if($ocpsw_invce_dis_invc_num == 'order_num') { echo 'selected'; } ?>><?php echo __( 'Order Number', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                      </select>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Invoice Date:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_invce_dis_invc_date = get_option( 'ocpsw_invce_dis_invc_date', 'no' );
							                      ?>
							                      <select name="ocpsw_invce_dis_invc_date" class="regular-text">
							                      	<option value="no" <?php if($ocpsw_invce_dis_invc_date == 'no') { echo 'selected'; } ?>><?php echo __( 'No', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                      	<option value="invoice_date" <?php if($ocpsw_invce_dis_invc_date == 'invoice_date') { echo 'selected'; } ?>><?php echo __( 'Invoice Date', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                      	<option value="order_date" <?php if($ocpsw_invce_dis_invc_date == 'order_date') { echo 'selected'; } ?>><?php echo __( 'Order Date', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></option>
							                      </select>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Enable Invoice Download Button (Customer - My Account Page):', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_invce_dwn_cust_my_acc = get_option( 'ocpsw_invce_dwn_cust_my_acc', 'enable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_invce_dwn_cust_my_acc" value="enable" <?php if($ocpsw_invce_dwn_cust_my_acc == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							            </tbody>
							        </table>
							    </div>

							    <div id="ocpsw-tab-packaging" class="ocpsw-tab-content">
	                            	<h3 class="ocpsw-head"><?php echo __( 'Packaging Settings', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></h3>
	                            	<table class="form-table ocpsw_data_table">
						              	<tbody>
							              	<tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Enable Packaging', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_packaging_enable = get_option( 'ocpsw_packaging_enable', 'enable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_packaging_enable" value="enable" <?php if($ocpsw_packaging_enable == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Billing Address:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_pkg_dis_bil = get_option( 'ocpsw_pkg_dis_bil', 'enable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_pkg_dis_bil" value="enable" <?php if($ocpsw_pkg_dis_bil == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Email Address:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_pkg_dis_email = get_option( 'ocpsw_pkg_dis_email', 'disable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_pkg_dis_email" value="enable" <?php if($ocpsw_pkg_dis_email == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Phone Number:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_pkg_dis_phone = get_option( 'ocpsw_pkg_dis_phone', 'disable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_pkg_dis_phone" value="enable" <?php if($ocpsw_pkg_dis_phone == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							                <tr valign="top">
							                    <th scope="row">
							                        <label><?php echo __( 'Display Customer Note:', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ); ?></label>
							                    </th>
							                    <td class="forminp forminp-text">
							                      <?php
							                      $ocpsw_pkg_dis_cnotes = get_option( 'ocpsw_pkg_dis_cnotes', 'disable' );
							                      ?>
							                      <input type="checkbox" name="ocpsw_pkg_dis_cnotes" value="enable" <?php if($ocpsw_pkg_dis_cnotes == 'enable') { echo 'checked'; } ?>>
							                    </td>
							                </tr>
							            </tbody>
							        </table>
							    </div>

					        </div>            
					    <input type="hidden" name="action" value="ocpsw_save_option">
					    <input type="submit" value="Save changes" name="submit" class="button-primary" id="wfc-btn-space">
					</form>
				</div>
			</div>
			<?php
	    }


	    function OCPSW_add_order_actions_pdf_button( $order ) {

		    $ocpsw_invoice_enable = get_option( 'ocpsw_invoice_enable', 'enable' );

		    if($ocpsw_invoice_enable == 'enable') {

		        $invoice_nonce = wp_create_nonce('ocpsw-woo-invoice-pdf');

		        // Prepare the button data
		        $woo_pdf_invoice_url = admin_url().'?action=woo_pdf_invoice&order_id='.$order->get_id().'&_wpnonce='.$invoice_nonce;
		        $woo_pdf_invoice_url = esc_url($woo_pdf_invoice_url);
		        $woo_pdf_invoice_name = esc_attr( __('PDF Invoice', 'woocommerce' ) );
		        $woo_pdf_invoice_action = esc_attr( 'view ocpsw-pdf-invoice-btn' ); // keep "view" class for a clean button CSS

		        // Set the action button
		        printf( '<a class="button tips %s" href="%s" data-tip="%s" target="_blank">%s</a>', $woo_pdf_invoice_action, $woo_pdf_invoice_url, $woo_pdf_invoice_name, $woo_pdf_invoice_name );
		    }

		    $ocpsw_packaging_enable = get_option( 'ocpsw_packaging_enable', 'enable' );

	    	if($ocpsw_packaging_enable == 'enable') {

		        $nonce = wp_create_nonce('ocpsw-woo-pdf');

		        // Prepare the button data
		        $woo_pdf_packaging_url = admin_url().'?action=woo_pdf&order_id='.$order->get_id().'&_wpnonce='.$nonce;
		        $woo_pdf_packaging_url = esc_url($woo_pdf_packaging_url);
		        $woo_pdf_packaging_name   = esc_attr( __('Packaging Slip', 'woocommerce' ) );
		        $woo_pdf_packaging_action = esc_attr( 'view ocpsw-pckg-slip-btn' ); // keep "view" class for a clean button CSS

		        // Set the action button
		        printf( '<a class="button tips %s" href="%s" data-tip="%s" target="_blank">%s</a>', $woo_pdf_packaging_action, $woo_pdf_packaging_url, $woo_pdf_packaging_name, $woo_pdf_packaging_name );
		    }
	    }

    
	    function OCPSW_add_order_actions_pdf_button_css() {

			$packing_slip_icon = OCPSW_PLUGIN_DIR .'/images/pdf.png';
			$pdf_invoice_icon = OCPSW_PLUGIN_DIR .'/images/bill.png';

			echo '<style>.view.ocpsw-pckg-slip-btn::after { background: url('. $packing_slip_icon.'); content: "" !important; background-repeat:no-repeat;background-position: center center; } .view.ocpsw-pdf-invoice-btn::after { background: url('. $pdf_invoice_icon.'); content: "" !important; background-repeat:no-repeat;background-position: center center; }</style>';
	    }


	    function OCPSW_me_post_pdf() {

			if(isset($_REQUEST['order_id'])) {
				$ocpsw_order_id = sanitize_text_field($_REQUEST['order_id']);
				$order = wc_get_order($ocpsw_order_id);
			}
	   
	      	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "woo_pdf") {

		        if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'ocpsw-woo-pdf' ) ) {

					include_once(plugin_dir_path( __FILE__ ).'dompdf/autoload.inc.php');

					ob_start();

					$ocpsw_template_pos = get_option( 'ocpsw_template_pos', 'wp-content/plugins/pdf-invoices-and-packing-slips-bundle-woocommerce/templates/Template 1' );
					
					$wp_root_path = str_replace('wp-content/themes', '', get_theme_root());
					$template_path = $wp_root_path.$ocpsw_template_pos.'/html-wrapper.php';
			        $pdf_page_title = 'PDF Packaging';
			        $pdf_page_label = 'Packing Slip';
			        $pdf_body_class = 'ocpsw-packaging';
			        $pdf_content_path = $wp_root_path.$ocpsw_template_pos.'/packaging-slip.php';
			        $style_path = $wp_root_path.$ocpsw_template_pos.'/style.css';

			        include($template_path);

					$html = ob_get_clean();

					$ocpsw_paper_size = 'A4';
					$ocpsw_pdf_view = get_option( 'ocpsw_pdf_view', 'open_in_new_window' );

					if($ocpsw_pdf_view == 'open_in_new_window' || $ocpsw_pdf_view == 'open_in_current_window') {
						$ocpsw_pdf_download = false;
					} else {
						$ocpsw_pdf_download = true;
					}
					
					$dompdf = new Dompdf();
					$options = $dompdf->getOptions(); 
				    $options->set(array('isRemoteEnabled' => true));
				    $dompdf->setOptions($options);
					$dompdf->loadHtml($html);
					$dompdf->setPaper($ocpsw_paper_size, 'portrait');
					$dompdf->render();
					$dompdf->stream( 'Packaging-Slip-'.$ocpsw_order_id.'.pdf', array("Attachment" => $ocpsw_pdf_download));
					exit();
		        } else {
			        print 'Sorry, your nonce did not verify. It is a secure WordPress site. go get a coffee !!';
			        exit;
		        }
	      	}
	    }
        

	    function OCPSW_me_post_pdf_invoice() {
	       
		    if(isset($_REQUEST['order_id'])) {
		    	$ocpsw_order_id = sanitize_text_field($_REQUEST['order_id']);
				$order = wc_get_order($ocpsw_order_id);
		    }
	   
	      	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "woo_pdf_invoice") {

		      	if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'ocpsw-woo-invoice-pdf' ) ) {

			        include_once(plugin_dir_path( __FILE__ ).'dompdf/autoload.inc.php');
			        
			        ob_start();
			          
			        $ocpsw_template_pos = get_option( 'ocpsw_template_pos', 'wp-content/plugins/pdf-invoices-and-packing-slips-bundle-woocommerce/templates/Template 1' );
			        $wp_root_path = str_replace('wp-content/themes', '', get_theme_root());
			        $template_path = $wp_root_path.$ocpsw_template_pos.'/html-wrapper.php';
			        $pdf_page_title = 'PDF Invoice';
			        $pdf_page_label = 'Invoice';
			        $pdf_body_class = 'ocpsw-invoice';
			        $pdf_content_path = $wp_root_path.$ocpsw_template_pos.'/invoice.php';
			        $style_path = $wp_root_path.$ocpsw_template_pos.'/style.css';

			        include($template_path);

			        $html=ob_get_clean();

			        $ocpsw_pdf_view = get_option( 'ocpsw_pdf_view', 'open_in_new_window' );

					if($ocpsw_pdf_view == 'open_in_new_window' || $ocpsw_pdf_view == 'open_in_current_window') {
						$ocpsw_pdf_download = false;
					} else {
						$ocpsw_pdf_download = true;
					}

					$ocpsw_paper_size = 'A4';

			        $dompdf = new Dompdf();
			        $options = $dompdf->getOptions(); 
				    $options->set(array('isRemoteEnabled' => true));
				    $dompdf->setOptions($options);
			        $dompdf->loadHtml($html);
			        $dompdf->setPaper($ocpsw_paper_size, 'portrait');
			        $dompdf->render();

			        $dompdf->stream( 'Invoice-'.$ocpsw_order_id.'.pdf', array("Attachment" => $ocpsw_pdf_download));

			        exit();
			    } else {
					print 'Sorry, your nonce did not verify. It is a secure WordPress site. go get a coffee !!';
					exit;
		        }
	        }
	    }


	    function OCPSW_downloads_bulk_actions_edit_product( $actions ) {

	    	$ocpsw_invoice_enable = get_option( 'ocpsw_invoice_enable', 'enable' );

	    	if($ocpsw_invoice_enable == 'enable') {
	    		$actions['bulk_invoice_slip'] = __( 'PDF Invoice', 'woocommerce' );
	    	}

	    	$ocpsw_packaging_enable = get_option( 'ocpsw_packaging_enable', 'enable' );

	    	if($ocpsw_packaging_enable == 'enable') {
	    		$actions['bulk_packing_slip'] = __( 'PDF Packing Slip', 'woocommerce' );
	    	}

			return $actions;
	    }


    	function OCPSW_downloads_handle_bulk_action_edit_shop_order( $redirect_to, $action, $post_ids ) {
	        if ( $action !== 'bulk_packing_slip' ) {
	       		return $redirect_to;
         	}
       		
       		include_once(plugin_dir_path( __FILE__ ).'dompdf/autoload.inc.php');

       		$final_pdf_html = '';

     		if(!empty($post_ids)) {
	       		foreach ( $post_ids as $post_id ) {
	                $order = wc_get_order( $post_id );
	                $order_data = $order->get_data();

	                ob_start();

	                $ocpsw_template_pos = get_option( 'ocpsw_template_pos', 'wp-content/plugins/pdf-invoices-and-packing-slips-bundle-woocommerce/templates/Template 1' );
					$wp_root_path = str_replace('wp-content/themes', '', get_theme_root());
					$template_path = $wp_root_path.$ocpsw_template_pos.'/html-wrapper.php';
			        $pdf_page_title = 'PDF Packaging';
			        $pdf_page_label = 'Packing Slip';
			        $pdf_body_class = 'ocpsw-packaging';
			        $pdf_content_path = $wp_root_path.$ocpsw_template_pos.'/packaging-slip.php';
			        $style_path = $wp_root_path.$ocpsw_template_pos.'/style.css';

			        echo '<div class="ocpsw-bulk-page">';
			        include($template_path);
			        echo '</div>';

					$final_pdf_html .= ob_get_clean();
            	}
            }

            $ocpsw_paper_size = 'A4';
			$ocpsw_pdf_view = get_option( 'ocpsw_pdf_view', 'open_in_new_window' );

			if($ocpsw_pdf_view == 'open_in_new_window'  || $ocpsw_pdf_view == 'open_in_current_window') {
				$ocpsw_pdf_download = false;
			} else {
				$ocpsw_pdf_download = true;
			}
			
			$pdf_name = 'bulk-packing-slips-'.current_time('dmY_Hi').'.pdf';

			$dompdf = new Dompdf();
			$options = $dompdf->getOptions(); 
		    $options->set(array('isRemoteEnabled' => true));
		    $dompdf->setOptions($options);
			$dompdf->loadHtml($final_pdf_html);
			$dompdf->setPaper($ocpsw_paper_size, 'portrait');
			$dompdf->render();
			$dompdf->stream( $pdf_name, array("Attachment" => $ocpsw_pdf_download));
			exit();
    	}


	    function OCPSW_downloads_handle_bulk_action_edit_shop_order_invoice( $redirect_to, $action, $post_ids ) {
	        if ( $action !== 'bulk_invoice_slip' ) {
	            return $redirect_to;
	        }

	        include_once(plugin_dir_path( __FILE__ ).'dompdf/autoload.inc.php');

	        $final_pdf_html = '';

	        if(!empty($post_ids)) {
	       		foreach ( $post_ids as $post_id ) {
	                $order = wc_get_order( $post_id );
	                $order_data = $order->get_data();

	                ob_start();

	                $ocpsw_template_pos = get_option( 'ocpsw_template_pos', 'wp-content/plugins/pdf-invoices-and-packing-slips-bundle-woocommerce/templates/Template 1' );
					$wp_root_path = str_replace('wp-content/themes', '', get_theme_root());
					$template_path = $wp_root_path.$ocpsw_template_pos.'/html-wrapper.php';
			        $pdf_page_title = 'PDF Invoice';
			        $pdf_page_label = 'Invoice';
			        $pdf_body_class = 'ocpsw-invoice';
			        $pdf_content_path = $wp_root_path.$ocpsw_template_pos.'/invoice.php';
			        $style_path = $wp_root_path.$ocpsw_template_pos.'/style.css';

			        echo '<div class="ocpsw-bulk-page">';
			        include($template_path);
			        echo '</div>';
					$final_pdf_html .= ob_get_clean();
            	}
            }

            $ocpsw_paper_size = 'A4';
			$ocpsw_pdf_view = get_option( 'ocpsw_pdf_view', 'open_in_new_window' );

			if($ocpsw_pdf_view == 'open_in_new_window'  || $ocpsw_pdf_view == 'open_in_current_window') {
				$ocpsw_pdf_download = false;
			} else {
				$ocpsw_pdf_download = true;
			}
			
			$pdf_name = 'bulk-invoice-'.current_time('dmY_Hi').'.pdf';

			$dompdf = new Dompdf();
			$options = $dompdf->getOptions(); 
		    $options->set(array('isRemoteEnabled' => true));
		    $dompdf->setOptions($options);
			$dompdf->loadHtml($final_pdf_html);
			$dompdf->setPaper($ocpsw_paper_size, 'portrait');
			$dompdf->render();
			$dompdf->stream( $pdf_name, array("Attachment" => $ocpsw_pdf_download));
			exit();
    	}

        
	    function OCPSW_attach_terms_conditions_pdf_to_email_invoice ( $attachments, $status , $order ) {

	    	$ocpsw_atch_to_email = array('new_order', 'customer_processing_order');

			$ocpsw_disbl_atch_for_ord_status = get_option( 'ocpsw_disbl_atch_for_ord_status', array() );

			$get_status = 'wc-'.$order->get_status();

			if( isset( $status ) && in_array ( $status, $ocpsw_atch_to_email ) && !in_array($get_status, $ocpsw_disbl_atch_for_ord_status) ) {

				$order_id = $order->get_id();

				include_once(plugin_dir_path( __FILE__ ).'dompdf/autoload.inc.php');

				ob_start();
				$ocpsw_template_pos = get_option( 'ocpsw_template_pos', 'wp-content/plugins/pdf-invoices-and-packing-slips-bundle-woocommerce/templates/Template 1' );
			    $wp_root_path = str_replace('wp-content/themes', '', get_theme_root());
			    $template_path = $wp_root_path.$ocpsw_template_pos.'/html-wrapper.php';
			    $pdf_page_title = 'PDF Invoice';
			    $pdf_page_label = 'Invoice';
			    $pdf_body_class = 'ocpsw-invoice';
			    $pdf_content_path = $wp_root_path.$ocpsw_template_pos.'/invoice.php';
			    $style_path = $wp_root_path.$ocpsw_template_pos.'/style.css';

				$ocpsw_paper_size = 'A4';

				include($template_path);

				$html = ob_get_clean();
				$dompdf = new Dompdf();
				$options = $dompdf->getOptions(); 
			    $options->set(array('isRemoteEnabled' => true));
			    $dompdf->setOptions($options);
				$dompdf->loadHtml($html);
				$dompdf->setPaper($ocpsw_paper_size, 'portrait');
				$dompdf->render();

				$output = $dompdf->output();
				file_put_contents( OCPSW_BASE_PLUGIN_DIR . 'pdf/Invoice-'. $order_id.'.pdf', $output);           
				$file =OCPSW_BASE_PLUGIN_DIR . 'pdf/Invoice-'. $order_id.'.pdf';

				$attachments[] = $file;
			}
			return $attachments;
	    }


	    function OCPSW_recursive_sanitize_text_field($array) {
            if(!empty($array)) {
                foreach ( $array as $key => &$value ) {
                    if ( is_array( $value ) ) {
                        $value = $this->OCSCW_recursive_sanitize_text_field($value);
                    } else {
                        $value = sanitize_text_field( $value );
                    }
                }
            }
            return $array;
        }


	    function OCPSW_save_options() {
			if( current_user_can('administrator') ) { 
				if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'ocpsw_save_option') {
				    if(!isset( $_POST['ocpsw_nonce_field'] ) || !wp_verify_nonce( $_POST['ocpsw_nonce_field'], 'ocpsw_nonce_action' ) ) {
				        print 'Sorry, your nonce did not verify.';
				        exit;
				    } else {

				        update_option('ocpsw_shop_addr',sanitize_textarea_field( $_REQUEST['ocpsw_shop_addr']),'yes');
				        update_option('ocpsw_shop_title',sanitize_text_field( $_REQUEST['ocpsw_shop_title']),'yes');
				        update_option('ocpsw_footer_text',sanitize_textarea_field( $_REQUEST['ocpsw_footer_text']),'yes');
				        update_option('ocpsw_template_pos', sanitize_text_field( $_REQUEST['ocpsw_template_pos'] ),'yes');
				        update_option('ocpsw_ordtbl_head_bg_color', sanitize_text_field( $_REQUEST['ocpsw_ordtbl_head_bg_color'] ),'yes');
				        update_option('ocpsw_ordtbl_head_color', sanitize_text_field( $_REQUEST['ocpsw_ordtbl_head_color'] ),'yes');

				        if(isset($_REQUEST['ocpsw_atmclnup_days']) && !empty($_REQUEST['ocpsw_atmclnup_days'])) {
				          $ocpsw_atmclnup_days = sanitize_text_field( $_REQUEST['ocpsw_atmclnup_days'] );
				        } else {
				          $ocpsw_atmclnup_days = '7';
				        }
				        update_option('ocpsw_atmclnup_days', $ocpsw_atmclnup_days, 'yes');
				        update_option('ocpsw_pdf_view', sanitize_text_field( $_REQUEST['ocpsw_pdf_view'] ), 'yes');

				        if(isset($_REQUEST['ocpsw_packaging_enable']) && !empty($_REQUEST['ocpsw_packaging_enable'])) {
				          $ocpsw_packaging_enable = sanitize_text_field( $_REQUEST['ocpsw_packaging_enable'] );
				        } else {
				          $ocpsw_packaging_enable = 'disable';
				        }
				        update_option('ocpsw_packaging_enable', $ocpsw_packaging_enable, 'yes');

				        if(isset($_REQUEST['ocpsw_invoice_enable']) && !empty($_REQUEST['ocpsw_invoice_enable'])) {
				          $ocpsw_invoice_enable = sanitize_text_field( $_REQUEST['ocpsw_invoice_enable'] );
				        } else {
				          $ocpsw_invoice_enable = 'disable';
				        }
				        update_option('ocpsw_invoice_enable', $ocpsw_invoice_enable, 'yes');

						if(isset($_REQUEST['ocpsw_disbl_atch_for_ord_status']) && !empty($_REQUEST['ocpsw_disbl_atch_for_ord_status']) ) {
				    		$ocpsw_disbl_atch_for_ord_status = $this->OCPSW_recursive_sanitize_text_field( $_REQUEST['ocpsw_disbl_atch_for_ord_status'] );
				    	} else {
				    		$ocpsw_disbl_atch_for_ord_status = array();
				    	}
						update_option('ocpsw_disbl_atch_for_ord_status', $ocpsw_disbl_atch_for_ord_status, 'yes');

						if(isset($_REQUEST['ocpsw_invce_dis_ship']) && !empty($_REQUEST['ocpsw_invce_dis_ship'])) {
				          $ocpsw_invce_dis_ship = sanitize_text_field( $_REQUEST['ocpsw_invce_dis_ship'] );
				        } else {
				          $ocpsw_invce_dis_ship = 'disable';
				        }
				        update_option('ocpsw_invce_dis_ship', $ocpsw_invce_dis_ship, 'yes');

						if(isset($_REQUEST['ocpsw_invce_dis_email']) && !empty($_REQUEST['ocpsw_invce_dis_email'])) {
				          $ocpsw_invce_dis_email = sanitize_text_field( $_REQUEST['ocpsw_invce_dis_email'] );
				        } else {
				          $ocpsw_invce_dis_email = 'disable';
				        }
				        update_option('ocpsw_invce_dis_email', $ocpsw_invce_dis_email, 'yes');

				        if(isset($_REQUEST['ocpsw_invce_dis_phone']) && !empty($_REQUEST['ocpsw_invce_dis_phone'])) {
				          $ocpsw_invce_dis_phone = sanitize_text_field( $_REQUEST['ocpsw_invce_dis_phone'] );
				        } else {
				          $ocpsw_invce_dis_phone = 'disable';
				        }
				        update_option('ocpsw_invce_dis_phone', $ocpsw_invce_dis_phone, 'yes');

				        if(isset($_REQUEST['ocpsw_invce_dis_cnotes']) && !empty($_REQUEST['ocpsw_invce_dis_cnotes'])) {
				          $ocpsw_invce_dis_cnotes = sanitize_text_field( $_REQUEST['ocpsw_invce_dis_cnotes'] );
				        } else {
				          $ocpsw_invce_dis_cnotes = 'disable';
				        }
				        update_option('ocpsw_invce_dis_cnotes', $ocpsw_invce_dis_cnotes, 'yes');
				        update_option('ocpsw_invce_dis_invc_date', sanitize_text_field($_REQUEST['ocpsw_invce_dis_invc_date']), 'yes');
				        update_option('ocpsw_invce_dis_invc_num', sanitize_text_field($_REQUEST['ocpsw_invce_dis_invc_num']), 'yes');

				        if(isset($_REQUEST['ocpsw_invce_dwn_cust_my_acc']) && !empty($_REQUEST['ocpsw_invce_dwn_cust_my_acc'])) {
				          $ocpsw_invce_dwn_cust_my_acc = sanitize_text_field( $_REQUEST['ocpsw_invce_dwn_cust_my_acc'] );
				        } else {
				          $ocpsw_invce_dwn_cust_my_acc = 'disable';
				        }
				        update_option('ocpsw_invce_dwn_cust_my_acc', $ocpsw_invce_dwn_cust_my_acc, 'yes');

				        if(isset($_REQUEST['ocpsw_pkg_dis_bil']) && !empty($_REQUEST['ocpsw_pkg_dis_bil'])) {
				          $ocpsw_pkg_dis_bil = sanitize_text_field( $_REQUEST['ocpsw_pkg_dis_bil'] );
				        } else {
				          $ocpsw_pkg_dis_bil = 'disable';
				        }
				        update_option('ocpsw_pkg_dis_bil', $ocpsw_pkg_dis_bil, 'yes');

				        if(isset($_REQUEST['ocpsw_pkg_dis_email']) && !empty($_REQUEST['ocpsw_pkg_dis_email'])) {
				          $ocpsw_pkg_dis_email = sanitize_text_field( $_REQUEST['ocpsw_pkg_dis_email'] );
				        } else {
				          $ocpsw_pkg_dis_email = 'disable';
				        }
				        update_option('ocpsw_pkg_dis_email', $ocpsw_pkg_dis_email, 'yes');

				        if(isset($_REQUEST['ocpsw_pkg_dis_phone']) && !empty($_REQUEST['ocpsw_pkg_dis_phone'])) {
				          $ocpsw_pkg_dis_phone = sanitize_text_field( $_REQUEST['ocpsw_pkg_dis_phone'] );
				        } else {
				          $ocpsw_pkg_dis_phone = 'disable';
				        }
				        update_option('ocpsw_pkg_dis_phone', $ocpsw_pkg_dis_phone, 'yes');
				        
				        if(isset($_REQUEST['ocpsw_pkg_dis_cnotes']) && !empty($_REQUEST['ocpsw_pkg_dis_cnotes'])) {
				          $ocpsw_pkg_dis_cnotes = sanitize_text_field( $_REQUEST['ocpsw_pkg_dis_cnotes'] );
				        } else {
				          $ocpsw_pkg_dis_cnotes = 'disable';
				        }
				        update_option('ocpsw_pkg_dis_cnotes', $ocpsw_pkg_dis_cnotes, 'yes');
				    }
				}
			}
	    }

	  	function OCPSW_get_pdf_templates() {
		    $pdf_templates = array();

		    $template_dir = array (
		      'default'   => OCPSW_BASE_PLUGIN_DIR . 'templates/',
		      'child-theme' => get_stylesheet_directory() . "/woocommerce/pdf/",
		      'theme'     => get_template_directory() . "/woocommerce/pdf/",
		    );

		    $template_dir = apply_filters( 'OCPSW_template_dir', $template_dir );

		    if ( defined('WP_CONTENT_DIR') && strpos( WP_CONTENT_DIR, ABSPATH ) !== false ) {
		      $forwardslash_basepath = str_replace('\\','/', ABSPATH);
		    } else {
		      $forwardslash_basepath = str_replace('\\','/', WP_CONTENT_DIR);
		    }

		    foreach ($template_dir as $template_src => $template_dir_path) {
			    $dirs = (array) glob( $template_dir_path . '*' , GLOB_ONLYDIR);
			      
			    foreach ($dirs as $dir) {
			        $forwardslash_dir = str_replace('\\','/', $dir);
			        $pdf_templates[ str_replace( $forwardslash_basepath, '', $forwardslash_dir ) ] = basename($dir);
			    }
		    }

		    $pdf_templates = array_unique($pdf_templates);

		    if (empty($pdf_templates)) {
		    	$simple_template_path = str_replace( ABSPATH, '', $template_dir['default'] . 'Template 1' );
		      	$pdf_templates[$simple_template_path] = 'Template 1';
		    }

		    return apply_filters( 'OCPSW_pdf_templates', $pdf_templates );
	  	}


	  	function OCPSW_get_woocommerce_emails() {
			if (function_exists('WC')) {
				$emails_object = WC()->mailer();
			} else {
				global $woocommerce;
				if ( empty( $woocommerce ) ) {
					return array();
				}
				$emails_object = $woocommerce->mailer();
			}
			$wocommerce_emails = $emails_object->get_emails();

			$exclude_emails = array(
				'customer_reset_password',
				'customer_new_account'
			);

			$emails = array();
			foreach ($wocommerce_emails as $email) {
				if ( !is_object( $email ) ) {
					continue;
				}
				if ( !in_array( $email->id, $exclude_emails ) ) {
					switch ($email->id) {
						case 'new_order':
							$emails[$email->id] = sprintf('%s (%s)', $email->title, __( 'Admin email', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ) );
							break;
						case 'customer_invoice':
							$emails[$email->id] = sprintf('%s (%s)', $email->title, __( 'Manual email', 'pdf-invoices-and-packing-slips-bundle-woocommerce' ) );
							break;
						default:
							$emails[$email->id] = $email->title;
							break;
					}
				}
			}

			return $emails;
		}


		function OCPSW_search_ord_status_ajax_callback() {

            $return = array();

            $wc_get_order_statuses = wc_get_order_statuses();

			if(!empty($wc_get_order_statuses)) {
				foreach ($wc_get_order_statuses as $status => $label) {
					$return[] = array( $status, $label );
				}
			}

            echo json_encode( $return );
            die;
        }

		function OCPSW_add_meta_box_pdf_buttons() {

			$ocpsw_packaging_enable = get_option( 'ocpsw_packaging_enable', 'enable' );
	    	$ocpsw_invoice_enable = get_option( 'ocpsw_invoice_enable', 'enable' );

	    	if($ocpsw_invoice_enable == 'enable') {
	    		add_meta_box(
					'wpo_wcpdf-data-input-box',
					__( 'PDF document data', 'woocommerce' ),
					array( $this, 'OCPSW_meta_box_invoice_data' ),
					'shop_order',
					'normal',
					'high'
				);	
	    	}

	    	if($ocpsw_packaging_enable == 'enable' || $ocpsw_invoice_enable == 'enable') {

		    	add_meta_box( 'ocpsw_meta_pdf_buttons', __('Create PDF', 'pdf-invoices-and-packing-slips-bundle-woocommerce'), array($this, 'OCPSW_meta_box_pdf_buttons_html'), 'shop_order', 'side', 'core' );
		    }
		}


		function OCPSW_meta_box_pdf_buttons_html() {
		    global $post;

		    $ocpsw_invoice_enable = get_option( 'ocpsw_invoice_enable', 'enable' );

		    if($ocpsw_invoice_enable == 'enable') {

		        $invoice_nonce = wp_create_nonce('ocpsw-woo-invoice-pdf');

		        // Prepare the button data
		        $woo_pdf_invoice_url = admin_url().'?action=woo_pdf_invoice&order_id='.$post->ID.'&_wpnonce='.$invoice_nonce;
		        $woo_pdf_invoice_url = esc_url($woo_pdf_invoice_url);
		        $woo_pdf_invoice_name = esc_attr( __('PDF Invoice', 'woocommerce' ) );
		        $woo_pdf_invoice_action = esc_attr( 'view ocpsw-eo-pdf-invoice-btn' ); // keep "view" class for a clean button CSS

		        // Set the action button
		        printf( '<a class="button tips %s" href="%s" data-tip="%s" target="_blank">%s</a>', $woo_pdf_invoice_action, $woo_pdf_invoice_url, $woo_pdf_invoice_name, $woo_pdf_invoice_name );
		    }

		    $ocpsw_packaging_enable = get_option( 'ocpsw_packaging_enable', 'enable' );

			if($ocpsw_packaging_enable == 'enable') {

		        $nonce = wp_create_nonce('ocpsw-woo-pdf');

		        // Prepare the button data
		        $woo_pdf_packaging_url = admin_url().'?action=woo_pdf&order_id='.$post->ID.'&_wpnonce='.$nonce;
		        $woo_pdf_packaging_url = esc_url($woo_pdf_packaging_url);
		        $woo_pdf_packaging_name   = esc_attr( __('Packaging Slip', 'woocommerce' ) );
		        $woo_pdf_packaging_action = esc_attr( 'ocpsw-eo-pckg-slip-btn' ); // keep "view" class for a clean button CSS

		        // Set the action button
		        printf( '<a class="button tips %s" href="%s" data-tip="%s" target="_blank">%s</a>', $woo_pdf_packaging_action, $woo_pdf_packaging_url, $woo_pdf_packaging_name, $woo_pdf_packaging_name );
		    }
		}


		function OCPSW_meta_box_invoice_data ( $post ) {

			global $post;

			$ocpsw_invoice_number = get_post_meta( $post->ID, '_ocpsw_invoice_number', true ) ? get_post_meta( $post->ID, '_ocpsw_invoice_number', true ) : '';

	        $ocpsw_invoice_date = get_post_meta( $post->ID, '_ocpsw_invoice_date', true ) ? get_post_meta( $post->ID, '_ocpsw_invoice_date', true ) : '';	        

	        $ocpsw_invoice_note = get_post_meta( $post->ID, '_ocpsw_invoice_note', true ) ? get_post_meta( $post->ID, '_ocpsw_invoice_note', true ) : '';
	        ?>
	        <div class="ocpsw_paper_size">
		        <input type="hidden" name="ocpsw_save_invoice_data" value="<?php echo wp_create_nonce(); ?>">
		        <p class="form-field form-field-wide">
					<label for="_ocpsw_invoice_number">Invoice Number:</label>
					<input type="text" class="short" name="_ocpsw_invoice_number" id="_ocpsw_invoice_number" value="<?php echo $ocpsw_invoice_number; ?>">
				</p>
				<p class="form-field form-field-wide">
					<label for="_ocpsw_invoice_date">Invoice Date:</label>
					<input type="text" class="ocpsw_datepicker" name="_ocpsw_invoice_date" id="_ocpsw_invoice_date" value="<?php echo $ocpsw_invoice_date; ?>">
				</p>
				<p class="form-field form-field-wide">
					<label for="_ocpsw_invoice_note">Notes:</label>
					<textarea name="_ocpsw_invoice_note" id="_ocpsw_invoice_note" cols="50" rows="6"><?php echo $ocpsw_invoice_note; ?></textarea>
				</p>
			</div>
			<script type="text/javascript">
				jQuery( ".ocpsw_datepicker").datepicker({});
			</script>
	        <?php
		}


		function OCPSW_meta_box_invoice_save_data( $post_id ) {
		    // Check if our nonce is set.
		    if ( ! isset( $_POST[ 'ocpsw_save_invoice_data' ] ) ) {
		        return $post_id;
		    }
		    $nonce = $_REQUEST[ 'ocpsw_save_invoice_data' ];

		    //Verify that the nonce is valid.
		    if ( ! wp_verify_nonce( $nonce ) ) {
		        return $post_id;
		    }

		    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
		    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		        return $post_id;
		    }

		    // Check the user's permissions.
		    if ( 'page' == $_POST[ 'post_type' ] ) {
		        if ( ! current_user_can( 'edit_page', $post_id ) ) {
		            return $post_id;
		        }
		    } else {
		        if ( ! current_user_can( 'edit_post', $post_id ) ) {
		            return $post_id;
		        }
		    }		    

		    // Sanitize user input  and update the meta field in the database.
		    update_post_meta( $post_id, '_ocpsw_invoice_number', sanitize_text_field($_POST[ '_ocpsw_invoice_number' ]) );
		    update_post_meta( $post_id, '_ocpsw_invoice_date', sanitize_text_field($_POST[ '_ocpsw_invoice_date' ]) );
		    update_post_meta( $post_id, '_ocpsw_invoice_note', sanitize_textarea_field($_POST[ '_ocpsw_invoice_note' ]) );
		}


	  	function init() {
		    add_action( 'admin_menu',  array($this, 'OCPSW_submenu_page'));
		    add_action('init', array( $this, 'OCPSW_me_post_pdf'));
		    add_action('init', array( $this, 'OCPSW_me_post_pdf_invoice'));
		    add_filter( 'bulk_actions-edit-shop_order', array( $this,'OCPSW_downloads_bulk_actions_edit_product'), 20, 1 );

		    $ocpsw_packaging_enable = get_option( 'ocpsw_packaging_enable', 'enable' );

	    	if($ocpsw_packaging_enable == 'enable') {
	    		add_filter( 'handle_bulk_actions-edit-shop_order', array( $this, 'OCPSW_downloads_handle_bulk_action_edit_shop_order'), 10, 3 );
	    	}

	    	$ocpsw_invoice_enable = get_option( 'ocpsw_invoice_enable', 'enable' );

	    	if($ocpsw_invoice_enable == 'enable') {
	    		add_filter( 'handle_bulk_actions-edit-shop_order', array( $this, 'OCPSW_downloads_handle_bulk_action_edit_shop_order_invoice'), 10, 4 );
	    	}

		    // Add your custom order action button
		    add_action( 'woocommerce_admin_order_actions_end', array( $this, 'OCPSW_add_order_actions_pdf_button'), 100, 1 );
		    // The icon of your action button (CSS)
		   	add_action( 'admin_head', array( $this, 'OCPSW_add_order_actions_pdf_button_css' ) );
		    add_action( 'init',  array($this, 'OCPSW_save_options'));
		    add_filter( 'woocommerce_email_attachments', array( $this,'OCPSW_attach_terms_conditions_pdf_to_email_invoice'), 10, 3);

		    add_action( 'wp_ajax_nopriv_ocpsw_search_ord_status',array($this, 'OCPSW_search_ord_status_ajax_callback') );
            add_action( 'wp_ajax_ocpsw_search_ord_status', array($this, 'OCPSW_search_ord_status_ajax_callback') );

            add_action( 'add_meta_boxes', array($this, 'OCPSW_add_meta_box_pdf_buttons' ) );
            add_action( 'save_post', array($this, 'OCPSW_meta_box_invoice_save_data'), 10, 1 );
	  	}


  		public static function instance() {
		    if (!isset(self::$instance)) {
		      self::$instance = new self();
		      self::$instance->init();
		    }
		    return self::$instance;
  		}
	}

  	OCPSW_backend::instance();
}