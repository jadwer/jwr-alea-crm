<?php

namespace JWR\Alea {

    class StartSurvey
    {
        const NUM_FIELDS = 80;

        public $order;
        public $edad;
        public $sexo;
        public $altura;
        public $peso;
        public $per_m;
        public $per_ci;
        public $per_ca;
        public $peso_infancia;
        public $peso_adulto_estable;
        public $peso_adulto_minimo;
        public $peso_adulto_maximo;
        public $peso_ultimo;
        public $dieta_ultimo;
        public $embarazada;
        public $embarazada_kilos;
        public $embarazada_anterior;
        public $embarazada_pecho;
        public $embarazada_tiempo_bebe;
        public $causa_kilos;
        public $peso_comodo;
        public $ultima_analitica;
        public $ultima_analitica_txt;
        public $estado_general;
        public $estado_general_txt;
        public $medicamento;
        public $medicamento_txt;
        public $quirofano;
        public $quirofano_txt;
        public $reglas;
        public $tension;
        public $digestiones;
        public $bano;
        public $alcohol;
        public $tabaco;
        public $rutina;
        public $cama;
        public $caminar;
        public $deporte;
        public $deporte_txt;
        public $desayunos_txt;
        public $media_manana_txt;
        public $meriendas_txt;
        public $postre_txt;
        public $postcena_txt;
        public $bebida_en_comidas;
        public $veces_fuera_casa;
        public $fuera_casa_trabajo;
        public $picoteas;
        public $ansiedad_comida;
        public $leche;
        public $carne_roja;
        public $pescado;
        public $huevos;
        public $verduras;
        public $fruta;
        public $legumbres;
        public $patatas;
        public $pan;
        public $comida_rapida;
        public $precocinada;
        public $snacks;
        public $bolleria;
        public $intolerancia_txt;
        public $vegetariana_txt;
        public $sin_gracia;
        public $con_gracia;
        public $trabajo;
        public $unico;
        public $comentarios;
        public $paciente_nombre;
        public $paciente_apellidos;
        public $paciente_nif;
        public $paciente_email;
        public $paciente_repite;
        public $paciente_telefono;
        public $paciente_calle;
        public $paciente_numero;
        public $paciente_piso_letra;
        public $paciente_cp;
        public $paciente_ciudad;
        public $paciente_provincia;
        public $newsletter;

        public function __construct()
        {
            $params = func_get_args();
            $num_params = func_num_args();

            if ($num_params == 1) {
                call_user_func_array(array($this, '__construct_array'), $params);
            } else if ($num_params == static::NUM_FIELDS) {
                call_user_func_array(array($this, '__construct_data'), $params);
            } else {
                call_user_func_array(array($this, '__construct_void'), $params);
            }
        }

