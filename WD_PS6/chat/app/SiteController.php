<?php
class SiteController
{
    static function actionIndex()
    {
        global $configs;

        include $configs->header;


        CreateDb::create();
        
        if (isset($_SESSION['auth'])) {
            include $configs->chatForm;
        } else {
            include $configs->authForm;
        };

        include $configs->footer;
    }
}
