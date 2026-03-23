<?php 
// Clase Database: 
class Database {
    // Propiedad privada para la conexión:
    private $connection;

    // Constructor que junta los parámetros para realizar la conexión a la base de datos:
    public function __construct($host_name, $host_admin, $host_admin_password, $database_name) {
        // Conexión a la base de datos:
        $this->connection = mysqli_connect($host_name, $host_admin, $host_admin_password, $database_name);

        // Si la conexión falla, $this->connection será false, el Controller se encargará de verificarlo  
    }

    // Método público que retorna la conexión a la base de datos:
    public function getConnection(){
        return $this->connection;
    }

    // Método público que cierra la conexión a la base de datos:
    public function closeConnection(){
        if($this->connection){
            mysqli_close($this->connection);
        }
    }
}
?>