        public function toArray()
        {
            return array(
                'order' => $this->order,
                'edad' => $this->edad,
                'sexo' => $this->sexo,
                'altura' => $this->altura,
                'peso' => $this->peso,
                'per_m' => $this->per_m,
                'per_ci' => $this->per_ci,
                'per_ca' => $this->per_ca,
                'peso_infancia' => $this->peso_infancia,
                'peso_adulto_estable' => $this->peso_adulto_estable,
                'peso_adulto_minimo' => $this->peso_adulto_minimo,
                'peso_adulto_maximo' => $this->peso_adulto_maximo,
                'peso_ultimo' => $this->peso_ultimo,
                'dieta_ultimo' => $this->dieta_ultimo,
                'embarazada' => $this->embarazada,
                'embarazada_kilos' => $this->embarazada_kilos,
                'embarazada_anterior' => $this->embarazada_anterior,
                'embarazada_pecho' => $this->embarazada_pecho,
                'embarazada_tiempo_bebe' => $this->embarazada_tiempo_bebe,
                'causa_kilos' => $this->causa_kilos,
                'peso_comodo' => $this->peso_comodo,
                'ultima_analitica' => $this->ultima_analitica,
                'ultima_analitica_txt' => $this->ultima_analitica_txt,
                'estado_general' => $this->estado_general,
                'estado_general_txt' => $this->estado_general_txt,
                'medicamento' => $this->medicamento,
                'medicamento_txt' => $this->medicamento_txt,
                'quirofano' => $this->quirofano,
                'quirofano_txt' => $this->quirofano_txt,
                'reglas' => $this->reglas,
                'tension' => $this->tension,
                'digestiones' => $this->digestiones,
                'bano' => $this->bano,
                'alcohol' => $this->alcohol,
                'tabaco' => $this->tabaco,
                'rutina' => $this->rutina,
                'cama' => $this->cama,
                'caminar' => $this->caminar,
                'deporte' => $this->deporte,
                'deporte_txt' => $this->deporte_txt,
                'desayunos_txt' => $this->desayunos_txt,
                'media_manana_txt' => $this->media_manana_txt,
                'meriendas_txt' => $this->meriendas_txt,
                'postre_txt' => $this->postre_txt,
                'postcena_txt' => $this->postcena_txt,
                'bebida_en_comidas' => $this->bebida_en_comidas,
                'veces_fuera_casa' => $this->veces_fuera_casa,
                'fuera_casa_trabajo' => $this->fuera_casa_trabajo,
                'picoteas' => $this->picoteas,
                'ansiedad_comida' => $this->ansiedad_comida,
                'leche' => $this->leche,
                'carne_roja' => $this->carne_roja,
                'pescado' => $this->pescado,
                'huevos' => $this->huevos,
                'verduras' => $this->verduras,
                'fruta' => $this->fruta,
                'legumbres' => $this->legumbres,
                'patatas' => $this->patatas,
                'pan' => $this->pan,
                'comida_rapida' => $this->comida_rapida,
                'precocinada' => $this->precocinada,
                'snacks' => $this->snacks,
                'bolleria' => $this->bolleria,
                'intolerancia_txt' => $this->intolerancia_txt,
                'vegetariana_txt' => $this->vegetariana_txt,
                'sin_gracia' => $this->sin_gracia,
                'con_gracia' => $this->con_gracia,
                'trabajo' => $this->trabajo,
                'unico' => $this->unico,
                'comentarios' => $this->comentarios,
                'paciente_nombre' => $this->paciente_nombre,
                'paciente_apellidos' => $this->paciente_apellidos,
                'paciente_nif' => $this->paciente_nif,
                'paciente_email' => $this->paciente_email,
                'paciente_repite' => $this->paciente_repite,
                'paciente_telefono' => $this->paciente_telefono,
                'paciente_calle' => $this->paciente_calle,
                'paciente_numero' => $this->paciente_numero,
                'paciente_piso_letra' => $this->paciente_piso_letra,
                'paciente_cp' => $this->paciente_cp,
                'paciente_ciudad' => $this->paciente_ciudad,
                'paciente_provincia' => $this->paciente_provincia,
                'newsletter' => $this->newsletter
            );
        }

        public function toJsonEncode()
        {
            return Utils::jsonEnconder($this->toArray());
        }

        private function __construct_void()
        {
            $this->order = "";
            $this->edad = "";
            $this->sexo = "";
            $this->altura = "";
            $this->peso = "";
            $this->per_m = "";
            $this->per_ci = "";
            $this->per_ca = "";
            $this->peso_infancia = "";
            $this->peso_adulto_estable = "";
            $this->peso_adulto_minimo = "";
            $this->peso_adulto_maximo = "";
            $this->peso_ultimo = "";
            $this->dieta_ultimo = "";
            $this->embarazada = "";
            $this->embarazada_kilos = "";
            $this->embarazada_anterior = "";
            $this->embarazada_pecho = "";
            $this->embarazada_tiempo_bebe = "";
            $this->causa_kilos = "";
            $this->peso_comodo = "";
            $this->ultima_analitica = "";
            $this->ultima_analitica_txt = "";
            $this->estado_general = "";
            $this->estado_general_txt = "";
            $this->medicamento = "";
            $this->medicamento_txt = "";
            $this->quirofano = "";
            $this->quirofano_txt = "";
            $this->reglas = "";
            $this->tension = "";
            $this->digestiones = "";
            $this->bano = "";
            $this->alcohol = "";
            $this->tabaco = "";
            $this->rutina = "";
            $this->cama = "";
            $this->caminar = "";
            $this->deporte = "";
            $this->deporte_txt = "";
            $this->desayunos_txt = "";
            $this->media_manana_txt = "";
            $this->meriendas_txt = "";
            $this->postre_txt = "";
            $this->postcena_txt = "";
            $this->bebida_en_comidas = "";
            $this->veces_fuera_casa = "";
            $this->fuera_casa_trabajo = "";
            $this->picoteas = "";
            $this->ansiedad_comida = "";
            $this->leche = "";
            $this->carne_roja = "";
            $this->pescado = "";
            $this->huevos = "";
            $this->verduras = "";
            $this->fruta = "";
            $this->legumbres = "";
            $this->patatas = "";
            $this->pan = "";
            $this->comida_rapida = "";
            $this->precocinada = "";
            $this->snacks = "";
            $this->bolleria = "";
            $this->intolerancia_txt = "";
            $this->vegetariana_txt = "";
            $this->sin_gracia = "";
            $this->con_gracia = "";
            $this->trabajo = "";
            $this->unico = "";
            $this->comentarios = "";
            $this->paciente_nombre = "";
            $this->paciente_apellidos = "";
            $this->paciente_nif = "";
            $this->paciente_email = "";
            $this->paciente_repite = "";
            $this->paciente_telefono = "";
            $this->paciente_calle = "";
            $this->paciente_numero = "";
            $this->paciente_piso_letra = "";
            $this->paciente_cp = "";
            $this->paciente_ciudad = "";
            $this->paciente_provincia = "";
            $this->newsletter = "";
        }

