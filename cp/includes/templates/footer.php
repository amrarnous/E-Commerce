
<footer>
	
</footer>
<?php

	$js_files = array("jquery-3.1.1.min.js", "bootstrap.min.js", "plugin.js");

	for($i=0; $i < count($js_files); $i++) {
		echo "<script src='" . $js . $js_files[$i] . "'></script>\n";
	}

?>

</body>
</html>