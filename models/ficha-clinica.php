<?php
include_once("../models/hijo.php");
include_once("../models/antecedente-paciente.php");
include_once("../models/antecedente-familia.php");
class Ficha
{
    private $id;
    private $paciente;
    private $tipoSangre;
    private $quienRecomendo;
    private $embarazo;
    private $partos;
    private $cesareas;
    private $abortos;
    private $muertos;
    private $enfs;
    private $fuma;
    private $cigarrosDia;
    private $fumaAntiguedad;
    private $alcohol;
    private $alcFrecuencia;
    private $alcoholCantidad;
    private $alcoholTipos;
    private $adicciones;
    private $alergias;
    private $desayuno;
    private $comida;
    private $cena;
    private $entreComidas;
    private $vasoAguaDia;
    private $otrosLiquidos;
    private $intolerancias;
    private $orinaDia;
    private $orinaNoche;
    private $orinaColor;
    private $orinaOlor;
    private $orinaMolestias;
    private $excrementoDia;
    private $exConsistencia;
    private $exOlor;
    private $exColor;
    private $exDolor;
    private $fechaMenstruacion;
    private $mensPeriodicidad;
    private $mensMolestias;
    private $ejercicioSemana;
    private $fecha;
    private $firmaPaciente;
    private $firmaUsuario;
    private $hora;
    private $usuario;
    private $hijos = array();
    private $antecedentes = array();
    private $antecedentesFam = array();
    private $dbh;
    public function __construct(
    ) {
        try {
            $dbname = "consultorio";
            $user = "root";
            $password = "";
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
            $dsn = "mysql:host=localhost;dbname=$dbname";
            $this->dbh = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //SET GET
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }
    public function setValues($paciente, $tipoSangre, $quienRecomendo, $embarazo, $partos, $cesareas, $abortos, $muertos, $enfs, $fuma, $cigarrosDia, $fumaAntiguedad, $alcohol, $alcFrecuencia, $alcoholCantidad, $alcoholTipos, $adicciones, $alergias, $desayuno, $comida, $cena, $entreComidas, $vasoAguaDia, $otrosLiquidos, $intolerancias, $orinaDia, $orinaNoche, $orinaColor, $orinaOlor, $orinaMolestias, $excrementoDia, $exConsistencia, $exOlor, $exColor, $exDolor, $fechaMenstruacion, $mensPeriodicidad, $mensMolestias, $ejercicioSemana, $fecha, /*$firmaUsuario, $firmaPaciente, */$hora, $usuario)
    {
        $this->paciente = $paciente;
        $this->tipoSangre = $tipoSangre;
        $this->quienRecomendo = $quienRecomendo;
        $this->embarazo = $embarazo;
        $this->partos = $partos;
        $this->cesareas = $cesareas;
        $this->abortos = $abortos;
        $this->muertos = $muertos;
        $this->enfs = $enfs;
        $this->fuma = $fuma;
        $this->cigarrosDia = $cigarrosDia;
        $this->fumaAntiguedad = $fumaAntiguedad;
        $this->alcohol = $alcohol;
        $this->alcFrecuencia = $alcFrecuencia;
        $this->alcoholCantidad = $alcoholCantidad;
        $this->alcoholTipos = $alcoholTipos;
        $this->adicciones = $adicciones;
        $this->alergias = $alergias;
        $this->desayuno = $desayuno;
        $this->comida = $comida;
        $this->cena = $cena;
        $this->entreComidas = $entreComidas;
        $this->vasoAguaDia = $vasoAguaDia;
        $this->otrosLiquidos = $otrosLiquidos;
        $this->intolerancias = $intolerancias;
        $this->orinaDia = $orinaDia;
        $this->orinaNoche = $orinaNoche;
        $this->orinaColor = $orinaColor;
        $this->orinaOlor = $orinaOlor;
        $this->orinaMolestias = $orinaMolestias;
        $this->excrementoDia = $excrementoDia;
        $this->exConsistencia = $exConsistencia;
        $this->exOlor = $exOlor;
        $this->exColor = $exColor;
        $this->exDolor = $exDolor;
        $this->fechaMenstruacion = $fechaMenstruacion;
        $this->mensPeriodicidad = $mensPeriodicidad;
        $this->mensMolestias = $mensMolestias;
        $this->ejercicioSemana = $ejercicioSemana;
        $this->fecha = $fecha; /*
$this->firmaUsuario = $firmaUsuario;
echo $firmaUsuario;
$this->firmaPaciente = $firmaPaciente;
echo $firmaPaciente;*/
        $this->hora = $hora;
        $this->usuario = $usuario;
    }
    public function getValues()
    {
        return [
            'id' => $this->id,
            'paciente' => $this->paciente,
            'tipoSangre' => $this->tipoSangre,
            'quienRecomendo' => $this->quienRecomendo,
            'embarazo' => $this->embarazo,
            'partos' => $this->partos,
            'cesareas' => $this->cesareas,
            'abortos' => $this->abortos,
            'muertos' => $this->muertos,
            'enfs' => $this->enfs,
            'fuma' => $this->fuma,
            'cigarrosDia' => $this->cigarrosDia,
            'fumaAntiguedad' => $this->fumaAntiguedad,
            'alcohol' => $this->alcohol,
            'alcFrecuencia' => $this->alcFrecuencia,
            'alcoholCantidad' => $this->alcoholCantidad,
            'alcoholTipos' => $this->alcoholTipos,
            'adicciones' => $this->adicciones,
            'alergias' => $this->alergias,
            'desayuno' => $this->desayuno,
            'comida' => $this->comida,
            'cena' => $this->cena,
            'entreComidas' => $this->entreComidas,
            'vasoAguaDia' => $this->vasoAguaDia,
            'otrosLiquidos' => $this->otrosLiquidos,
            'intolerancias' => $this->intolerancias,
            'orinaDia' => $this->orinaDia,
            'orinaNoche' => $this->orinaNoche,
            'orinaColor' => $this->orinaColor,
            'orinaOlor' => $this->orinaOlor,
            'orinaMolestias' => $this->orinaMolestias,
            'excrementoDia' => $this->excrementoDia,
            'exConsistencia' => $this->exConsistencia,
            'exOlor' => $this->exOlor,
            'exColor' => $this->exColor,
            'exDolor' => $this->exDolor,
            'fechaMenstruacion' => $this->fechaMenstruacion,
            'mensPeriodicidad' => $this->mensPeriodicidad,
            'mensMolestias' => $this->mensMolestias,
            'ejercicioSemana' => $this->ejercicioSemana,
            'fecha' => $this->fecha,
            'firmaPaciente' => $this->firmaPaciente,
            'firmaUsuario' => $this->firmaUsuario,
            'hora' => $this->hora,
            'usuario' => $this->usuario,
            'hijos' => $this->getHijos(),
            'antecedentes' => $this->getAntecedentes(),
            'antecedentesFam' => $this->getAntecedentesFam()
        ];
    }
    //SET GET
    function insertar()
    {
        $query = "INSERT INTO ficha (paciente, tipoSangre, quienRecomendo, embarazo, partos, cesareas, abortos, muertos, enfs, fuma, cigarrosDia, fumaAntiguedad, alcohol, alcFrecuencia, alcoholCantidad, alcoholTipos, adicciones, alergias, desayuno, comida, cena, entreComidas, vasoAguaDia, otrosLiquidos, intolerancias, orinaDia, orinaNoche, orinaColor, orinaOlor, orinaMolestias, excrementoDia, exConsistencia, exOlor, exColor, exDolor, fechaMenstruacion, mensPeriodicidad, mensMolestias, ejercicioSemana, fecha, firmaUsuario, firmaPaciente, hora, usuario) 
                  VALUES (:paciente, :tipoSangre, :quienRecomendo, :embarazo, :partos, :cesareas, :abortos, :muertos, :enfs, :fuma, :cigarrosDia, :fumaAntiguedad, :alcohol, :alcFrecuencia, :alcoholCantidad, :alcoholTipos, :adicciones, :alergias, :desayuno, :comida, :cena, :entreComidas, :vasoAguaDia, :otrosLiquidos, :intolerancias, :orinaDia, :orinaNoche, :orinaColor, :orinaOlor, :orinaMolestias, :excrementoDia, :exConsistencia, :exOlor, :exColor, :exDolor, :fechaMenstruacion, :mensPeriodicidad, :mensMolestias, :ejercicioSemana, :fecha, :firmaUsuario, :firmaPaciente, :hora, :usuario); ";
        try {
            $stmt = $this->dbh->prepare($query);
            // Vincula los parámetros con los valores reales
            $stmt->bindParam(':paciente', $this->paciente);
            $stmt->bindParam(':tipoSangre', $this->tipoSangre);
            $stmt->bindParam(':quienRecomendo', $this->quienRecomendo);
            $stmt->bindParam(':embarazo', $this->embarazo);
            $stmt->bindParam(':partos', $this->partos);
            $stmt->bindParam(':cesareas', $this->cesareas);
            $stmt->bindParam(':abortos', $this->abortos);
            $stmt->bindParam(':muertos', $this->muertos);
            $stmt->bindParam(':enfs', $this->enfs);
            $stmt->bindParam(':fuma', $this->fuma);
            $stmt->bindParam(':cigarrosDia', $this->cigarrosDia);
            $stmt->bindParam(':fumaAntiguedad', $this->fumaAntiguedad);
            $stmt->bindParam(':alcohol', $this->alcohol);
            $stmt->bindParam(':alcFrecuencia', $this->alcFrecuencia);
            $stmt->bindParam(':alcoholCantidad', $this->alcoholCantidad);
            $stmt->bindParam(':alcoholTipos', $this->alcoholTipos);
            $stmt->bindParam(':adicciones', $this->adicciones);
            $stmt->bindParam(':alergias', $this->alergias);
            $stmt->bindParam(':desayuno', $this->desayuno);
            $stmt->bindParam(':comida', $this->comida);
            $stmt->bindParam(':cena', $this->cena);
            $stmt->bindParam(':entreComidas', $this->entreComidas);
            $stmt->bindParam(':vasoAguaDia', $this->vasoAguaDia);
            $stmt->bindParam(':otrosLiquidos', $this->otrosLiquidos);
            $stmt->bindParam(':intolerancias', $this->intolerancias);
            $stmt->bindParam(':orinaDia', $this->orinaDia);
            $stmt->bindParam(':orinaNoche', $this->orinaNoche);
            $stmt->bindParam(':orinaColor', $this->orinaColor);
            $stmt->bindParam(':orinaOlor', $this->orinaOlor);
            $stmt->bindParam(':orinaMolestias', $this->orinaMolestias);
            $stmt->bindParam(':excrementoDia', $this->excrementoDia);
            $stmt->bindParam(':exConsistencia', $this->exConsistencia);
            $stmt->bindParam(':exOlor', $this->exOlor);
            $stmt->bindParam(':exColor', $this->exColor);
            $stmt->bindParam(':exDolor', $this->exDolor);
            $stmt->bindParam(':fechaMenstruacion', $this->fechaMenstruacion);
            $stmt->bindParam(':mensPeriodicidad', $this->mensPeriodicidad);
            $stmt->bindParam(':mensMolestias', $this->mensMolestias);
            $stmt->bindParam(':ejercicioSemana', $this->ejercicioSemana);
            $stmt->bindParam(':fecha', $this->fecha);
            $stmt->bindParam(':firmaUsuario', $this->firmaUsuario);
            $stmt->bindParam(':firmaPaciente', $this->firmaPaciente);
            $stmt->bindParam(':hora', $this->hora);
            $stmt->bindParam(':usuario', $this->usuario);
            $return = $stmt->execute();
            $this->id = $this->dbh->lastInsertId();
            return $return;
        } catch (PDOException $e) {
            echo "Error al insertar ficha" . $e->getMessage();
        }
    }
    public function setHijos($hijos)
    {
        foreach ($hijos as $i) {
            $hijo = new Hijo($i->_id, $i->_sexo, $i->_edad, $this->id);
            $this->hijos[] = $hijo;
            $hijo->insertar();
        }
    }
    public function getHijos()
    {
        $hijos = array();
        foreach ($this->hijos as $hijo) {
            $hijos[] = $hijo->getValues();
        }
        return $hijos;
    }
    function setAntecedentes($antecedentes)
    {
        foreach ($antecedentes as $i) {
            $antecedente = new AntecedentePaciente($i->_id, $i->_enfermedad, $i->_descripcion, $i->_estaActiva, $this->id);
            $this->antecedentes[] = $antecedente;
            $antecedente->insertar();
        }
    }
    function getAntecedentes()
    {
        $antecedentes = array();
        foreach ($this->antecedentes as $ant) {
            $antecedentes[] = $ant->getValues();
        }
        return $antecedentes;
    }
    function setAntecedentesFam($antecedentesFam)
    {
        foreach ($antecedentesFam as $i) {
            $antecedenteFam = new AntecedenteFamilia($i->_id, $i->_familiar, $i->_enfermedad, $i->_descripcion, $this->id);
            $this->antecedentesFam[] = $antecedenteFam;
            $antecedenteFam->insertar();
        }
    }
    function getAntecedentesFam()
    {
        $antecedentesFam = array();
        foreach ($this->antecedentesFam as $ant) {
            $antecedentesFam[] = $ant->getValues();
        }
        return $antecedentesFam;
    }
    public function obtener()
    {
        $query = "SELECT * FROM ficha WHERE paciente = :paciente; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":paciente", $this->paciente, PDO::PARAM_INT);
            $stmt->execute();
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($datos){
                $this->id = $datos["id"];
                $this->paciente = $datos["paciente"];
                $this->tipoSangre = $datos["tipoSangre"];
                $this->quienRecomendo = $datos["quienRecomendo"];
                $this->embarazo = $datos["embarazo"];
                $this->partos = $datos["partos"];
                $this->cesareas = $datos["cesareas"];
                $this->abortos = $datos["abortos"];
                $this->muertos = $datos["muertos"];
                $this->enfs = $datos["enfs"];
                $this->fuma = $datos["fuma"];
                $this->cigarrosDia = $datos["cigarrosDia"];
                $this->fumaAntiguedad = $datos["fumaAntiguedad"];
                $this->alcohol = $datos["alcohol"];
                $this->alcFrecuencia = $datos["alcFrecuencia"];
                $this->alcoholCantidad = $datos["alcoholCantidad"];
                $this->alcoholTipos = $datos["alcoholTipos"];
                $this->adicciones = $datos["adicciones"];
                $this->alergias = $datos["alergias"];
                $this->desayuno = $datos["desayuno"];
                $this->comida = $datos["comida"];
                $this->cena = $datos["cena"];
                $this->entreComidas = $datos["entreComidas"];
                $this->vasoAguaDia = $datos["vasoAguaDia"];
                $this->otrosLiquidos = $datos["otrosLiquidos"];
                $this->intolerancias = $datos["intolerancias"];
                $this->orinaDia = $datos["orinaDia"];
                $this->orinaNoche = $datos["orinaNoche"];
                $this->orinaColor = $datos["orinaColor"];
                $this->orinaOlor = $datos["orinaOlor"];
                $this->orinaMolestias = $datos["orinaMolestias"];
                $this->excrementoDia = $datos["excrementoDia"];
                $this->exConsistencia = $datos["exConsistencia"];
                $this->exOlor = $datos["exOlor"];
                $this->exColor = $datos["exColor"];
                $this->exDolor = $datos["exDolor"];
                $this->fechaMenstruacion = $datos["fechaMenstruacion"];
                $this->mensPeriodicidad = $datos["mensPeriodicidad"];
                $this->mensMolestias = $datos["mensMolestias"];
                $this->ejercicioSemana = $datos["ejercicioSemana"];
                $this->fecha = $datos["fecha"]; /*
$this->firmaUsuario = $datos["firmaUsuario"];
$this->firmaPaciente = $datos["firmaPaciente"];*/
                $this->hora = $datos["hora"];
                $this->usuario = $datos["usuario"];
                $this->obtenerHijos();
                $this->obtenerAntecedentes();
                $this->obtenerAntecedentesFam();
            }
        } catch (PDOException $e) {
            echo "Error al obtener " . $e->getMessage();
        }
    }
    function obtenerHijos()
    {
        $query = "SELECT * FROM hijo WHERE ficha = :id";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $hijos = null;
            while ($hijos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $hijo = new Hijo($hijos["id"], $hijos["sexo"], $hijos["edad"], $hijos["ficha"]);
                $this->hijos[] = $hijo;
            }
            return $hijos;
        } catch (PDOException $e) {
            echo "Error al obtener hijos" . $e->getMessage();
        }

    }
    function obtenerAntecedentes()
    {
        $query = "SELECT * FROM antecedentes WHERE ficha = :id; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $ant = null;
            while ($ant = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $antecedente = new AntecedentePaciente($ant["id"], $ant["enfermedad"], $ant["descripcion"], $ant["estaActiva"], $ant["ficha"]);
                $this->antecedentes[] = $antecedente;
            }
            return $ant;
        } catch (PDOException $e) {
            echo "Error al obtener antecedentes" . $e->getMessage();
        }
    }
    function obtenerAntecedentesFam()
    {
        $query = "SELECT * FROM antecedentesFamilia WHERE ficha = :id; ";
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $antecedentesFam = null;
            while ($antFam = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $antecedenteFam = new AntecedenteFamilia($antFam["id"], $antFam["familiar"], $antFam["enfermedad"], $antFam["descripcion"], $antFam["ficha"]);
                $this->antecedentesFam[] = $antecedenteFam;
            }
            return $antFam;
        } catch (PDOException $e) {
            echo "Error al obtener Antecedente Familia" . $e->getMessage();
        }
    }
    function actualizar()
    {
        $query = "UPDATE ficha SET 
            paciente = :paciente, 
            tipoSangre = :tipoSangre, 
            quienRecomendo = :quienRecomendo, 
            embarazo = :embarazo, 
            partos = :partos, 
            cesareas = :cesareas, 
            abortos = :abortos, 
            muertos = :muertos, 
            enfs = :enfs, 
            fuma = :fuma, 
            cigarrosDia = :cigarrosDia, 
            fumaAntiguedad = :fumaAntiguedad, 
            alcohol = :alcohol, 
            alcFrecuencia = :alcFrecuencia, 
            alcoholCantidad = :alcoholCantidad, 
            alcoholTipos = :alcoholTipos, 
            adicciones = :adicciones, 
            alergias = :alergias, 
            desayuno = :desayuno, 
            comida = :comida, 
            cena = :cena, 
            entreComidas = :entreComidas, 
            vasoAguaDia = :vasoAguaDia, 
            otrosLiquidos = :otrosLiquidos, 
            intolerancias = :intolerancias, 
            orinaDia = :orinaDia, 
            orinaNoche = :orinaNoche, 
            orinaColor = :orinaColor, 
            orinaOlor = :orinaOlor, 
            orinaMolestias = :orinaMolestias, 
            excrementoDia = :excrementoDia, 
            exConsistencia = :exConsistencia, 
            exOlor = :exOlor, 
            exColor = :exColor, 
            exDolor = :exDolor, 
            fechaMenstruacion = :fechaMenstruacion, 
            mensPeriodicidad = :mensPeriodicidad, 
            mensMolestias = :mensMolestias, 
            ejercicioSemana = :ejercicioSemana, 
            fecha = :fecha, /*
            firmaUsuario = :firmaUsuario, 
            firmaPaciente = :firmaPaciente, */
            hora = :hora, 
            usuario = :usuario 
            WHERE id = :id; ";
        try {
            $stmt = $this->dbh->prepare($query);

            // Bind de los valores
            $stmt->bindParam(':paciente', $this->paciente);
            $stmt->bindParam(':tipoSangre', $this->tipoSangre);
            $stmt->bindParam(':quienRecomendo', $this->quienRecomendo);
            $stmt->bindParam(':embarazo', $this->embarazo);
            $stmt->bindParam(':partos', $this->partos);
            $stmt->bindParam(':cesareas', $this->cesareas);
            $stmt->bindParam(':abortos', $this->abortos);
            $stmt->bindParam(':muertos', $this->muertos);
            $stmt->bindParam(':enfs', $this->enfs);
            $stmt->bindParam(':fuma', $this->fuma);
            $stmt->bindParam(':cigarrosDia', $this->cigarrosDia);
            $stmt->bindParam(':fumaAntiguedad', $this->fumaAntiguedad);
            $stmt->bindParam(':alcohol', $this->alcohol);
            $stmt->bindParam(':alcFrecuencia', $this->alcFrecuencia);
            $stmt->bindParam(':alcoholCantidad', $this->alcoholCantidad);
            $stmt->bindParam(':alcoholTipos', $this->alcoholTipos);
            $stmt->bindParam(':adicciones', $this->adicciones);
            $stmt->bindParam(':alergias', $this->alergias);
            $stmt->bindParam(':desayuno', $this->desayuno);
            $stmt->bindParam(':comida', $this->comida);
            $stmt->bindParam(':cena', $this->cena);
            $stmt->bindParam(':entreComidas', $this->entreComidas);
            $stmt->bindParam(':vasoAguaDia', $this->vasoAguaDia);
            $stmt->bindParam(':otrosLiquidos', $this->otrosLiquidos);
            $stmt->bindParam(':intolerancias', $this->intolerancias);
            $stmt->bindParam(':orinaDia', $this->orinaDia);
            $stmt->bindParam(':orinaNoche', $this->orinaNoche);
            $stmt->bindParam(':orinaColor', $this->orinaColor);
            $stmt->bindParam(':orinaOlor', $this->orinaOlor);
            $stmt->bindParam(':orinaMolestias', $this->orinaMolestias);
            $stmt->bindParam(':excrementoDia', $this->excrementoDia);
            $stmt->bindParam(':exConsistencia', $this->exConsistencia);
            $stmt->bindParam(':exOlor', $this->exOlor);
            $stmt->bindParam(':exColor', $this->exColor);
            $stmt->bindParam(':exDolor', $this->exDolor);
            $stmt->bindParam(':fechaMenstruacion', $this->fechaMenstruacion);
            $stmt->bindParam(':mensPeriodicidad', $this->mensPeriodicidad);
            $stmt->bindParam(':mensMolestias', $this->mensMolestias);
            $stmt->bindParam(':ejercicioSemana', $this->ejercicioSemana);
            $stmt->bindParam(':fecha', $this->fecha); /*
$stmt->bindParam(':firmaUsuario', $this->firmaUsuario);
$stmt->bindParam(':firmaPaciente', $this->firmaPaciente);*/
            $stmt->bindParam(':hora', $this->hora);
            $stmt->bindParam(':usuario', $this->usuario);

            // Bind del ID
            $stmt->bindParam(':id', $this->id);
            //llama a funciones actualizar tablas ligadas
            /*
            $this->actualizarHijos();
            $this->actualizarAntecedentes();
            $this->actualizarAntecedentesFam();*/
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error al actualizar ficha" . $e->getMessage();
        }
    }
    function actualizarHijos($hijosNuevo)
    {
        $this->obtenerHijos();
        $hijosViejo = array();
        $hijosViejo = $this->hijos;
        $idsViejo = array();
        $idsNuevo = array();
        $idsViejosNONuevos = array();
        $idsNuevosNOViejos = array();
        $arrayHijosInsertar = array();
        foreach ($hijosViejo as $elemento) {
            $idsViejo[] = $elemento->getId();
        }
        foreach ($hijosNuevo as $elemento) {
            $idsNuevo[] = $elemento->_id;
        }
        // revisa que ids estan el el viejo pero no en el nuevo array
        $idsViejosNONuevos = array_diff($idsViejo, $idsNuevo);
        //revisa que ids estan en el nuevo array pero no en el viejo array
        $idsNuevosNOViejos = array_diff($idsNuevo, $idsViejo);
        foreach ($idsViejosNONuevos as $id) {
            foreach ($this->hijos as $hijo) {
                if ($hijo->getId() == $id) {
                    $hijo->eliminar();
                }
            }
        }
        foreach ($idsNuevosNOViejos as $id) {
            foreach ($hijosNuevo as $hijo) {
                if ($hijo->_id == $id) {
                    $arrayHijosInsertar[] = $hijo;
                }
            }
        }
        if (!empty($arrayHijosInsertar)) {
            $this->setHijos($arrayHijosInsertar);
        }
    }
    function actualizarAntecedentes($antsNuevo)
    {
        $this->obtenerAntecedentes();
        $idsViejo = array_map(function ($antViejo) {
            return $antViejo->getId();
        }, $this->antecedentes);
        $idsNuevo = array_map(function ($antNuevo) {
            return $antNuevo->_id;
        }, $antsNuevo);
        $idsViejosNoNuevos = array_diff($idsViejo, $idsNuevo);
        $idsNuevosNoViejos = array_diff($idsNuevo, $idsViejo);
        foreach ($idsViejosNoNuevos as $id) {
            foreach ($this->antecedentes as $ant) {
                if ($ant->getId() == $id) {
                    $ant->eliminar();
                }
            }
        }
        $arrayAntecedentesInsertar = [];
        foreach ($idsNuevosNoViejos as $id) {
            foreach ($antsNuevo as $antNuevo) {
                if ($antNuevo->_id == $id) {
                    $arrayAntecedentesInsertar[] = $antNuevo;
                }
            }
        }
        if (!empty($arrayAntecedentesInsertar)) {
            $this->setAntecedentes($arrayAntecedentesInsertar);
        }
    }

    function actualizarAntecedentesFam($antsFamNuevo)
    {
        $this->obtenerAntecedentesFam();
        $antsFamViejo = array();
        $antsFamViejo = $this->antecedentesFam;
        $idsViejo = array();
        $idsNuevo = array();
        $arrayAntecentesFamInsertar = array();
        $idsViejosNoNuevos = array();
        $idsNuevosNoViejos = array();
        foreach ($antsFamViejo as $antFamViejo) {
            $idsViejo[] = $antFamViejo->getId();
        }
        foreach ($antsFamNuevo as $antFamNuevo) {
            $idsNuevo[] = $antFamNuevo->_id;
        }
        $idsViejosNoNuevos = array_diff($idsViejo, $idsNuevo);
        $idsNuevosNoViejos = array_diff($idsNuevo, $idsViejo);
        foreach ($idsViejosNoNuevos as $id) {
            foreach ($this->antecedentesFam as $antFam) {
                if ($antFam->getId() == $id) {
                    $antFam->eliminar();
                }
            }
        }
        foreach ($idsNuevosNoViejos as $id) {
            foreach ($antsFamNuevo as $antFam) {
                if ($antFam->_id == $id) {
                    $arrayAntecentesFamInsertar[] = $antFam;
                }
            }
        }
        if (!empty($arrayAntecentesFamInsertar)) {
            $this->setAntecedentesFam($arrayAntecentesFamInsertar);
        }
    }
}
?>