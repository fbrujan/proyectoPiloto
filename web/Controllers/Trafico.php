<?php
class Trafico extends Controller
{
    private $msg;
    public function __construct()
    {
        session_start();
        
        parent::__construct();
        
    }
    
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        
       //print "<h2>Metodo Index del Controlador Home funcionando </h2>";
       $this->views->getView($this, "index");
       // print_r($this->model->getUsuario());

    }
   

    public function listar($subsc)
    {
       
        $data = $this->model->listarTrafico($subsc);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnCopyCall('.$data[$i]['codigo_llamada'] .')"><i class="fas fa-copy"></i></button>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
       
        
    }

    public function editar(int $id)
    {
        $data = $this->model->buscaIdUsuario($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

   

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }
    
}

?>

