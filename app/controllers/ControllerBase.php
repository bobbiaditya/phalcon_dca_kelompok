<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    // Implement common logic
    public function onConstruct(){
        $this->assets->addCss("plugins/datatables-bs4/css/dataTables.bootstrap4.css"); 
        $this->assets->addCss("plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css");
        $this->assets->addCss("plugins/fontawesome-free/css/all.min.css");
        $this->assets->addCss("plugins/overlayScrollbars/css/OverlayScrollbars.min.css");
        $this->assets->addCss("dist/css/adminlte.min.css");
        $this->assets->addJs("plugins/jquery/jquery.min.js");
        $this->assets->addJs("plugins/bootstrap/js/bootstrap.bundle.min.js");
        $this->assets->addJs("dist/js/adminlte.min.js");
        $this->assets->addJs("plugins/datatables/jquery.dataTables.js");
        $this->assets->addJs("plugins/datatables-bs4/js/dataTables.bootstrap4.js");
        $this->assets->addJs("plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js");
        $this->assets->addJs("dist/js/demo.js");
        $this->assets->addJs("bootstrap-colorpicker/js/bootstrap-colorpicker.min.js");
    }


    // public function beforeExecuteRoute() {
    //     if (!$this->ses) {
    //         // $this->view->disable();
    //         $this->response->redirect('/');
    //         return false;
    //     }
    // }
}
