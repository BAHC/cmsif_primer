$(function(){

    /* https://stackoverflow.com/questions/14744437/html-select-box-not-showing-drop-down-arrow-on-android-version-4-0-when-set-with */
    var nua = navigator.userAgent
    var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1)
    if (isAndroid) {
      $('select.form-control').removeClass('form-control').css('width', '100%')
    }

    var infoMessage = document.getElementById("info");
    var errorMessage = document.getElementById("error");

    if(null!=infoMessage)
    {
        infoMessage.classList.add('success');
    }

    if(null!=errorMessage)
    {
        errorMessage.classList.add('error');
    }

    if(!!$('.alert')) $('.alert').alert();

    var App = {};

})();