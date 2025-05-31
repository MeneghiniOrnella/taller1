<?php
function redirectWith($path, $type = 'success', $code = 1) {
    header("Location: $path?$type=$code");
    exit;
}
?>