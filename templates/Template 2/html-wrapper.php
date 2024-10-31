<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo $pdf_page_title; ?></title>
	<style type="text/css">
		<?php
		ob_start();
		if (file_exists($style_path)) {
			include($style_path);
		}
		echo $style_path = ob_get_clean();
		?>
	</style>
</head>
<body class="<?php echo $pdf_body_class; ?>">
	<?php include($pdf_content_path); ?>
</body>
</html>