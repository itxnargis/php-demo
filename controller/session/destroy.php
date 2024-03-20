<?php

echo "Destroying session...";

logout();

header('location: /');
exit();
