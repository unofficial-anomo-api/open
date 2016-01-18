<?php
$db = new SQLite3('db.db');
$db->close();
unset($db);
?>