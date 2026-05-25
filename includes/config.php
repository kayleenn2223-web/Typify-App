<?php
// Mencegah akses langsung ke file ini
if (count(get_included_files()) === 1) { exit("Direct access not permitted."); }

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_typify');

?>