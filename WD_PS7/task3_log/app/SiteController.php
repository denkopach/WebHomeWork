<?php
class SiteController
{
    private $configs;

    public function __construct()
    {
        $this->configs = Configs::getPath();
    }

    public function actionIndex()
    {
        include $this->configs->header;
        
        if (isset($_SESSION['auth'])) {
            include $this->configs->chatForm;
        } else {
            include $this->configs->authForm;
        };

        include $this->configs->footer;
    }
}