        public function __construct_array($data)
        {
            $this->__construct_void();

            if (is_array($data)) {

                if (isset($data['order'])) {
                    $this->order = $data['order'];
                }
                if (isset($data['edad'])) {
                    $this->edad = $data['edad'];
                }
                if (isset($data['sexo'])) {
                    $this->sexo = $data['sexo'];
                }
                if (isset($data['altura'])) {
                    $this->altura = $data['altura'];
                }
                if (isset($data['peso'])) {
                    $this->peso = $data['peso'];
                }
                if (isset($data['per_m'])) {
                    $this->per_m = $data['per_m'];
                }
                if (isset($data['per_ci'])) {
                    $this->per_ci = $data['per_ci'];
                }
                if (isset($data['per_ca'])) {
                    $this->per_ca = $data['per_ca'];
                }
                if (isset($data['peso_infancia'])) {
                    $this->peso_infancia = $data['peso_infancia'];
                }
                if (isset($data['peso_adulto_estable'])) {
                    $this->peso_adulto_estable = $data['peso_adulto_estable'];
                }
                if (isset($data['peso_adulto_minimo'])) {
                    $this->peso_adulto_minimo = $data['peso_adulto_minimo'];
                }
                if (isset($data['peso_adulto_maximo'])) {
                    $this->peso_adulto_maximo = $data['peso_adulto_maximo'];
                }
                if (isset($data['peso_ultimo'])) {
                    $this->peso_ultimo = $data['peso_ultimo'];
                }
                if (isset($data['dieta_ultimo'])) {
                    $this->dieta_ultimo = $data['dieta_ultimo'];
                }
                if (isset($data['embarazada'])) {
                    $this->embarazada = $data['embarazada'];
                }
                if (isset($data['embarazada_kilos'])) {
                    $this->embarazada_kilos = $data['embarazada_kilos'];
                }
                if (isset($data['embarazada_anterior'])) {
                    $this->embarazada_anterior = $data['embarazada_anterior'];
                }
                if (isset($data['embarazada_pecho'])) {
                    $this->embarazada_pecho = $data['embarazada_pecho'];
                }
                if (isset($data['embarazada_tiempo_bebe'])) {
                    $this->embarazada_tiempo_bebe = $data['embarazada_tiempo_bebe'];
                }
                if (isset($data['causa_kilos'])) {
                    $this->causa_kilos = $data['causa_kilos'];
                }
                if (isset($data['peso_comodo'])) {
                    $this->peso_comodo = $data['peso_comodo'];
                }
                if (isset($data['ultima_analitica'])) {
                    $this->ultima_analitica = $data['ultima_analitica'];
                }
                if (isset($data['ultima_analitica_txt'])) {
                    $this->ultima_analitica_txt = $data['ultima_analitica_txt'];
                }
                if (isset($data['estado_general'])) {
                    $this->estado_general = $data['estado_general'];
                }
                if (isset($data['estado_general_txt'])) {
                    $this->estado_general_txt = $data['estado_general_txt'];
                }
                if (isset($data['medicamento'])) {
                    $this->medicamento = $data['medicamento'];
                }
                if (isset($data['medicamento_txt'])) {
                    $this->medicamento_txt = $data['medicamento_txt'];
                }
                if (isset($data['quirofano'])) {
                    $this->quirofano = $data['quirofano'];
                }
                if (isset($data['quirofano_txt'])) {
                    $this->quirofano_txt = $data['quirofano_txt'];
                }
                if (isset($data['reglas'])) {
                    $this->reglas = $data['reglas'];
                }
                if (isset($data['tension'])) {
                    $this->tension = $data['tension'];
                }
                if (isset($data['digestiones'])) {
                    $this->digestiones = $data['digestiones'];
                }
                if (isset($data['bano'])) {
                    $this->bano = $data['bano'];
                }
                if (isset($data['alcohol'])) {
                    $this->alcohol = $data['alcohol'];
                }
                if (isset($data['tabaco'])) {
                    $this->tabaco = $data['tabaco'];
                }
                if (isset($data['rutina'])) {
                    $this->rutina = $data['rutina'];
                }
                if (isset($data['cama'])) {
                    $this->cama = $data['cama'];
                }
                if (isset($data['caminar'])) {
                    $this->caminar = $data['caminar'];
                }
                if (isset($data['deporte'])) {
                    $this->deporte = $data['deporte'];
                }
                if (isset($data['deporte_txt'])) {
                    $this->deporte_txt = $data['deporte_txt'];
                }
                if (isset($data['desayunos_txt'])) {
                    $this->desayunos_txt = $data['desayunos_txt'];
                }
                if (isset($data['media_manana_txt'])) {
                    $this->media_manana_txt = $data['media_manana_txt'];
                }
                if (isset($data['meriendas_txt'])) {
                    $this->meriendas_txt = $data['meriendas_txt'];
                }
                if (isset($data['postre_txt'])) {
                    $this->postre_txt = $data['postre_txt'];
                }
                if (isset($data['postcena_txt'])) {
                    $this->postcena_txt = $data['postcena_txt'];
                }
                if (isset($data['bebida_en_comidas'])) {
                    $this->bebida_en_comidas = $data['bebida_en_comidas'];
                }
                if (isset($data['veces_fuera_casa'])) {
                    $this->veces_fuera_casa = $data['veces_fuera_casa'];
                }
                if (isset($data['fuera_casa_trabajo'])) {
                    $this->fuera_casa_trabajo = $data['fuera_casa_trabajo'];
                }
                if (isset($data['picoteas'])) {
                    $this->picoteas = $data['picoteas'];
                }
                if (isset($data['ansiedad_comida'])) {
                    $this->ansiedad_comida = $data['ansiedad_comida'];
                }
                if (isset($data['leche'])) {
                    $this->leche = $data['leche'];
                }
                if (isset($data['carne_roja'])) {
                    $this->carne_roja = $data['carne_roja'];
                }
                if (isset($data['pescado'])) {
                    $this->pescado = $data['pescado'];
                }
                if (isset($data['huevos'])) {
                    $this->huevos = $data['huevos'];
                }
                if (isset($data['verduras'])) {
                    $this->verduras = $data['verduras'];
                }
                if (isset($data['fruta'])) {
                    $this->fruta = $data['fruta'];
                }
                if (isset($data['legumbres'])) {
                    $this->legumbres = $data['legumbres'];
                }
                if (isset($data['patatas'])) {
                    $this->patatas = $data['patatas'];
                }
                if (isset($data['pan'])) {
                    $this->pan = $data['pan'];
                }
                if (isset($data['comida_rapida'])) {
                    $this->comida_rapida = $data['comida_rapida'];
                }
                if (isset($data['precocinada'])) {
                    $this->precocinada = $data['precocinada'];
                }
                if (isset($data['snacks'])) {
                    $this->snacks = $data['snacks'];
                }
                if (isset($data['bolleria'])) {
                    $this->bolleria = $data['bolleria'];
                }
                if (isset($data['intolerancia_txt'])) {
                    $this->intolerancia_txt = $data['intolerancia_txt'];
                }
                if (isset($data['vegetariana_txt'])) {
                    $this->vegetariana_txt = $data['vegetariana_txt'];
                }
                if (isset($data['sin_gracia'])) {
                    $this->sin_gracia = $data['sin_gracia'];
                }
                if (isset($data['con_gracia'])) {
                    $this->con_gracia = $data['con_gracia'];
                }
                if (isset($data['trabajo'])) {
                    $this->trabajo = $data['trabajo'];
                }
                if (isset($data['unico'])) {
                    $this->unico = $data['unico'];
                }
                if (isset($data['comentarios'])) {
                    $this->comentarios = $data['comentarios'];
                }
                if (isset($data['paciente_nombre'])) {
                    $this->paciente_nombre = $data['paciente_nombre'];
                }
                if (isset($data['paciente_apellidos'])) {
                    $this->paciente_apellidos = $data['paciente_apellidos'];
                }
                if (isset($data['paciente_nif'])) {
                    $this->paciente_nif = $data['paciente_nif'];
                }
                if (isset($data['paciente_email'])) {
                    $this->paciente_email = $data['paciente_email'];
                }
                if (isset($data['paciente_repite'])) {
                    $this->paciente_repite = $data['paciente_repite'];
                }
                if (isset($data['paciente_telefono'])) {
                    $this->paciente_telefono = $data['paciente_telefono'];
                }
                if (isset($data['paciente_calle'])) {
                    $this->paciente_calle = $data['paciente_calle'];
                }
                if (isset($data['paciente_numero'])) {
                    $this->paciente_numero = $data['paciente_numero'];
                }
                if (isset($data['paciente_piso_letra'])) {
                    $this->paciente_piso_letra = $data['paciente_piso_letra'];
                }
                if (isset($data['paciente_cp'])) {
                    $this->paciente_cp = $data['paciente_cp'];
                }
                if (isset($data['paciente_ciudad'])) {
                    $this->paciente_ciudad = $data['paciente_ciudad'];
                }
                if (isset($data['paciente_provincia'])) {
                    $this->paciente_provincia = $data['paciente_provincia'];
                }
                if (isset($data['newsletter'])) {
                    $this->newsletter = $data['newsletter'];
                }
            }
        }

