<?php

namespace JWR\Alea {

    class AleaSurvey
    {
        public static function createSurveyPages()
        {
            Utils::createPage("Alea CRM Start", "comienza", "alea-survey-start", "jwr-alea-crm-survey-start-id", "");
            Utils::createPage("Alea CRM Continue", "continua", "alea-survey-continue", "jwr-alea-crm-survey-continue-id", "");
        }
        public static function deleteSurveyPages()
        {
            Utils::deletePage("jwr-alea-crm-survey-start-id");
            Utils::deletePage("jwr-alea-crm-survey-continue-id");
        }

        public static function startSurvey($survey)
        {
?>

            <div><label>order: </label> <?= $survey->getorder($survey); ?></div>
            <div><label>edad: </label> <?= $survey->getedad(); ?></div>
            <div><label>sexo: </label> <?= $survey->getsexo(); ?></div>
            <div><label>altura: </label> <?= $survey->getaltura(); ?></div>
            <div><label>peso: </label> <?= $survey->getpeso(); ?></div>
            <div><label>per_m: </label> <?= $survey->getper_m(); ?></div>
            <div><label>per_ci: </label> <?= $survey->getper_ci(); ?></div>
            <div><label>per_ca: </label> <?= $survey->getper_ca(); ?></div>
            <div><label>peso_infancia: </label> <?= $survey->getpeso_infancia(); ?></div>
            <div><label>peso_adulto_estable: </label> <?= $survey->getpeso_adulto_estable(); ?></div>
            <div><label>peso_adulto_minimo: </label> <?= $survey->getpeso_adulto_minimo(); ?></div>
            <div><label>peso_adulto_maximo: </label> <?= $survey->getpeso_adulto_maximo(); ?></div>
            <div><label>peso_ultimo: </label> <?= $survey->getpeso_ultimo(); ?></div>
            <div><label>dieta_ultimo: </label> <?= $survey->getdieta_ultimo(); ?></div>
            <div><label>embarazada: </label> <?= $survey->getembarazada(); ?></div>
            <div><label>embarazada_tiempo_bebe: </label> <?= $survey->getembarazada_tiempo_bebe(); ?></div>
            <div><label>causa_kilos: </label> <?= $survey->getcausa_kilos(); ?></div>
            <div><label>peso_comodo: </label> <?= $survey->getpeso_comodo(); ?></div>
            <div><label>ultima_analitica: </label> <?= $survey->getultima_analitica(); ?></div>
            <div><label>ultima_analitica_txt: </label> <?= $survey->getultima_analitica_txt(); ?></div>
            <div><label>estado_general: </label> <?= $survey->getestado_general(); ?></div>
            <div><label>estado_general_txt: </label> <?= $survey->getestado_general_txt(); ?></div>
            <div><label>medicamento: </label> <?= $survey->getmedicamento(); ?></div>
            <div><label>medicamento_txt: </label> <?= $survey->getmedicamento_txt(); ?></div>
            <div><label>quirofano: </label> <?= $survey->getquirofano(); ?></div>
            <div><label>quirofano_txt: </label> <?= $survey->getquirofano_txt(); ?></div>
            <div><label>reglas: </label> <?= $survey->getreglas(); ?></div>
            <div><label>tension: </label> <?= $survey->gettension(); ?></div>
            <div><label>digestiones: </label> <?= $survey->getdigestiones(); ?></div>
            <div><label>bano: </label> <?= $survey->getbano(); ?></div>
            <div><label>alcohol: </label> <?= $survey->getalcohol(); ?></div>
            <div><label>tabaco: </label> <?= $survey->gettabaco(); ?></div>
            <div><label>rutina: </label> <?= $survey->getrutina(); ?></div>
            <div><label>cama: </label> <?= $survey->getcama(); ?></div>
            <div><label>caminar: </label> <?= $survey->getcaminar(); ?></div>
            <div><label>deporte: </label> <?= $survey->getdeporte(); ?></div>
            <div><label>deporte_txt: </label> <?= $survey->getdeporte_txt(); ?></div>
            <div><label>desayunos_txt: </label> <?= $survey->getdesayunos_txt(); ?></div>
            <div><label>media_manana_txt: </label> <?= $survey->getmedia_manana_txt(); ?></div>
            <div><label>meriendas_txt: </label> <?= $survey->getmeriendas_txt(); ?></div>
            <div><label>postre_txt: </label> <?= $survey->getpostre_txt(); ?></div>
            <div><label>postcena_txt: </label> <?= $survey->getpostcena_txt(); ?></div>
            <div><label>bebida_en_comidas: </label> <?= $survey->getbebida_en_comidas(); ?></div>
            <div><label>veces_fuera_casa: </label> <?= $survey->getveces_fuera_casa(); ?></div>
            <div><label>fuera_casa_trabajo: </label> <?= $survey->getfuera_casa_trabajo(); ?></div>
            <div><label>picoteas: </label> <?= $survey->getpicoteas(); ?></div>
            <div><label>ansiedad_comida: </label> <?= $survey->getansiedad_comida(); ?></div>
            <div><label>leche: </label> <?= $survey->getleche(); ?></div>
            <div><label>carne_roja: </label> <?= $survey->getcarne_roja(); ?></div>
            <div><label>pescado: </label> <?= $survey->getpescado(); ?></div>
            <div><label>huevos: </label> <?= $survey->gethuevos(); ?></div>
            <div><label>verduras: </label> <?= $survey->getverduras(); ?></div>
            <div><label>fruta: </label> <?= $survey->getfruta(); ?></div>
            <div><label>legumbres: </label> <?= $survey->getlegumbres(); ?></div>
            <div><label>patatas: </label> <?= $survey->getpatatas(); ?></div>
            <div><label>pan: </label> <?= $survey->getpan(); ?></div>
            <div><label>comida_rapida: </label> <?= $survey->getcomida_rapida(); ?></div>
            <div><label>precocinada: </label> <?= $survey->getprecocinada(); ?></div>
            <div><label>snacks: </label> <?= $survey->getsnacks(); ?></div>
            <div><label>bolleria: </label> <?= $survey->getbolleria(); ?></div>
            <div><label>intolerancia_txt: </label> <?= $survey->getintolerancia_txt(); ?></div>
            <div><label>vegetariana_txt: </label> <?= $survey->getvegetariana_txt(); ?></div>
            <div><label>sin_gracia: </label> <?= $survey->getsin_gracia(); ?></div>
            <div><label>con_gracia: </label> <?= $survey->getcon_gracia(); ?></div>
            <div><label>trabajo: </label> <?= $survey->gettrabajo(); ?></div>
            <div><label>unico: </label> <?= $survey->getunico(); ?></div>
            <div><label>comentarios: </label> <?= $survey->getcomentarios(); ?></div>
            <div><label>paciente_nombre: </label> <?= $survey->getpaciente_nombre(); ?></div>
            <div><label>paciente_apellidos: </label> <?= $survey->getpaciente_apellidos(); ?></div>
            <div><label>paciente_nif: </label> <?= $survey->getpaciente_nif(); ?></div>
            <div><label>paciente_email: </label> <?= $survey->getpaciente_email(); ?></div>
            <div><label>paciente_repite: </label> <?= $survey->getpaciente_repite(); ?></div>
            <div><label>paciente_telefono: </label> <?= $survey->getpaciente_telefono(); ?></div>
            <div><label>paciente_calle: </label> <?= $survey->getpaciente_calle(); ?></div>
            <div><label>paciente_numero: </label> <?= $survey->getpaciente_numero(); ?></div>
            <div><label>paciente_piso_letra: </label> <?= $survey->getpaciente_piso_letra(); ?></div>
            <div><label>paciente_cp: </label> <?= $survey->getpaciente_cp(); ?></div>
            <div><label>paciente_ciudad: </label> <?= $survey->getpaciente_ciudad(); ?></div>
            <div><label>paciente_provincia: </label> <?= $survey->getpaciente_provincia(); ?></div>
            <div><label>newsletter: </label> <?= $survey->getnewsletter(); ?></div>

        <?php
        }
        public static function continueSurvey($survey)
        {
        ?>

            <div><label>order: </label> <?= $survey->getorder(); ?> </div>
            <div><label>estricta: </label> <?= $survey->getestricta(); ?> </div>
            <div><label>pesado: </label> <?= $survey->getpesado(); ?> </div>
            <div><label>fuera_casa: </label> <?= $survey->getfuera_casa(); ?> </div>
            <div><label>picoteado: </label> <?= $survey->getpicoteado(); ?> </div>
            <div><label>cocinado: </label> <?= $survey->getcocinado(); ?> </div>
            <div><label>cambios: </label> <?= $survey->getcambios(); ?> </div>
            <div><label>hambre: </label> <?= $survey->gethambre(); ?> </div>
            <div><label>ansiedad: </label> <?= $survey->getansiedad(); ?> </div>
            <div><label>echas_menos: </label> <?= $survey->getechas_menos(); ?> </div>
            <div><label>gustado: </label> <?= $survey->getgustado(); ?> </div>
            <div><label>gustado_txt: </label> <?= $survey->getgustado_txt(); ?> </div>
            <div><label>menores: </label> <?= $survey->getmenores(); ?> </div>
            <div><label>menores_txt: </label> <?= $survey->getmenores_txt(); ?> </div>
            <div><label>digestiones: </label> <?= $survey->getdigestiones(); ?> </div>
            <div><label>bano: </label> <?= $survey->getbano(); ?> </div>
            <div><label>ejercicio: </label> <?= $survey->getejercicio(); ?> </div>
            <div><label>altura: </label> <?= $survey->getaltura(); ?> </div>
            <div><label>peso: </label> <?= $survey->getpeso(); ?> </div>
            <div><label>per_ci: </label> <?= $survey->getper_ci(); ?> </div>
            <div><label>per_ca: </label> <?= $survey->getper_ca(); ?> </div>
            <div><label>comentarios: </label> <?= $survey->getcomentarios(); ?> </div>
            <div><label>paciente_nif: </label> <?= $survey->getpaciente_nif(); ?> </div>

<?php
        }
    } // EOC
} // namespace
