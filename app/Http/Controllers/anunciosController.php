<?php

namespace App\Http\Controllers;

use JanuSoftware\Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class anunciosController extends Controller
{
    public function filter($adId)
    {
        // Especifica la información de autenticación
        // Token de acceso y ID de la cuenta publicitaria
        $appId = '714212166742095';
        $access_token = env('FB_ACCESS_TOKEN');
        $graphVersion = 'v15.0';
        $appSecret = env('FB_APP_SECRET');

        // Inicializar la API Graph de Facebook
        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => $graphVersion,
            'default_access_token' => $access_token, // optional
        ]);

        try {
            if (isset($_GET['desde']) && isset($_GET['hasta'])) {
                $desde = $_GET['desde'];
                $hasta = $_GET['hasta'];
                if (empty($desde) && empty($hasta)) {
                    $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
                    $response = $request->getDecodedBody();

                    $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
                    $resp = $camp->getDecodedBody();

                    $lug = $fb->get("/$adId?fields=targeting&");
                    $lugares = $lug->getDecodedBody();

                    $int = $fb->get("/$adId?fields=targeting&");
                    $intereses = $int->getDecodedBody();
                } else {
                    $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_range[since]=$desde&time_range[until]=$hasta");
                    $response = $request->getDecodedBody();
                    $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_range[since]=$desde&time_range[until]=$hasta");
                    $resp = $camp->getDecodedBody();
                    $lug = $fb->get("/$adId?fields=targeting&");
                    $lugares = $lug->getDecodedBody();

                    $int = $fb->get("/$adId?fields=targeting&");
                    $intereses = $int->getDecodedBody();
                }
            } else {
                $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
                $response = $request->getDecodedBody();

                $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
                $resp = $camp->getDecodedBody();

                $lug = $fb->get("/$adId?fields=targeting&");
                $lugares = $lug->getDecodedBody();

                $int = $fb->get("/$adId?fields=targeting&");
                $intereses = $int->getDecodedBody();
            }
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        //dd($response);
        $n = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ad = json_decode($n, true);

        $c = json_encode($resp, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ca = json_decode($c, true);

        $l = json_encode($lugares, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $lu = json_decode($l, true);

        $in = json_encode($intereses, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $inte = json_decode($in, true);
        // dd($ca);
        // echo '<pre>';
        // print_r($ca);
        // echo '</pre>';
        $interests = [];
        for ($i = 0; $i < count($inte['targeting']['flexible_spec'][0]['interests']); $i++) {
            $interests[] = $inte['targeting']['flexible_spec'][0]['interests'][$i]['name'];
        }
        $locations = [];
        for ($i = 0; $i < count($lu['targeting']['geo_locations']['regions']); $i++) {
            $locations[] = $lu['targeting']['geo_locations']['regions'][$i]['name'];
        }
        $costA = [];
        for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
            $costA[] = $ad['data'][0]['cost_per_action_type'][$i]['action_type'];
        }
        $costV = [];
        for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
            $costV[] = $ad['data'][0]['cost_per_action_type'][$i]['value'] / ($ca['campaign']['budget_remaining'] / 100);
        }

        $hoy = getdate();
        $year = $hoy['year'];
        $md = $hoy['mday'];
        $wd = $hoy['mon'];
        $hour = $hoy['hours'];

        $fecha = $md . "-" . $wd . "-" . $year . $hour;
        if (empty($ad['data']) && empty($ca['data'])) {
            $name = 0;
            $imp = 0;
            $time = 0;
            $alc = 0;
            $cpa = 0;
            $tasa = 0;
            $claf = 0;
            $gasto = 0;
            $name = "";
            $puja = 0;
            $endtime = 0;
            $pre = 0;
        } else {
            $name = $ca['name'];
            $imp = $ad['data'][0]['impressions'];
            $time = $ad['data'][0]['updated_time'];
            $alc = $ad['data'][0]['reach'];
            $tasa = $ad['data'][0]['engagement_rate_ranking'];
            $claf = $ad['data'][0]['quality_ranking'];
            if ($claf == "AVERAGE") {
                $claf = "PROMEDIO";
            }
            if ($claf == "BELOW_AVERAGE_35") {
                $claf = "POR DEBAJO DEL PROMEDIO";
            }
            if ($tasa == "AVERAGE") {
                $tasa = "PROMEDIO";
            }
            if ($tasa == "BELOW_AVERAGE_35") {
                $tasa = "POR DEBAJO DEL PROMEDIO";
            }
            $gasto = $ad['data'][0]['spend'];
            $pre = $ca['campaign']['budget_remaining'];
            //Formato de la fecha
            $newDate = $ca['adset']['end_time'];
            $timestamp = strtotime($newDate);
            $endtime = date("d-m-Y", $timestamp);
            //Formato de la fecha
            $puja = $ca['campaign']['bid_strategy'];
            if ($puja == "LOWEST_COST_WITHOUT_CAP") {
                $puja = "Costo más bajo";
            }
        }

        //$spend = $ad['data'][0]['spend'];
        // print_r($ad['data'][0]['impressions']);  impressions
        // print_r($ad['data'][0]['frequency']); frequency
        // print_r($ad['data'][0]['date_start']);
        // print_r($ad['data'][0]['date_stop']);
        return view('ads.ad-info', compact('imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'locations', 'interests', 'fecha', 'costA', 'costV', 'ca'));
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function filterF()
    {
        // Especifica la información de autenticación
        // Token de acceso y ID de la cuenta publicitaria
        $appId = '714212166742095';
        $access_token = env('FB_ACCESS_TOKEN');
        $graphVersion = 'v15.0';
        $appSecret = env('FB_APP_SECRET');

        $adId = $_GET['ad_id'];

        // Grafica de presupuesto
        $grafPresupuesto = $this->grafPresupuesto($adId);

        // Inicializar la API Graph de Facebook
        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => $graphVersion,
            'default_access_token' => $access_token, // optional
        ]);

        try {
            $request1 = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
            $response1 = $request1->getDecodedBody();

            $camp1 = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
            $resp1 = $camp1->getDecodedBody();

            $lug = $fb->get("/$adId?fields=targeting&");
            $lugares = $lug->getDecodedBody();

            $int = $fb->get("/$adId?fields=targeting&");
            $intereses = $int->getDecodedBody();

            $gr = $fb->get("/$adId/insights?fields=reach&breakdowns=age,gender&sort_ascending");
            $grK = $gr->getDecodedBody();

            if (isset($_GET['dia'])) {
                $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_increment=1");
                $response = $request->getDecodedBody();
                $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_increment=1");
                $resp = $camp->getDecodedBody();
            }

            if (isset($_GET['week'])) {
                $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_increment=7");
                $response = $request->getDecodedBody();
                $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_increment=7");
                $resp = $camp->getDecodedBody();
            }
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        //dd($response);
        $n = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ad = json_decode($n, true);

        $c = json_encode($resp, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ca = json_decode($c, true);

        $n1 = json_encode($response1, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ad1 = json_decode($n1, true);

        $c1 = json_encode($resp1, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ca1 = json_decode($c1, true);

        $l = json_encode($lugares, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $lu = json_decode($l, true);

        $in = json_encode($intereses, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $inte = json_decode($in, true);

        $graf = json_encode($grK, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $graficaK = json_decode($graf, true);
        // dd($ca);
        // echo '<pre>';
        // print_r($ca);
        // echo '</pre>';
        $interests = [];
        for ($i = 0; $i < count($inte['targeting']['flexible_spec'][0]['interests']); $i++) {
            $interests[] = $inte['targeting']['flexible_spec'][0]['interests'][$i]['name'];
        }
        if (empty($lu['targeting']['geo_locations']['regions'])) {
            $locations[] = "No hat datos";
        } else {
            $locations = [];
            for ($i = 0; $i < count($lu['targeting']['geo_locations']['regions']); $i++) {
                $locations[] = $lu['targeting']['geo_locations']['regions'][$i]['name'];
            }
        }
        $costA = [];
        for ($i = 0; $i < count($ad1['data'][0]['cost_per_action_type']); $i++) {
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.post_save") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Publicación guardada";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "post_engagement") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Compromiso con la publicación";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "link_click") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Publicación guardada";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "page_engagement") {
                $aad1d['data'][0]['cost_per_action_type'][$i]['action_type'] = "Interacción con la página";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.messaging_conversation_started_7d") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Conversaciones de mensajería iniciadas";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "lead") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Clientes potenciales";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.lead_grouped") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Todos los clientes potenciales en Facebook";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "leadgen_grouped") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Clientes potenciales en Facebook provenientes de Messenger e Instant Forms";
            }
            $costA[] = $ad1['data'][0]['cost_per_action_type'][$i]['action_type'];
        }
        $costV = [];
        for ($i = 0; $i < count($ad1['data'][0]['cost_per_action_type']); $i++) {
            $costV[] = $ad1['data'][0]['cost_per_action_type'][$i]['value'] / ($ca['campaign']['budget_remaining'] / 100);
        }
        $costR = [];
        for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
            $costR[] = $ad['data'][0]['cost_per_action_type'][$i]['value'];
        }
        $edad = [];
        for ($i = 0; $i < count($graficaK['data']); $i++) {
            $edad[] = $graficaK['data'][$i]['age'];
            $edad = array_unique($edad);
        }

        for ($i = 0; $i < count($graficaK['data']); $i++) {
            $alcance[] = array("edad" => $graficaK['data'][$i]['age'], "alcance" => $graficaK['data'][$i]['reach'], "sex" => $graficaK['data'][$i]['gender']);
            if ($alcance[$i]['sex'] == "unknown") {
                unset($alcance[$i]);
            }
        }


        $alcance = array_values($alcance);


        $agr = array();
        $gen = array();

        foreach ($alcance as $k => $alca) {
            $gen[$alca['edad']][] = $alca['alcance'];
        }
        $z = 1;
        foreach ($gen as $k => $arr) {
            foreach ($arr as $k => $v) {
                $arre[] = $v;
                $z++;
            }
        }
        $genero = [];
        for ($i = 0; $i < count($graficaK['data']); $i++) {
            $genero[] = $graficaK['data'][$i]['gender'];
            $genero = array_unique($genero);
        }
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $year = $hoy['year'];
        $md = $hoy['mday'];
        $wd = $hoy['mon'];
        $hour = $hoy['hours'];
        $m = $hoy['minutes'];

        $fecha = $md . "-" . $wd . "-" . $year . "Hora:" . $hour . ":" . $m;
        if (isset($_GET['dia'])) {
            for ($i = 0; $i < count($ad['data']); $i++) {
                $i;
            }
            if (empty($ad1['data']) && empty($ca1['data'])) {
                $name = 0;
                $imp = 0;
                $time = 0;
                $alc = 0;
                $cpa = 0;
                $tasa = 0;
                $claf = 0;
                $gasto = 0;
                $name = "";
                $puja = 0;
                $endtime = 0;
                $pre = 0;
            } else {
                $name = $ca1['name'];
                $imp = $ad1['data'][0]['impressions'];
                $date1 = $ad1['data'][0]['date_start'];
                $date2 = $ad1['data'][0]['date_stop'];
                $time = $ad1['data'][0]['updated_time'];
                $alc = $ad1['data'][0]['reach'];
                $tasa = $ad1['data'][0]['engagement_rate_ranking'];
                $claf = $ad1['data'][0]['quality_ranking'];
                if ($claf == "AVERAGE") {
                    $claf = "PROMEDIO";
                }
                if ($claf == "BELOW_AVERAGE_35") {
                    $claf = "POR DEBAJO DEL PROMEDIO";
                }
                if ($tasa == "AVERAGE") {
                    $tasa = "PROMEDIO";
                }
                if ($tasa == "BELOW_AVERAGE_35") {
                    $tasa = "POR DEBAJO DEL PROMEDIO";
                }
                $gasto = $ad1['data'][0]['spend'];
                $pre = $ca1['campaign']['budget_remaining'];
                //Formato de la fecha
                $newDate = $ca1['adset']['end_time'];
                $timestamp = strtotime($newDate);
                $endtime = date("d-m-Y", $timestamp);
                //Formato de la fecha
                $puja = $ca1['campaign']['bid_strategy'];
                if ($puja == "LOWEST_COST_WITHOUT_CAP") {
                    $puja = "Costo más bajo";
                }
            }
            return view('Ads.ad-info1', compact('adId', 'grafPresupuesto', 'i', 'ad', 'ca', 'imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'date1', 'date2', 'locations', 'interests', 'fecha', 'costA', 'costV', 'edad', 'genero', 'graficaK', 'gen', 'costR'));
        }
        if (isset($_GET['week'])) {
            for ($i = 0; $i < count($ad['data']); $i++) {
                $i;
            }
            if (empty($ad1['data']) && empty($ca1['data'])) {
                $name = 0;
                $imp = 0;
                $time = 0;
                $alc = 0;
                $cpa = 0;
                $tasa = 0;
                $claf = 0;
                $gasto = 0;
                $name = "";
                $puja = 0;
                $endtime = 0;
                $pre = 0;
            } else {
                $name = $ca1['name'];
                $imp = $ad1['data'][0]['impressions'];
                $time = $ad1['data'][0]['updated_time'];
                $alc = $ad1['data'][0]['reach'];
                $date1 = $ad1['data'][0]['date_start'];
                $date2 = $ad1['data'][0]['date_stop'];
                $tasa = $ad1['data'][0]['engagement_rate_ranking'];
                $claf = $ad1['data'][0]['quality_ranking'];
                if ($claf == "AVERAGE") {
                    $claf = "PROMEDIO";
                }
                if ($tasa == "BELOW_AVERAGE_35") {
                    $tasa = "POR DEBAJO DEL PROMEDIO";
                }
                $gasto = $ad1['data'][0]['spend'];
                $pre = $ca1['campaign']['budget_remaining'];
                //Formato de la fecha
                $newDate = $ca1['adset']['end_time'];
                $timestamp = strtotime($newDate);
                $endtime = date("d-m-Y", $timestamp);
                //Formato de la fecha
                $puja = $ca1['campaign']['bid_strategy'];
                if ($puja == "LOWEST_COST_WITHOUT_CAP") {
                    $puja = "Costo más bajo";
                }
            }
            return view('ads.ad-info1', compact('adId', 'grafPresupuesto', 'i', 'ad', 'ca', 'imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'date1', 'date2', 'locations', 'interests', 'fecha', 'costA', 'costV', 'edad', 'genero', 'graficaK', 'gen'));
        }
    }

    private function grafPresupuesto($adId)
    {
        // Token de acceso y ID de la cuenta publicitaria
        $appId = '714212166742095';
        $access_token = env('FB_ACCESS_TOKEN');
        $graphVersion = 'v15.0';
        $appSecret = env('FB_APP_SECRET');

        // Inicializar la API Graph de Facebook
        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => $graphVersion,
            'default_access_token' => $access_token, // optional
        ]);

        try {
            // TODO: checar esta parte del AdId
            $request = $fb->get("/23853396924910372?fields=lifetime_budget%2Cbudget_remaining%2Cinsights.fields(spend)&");
            $response = $request->getDecodedBody();
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $n = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $insights = json_decode($n, true);

        $datet = $insights['insights']['data'][0]['date_stop'];
        $dates = $insights['insights']['data'][0]['date_start'];
        $imgast = $insights['budget_remaining'];
        $pre = $insights['insights']['data'][0]['spend'];
        //dd($date);

        return compact('imgast', 'pre', 'datet', 'dates');
    }

    public function deglose()
    {
        // Especifica la información de autenticación
        // Token de acceso y ID de la cuenta publicitaria
        $appId = '714212166742095';
        $access_token = env('FB_ACCESS_TOKEN');
        $graphVersion = 'v15.0';
        $appSecret = env('FB_APP_SECRET');

        $adId = $_GET['ad_id'];

        // Grafica de presupuesto
        $grafPresupuesto = $this->grafPresupuesto($adId);

        // Inicializar la API Graph de Facebook
        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => $graphVersion,
            'default_access_token' => $access_token, // optional
        ]);

        try {
            $request1 = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
            $response1 = $request1->getDecodedBody();

            $camp1 = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
            $resp1 = $camp1->getDecodedBody();

            $lug = $fb->get("/$adId?fields=targeting&");
            $lugares = $lug->getDecodedBody();

            $int = $fb->get("/$adId?fields=targeting&");
            $intereses = $int->getDecodedBody();

            $gr = $fb->get("/$adId/insights?fields=reach&breakdowns=age,gender&sort_ascending");
            $grK = $gr->getDecodedBody();

            $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_increment=1");
            $response = $request->getDecodedBody();
            $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_increment=1");
            $resp = $camp->getDecodedBody();
            
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        //dd($response);
        $n = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ad = json_decode($n, true);

        $c = json_encode($resp, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ca = json_decode($c, true);

        $n1 = json_encode($response1, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ad1 = json_decode($n1, true);

        $c1 = json_encode($resp1, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ca1 = json_decode($c1, true);

        $l = json_encode($lugares, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $lu = json_decode($l, true);

        $in = json_encode($intereses, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $inte = json_decode($in, true);

        $graf = json_encode($grK, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $graficaK = json_decode($graf, true);
        // dd($ca);
        // echo '<pre>';
        // print_r($ca);
        // echo '</pre>';
        $interests = [];
        for ($i = 0; $i < count($inte['targeting']['flexible_spec'][0]['interests']); $i++) {
            $interests[] = $inte['targeting']['flexible_spec'][0]['interests'][$i]['name'];
        }
        if (empty($lu['targeting']['geo_locations']['regions'])) {
            $locations[] = "No hat datos";
        } else {
            $locations = [];
            for ($i = 0; $i < count($lu['targeting']['geo_locations']['regions']); $i++) {
                $locations[] = $lu['targeting']['geo_locations']['regions'][$i]['name'];
            }
        }
        $costA = [];
        for ($i = 0; $i < count($ad1['data'][0]['cost_per_action_type']); $i++) {
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.post_save") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Publicación guardada";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "post_engagement") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Compromiso con la publicación";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "link_click") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Publicación guardada";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "page_engagement") {
                $aad1d['data'][0]['cost_per_action_type'][$i]['action_type'] = "Interacción con la página";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.messaging_conversation_started_7d") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Conversaciones de mensajería iniciadas";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "lead") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Clientes potenciales";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.lead_grouped") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Todos los clientes potenciales en Facebook";
            }
            if ($ad1['data'][0]['cost_per_action_type'][$i]['action_type'] == "leadgen_grouped") {
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Clientes potenciales en Facebook provenientes de Messenger e Instant Forms";
            }
            $costA[] = $ad1['data'][0]['cost_per_action_type'][$i]['action_type'];
        }
        $costV = [];
        for ($i = 0; $i < count($ad1['data'][0]['cost_per_action_type']); $i++) {
            $costV[] = $ad1['data'][0]['cost_per_action_type'][$i]['value'] / ($ca['campaign']['budget_remaining'] / 100);
        }
        $costR = [];
        for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
            $costR[] = $ad['data'][0]['cost_per_action_type'][$i]['value'];
        }
        $edad = [];
        for ($i = 0; $i < count($graficaK['data']); $i++) {
            $edad[] = $graficaK['data'][$i]['age'];
            $edad = array_unique($edad);
        }

        for ($i = 0; $i < count($graficaK['data']); $i++) {
            $alcance[] = array("edad" => $graficaK['data'][$i]['age'], "alcance" => $graficaK['data'][$i]['reach'], "sex" => $graficaK['data'][$i]['gender']);
            if ($alcance[$i]['sex'] == "unknown") {
                unset($alcance[$i]);
            }
        }


        $alcance = array_values($alcance);


        $agr = array();
        $gen = array();

        foreach ($alcance as $k => $alca) {
            $gen[$alca['edad']][] = $alca['alcance'];
        }
        $z = 1;
        foreach ($gen as $k => $arr) {
            foreach ($arr as $k => $v) {
                $arre[] = $v;
                $z++;
            }
        }
        $genero = [];
        for ($i = 0; $i < count($graficaK['data']); $i++) {
            $genero[] = $graficaK['data'][$i]['gender'];
            $genero = array_unique($genero);
        }
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $year = $hoy['year'];
        $md = $hoy['mday'];
        $wd = $hoy['mon'];
        $hour = $hoy['hours'];
        $m = $hoy['minutes'];

        $fecha = $md . "-" . $wd . "-" . $year . "Hora:" . $hour . ":" . $m;
        $hora = $md . "-" . $wd . "-" . $year . "Hora:" . $hour . ":" . $m;
        for ($i = 0; $i < count($ad['data']); $i++) {
            $i;
        }
        $name = $ca1['name'];
        $imp = $ad1['data'][0]['impressions'];
        $date1 = $ad1['data'][0]['date_start'];
        $date2 = $ad1['data'][0]['date_stop'];
        $time = $ad1['data'][0]['updated_time'];
        $alc = $ad1['data'][0]['reach'];
        $tasa = $ad1['data'][0]['engagement_rate_ranking'];
        $claf = $ad1['data'][0]['quality_ranking'];
        if ($claf == "AVERAGE") {
            $claf = "PROMEDIO";
        }
        if ($claf == "BELOW_AVERAGE_35") {
            $claf = "POR DEBAJO DEL PROMEDIO";
        }
        if ($tasa == "AVERAGE") {
            $tasa = "PROMEDIO";
        }
        if ($tasa == "BELOW_AVERAGE_35") {
            $tasa = "POR DEBAJO DEL PROMEDIO";
        }
        $gasto = $ad1['data'][0]['spend'];
        $pre = $ca1['campaign']['budget_remaining'];
        //Formato de la fecha
        $newDate = $ca1['adset']['end_time'];
        $timestamp = strtotime($newDate);
        $endtime = date("d-m-Y", $timestamp);
        //Formato de la fecha
        $puja = $ca1['campaign']['bid_strategy'];
        if ($puja == "LOWEST_COST_WITHOUT_CAP") {
            $puja = "Costo más bajo";
        }
        return view('pdf.ad-report', compact('adId', 'grafPresupuesto', 'i', 'ad', 'ca', 'imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'date1', 'date2', 'locations', 'interests', 'fecha', 'costA', 'costV', 'edad', 'genero', 'graficaK', 'gen', 'costR' . 'hora'));
    }
}
