<?php
session_start();
session_destroy();
echo "you logged out";
header('Location: '. 'index.php');