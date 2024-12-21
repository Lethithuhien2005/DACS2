<?php
    session_start();
    // Deleting session
    session_unset();
    session_destroy();
    // Coming back to index page:
    header("{{URL::to('/homepage')}}");
    exit();
?>