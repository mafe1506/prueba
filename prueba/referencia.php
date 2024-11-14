<?php

// Clase Referencia
class Referencia {
    public $nombre;
    public $cantidadDeMoldes;
    public $juegosPorMolde;
    public $gramosPorJuego;
    public $tipo; // Puede ser "Muela" o "Diente"
    public $capas; // Puede ser "2C" o "4C"

    // Constructor para inicializar las propiedades
    public function __construct($nombre, $cantidadDeMoldes, $juegosPorMolde, $gramosPorJuego, $tipo, $capas) {
        $this->nombre = $nombre;
        $this->cantidadDeMoldes = $cantidadDeMoldes;
        $this->juegosPorMolde = $juegosPorMolde;
        $this->gramosPorJuego = $gramosPorJuego;
        $this->tipo = $tipo;
        $this->capas = $capas;
    }

    // Método para aumentar en 1 la cantidad de moldes
    public function actualizarMoldes() {
        $this->cantidadDeMoldes += 1;
    }
}

// Subclase ReferenciaDePrueba que hereda de Referencia
class ReferenciaDePrueba extends Referencia {
    public $materialDelMolde;

    // Constructor que inicializa también la propiedad adicional
    public function __construct($nombre, $cantidadDeMoldes, $juegosPorMolde, $gramosPorJuego, $tipo, $capas, $materialDelMolde) {
        parent::__construct($nombre, $cantidadDeMoldes, $juegosPorMolde, $gramosPorJuego, $tipo, $capas);
        $this->materialDelMolde = $materialDelMolde;
    }

    // Sobrescritura del método ActualizarMoldes para aumentar en 10 la cantidad de moldes
    public function actualizarMoldes() {
        $this->cantidadDeMoldes += 10;
    }
}

// Crear una instancia de Referencia
$ref1 = new Referencia("Referencia1", 5, 3, 10.5, "Muela", "2C");
echo "Nombre: " . $ref1->nombre . ", Moldes: " . $ref1->cantidadDeMoldes . "<br>";

// Llamar a actualizar moldes
$ref1->actualizarMoldes();
echo "Después de actualizar, Moldes: " . $ref1->cantidadDeMoldes . "<br>";

// Crear una instancia de ReferenciaDePrueba
$ref2 = new ReferenciaDePrueba("Referencia2", 5, 3, 10.5, "Diente", "4C", "Acero");
echo "Nombre: " . $ref2->nombre . ", Moldes: " . $ref2->cantidadDeMoldes . ", Material: " . $ref2->materialDelMolde . "<br>";

// Llamar a actualizar moldes
$ref2->actualizarMoldes();
echo "Después de actualizar, Moldes: " . $ref2->cantidadDeMoldes . "<br>";

?>
