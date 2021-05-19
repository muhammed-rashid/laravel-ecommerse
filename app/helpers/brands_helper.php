<?php

use App\Models\brand;

function get_all_brands(){
    return brand::all();
}
?>