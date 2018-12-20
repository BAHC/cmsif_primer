<?php
assetExternal('//fonts.googleapis.com/css?family=Roboto', 'css');
asset('style.css');

$_content = '<p>Test content</p>';

renderBlock($_content, 'content');
renderView('main');