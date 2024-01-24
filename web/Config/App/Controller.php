<?php
class Controller
{
    public function __construct()
    {
        
        $this->views = new Views();
        $this->cargarModelo();
        

    }
    public function cargarModelo()
    {
        
        $modelo = get_class($this) . "Model";
        $ruta = "Models/" . $modelo . ".php";

        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $modelo();
        }else{
            echo "<h2>no existe el archivo:' " . $ruta . "'</h2>";
        }

        
    }
}
?>