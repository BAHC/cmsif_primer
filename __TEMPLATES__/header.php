<?php
assetExternal('//code.jquery.com/jquery-3.3.1.min.js', ['type'=>'js']);
assetExternal('//stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css', ['type'=>'css', 'integrity'=>"sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4", 'crossorigin'=>'anonymous']);
assetExternal('//stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js', ['type'=>'js', 'integrity'=>"sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm", 'crossorigin'=>'anonymous']);
assetExternal('//use.fontawesome.com/releases/v5.6.1/css/all.css', ['integrity'=>'sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP', 'crossorigin'=>'anonymous']);
assetExternal('//cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.11/combined/css/gijgo.min.css', ['integrity'=>'sha256-+SmN5AjG3w6rAfc/L0ymwbqgVHAwcrlY2BJ+UPrHAu8=', 'crossorigin'=>'anonymous']);
assetExternal('//cdnjs.cloudflare.com/ajax/libs/gijgo/1.9.11/combined/js/gijgo.min.js', ['type'=>'js', 'integrity'=>'sha256-tSw4SLa+RaPWT9nWC8vm2aQqkwOmJEEFQOEOENKhyKA=', 'crossorigin'=>'anonymous']);

assetExternal('//fonts.googleapis.com/css?family=Roboto', ['type'=>'css', 'media'=>'all']);

asset('style.css',['version'=>dataGet('VERSION', 'v1')]);
asset('app.js',['version'=>dataGet('VERSION', 'v1')]);

$s_out = '
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="'. getHost() .'/">
    <i class="far fa-file logo"></i>
    </a>
    <span class="navbar-text">
        <a href="'. getHost() .'/profile" alt="Profile"><i id="profileTop" class="fas fa-user"></i></a>
        <a href="#"><i id="languageTop" class="fas fa-language"></i></a><i id="menuTop" class="fas fa-bars"></i>
    </span>
</nav>';

renderBlock($s_out, 'header');

$_info = sessionGet('info');
if(!empty($_info))
{
    $_info = '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong><i class="fas fa-info-circle"></i></strong> '. $_info .'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>';

    renderBlock($_info, 'notify');
    sessionFlush('info');
}

$_error = sessionGet('error');
if(!empty($_error))
{
    renderBlock($_error, 'error');
    sessionFlush('error');
}