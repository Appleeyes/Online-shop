<?php

function authorizeAdmin()
{
    return isset($_SESSION['user_role']) && $_SESSION['user_role'];
}
?>