<?php

session_start();


// CLASE PERSONA


class Persona
{
    protected $nombre;
    protected $apellido;
    protected $fechaNacimiento;

    public function __construct($nombre, $apellido, $fechaNacimiento)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
}


// CLASE ESTUDIANTE


class Estudiante extends Persona
{
    private $codigo;
    private $indice;
    private $anioIngreso;
    private $estado;
    private $grado;
    private $modalidad;

    public function __construct(
        $nombre,
        $apellido,
        $fechaNacimiento,
        $codigo,
        $indice,
        $anioIngreso,
        $estado,
        $grado,
        $modalidad
    )
    {
        parent::__construct($nombre, $apellido, $fechaNacimiento);

        $this->codigo = $codigo;
        $this->indice = $indice;
        $this->anioIngreso = $anioIngreso;
        $this->estado = $estado;
        $this->grado = $grado;
        $this->modalidad = $modalidad;
    }

    public function obtenerDatos()
    {
        return [
            "tipo" => "Estudiante",
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "fecha" => $this->fechaNacimiento,
            "codigo" => $this->codigo,
            "indice" => $this->indice,
            "anio" => $this->anioIngreso,
            "estado" => $this->estado,
            "grado" => $this->grado,
            "modalidad" => $this->modalidad
        ];
    }
}


// CLASE DOCENTE


class Docente extends Persona
{
    private $codigo;
    private $departamento;
    private $categoria;
    private $titulo;
    private $contratacion;

    public function __construct(
        $nombre,
        $apellido,
        $fechaNacimiento,
        $codigo,
        $departamento,
        $categoria,
        $titulo,
        $contratacion
    )
    {
        parent::__construct($nombre, $apellido, $fechaNacimiento);

        $this->codigo = $codigo;
        $this->departamento = $departamento;
        $this->categoria = $categoria;
        $this->titulo = $titulo;
        $this->contratacion = $contratacion;
    }

    public function obtenerDatos()
    {
        return [
            "tipo" => "Docente",
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "fecha" => $this->fechaNacimiento,
            "codigo" => $this->codigo,
            "departamento" => $this->departamento,
            "categoria" => $this->categoria,
            "titulo" => $this->titulo,
            "contratacion" => $this->contratacion
        ];
    }
}


// CREAR LA LISTA


if (!isset($_SESSION["lista"])) {
    $_SESSION["lista"] = [];
}



// GUARDAR LOS DATOS


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $tipo = $_POST["tipo"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fecha = $_POST["fecha"];


    // GUARDAR ESTUDIANTE
    if ($tipo == "Estudiante") {

        $persona = new Estudiante(
            $nombre,
            $apellido,
            $fecha,
            $_POST["codigo"],
            $_POST["indice"],
            $_POST["anio"],
            $_POST["estado"],
            $_POST["grado"],
            $_POST["modalidad"]
        );

        $_SESSION["lista"][] = $persona->obtenerDatos();
    }


    // GUARDAR DOCENTE
    if ($tipo == "Docente") {

        $persona = new Docente(
            $nombre,
            $apellido,
            $fecha,
            $_POST["codigo"],
            $_POST["departamento"],
            $_POST["categoria"],
            $_POST["titulo"],
            $_POST["contratacion"]
        );

        $_SESSION["lista"][] = $persona->obtenerDatos();
    }
}

?>


<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Registro de Personas</title>

</head>

<body>


<h1>Registro de Personas</h1>


