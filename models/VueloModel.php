<?php


    class VueloModel extends Basedatos{
        private $table;
        private $conexion;
        
        public function __construct(){
            $this->table = "vuelo";
            $this->conexion = $this->getConexion();
        }
        
        public function getAll(){
            try {
                $sql = "SELECT v.identificador, v.aeropuertoorigen, v.aeropuertodestino, v.tipovuelo, v.fechavuelo, "
                        . "a.nombre 'nombre aeropuerto', a.pais, COUNT(p.identificador) 'numpasajero' "
                        . "FROM $this->table v LEFT JOIN pasaje p ON (v.identificador=p.identificador) "
                        . "JOIN aeropuerto a ON v.aeropuertodestino = a.codaeropuerto "
                        . "GROUP BY v.identificador;";
                
                $statement = $this->conexion->query($sql);
                $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
                $statement = null;
                // Retorna el array de registros
                return $registros;
            } catch (PDOException $e) {
                return "ERROR AL CARGAR.<br>" . $e->getMessage();
            }
        }
    }

