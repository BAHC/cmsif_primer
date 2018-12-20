<?php
require __DIR__.'/config.php';
require __DIR__.'/vendor/cmsif/cmsif.php';

include CMSIF_MODULES.'/_functions/currency.php';

init();

/**/

include 'cmsif_primer.php';

/**/

router('get', '/', function(){
    headerHTML();
    echo '<h1>Welcome to CMSIF '. version().'</h1>';
});
error404();