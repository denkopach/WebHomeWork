<?php
class SiteController
{
    static function actionIndex()
    {
        global $configs;
        include $configs->header;

        if ($configs->createDb)  {
                CreateDb::create();
                $configs->createDb = false;
            }
        
        if (isset($_SESSION['auth'])) {
            include $configs->chatForm;
        } else {
            include $configs->authForm;
        };

        include $configs->footer;
    }
}
