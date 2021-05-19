<?php

use App\Models\Category;

function get_all_categories(){
    return Category::all();
}
?>