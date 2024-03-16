<?php

function redirect($url, $statusCode)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}
