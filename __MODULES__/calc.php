<?
assetExternal('//fonts.googleapis.com/css?family=Roboto', 'css');
asset('style.css');

$_content = '';
$_prices = getPrices();
$_percent = 'Средний процент наценки с налогами и отчислениями: ';

$_content .= '<h3>Метро * (1.113 + 0.01396*MUY + IVA*(0.011128+0.000114498*MUY) ) + 3/20</h3>'. EOL;
$_content .= '<div class="prices">'. EOL;
$_total_percent = 0;

foreach($_prices as $_v)
{
	list($_price_percent, $_out) = getPrice($_v['price'], $_v['IVA'], $_v['MUY']);
	$_total_percent += $_price_percent;
	$_content .= $_out;
}

$_content .= '</div>'. EOL;
$_content .= $_percent. number_format($_total_percent / count($_prices), '2', '.', ''). '<br />'. EOL;

$_content .= '<hr />';	
$_content .= '<h3>(Метро + IVA)+2(Отчисления+IVA)+(MUY+IVA)</h3>'. EOL;
$_content .= '<div class="prices">'. EOL;
$_total_percent = 0;

foreach($_prices as $_v)
{
	list($_price_percent, $_out) = getPavelPrice($_v['price'], $_v['IVA'], $_v['MUY']);
	$_total_percent += $_price_percent;
	$_content .= $_out;
}
$_content .= '</div>'. EOL;
$_content .= $_percent. number_format($_total_percent / count($_prices), '2', '.', ''). '<br />'. EOL;

renderBlock($_content, 'content');
renderHTML('main');

function getPrice($_price = 0.0, $MUY = 0, $IVA = 0)
{
	$_price_Y = number_format($_price*(1.113 + 0.01396*$MUY + $IVA*(0.011128+0.000114498*$MUY))+0.15, 2, '.', '');
	
	$_price_percent = number_format((($_price_Y/$_price)*100)-100, 2, '.', '');
	
	$_out = $_price .'=>'. $_price_Y .'=>'. $_price_percent .'%'. '<br />'. EOL;
	
	return [$_price_percent, $_out];
}

function getPavelPrice($_price = 0.0, $MUY = 0, $IVA = 0)
{
	$_partner = 13.5; //%

	$_price_Y = ($_price + ($_price/100)*$IVA); //(Метро + IVA)
	$_price_Y += 2 * ((($_price/100)*$_partner) + ((($_price/100)*$_partner)/100)*$IVA); //2(Отчисления+IVA)
	$_price_Y += ($_price/100)*$MUY + ($_price/100)*$IVA; //(MUY+IVA)

	$_price_Y = number_format( $_price_Y, 2, '.', '');
	
	$_price_percent = number_format((($_price_Y/$_price)*100)-100, 2, '.', '');

	$_out = $_price .'=>'. $_price_Y .'=>'. $_price_percent .'%'. '<br />'. EOL;
	
	return [$_price_percent, $_out];
}

function getPrices()
{
	$_prices_HRV = <<<EOB
1.21, 25, 10
11.31, 25, 8
1.12, 25, 20
3.89, 25, 18
10.38, 25, 8
1.75, 25, 15
0.99, 25, 21
10.75, 25, 8
2.56, 25, 15
8.76, 25, 10
8.76, 25, 10
8.76, 25, 10
6.54, 25, 12
15.90, 25, 8
13.48, 25, 13
21.97, 10, 8
3.56, 25, 30
1.86, 25, 30
3.79, 25, 10
1.86, 25, 20
3.56, 25, 21
1.15, 25, 32
0.89, 25, 32
2.16, 25, 26
2.15, 25, 32
1.82, 25, 26
2.45, 25, 21
2.42, 25, 21
5.36, 25, 21
0.54, 25, 32
3.28, 25, 18
4.18, 25, 15
3.03, 25, 15
14.96, 25, 10
5.94, 25, 26
1.21, 25, 8
4.49, 25, 8
1.34, 25, 8
9.43, 25, 15
1.84, 25, 21
13.21, 25, 8
1.62, 25, 31
26.28, 25, 32
1.62, 25, 32
2.02, 25, 32
2.56, 25, 32
1.89, 25, 21
1.21, 26, 21
1.28, 25, 21
12.40, 25, 21
2.74, 25, 21
2.02, 25, 15
0.94, 25, 32
0.91, 25, 10
1.29, 25, 41
0.50, 25, 32
2.96, 25, 15
3.10, 25, 21
6.28, 25, 15
4.85, 25, 20
9.52, 25, 20
2.77, 25, 32
10.11, 25, 10
1.90, 25, 15
0.96, 25, 15
1.98, 25, 15
1.98, 25, 23
1.48, 25, 15
2.65, 25, 36
2.36, 25, 23
15.23, 25, 8
14.55, 25, 8
18.46, 25, 8
1.21, 25, 8
7.43, 25, 21
3.08, 25, 21
25.47, 26, 15
16.31, 25, 8
2.25, 25, 10
2.84, 25, 10
0.43, 25, 32
0.73, 25, 32
2.45, 25, 32
8.30, 25, 10
0.68, 25, 3
13.88, 25, 15
8.00, 25, 15
1.48, 25, 42
2.72, 25, 37
1.18, 25, 42
3.07, 25, 37
3.00, 25, 23
6.20, 25, 17
2.51, 25, 18
3.88, 25, 9
2.31, 25, 23
5.68, 25, 22
7.81, 25, 10
5.05, 25, 8
5.53, 25, 21
2.88, 25, 12
1.85, 25, 8
1.79, 25, 10
3.56, 25, 15
1.31, 25, 130
14.55, 25, 12
0.81, 25, 180
5.77, 25, 15
18.96, 25, 8
1.89, 25, 42
1.89, 25, 8
1.08, 25, 15
0.87, 25, 15
1.48, 25, 42
1.15, 25, 32
2.13, 25, 32
38.41, 25, 6
33.69, 25, 7
2.22, 26, 5
13.10, 25, 5
3.25, 25, 21
8.84, 25, 20
7.64, 25, 20
5.77, 25, 20
26.14, 25, 32
1.38, 25, 21
2.84, 25, 21
1.15, 25, 21
0.79, 25, 10
1.75, 25, 53
1.70, 25, 21
2.46, 25, 21
1.85, 25, 19
4.04, 25, 42
9.44, 25, 8
0.62, 25, 52
12.59, 25, 12
14.52, 25, 10
6.20, 25, 8
8.80, 25, 12
8.36, 25, 8
15.77, 25, 15
3.77, 25, 78
20.89, 25, 78
1.49, 25, 32
0.85, 25, 15
14.42, 25, 8
1.67, 25, 8
11.53, 25, 8
5.91, 25, 8
10.81, 25, 8
9.44, 25, 15
9.44, 26, 20
9.44, 27, 10
9.44, 28, 10
9.44, 29, 10
9.44, 30, 32
9.44, 31, 20
9.44, 32, 10
8.89, 33, 10
9.44, 34, 3
1.05, 25, 15
1.64, 25, 72
5.23, 25, 15
6.51, 25, 32
5.58, 25, 32
1.78, 25, 15
14.82, 26, 10
1.70, 25, 15
2.01, 25, 72
7.07, 25, 42
1.77, 25, 32
25.87, 25, 8
EOB;

	$_prices = explode("\n", $_prices_HRV);
	$_out = [];
	foreach($_prices as $_line)
	{
		list($_price, $_MUY, $_IVA) = explode(', ', $_line);
		$_out[] = ['price'=>$_price, 'MUY'=>$_MUY, 'IVA'=>$_IVA];
	}
	return $_out;
}