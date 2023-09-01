<?php

// function to authorize users to access admin page
function authorizeAdmin()
{
    return isset($_SESSION['user_role']) && $_SESSION['user_role'];
}
?>