<?php

const HOME = 'Custom HOME page'; //-------------------------------------------

router('get', '/', function(){
    getPageHeader('main');
    echo CMSIF_SYSTEM_NAME, '<br />'.EOL;

    echo '<p><a href="'.getHost().'/files">Files</a></p>'. EOL;
    echo '<p><a href="'.getHost().'/profile">Profile</a></p>'. EOL;
    echo '<p><a href="'.getHost().'/main">Main</a></p>'. EOL;
    echo '<p><a href="'.getHost().'/exchange">Exchange</a></p>'. EOL;
    echo '<p><a href="'.getHost().'/exchange/turkey">Turkey Lira</a></p>'. EOL;
    echo '<p><a href="'.getHost().'/article/1">Article 1</a></p>'. EOL;
    echo '<p><a href="'.getHost().'/article/2">Article 2</a></p>'. EOL;
    echo '<p><a href="'.getHost().'/form">Form</a></p>'. EOL;
    echo '<p><a href="'.getHost().'/db">DB select</a></p>'. EOL;
});

const FILES = 'Route Files examples';  //-------------------------------------

router('get', '/files', function(){
    getPageHeader();

    //Read HTML and PLAIN text files
    echo fileRead('test.html', 'html'), '<br />'.EOL;
    echo fileRead('test.html'), '<br />'.EOL;

    //Write and Read JSON format files
    fileWrite('test2.json', ['1'=>'a', '2'=>'b', '3'=>'c', '4'=> 'd'], 'json');
    echo fileRead('test2.json'), '<br />'.EOL;
    dump( fileRead('test.json', 'json') );

    //Update file
    fileWrite('test3.txt', 'This is text file. Last Access Date: '. date('Y-m-d H:i:s', time()) );
    echo fileRead('test3.txt'), '<br />'.EOL;

});

const PROFILE = 'Route for Complex template'; //------------------------------

router('get', '/profile', function(){

    fileExecute('/_partials/header.php', ['_type' => 'template']);

    renderBlock('{{ Footer }}', 'footer', 'section');
    renderView('profile');
});

const MAIN = 'Route for main url'; //-----------------------------------------

router('get', '/main', function(){
    getPageHeader();

    echo 'User: ', getUser(), '<br />'.EOL;
    echo date_default_timezone_get(), '<br />'.EOL;
    echo cookieGet('language'), '<br />'.EOL;
    echo version(), '<br />'.EOL;
    echo getId(), '<br />'.EOL;
    echo getModule(), '<br />'.EOL;
    echo getMethod(), '<br />'.EOL;

});

const EXCHANGE = 'Route for Exchange'; //-------------------------------------

router('get', '/exchange', function(){
    getPageHeader();

    print_r( exchange_rate(['USD'=>'RUB'], 4) );
    echo '<br />'.EOL;
    print_r( exchange_rate(['EUR'=>'RUB'], 4) );
    echo '<br />'.EOL;
    echo '<br />'.EOL;
    print_r( exchange_rate(['EUR'=>'TRY']) );
    echo '<br />'.EOL;

    echo 'TRY in USD', turkey_exchange_rate('USD', 3);
    echo '<br />'.EOL;
    echo 'TRY in EUR', turkey_exchange_rate('EUR');
    echo '<br />'.EOL;

    echo 'TRY:', getExchangeRate('EUR', 'TRY', 4);
    echo '<br />';
    echo 'RUB:', getExchangeRate('EUR', 'RUB', 4);

});

const EXCHANGE_TURKEY = 'Route for Exchange TRY to USD or EUR'; //------------

router('get', '/exchange/turkey', function(){
    getPageHeader();

    echo 'USD: ', turkey_exchange_rate('USD', 3);
    echo '<br />'.EOL;
    echo 'EUR: ', turkey_exchange_rate('EUR', 3);

});

const ARTICLES = 'Routing with IDs'; //---------------------------------------

router('get', '/article/([0-9]*)', function($_matches){
    $out = '';
    switch( $_matches[1] )
    {
        case 1:
            $out .= '<h3>Article '. (int) $_matches[1].'</h3>'.EOL;
            $out .= view('<p>This is my article number 1</p>');
            break;
        case 2:
            $out .= '<h3>Article '. (int) $_matches[1].'</h3>'.EOL;
            $out .= view( [
                '<p>This is my second article.</p>', 
                '<p>This is my second paragraph.</p>'] 
            );
            break;
        default:
            error404();
            break;
    }

    getPageHeader();
    echo $out;
    footerHTML();
});

const DB = 'DB example'; //---------------------------------------------------

router('get', '/db', function(){
    getPageHeader();

    echo CMSIF_SYSTEM_NAME, '<br />'.EOL;

    $_out = dbQuery(['SELECT * FROM orders WHERE total>1000 limit 2']);
    dump($_out);

    dump(dbQuery(['SHOW TABLES']));
    dump(dbDisconnect());
});

const HTTP_AUTH = '';
router('get', '/login', function(){
    auth('http');
});

const ABOUT = 'Simple route to include module file'; //-----------------------

router('get', '/about', CMSIF_MODULES.'/about.php');

const COOKIE_COUNTER = 'Simple HTML page with counter'; //--------------------

router('get', '/counter', function(){

    $counter = cookieGet('counter', '0');

    //Set Cookie BEFORE any output in browser
    cookieSet('counter', ++$counter);

    getPageHeader();

    echo 'Count: ', $counter, '<br />'.EOL;

});

const FORM = 'Rendering of Form template with external and internal assets';

router('get', '/form', function(){
    getPageHeader();

    renderBlock('<h2>Auth form</h2>', 'Header', 'section');

    $form_fields = [
        'text'     => '{"name": "username", "id": "Username"}',
        'password' => '{"name": "password", "id": "Password"}',
        'submit'   => '{"name": "submit", "id": "Submit"}'
    ];

    $form = form(['method'=>'POST', 'action'=>getHost().'/form', 'fields'=>$form_fields]);
    renderBlock($form, 'section', 'section');

    renderView('form');
});

//POST action proccessing ----------------------------------------------------

router('post', '/form', function(){
    getPageHeader();

    dump(filterPOST());
});

// ---------------------------------------------------------------------------

function getPageHeader($section='') {
    headerHTML();
    echo assetExternal(getHost().'/css/normalize.css', 'css');
    echo assetExternal('//fonts.googleapis.com/css?family=Roboto', 'css');
    echo asset('style.css');

    if ('main'!=$section) {
        echo '<p><a href="'.getHost().'/">Home</a></p>'. EOL;
    }
}