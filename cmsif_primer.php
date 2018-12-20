<?php

//Complex template
router('get', '/profile', function(){

    fileExecute('/_partials/header.php', ['_type' => 'template']);

    renderBlock('{{ Footer }}', 'footer', 'section');
    renderView('profile');
});

router('get', '/test', CMSIF_MODULES.'test.php');

router('get', '/main', function(){

    headerHTML();

    echo 'User: ', getUser(), '<br />'.EOL;
    echo date_default_timezone_get(), '<br />'.EOL;
    echo cookieGet('language'), '<br />'.EOL;
    echo version(), '<br />'.EOL;
    echo getId(), '<br />'.EOL;
    echo getModule(), '<br />'.EOL;
    echo getMethod(), '<br />'.EOL;

    //dbConnect();
    //dbQuery(['SHOW TABLES']);

});

router('get', '/exchange', function(){

    headerHTML();

    print_r( exchange_rate(['EUR'=>'RUB']) );
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

router('get', '/exchange/turkey', function(){
	
	headerHTML();
	echo '<br />'.EOL;
	echo turkey_exchange_rate('USD', 3);
	echo '<br />'.EOL;
	echo turkey_exchange_rate('EUR');

});

router('get', '/article/([0-9]*)', function($_matches){
	$_out = '';
	switch( $_matches[1] )
	{
		case 1:
			$_out .= '<h3>Article '. (int) $_matches[1].'</h3>'.EOL;
			$_out .= view('This is my article number 1');
			break;
		case 2:
			$_out .= '<h3>Article '. (int) $_matches[1].'</h3>'.EOL;
			$_para = [
				'This is my second article.', 
				'And the article have two paragraphs',
			];
			$_out .= view($_para);

			break;
		default:
			error404();
			break;
	}
	
	if(!empty($_out))
	{
		headerHTML();
		echo $_out;
	}
});

router('get', '/form', function(){
	assetExternal('http://necolas.github.com/normalize.css');
	assetExternal('//fonts.googleapis.com/css?family=Roboto', 'css');
	asset('style.css');

	$_form_fields = [
		'text'     => '{"name": "username", "id": "Username"}',
		'password' => '{"name": "password", "id": "Password"}',
		'submit'   => '{"name": "submit", "id": "Submit"}'
	];
	form(['method'=>'POST', 'action'=>getHost().'/form', 'fields'=>$_form_fields]);
	$_out = [
		'<h1>Auth form</h1>',
		'Plain text without formatting',
	];
	renderView('form', $_out);
});


router('post', '/form', function(){ 
	dump(filterPOST());
});

router('get', '/db', function(){
    $_out = dbQuery(['select * from orders where total=0']);
    dump($_out);
    dump(dbDisconnect());
});

router('get', '/login', function(){
    auth('http');
});

router('get', '/', function(){
    headerHTML();
    echo assetExternal('http://necolas.github.com/normalize.css');
    echo assetExternal('//fonts.googleapis.com/css?family=Roboto', 'css');
    echo asset('style.css');


    echo CMSIF_SYSTEM_NAME, '<br />'.EOL;

    echo fileRead('test.html', 'html'), '<br />'.EOL;

    echo fileRead('test.html'), '<br />'.EOL;

    fileWrite('test2.json', ['1'=>'a', '2'=>'b', '3'=>'c', '4'=> 'd'], 'json');

    echo fileRead('test2.json'), '<br />'.EOL;

    dump( fileRead('test.json', 'json') );

    fileWrite('test3.txt', 'This is text file. Last Access Date: '. date('Y-m-d H:i:s', time()) );

    echo fileRead('test3.txt'), '<br />'.EOL;

    dump(getHeaders());

});

/**/
//Simple route to include module file
router('get', '/about', CMSIF_MODULES.'/about.php');

//Simple HTML page
router('get', '/main', function(){

	headerHTML();

    echo 'User: ', getUser(), '<br />'.EOL;
	echo date_default_timezone_get(), '<br />'.EOL;
	echo cookie('language'), '<br />'.EOL;
	echo version(), '<br />'.EOL;
	echo getId(), '<br />'.EOL;
	echo getModule(), '<br />'.EOL;
	echo getMethod(), '<br />'.EOL;

});

//Routing with IDs
router('get', '/article/([0-9]*)', function($_matches){
	$_out = '';
	switch( $_matches[1] )
	{
		case 1:
			$_out .= '<h3>Article '. (int) $_matches[1].'</h3>'.EOL;
			$_out .= view('This is my article number 1');
			break;
		case 2:
			$_out .= '<h3>Article '. (int) $_matches[1].'</h3>'.EOL;
			$_out .= view( ['This is my second article.', 'This is my second paragraph.'] );
			break;
		default:
			error404();
			break;
	}
	
	if(!empty($_out))
	{
		headerHTML();
		echo $_out;
	}
});

//Complex template
router('get', '/profile', function(){

    fileExecute('/_partials/header.php', ['_type' => 'template']);

    renderBlock('{{ Footer }}', 'footer', 'section');
    renderView('profile');
});

//Rendering of Form template with external and internal assets
router('get', '/form', function(){
    assetExternal('http://necolas.github.com/normalize.css');
    assetExternal('//fonts.googleapis.com/css?family=Roboto', 'css');
    asset('style.css', ['version'=>'123']);

    $_form_fields = [
        'text'     => '{"name": "username", "id": "Username"}',
        'password' => '{"name": "password", "id": "Password"}',
        'submit'   => '{"name": "submit", "id": "Submit"}'
    ];
    form(['method'=>'POST', 'action'=>getHost().'/form', 'fields'=>$_form_fields]);
    renderView('form');
});

//POST action proccessing
router('post', '/form', function(){ 
    dump(filterPOST());
});