<form method="POST">


    <label>Tipo de persona:</label>

    <select name="tipo" id="tipo" onchange="mostrarCampos()" required>

        <option value="">Seleccione</option>

        <option value="Estudiante">Estudiante</option>

        <option value="Docente">Docente</option>

    </select>

    <br><br>


    <label>Nombre:</label>

    <input type="text" name="nombre" required>

    <br><br>


    <label>Apellido:</label>

    <input type="text" name="apellido" required>

    <br><br>


    <label>Fecha de nacimiento:</label>

    <input type="date" name="fecha" required>

    <br><br>


    <label>Código:</label>

    <input type="text" name="codigo" required>

    <br><br>



    <!-- CAMPOS DEL ESTUDIANTE -->

    <div id="estudiante" style="display:none;">


        <label>Índice académico:</label>

        <input type="number" step="0.01" name="indice">

        <br><br>


        <label>Año de ingreso:</label>

        <input type="number" name="anio">

        <br><br>


        <label>Estado académico:</label>

        <select name="estado">

            <option value="Activo">Activo</option>

            <option value="Inactivo">Inactivo</option>

            <option value="Retirado">Retirado</option>

        </select>

        <br><br>


        <label>Grado:</label>

        <input type="number" name="grado">

        <br><br>


        <label>Modalidad:</label>

        <select name="modalidad">

            <option value="Presencial">Presencial</option>

            <option value="Virtual">Virtual</option>

            <option value="Híbrida">Híbrida</option>

        </select>

        <br><br>

    </div>



    <!-- CAMPOS DEL DOCENTE -->

    <div id="docente" style="display:none;">


        <label>Departamento o Facultad:</label>

        <input type="text" name="departamento">

        <br><br>


        <label>Categoría:</label>

        <select name="categoria">

            <option value="Titular">Titular</option>

            <option value="Adjunto">Adjunto</option>

            <option value="Especial">Especial</option>

            <option value="Interino">Interino</option>

        </select>

        <br><br>


        <label>Máximo título académico:</label>

        <input type="text" name="titulo">

        <br><br>


        <label>Tipo de contratación:</label>

        <select name="contratacion">

            <option value="Tiempo Completo">
                Tiempo Completo
            </option>

            <option value="Tiempo Parcial">
                Tiempo Parcial
            </option>

            <option value="Por Horas">
                Por Horas
            </option>

        </select>

        <br><br>

    </div>


    <input type="submit" value="Guardar">


</form>


<hr>


<h2>Lista de personas registradas</h2>


<?php

if (empty($_SESSION["lista"])) {

    echo "Todavía no hay personas registradas.";

} else {

    foreach ($_SESSION["lista"] as $persona) {

        echo "<p>";

        echo "<strong>Tipo:</strong> "
            . $persona["tipo"] . "<br>";

        echo "<strong>Nombre:</strong> "
            . $persona["nombre"] . " "
            . $persona["apellido"] . "<br>";

        echo "<strong>Fecha de nacimiento:</strong> "
            . $persona["fecha"] . "<br>";

        echo "<strong>Código:</strong> "
            . $persona["codigo"] . "<br>";


        // DATOS DEL ESTUDIANTE

        if ($persona["tipo"] == "Estudiante") {

            echo "<strong>Índice:</strong> "
                . $persona["indice"] . "<br>";

            echo "<strong>Año de ingreso:</strong> "
                . $persona["anio"] . "<br>";

            echo "<strong>Estado:</strong> "
                . $persona["estado"] . "<br>";

            echo "<strong>Grado:</strong> "
                . $persona["grado"] . "<br>";

            echo "<strong>Modalidad:</strong> "
                . $persona["modalidad"] . "<br>";
        }


        // DATOS DEL DOCENTE

        if ($persona["tipo"] == "Docente") {

            echo "<strong>Departamento:</strong> "
                . $persona["departamento"] . "<br>";

            echo "<strong>Categoría:</strong> "
                . $persona["categoria"] . "<br>";

            echo "<strong>Título académico:</strong> "
                . $persona["titulo"] . "<br>";

            echo "<strong>Contratación:</strong> "
                . $persona["contratacion"] . "<br>";
        }


        echo "</p>";

        echo "<hr>";
    }
}

?>


<script>

function mostrarCampos()
{
    let tipo = document.getElementById("tipo").value;

    document.getElementById("estudiante").style.display = "none";

    document.getElementById("docente").style.display = "none";


    if (tipo == "Estudiante")
    {
        document.getElementById("estudiante").style.display = "block";
    }


    if (tipo == "Docente")
    {
        document.getElementById("docente").style.display = "block";
    }
}

</script>


</body>

</html>