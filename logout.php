<?php

session_start();

session_destroy();

header("Location: index.php"); #go back 2 index.php
exit; #good practice after sending a header

#htmlspecialchars for untrusted content