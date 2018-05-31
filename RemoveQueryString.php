<?php

function remove_query_string($url) {  
    return preg_replace('/\?.*/', '', $url)
}
