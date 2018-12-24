<?php
assetExternal('//fonts.googleapis.com/css?family=Roboto', 'css');
asset('style.css');

$content = '<p>Test content</p>';

renderBlock($content, 'content');
renderView('main');