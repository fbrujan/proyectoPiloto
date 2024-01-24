<?php
class Usuarios  extends Controller
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
       $this->views->getView($this, "index", $data);
       // print_r($this->model->getUsuario());

    }

    public function validar()
    {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg =  "Los campos estan vacios";
        }else{
            $usuario    = strtolower($_POST['usuario']);
            $clave      = hash('SHA256',$_POST['clave']);

            $data = $this->model->getUsuario($usuario, $clave);

            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['activo'] = true;
                $this->msg = "OK";
            }else{
                $this->msg="Usuario o Contraseña Inválida";
            }

            
        }

        echo json_encode($this->msg, JSON_UNESCAPED_UNICODE);
    }

    public function listar()
    {
        $data = $this->model->listarUsuarios();
       
        for ($i=0; $i < count($data); $i++) { 
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarUsuario('.$data[$i]['id'] .')"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger"  type="button" onclick="btnEliminarUsuario('.$data[$i]['id'] .')"><i class="fas fa-trash-alt"></i></button>
                </div>';

            }else{
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success"  type="button" onclick="btnReingresarUsuario('.$data[$i]['id'] .')"><i class="fas fa-check"></i></button>
                </div>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $usuario    = strtolower($_POST['usuario']);
        $nombre     = ucwords($_POST['nombre']);
        $clave      = $_POST['clave'];
        $confirmar  = $_POST['confirmar'];

        if (empty($usuario) || empty($nombre)) {
            $this->msg = "Todos los campos son obligatorios";
        } else {
            if ($_POST['id_usuario'] == "") {
                if($clave != $confirmar){
                    $this->msg = "Las Contraseñas no coinciden";
                } else if (empty($clave)){
                    $this->msg = "La clave no puede estar en blanco";
                }else {

                    // Registrar el usuario;
                    $claveHash  = hash("SHA256",$clave); // Encriptar la contraseña

                    $data =  $this->model->registrarUsuario($usuario, $nombre, $claveHash);

                    if ($data == "OK") {
                        $this->msg = "OK";            
                    } else if ($data == "Existe") {
                        $this->msg = "Err-Reg-00: Error al agregar, El usuario ya existe";
                    } else {
                        $this->msg = "Err-Reg-01:  No se pudo agregar el usuario";
                    }
                }

            } else {
                // Editar el usuario;
                $id = $_POST['id_usuario'];
                $data = $this->model->editarUsuario($id, $usuario, $nombre);

                if ($data == "Duplicado") {
                    $this->msg = "Err-Edit-00: Error al Editar. El usuario ya esta en uso.";
                }else if ($data == "Actualizado") {
                    $this->msg = "Actualizado";
                }else {
                    $this->msg = "Err-Edit-01: No se pudo editar al usuario";
                }

            }
           

        }
        echo json_encode($this->msg, JSON_UNESCAPED_UNICODE);
        die();

    }

    public function editar(int $id)
    {
        $data = $this->model->buscaIdUsuario($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $id)
    {
       $data = $this->model->accionUsuario($id, 0);
        if ($data == "OK") {
            $this->msg = "OK";            
        } else {
            $this->msg = "Err-Del-00:  No se pudo Eliminar el usuario";
        }
        
        echo json_encode($this->msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $id)
    {
       $data = $this->model->accionUsuario($id, 1);
        if ($data == "OK") {
            $this->msg = "OK";            
        } else {
            $this->msg = "Err-Hab-00:  No se pudo Reingresar el usuario";
        }
        
        echo json_encode($this->msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function salir()
    {
        session_destroy();
        header("location: " . base_url);
    }
    
}

?>

