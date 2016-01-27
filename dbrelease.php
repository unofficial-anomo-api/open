<?php
//closes the database connection
$db = new SQLite3('db.db');
$db->close();
unset($db);
?>