<?php
class SuscriptoresModel extends Query
{
    private $suscriptor;
    public function __construct()
    {
        parent::__construct();
        //echo "<h2> Modelo de Home </h2>";
    }

    public function getSuscriptor(string $suscriptor)
    {
        $this->suscriptor  = $suscriptor;
        $sql = "SELECT s.nro_telefonico, s.imsi, s.imei, p.*, o.*
                FROM suscriptores s, padron p, operadoras o
                WHERE s.nro_documento = p.nro_documento
                  AND s.id_operadora  = o.id_operadora
                  AND  s.nro_telefonico = '$this->suscriptor'";
        $data = $this->select($sql);
        return $data;
    }
   // 134,217,728
   //  30,429,184

    public function listarSuscriptores($subsc)
    {
        $sql = "SELECT s.nro_telefonico, s.nro_documento, p.tipo_documento, p.nombre, p.apellidos, p.pais
                        , (SELECT operadora 
                            from operadoras 
                            where id_operadora=s.id_operadora
                            ) as operadora
                    FROM suscriptores s, padron p
                    WHERE s.nro_documento = p.nro_documento
                    AND (s.nro_telefonico LIKE '$subsc%' or s.nro_documento LIKE '$subsc%' )
                      LIMIT 900000";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function buscaIdSuscriptor(int $id)
    {
        $this->id_usuario = $id;
        $sql = "SELECT * FROM usuarios WHERE id = '$this->id_usuario'";
        $data = $this->select($sql);
        return $data;
    }

    public function editarSuscriptor(int $id_suscriptor, string $suscriptor)
    {
        $this->suscriptor      = $suscriptor;
        $this->id_usuario   = $id_usuario;

        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario' AND id != '$this->id_usuario'";
        $existe = $this->select($verificar);

        if (!empty($existe)) {
           $res = "Duplicado";
        } else {
            $sql = "UPDATE usuarios SET usuario = ?, nombre = ? WHERE id = ?";
            $datos = array ($this->usuario, $this->nombre, $this->id_usuario);
            $data = $this->save($sql, $datos);

            if ($data == 1) {
                $res = "Actualizado";
            }else{
                $res = "Error";
            }

        }

        return $res;
    }


}
?>