        public function getorder()
        {
            return $this->order;
        }
        public function setorder($order)
        {
            $this->order = $order;
        }
        public function getedad()
        {
            return $this->edad;
        }
        public function getFechaNacimiento()
        {
            return $this->edad;
        }
        public function setedad($edad)
        {
            $this->edad = $edad;
        }
        public function getsexo()
        {
            return $this->sexo;
        }
        public function setsexo($sexo)
        {
            $this->sexo = $sexo;
        }
        public function getaltura()
        {
            return $this->altura;
        }
        public function setaltura($altura)
        {
            $this->altura = $altura;
        }
        public function getpeso()
        {
            return $this->peso;
        }
        public function setpeso($peso)
        {
            $this->peso = $peso;
        }
        public function getper_m()
        {
            return $this->per_m;
        }
        public function setper_m($per_m)
        {
            $this->per_m = $per_m;
        }
        public function getper_ci()
        {
            return $this->per_ci;
        }
        public function setper_ci($per_ci)
        {
            $this->per_ci = $per_ci;
        }
        public function getper_ca()
        {
            return $this->per_ca;
        }
        public function setper_ca($per_ca)
        {
            $this->per_ca = $per_ca;
        }
        public function getpeso_infancia()
        {
            return $this->peso_infancia;
        }
        public function setpeso_infancia($peso_infancia)
        {
            $this->peso_infancia = $peso_infancia;
        }
        public function getpeso_adulto_estable()
        {
            return $this->peso_adulto_estable;
        }
        public function setpeso_adulto_estable($peso_adulto_estable)
        {
            $this->peso_adulto_estable = $peso_adulto_estable;
        }
        public function getpeso_adulto_minimo()
        {
            return $this->peso_adulto_minimo;
        }
        public function setpeso_adulto_minimo($peso_adulto_minimo)
        {
            $this->peso_adulto_minimo = $peso_adulto_minimo;
        }
        public function getpeso_adulto_maximo()
        {
            return $this->peso_adulto_maximo;
        }
        public function setpeso_adulto_maximo($peso_adulto_maximo)
        {
            $this->peso_adulto_maximo = $peso_adulto_maximo;
        }
        public function getpeso_ultimo()
        {
            return $this->peso_ultimo;
        }
        public function setpeso_ultimo($peso_ultimo)
        {
            $this->peso_ultimo = $peso_ultimo;
        }
        public function getdieta_ultimo()
        {
            return $this->dieta_ultimo;
        }
        public function setdieta_ultimo($dieta_ultimo)
        {
            $this->dieta_ultimo = $dieta_ultimo;
        }
        public function getembarazada()
        {
            return $this->embarazada;
        }
        public function setembarazada($embarazada)
        {
            $this->embarazada = $embarazada;
        }
        public function getembarazada_kilos()
        {
            return $this->embarazada_kilos;
        }
        public function setembarazada_kilos($embarazada_kilos)
        {
            $this->embarazada_kilos = $embarazada_kilos;
        }
        public function getembarazada_anterior()
        {
            return $this->embarazada_anterior;
        }
        public function setembarazada_anterior($embarazada_anterior)
        {
            $this->embarazada_anterior = $embarazada_anterior;
        }
        public function getembarazada_pecho()
        {
            return $this->embarazada_pecho;
        }
        public function setembarazada_pecho($embarazada_pecho)
        {
            $this->embarazada_pecho = $embarazada_pecho;
        }
        public function getembarazada_tiempo_bebe()
        {
            return $this->embarazada_tiempo_bebe;
        }
        public function setembarazada_tiempo_bebe($embarazada_tiempo_bebe)
        {
            $this->embarazada_tiempo_bebe = $embarazada_tiempo_bebe;
        }
        public function getcausa_kilos()
        {
            return $this->causa_kilos;
        }
        public function setcausa_kilos($causa_kilos)
        {
            $this->causa_kilos = $causa_kilos;
        }
        public function getpeso_comodo()
        {
            return $this->peso_comodo;
        }
        public function setpeso_comodo($peso_comodo)
        {
            $this->peso_comodo = $peso_comodo;
        }
        public function getultima_analitica()
        {
            return $this->ultima_analitica;
        }
        public function setultima_analitica($ultima_analitica)
        {
            $this->ultima_analitica = $ultima_analitica;
        }
        public function getultima_analitica_txt()
        {
            return $this->ultima_analitica_txt;
        }
        public function setultima_analitica_txt($ultima_analitica_txt)
        {
            $this->ultima_analitica_txt = $ultima_analitica_txt;
        }
        public function getestado_general()
        {
            return $this->estado_general;
        }
        public function setestado_general($estado_general)
        {
            $this->estado_general = $estado_general;
        }
        public function getestado_general_txt()
        {
            return $this->estado_general_txt;
        }
        public function setestado_general_txt($estado_general_txt)
        {
            $this->estado_general_txt = $estado_general_txt;
        }
        public function getmedicamento()
        {
            return $this->medicamento;
        }
        public function setmedicamento($medicamento)
        {
            $this->medicamento = $medicamento;
        }
        public function getmedicamento_txt()
        {
            return $this->medicamento_txt;
        }
        public function setmedicamento_txt($medicamento_txt)
        {
            $this->medicamento_txt = $medicamento_txt;
        }
        public function getquirofano()
        {
            return $this->quirofano;
        }
        public function setquirofano($quirofano)
        {
            $this->quirofano = $quirofano;
        }
        public function getquirofano_txt()
        {
            return $this->quirofano_txt;
        }
        public function setquirofano_txt($quirofano_txt)
        {
            $this->quirofano_txt = $quirofano_txt;
        }
        public function getreglas()
        {
            return $this->reglas;
        }
        public function setreglas($reglas)
        {
            $this->reglas = $reglas;
        }
        public function gettension()
        {
            return $this->tension;
        }
        public function settension($tension)
        {
            $this->tension = $tension;
        }
        public function getdigestiones()
        {
            return $this->digestiones;
        }
        public function setdigestiones($digestiones)
        {
            $this->digestiones = $digestiones;
        }
        public function getbano()
        {
            return $this->bano;
        }
        public function setbano($bano)
        {
            $this->bano = $bano;
        }
        public function getalcohol()
        {
            return $this->alcohol;
        }
        public function setalcohol($alcohol)
        {
            $this->alcohol = $alcohol;
        }
        public function gettabaco()
        {
            return $this->tabaco;
        }
        public function settabaco($tabaco)
        {
            $this->tabaco = $tabaco;
        }
        public function getrutina()
        {
            return $this->rutina;
        }
        public function setrutina($rutina)
        {
            $this->rutina = $rutina;
        }
        public function getcama()
        {
            return $this->cama;
        }
        public function setcama($cama)
        {
            $this->cama = $cama;
        }
        public function getcaminar()
        {
            return $this->caminar;
        }
        public function setcaminar($caminar)
        {
            $this->caminar = $caminar;
        }
        public function getdeporte()
        {
            return $this->deporte;
        }
        public function setdeporte($deporte)
        {
            $this->deporte = $deporte;
        }
        public function getdeporte_txt()
        {
            return $this->deporte_txt;
        }
        public function setdeporte_txt($deporte_txt)
        {
            $this->deporte_txt = $deporte_txt;
        }
        public function getdesayunos_txt()
        {
            return $this->desayunos_txt;
        }
        public function setdesayunos_txt($desayunos_txt)
        {
            $this->desayunos_txt = $desayunos_txt;
        }
        public function getmedia_manana_txt()
        {
            return $this->media_manana_txt;
        }
        public function setmedia_manana_txt($media_manana_txt)
        {
            $this->media_manana_txt = $media_manana_txt;
        }
        public function getmeriendas_txt()
        {
            return $this->meriendas_txt;
        }
        public function setmeriendas_txt($meriendas_txt)
        {
            $this->meriendas_txt = $meriendas_txt;
        }
        public function getpostre_txt()
        {
            return $this->postre_txt;
        }
        public function setpostre_txt($postre_txt)
        {
            $this->postre_txt = $postre_txt;
        }
        public function getpostcena_txt()
        {
            return $this->postcena_txt;
        }
        public function setpostcena_txt($postcena_txt)
        {
            $this->postcena_txt = $postcena_txt;
        }
        public function getbebida_en_comidas()
        {
            return $this->bebida_en_comidas;
        }
        public function setbebida_en_comidas($bebida_en_comidas)
        {
            $this->bebida_en_comidas = $bebida_en_comidas;
        }
        public function getveces_fuera_casa()
        {
            return $this->veces_fuera_casa;
        }
        public function setveces_fuera_casa($veces_fuera_casa)
        {
            $this->veces_fuera_casa = $veces_fuera_casa;
        }
        public function getfuera_casa_trabajo()
        {
            return $this->fuera_casa_trabajo;
        }
        public function setfuera_casa_trabajo($fuera_casa_trabajo)
        {
            $this->fuera_casa_trabajo = $fuera_casa_trabajo;
        }
        public function getpicoteas()
        {
            return $this->picoteas;
        }
        public function setpicoteas($picoteas)
        {
            $this->picoteas = $picoteas;
        }
        public function getansiedad_comida()
        {
            return $this->ansiedad_comida;
        }
        public function setansiedad_comida($ansiedad_comida)
        {
            $this->ansiedad_comida = $ansiedad_comida;
        }
        public function getleche()
        {
            return $this->leche;
        }
        public function setleche($leche)
        {
            $this->leche = $leche;
        }
        public function getcarne_roja()
        {
            return $this->carne_roja;
        }
        public function setcarne_roja($carne_roja)
        {
            $this->carne_roja = $carne_roja;
        }
        public function getpescado()
        {
            return $this->pescado;
        }
        public function setpescado($pescado)
        {
            $this->pescado = $pescado;
        }
        public function gethuevos()
        {
            return $this->huevos;
        }
        public function sethuevos($huevos)
        {
            $this->huevos = $huevos;
        }
        public function getverduras()
        {
            return $this->verduras;
        }
        public function setverduras($verduras)
        {
            $this->verduras = $verduras;
        }
        public function getfruta()
        {
            return $this->fruta;
        }
        public function setfruta($fruta)
        {
            $this->fruta = $fruta;
        }
        public function getlegumbres()
        {
            return $this->legumbres;
        }
        public function setlegumbres($legumbres)
        {
            $this->legumbres = $legumbres;
        }
        public function getpatatas()
        {
            return $this->patatas;
        }
        public function setpatatas($patatas)
        {
            $this->patatas = $patatas;
        }
        public function getpan()
        {
            return $this->pan;
        }
        public function setpan($pan)
        {
            $this->pan = $pan;
        }
        public function getcomida_rapida()
        {
            return $this->comida_rapida;
        }
        public function setcomida_rapida($comida_rapida)
        {
            $this->comida_rapida = $comida_rapida;
        }
        public function getprecocinada()
        {
            return $this->precocinada;
        }
        public function setprecocinada($precocinada)
        {
            $this->precocinada = $precocinada;
        }
        public function getsnacks()
        {
            return $this->snacks;
        }
        public function setsnacks($snacks)
        {
            $this->snacks = $snacks;
        }
        public function getbolleria()
        {
            return $this->bolleria;
        }
        public function setbolleria($bolleria)
        {
            $this->bolleria = $bolleria;
        }
        public function getintolerancia_txt()
        {
            return $this->intolerancia_txt;
        }
        public function setintolerancia_txt($intolerancia_txt)
        {
            $this->intolerancia_txt = $intolerancia_txt;
        }
        public function getvegetariana_txt()
        {
            return $this->vegetariana_txt;
        }
        public function setvegetariana_txt($vegetariana_txt)
        {
            $this->vegetariana_txt = $vegetariana_txt;
        }
        public function getsin_gracia()
        {
            return $this->sin_gracia;
        }
        public function setsin_gracia($sin_gracia)
        {
            $this->sin_gracia = $sin_gracia;
        }
        public function getcon_gracia()
        {
            return $this->con_gracia;
        }
        public function setcon_gracia($con_gracia)
        {
            $this->con_gracia = $con_gracia;
        }
        public function gettrabajo()
        {
            return $this->trabajo;
        }
        public function settrabajo($trabajo)
        {
            $this->trabajo = $trabajo;
        }
        public function getunico()
        {
            return $this->unico;
        }
        public function setunico($unico)
        {
            $this->unico = $unico;
        }
        public function getcomentarios()
        {
            return $this->comentarios;
        }
        public function setcomentarios($comentarios)
        {
            $this->comentarios = $comentarios;
        }
        public function getpaciente_nombre()
        {
            return $this->paciente_nombre;
        }
        public function setpaciente_nombre($paciente_nombre)
        {
            $this->paciente_nombre = $paciente_nombre;
        }
        public function getpaciente_apellidos()
        {
            return $this->paciente_apellidos;
        }
        public function setpaciente_apellidos($paciente_apellidos)
        {
            $this->paciente_apellidos = $paciente_apellidos;
        }
        public function getpaciente_nif()
        {
            return $this->paciente_nif;
        }
        public function setpaciente_nif($paciente_nif)
        {
            $this->paciente_nif = $paciente_nif;
        }
        public function getpaciente_email()
        {
            return $this->paciente_email;
        }
        public function setpaciente_email($paciente_email)
        {
            $this->paciente_email = $paciente_email;
        }
        public function getpaciente_repite()
        {
            return $this->paciente_repite;
        }
        public function setpaciente_repite($paciente_repite)
        {
            $this->paciente_repite = $paciente_repite;
        }
        public function getpaciente_telefono()
        {
            return $this->paciente_telefono;
        }
        public function setpaciente_telefono($paciente_telefono)
        {
            $this->paciente_telefono = $paciente_telefono;
        }
        public function getpaciente_calle()
        {
            return $this->paciente_calle;
        }
        public function setpaciente_calle($paciente_calle)
        {
            $this->paciente_calle = $paciente_calle;
        }
        public function getpaciente_numero()
        {
            return $this->paciente_numero;
        }
        public function setpaciente_numero($paciente_numero)
        {
            $this->paciente_numero = $paciente_numero;
        }
        public function getpaciente_piso_letra()
        {
            return $this->paciente_piso_letra;
        }
        public function setpaciente_piso_letra($paciente_piso_letra)
        {
            $this->paciente_piso_letra = $paciente_piso_letra;
        }
        public function getpaciente_cp()
        {
            return $this->paciente_cp;
        }
        public function setpaciente_cp($paciente_cp)
        {
            $this->paciente_cp = $paciente_cp;
        }
        public function getpaciente_ciudad()
        {
            return $this->paciente_ciudad;
        }
        public function setpaciente_ciudad($paciente_ciudad)
        {
            $this->paciente_ciudad = $paciente_ciudad;
        }
        public function getpaciente_provincia()
        {
            return $this->paciente_provincia;
        }
        public function setpaciente_provincia($paciente_provincia)
        {
            $this->paciente_provincia = $paciente_provincia;
        }
        public function getnewsletter()
        {
            return $this->newsletter;
        }
        public function setnewsletter($newsletter)
        {
            $this->newsletter = $newsletter;
        }
    } // EOC
} // namespace