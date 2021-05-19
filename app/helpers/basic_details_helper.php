
<?php

use App\Models\generalDetails;


 function get_basic_details(){
    $details = generalDetails::first();

    return $details;
    
}

?>