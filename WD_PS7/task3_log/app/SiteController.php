<?php
class SiteController
{
    public $configs;

    public function __construct($configs)
    {
        $this->configs = $configs;
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
