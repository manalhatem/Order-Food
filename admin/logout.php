<?php
include('../config/constants.php');
session_destroy();// unset for session ['user']
header("location:".SITEURL. 'admin/login.php');
?>