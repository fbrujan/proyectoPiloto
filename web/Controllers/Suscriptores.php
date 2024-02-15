<?php
class Suscriptores extends Controller
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
        
        $data = $this->model->listarSuscriptores($subsc);
        for ($i=0; $i < count($data); $i++) { 
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditSusc('.$data[$i]['nro_telefonico'] .')"><i class="fas fa-list-ol"></i></button>
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


/*
EL dia de San Valentin, una fecha marcada por el amor y la amistad en muchos corazones, esconde un origen menos conocido.
San Valentin se origina en festividades paganas que celebraban el amor y la fertilidad de maneras que contradicen nuestros principios cristianos.
Esta festividades, conocidas como Lupercalia, estaban llenas de prácticas que no honran el diseño de Dios para el amor y las relaciones.
La transformación de estas celebraciones  en un dia "cristiano" no borra su origen pagano.

Como cristianos estamos llamadas a ser luz en la oscuridad, eligiendo celebraciones que reflejen la santidad y el amor verdadero que proviene de Dios.

Los cristianos no celebramos a los santos puesto que nuestra adoracion es a Dios y no a los hombres.

No corramos en el mismo desenfreno del mundo


No améis al mundo, ni las cosas que están en el mundo. Si alguno ama al mundo, el amor del Padre no está en él. 
Porque todo lo que hay en el mundo, los deseos de la carne, los deseos de los ojos, y la vanagloria de la vida, no proviene del Padre, sino del mundo.
Y el mundo pasa, y sus deseos; pero el que hace la voluntad de Dios permanece para siempre.
1 Juan 2:15-17
*/
?>
