<?php

namespace JWR\Alea {

    class ContinueSurvey
    {
        private $order;
        private $estricta;
        private $pesado;
        private $fuera_casa;
        private $picoteado;
        private $cocinado;
        private $cambios;
        private $hambre;
        private $ansiedad;
        private $echas_menos;
        private $gustado;
        private $gustado_txt;
        private $menores;
        private $menores_txt;
        private $digestiones;
        private $bano;
        private $ejercicio;
        private $altura;
        private $peso;
        private $per_ci;
        private $per_ca;
        private $comentarios;
        private $paciente_nif;

        private function __construct_void()
        {
            $this->order = "";
            $this->estricta = "";
            $this->pesado = "";
            $this->fuera_casa = "";
            $this->picoteado = "";
            $this->cocinado = "";
            $this->cambios = "";
            $this->hambre = "";
            $this->ansiedad = "";
            $this->echas_menos = "";
            $this->gustado = "";
            $this->gustado_txt = "";
            $this->menores = "";
            $this->menores_txt = "";
            $this->digestiones = "";
            $this->bano = "";
            $this->ejercicio = "";
            $this->altura = "";
            $this->peso = "";
            $this->per_ci = "";
            $this->per_ca = "";
            $this->comentarios = "";
            $this->paciente_nif = "";
        }

        public function __construct($data)
        {
            $this->__construct_void();
            if (is_array($data)) {
                if (isset($data['order'])) {
                    $this->order = $data['order'];
                }
                if (isset($data['estricta'])) {
                    $this->estricta = $data['estricta'];
                }
                if (isset($data['pesado'])) {
                    $this->pesado = $data['pesado'];
                }
                if (isset($data['fuera_casa'])) {
                    $this->fuera_casa = $data['fuera_casa'];
                }
                if (isset($data['picoteado'])) {
                    $this->picoteado = $data['picoteado'];
                }
                if (isset($data['cocinado'])) {
                    $this->cocinado = $data['cocinado'];
                }
                if (isset($data['cambios'])) {
                    $this->cambios = $data['cambios'];
                }
                if (isset($data['hambre'])) {
                    $this->hambre = $data['hambre'];
                }
                if (isset($data['ansiedad'])) {
                    $this->ansiedad = $data['ansiedad'];
                }
                if (isset($data['echas_menos'])) {
                    $this->echas_menos = $data['echas_menos'];
                }
                if (isset($data['gustado'])) {
                    $this->gustado = $data['gustado'];
                }
                if (isset($data['gustado_txt'])) {
                    $this->gustado_txt = $data['gustado_txt'];
                }
                if (isset($data['menores'])) {
                    $this->menores = $data['menores'];
                }
                if (isset($data['menores_txt'])) {
                    $this->menores_txt = $data['menores_txt'];
                }
                if (isset($data['digestiones'])) {
                    $this->digestiones = $data['digestiones'];
                }
                if (isset($data['bano'])) {
                    $this->bano = $data['bano'];
                }
                if (isset($data['ejercicio'])) {
                    $this->ejercicio = $data['ejercicio'];
                }
                if (isset($data['altura'])) {
                    $this->altura = $data['altura'];
                }
                if (isset($data['peso'])) {
                    $this->peso = $data['peso'];
                }
                if (isset($data['per_ci'])) {
                    $this->per_ci = $data['per_ci'];
                }
                if (isset($data['per_ca'])) {
                    $this->per_ca = $data['per_ca'];
                }
                if (isset($data['comentarios'])) {
                    $this->comentarios = $data['comentarios'];
                }
                if (isset($data['paciente_nif'])) {
                    $this->paciente_nif = $data['paciente_nif'];
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
        public function getestricta()
        {
            return $this->estricta;
        }
        public function setestricta($estricta)
        {
            $this->estricta = $estricta;
        }
        public function getpesado()
        {
            return $this->pesado;
        }
        public function setpesado($pesado)
        {
            $this->pesado = $pesado;
        }
        public function getfuera_casa()
        {
            return $this->fuera_casa;
        }
        public function setfuera_casa($fuera_casa)
        {
            $this->fuera_casa = $fuera_casa;
        }
        public function getpicoteado()
        {
            return $this->picoteado;
        }
        public function setpicoteado($picoteado)
        {
            $this->picoteado = $picoteado;
        }
        public function getcocinado()
        {
            return $this->cocinado;
        }
        public function setcocinado($cocinado)
        {
            $this->cocinado = $cocinado;
        }
        public function getcambios()
        {
            return $this->cambios;
        }
        public function setcambios($cambios)
        {
            $this->cambios = $cambios;
        }
        public function gethambre()
        {
            return $this->hambre;
        }
        public function sethambre($hambre)
        {
            $this->hambre = $hambre;
        }
        public function getansiedad()
        {
            return $this->ansiedad;
        }
        public function setansiedad($ansiedad)
        {
            $this->ansiedad = $ansiedad;
        }
        public function getechas_menos()
        {
            return $this->echas_menos;
        }
        public function setechas_menos($echas_menos)
        {
            $this->echas_menos = $echas_menos;
        }
        public function getgustado()
        {
            return $this->gustado;
        }
        public function setgustado($gustado)
        {
            $this->gustado = $gustado;
        }
        public function getgustado_txt()
        {
            return $this->gustado_txt;
        }
        public function setgustado_txt($gustado_txt)
        {
            $this->gustado_txt = $gustado_txt;
        }
        public function getmenores()
        {
            return $this->menores;
        }
        public function setmenores($menores)
        {
            $this->menores = $menores;
        }
        public function getmenores_txt()
        {
            return $this->menores_txt;
        }
        public function setmenores_txt($menores_txt)
        {
            $this->menores_txt = $menores_txt;
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
        public function getejercicio()
        {
            return $this->ejercicio;
        }
        public function setejercicio($ejercicio)
        {
            $this->ejercicio = $ejercicio;
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
        public function getcomentarios()
        {
            return $this->comentarios;
        }
        public function setcomentarios($comentarios)
        {
            $this->comentarios = $comentarios;
        }
        public function getpaciente_nif()
        {
            return $this->paciente_nif;
        }
        public function setpaciente_nif($paciente_nif)
        {
            $this->paciente_nif = $paciente_nif;
        }
    } // EOC
} // namespace