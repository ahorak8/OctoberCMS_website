<?php namespace OFFLINE\SiteSearch\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class QueryLogs extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ImportExportController',
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = ['offline.sitesearch.view_log'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('OFFLINE.SiteSearch', 'querylogs');
    }
}
