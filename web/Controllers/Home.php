<?php
class Home  extends Controller
{
    public function __construct()
    {
        session_start();
        if (!empty($_SESSION['activo'])) {
            header("location: " . base_url . "usuarios");
        }
        parent::__construct();
    }
    public function index()
    {
        //print "<h2>Metodo Index del Controlador Home funcionando </h2>";
        $this->views->getView($this, "index");
    }
    
}

?>