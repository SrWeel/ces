<?php

function moduloCurlCargado() {
    if  (in_array  ('curl', get_loaded_extensions())) {
        return true;
    }
    else {
        return false;
    }
}


echo moduloCurlCargado();


?>