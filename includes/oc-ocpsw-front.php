<?php

if (!defined('ABSPATH'))
exit;

use Dompdf\Dompdf as Dompdf;

if (!class_exists('OCPSW_front')) {

    class OCPSW_front {

      	protected static $instance;

        function ocpsw_add_my_account_order_actions( $actions, $order ) {
            $action_dow = 'opsw_invoice';

            $nonce = wp_create_nonce('ocpsw-woo-pdf-download');

	        // Prepare the button data
	        $actions[$action_dow] = array(
	            // adjust URL as needed
	            'url'  => '?action=woo_pdf_download&order_id='  . $order->get_id().'&_wpnonce='.$nonce,
	            'name' => __( 'Invoice', 'my-textdomain' ),
	        );

            return $actions;
        }


        function ocpsw_custom_js() {
        	$ocpsw_pdf_view = get_option( 'ocpsw_pdf_view', 'open_in_new_window' );

			if($ocpsw_pdf_view == 'open_in_new_window') {
			    ?>
			    <script type="text/javascript">
			    	jQuery('a.opsw_invoice').each( function(){ 
			    		jQuery(this).attr('target','_blank'); 
			    	});
			    </script>
			    <?php
			}
		}


	    function OCPSW_me_post_pdf_invoice_download() {

	        if(isset($_REQUEST['order_id'])) {
	        	$ocpsw_order_id = sanitize_text_field($_REQUEST['order_id']);
	            $order = wc_get_order($ocpsw_order_id);
	        }

	        if(isset($_REQUEST['action']) && $_REQUEST['action'] == "woo_pdf_download") {

	        	if ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'ocpsw-woo-pdf-download' ) ) {

		        	include_once(plugin_dir_path( __FILE__ ).'dompdf/autoload.inc.php');

		        	ob_start();

		        	$ocpsw_template_pos = get_option( 'ocpsw_template_pos', 'wp-content/plugins/pdf-invoices-and-packing-slips-bundle-woocommerce/templates/Template 1' );
		        	$ocpsw_pdf_view = get_option( 'ocpsw_pdf_view', 'open_in_new_window' );

					if($ocpsw_pdf_view == 'open_in_new_window' || $ocpsw_pdf_view == 'open_in_current_window') {
						$ocpsw_pdf_download = false;
					} else {
						$ocpsw_pdf_download = true;
					}

					$ocpsw_paper_size = 'A4';

					$wp_root_path = str_replace('wp-content/themes', '', get_theme_root());
					$template_path = $wp_root_path.$ocpsw_template_pos.'/html-wrapper.php';
			        $pdf_page_title = 'PDF Invoice';
			        $pdf_page_label = 'Invoice';
			        $pdf_body_class = 'ocpsw-invoice';
			        $pdf_content_path = $wp_root_path.$ocpsw_template_pos.'/invoice.php';
			        $style_path = $wp_root_path.$ocpsw_template_pos.'/style.css';

					include($template_path);

			        $html=ob_get_clean();

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
              

        function init() {

        	$ocpsw_invoice_enable = get_option( 'ocpsw_invoice_enable', 'enable' );
        	$ocpsw_invce_dwn_cust_my_acc = get_option( 'ocpsw_invce_dwn_cust_my_acc', 'enable' );

	    	if($ocpsw_invoice_enable == 'enable' && $ocpsw_invce_dwn_cust_my_acc == 'enable') {
	    		add_filter( 'woocommerce_my_account_my_orders_actions', array($this ,'ocpsw_add_my_account_order_actions'), 10, 2 );
            	add_action('init',array( $this, 'OCPSW_me_post_pdf_invoice_download')); 
            	add_action( 'wp_footer', array($this, 'ocpsw_custom_js'), 100 );
	    	}
        }


        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
         	return self::$instance;
        }
    }
 OCPSW_front::instance();
}