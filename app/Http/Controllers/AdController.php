<?php

namespace App\Http\Controllers;

use App\Traits\ReportTrait;
use App\Mail\ReportCampaignsEmail;
use JanuSoftware\Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdController extends Controller
{
    use ReportTrait;

    public function indexAdsAll(int $account_id, string $account_name)
    {
        $account_id1 = env('FB_PAGE_ID'); //ID de CUENTA PUBLICITARIA
        $accessToken = env('FB_ACCESS_TOKEN');
        $url = "https://graph.facebook.com/v15.0/$account_id1/ads?fields=id,name,creative{actor_id,image_url},adset{start_time,end_time,promoted_object{object_store_url}}&access_token=$accessToken";
        $imageDefault = "https://www.shutterstock.com/image-vector/no-image-available-picture-coming-600w-2057829641.jpg";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $page_id = $account_id;

        $response = json_decode($result, true);
        $ads = array();
        $limite = 90;
        foreach ($response['data'] as $value) {
            //echo json_encode($value, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) . "<br>";
            $end_time = $value['adset']['end_time'];
            $end_time = substr($end_time, 0, strpos($end_time, 'T'));
            //echo $end_time ." ".$value['adset']['object_store_url']." ". "<br>";
            $end_time = Carbon::parse($end_time);
            $today = Carbon::parse(Carbon::now('America/Monterrey'));
            $date_diff = $end_time->diffInDays($today);
            // echo $date_diff;
            if ($date_diff <= $limite) {
                if ($value['creative']['actor_id'] == $page_id) {
                    if (!isset($value['creative']['image_url'])) {
                        $value['creative']['image_url'] = $imageDefault;
                    }
                    $ads[] = $value;
                }
            } else if ($date_diff > $limite) {
                break;
            }
        }

        //Bucle en caso de que existan más resultados en paginado
        while (isset($next_page)) {

            // Llamado a la API utilizando CURL con paginado
            $url = $response['paging']['next'];
            $response = file_get_contents($url);
            $response = json_decode($response, true);
            foreach ($response['data'] as $value) {
                //echo json_encode($value, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) . "<br>";
                $end_time = $value['adset']['end_time'];
                $end_time = substr($end_time, 0, strpos($end_time, 'T'));
                //echo $end_time ." ".$value['adset']['object_store_url']." ". "<br>";
                $end_time = Carbon::parse($end_time);
                $today = Carbon::parse(Carbon::now('America/Monterrey'));
                $date_diff = $end_time->diffInDays($today);
                // echo $date_diff;
                if ($date_diff <= $limite) {
                    if ($value['creative']['actor_id'] == $page_id) {
                        if (!isset($value['creative']['image_url'])) {
                            $value['creative']['image_url'] = $imageDefault;
                        }
                        $ads[] = $value;
                    }
                } else if ($date_diff > $limite) {
                    break;
                }
            }
            if (isset($response['paging']['next'])) {
                $next_page = $response['paging']['next'];
            } else {
                $next_page = null;
            }
        }


        $d = json_encode($ads, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        //echo json_encode($ads, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $adsD = json_decode($d, true);

        //dd($adsD);
        return view('ads.ads-all', compact('adsD', 'account_id', 'account_name'));
    }

    public function sendReportAd(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $msg = 'Hola ' . $user->name . ' ' . $user->last_name . ', te enviamos el reporte de tus anuncios de Facebook.';

        $pdf = Pdf::loadView('pdf.ad-report');
        $report2 = $pdf->output();

        Mail::to($user->email)->send(new ReportCampaignsEmail($msg, $report2));
        return redirect()->route('ad_info')->with('success', 'Reporte enviado correctamente.');
    }


    public function viewReport($adId)
    {
        $report = 'pdf.ad_report';
        $data = $this->filter($adId);
        $pdf = Pdf::loadView($report, $data);
        return $pdf->stream();
        // return $this->generateReport($report);
    }
    public function viewReport1($adId)
    {
        $report = 'pdf.ad_report1';
        $data = $this->desglose($adId);
        $pdf = Pdf::setPaper('A4', 'landscape')->loadView($report, $data);
        return $pdf->stream();
        // return $this->generateReport($report);
    }

    public function details($adId)
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
            if (isset($_POST['desde']) && isset($_POST['hasta'])) {
                $desde = $_POST['desde'];
                $hasta = $_POST['hasta'];
                if (empty($desde) && empty($hasta)) {
                    $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
                    $response = $request->getDecodedBody();

                    $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
                    $resp = $camp->getDecodedBody();

                    $lug = $fb->get("/$adId?fields=targeting&");
                    $lugares = $lug->getDecodedBody();

                    $int = $fb->get("/$adId?fields=targeting&");
                    $intereses = $int->getDecodedBody();

                    $gr = $fb->get("/$adId/insights?fields=reach&breakdowns=age,gender&sort_ascending");
                    $grK = $gr->getDecodedBody();
                } else {
                    $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_range[since]=$desde&time_range[until]=$hasta");
                    $response = $request->getDecodedBody();
                    $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_range[since]=$desde&time_range[until]=$hasta");
                    $resp = $camp->getDecodedBody();
                    $lug = $fb->get("/$adId?fields=targeting&");
                    $lugares = $lug->getDecodedBody();

                    $int = $fb->get("/$adId?fields=targeting&");
                    $intereses = $int->getDecodedBody();
                    $gr = $fb->get("/$adId/insights?fields=reach&breakdowns=age,gender&sort_ascending");
                    $grK = $gr->getDecodedBody();
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

                $gr = $fb->get("/$adId/insights?fields=reach&breakdowns=age,gender&sort_ascending");
                $grK = $gr->getDecodedBody();
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

        $graf = json_encode($grK, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $graficaK = json_decode($graf, true);
        // dd($lu);
        // echo '<pre>';
        // print_r($lu);
        // echo '</pre>';
        if (empty($ad['data']) & empty($ca['data'])) {
            $name = "";
            $imp = "";
            $date1 = "";
            $date2 = "";
            $time = "";
            $alc = "";
            $tasa = "";
            $claf = "";
            $gasto = "";
            $pre = "";
            //Formato de la fecha
            $endtime = "";
            //Formato de la fecha
            $puja = "";
            $locations = "";
            $interests = "";
            $fecha = "";
            $costA = "";
            $costV = "";
            $costR = "";
            $ca = "";
            $ad = "";
            $edad = "";
            $genero = "";
            $gen = "";
        } else {
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
            for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
                if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.post_save") {
                    $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Publicación guardada";
                }
                if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "post_engagement") {
                    $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Compromiso con la publicación";
                }
                if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "link_click") {
                    $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Publicación guardada";
                }
                if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "page_engagement") {
                    $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Interacción con la página";
                }
                if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.messaging_conversation_started_7d") {
                    $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Conversaciones de mensajería iniciadas";
                }
                if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "lead") {
                    $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Clientes potenciales";
                }
                if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.lead_grouped") {
                    $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Todos los clientes potenciales en Facebook";
                }
                if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "leadgen_grouped") {
                    $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Clientes potenciales en Facebook provenientes de Messenger e Instant Forms";
                }
                $costA[] = $ad['data'][0]['cost_per_action_type'][$i]['action_type'];
            }
            $costV = [];
            for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
                $costV[] = $ad['data'][0]['cost_per_action_type'][$i]['value'] / ($ca['campaign']['budget_remaining'] / 100);
            }
            $costR = [];
            for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
                $costR[] = $ad['data'][0]['cost_per_action_type'][$i]['value'];
            }
            //   dd($graficaK);
            //   echo '<pre>';
            //   print_r($graficaK);
            //   echo '</pre>';


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

            // $sex = [];
            // for ($i = 0; $i < count($graficaK['data']); $i++) {
            //     $sex[] = $graficaK['data'][$i]['gender'];
            //     if (($clave = array_search("unknown", $sex)) !== false) {
            //         unset($sex[$clave]);
            //     }
            // }
            //     for($h=1; $h<$z; $h+=2){
            //     print_r($arre[$h].",");
            //    }
            //   for($h=0; $h<$z-1; $h+=2){
            //       print_r($arre[$h].",");
            //       }
            // print_r($arre);
            //  dd($agr);
            //  echo '<pre>';
            //  print_r($agr);
            //  echo '</pre>';

            //     dd($alcance);
            //     echo '<pre>';
            //     var_dump($alcance);
            //     echo '</pre>';

            $genero = [];
            for ($i = 0; $i < count($graficaK['data']); $i++) {
                $genero[] = $graficaK['data'][$i]['gender'];
                $genero = array_unique($genero);
            }

            $hoy = getdate();
            $year = $hoy['year'];
            $md = $hoy['mday'];
            $wd = $hoy['mon'];

            $fecha = $md . "-" . $wd . "-" . $year;
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


            // $data = graficaJ($adId);
        }

        $grafPresupuesto = $this->grafPresupuesto($adId);


        return view('ads.ad-info', compact('adId', 'grafPresupuesto', 'imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'locations', 'interests', 'fecha', 'costA', 'costV', 'ca', 'ad', 'edad', 'genero', 'graficaK', 'gen', 'costR'));
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

    public function adInfo1($adId, $time)
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
            $request1 = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
            $response1 = $request1->getDecodedBody();

            $camp1 = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
            $resp1 = $camp1->getDecodedBody();

            $lug = $fb->get("/$adId?fields=targeting&");
            $lugares = $lug->getDecodedBody();

            $int = $fb->get("/$adId?fields=targeting&");
            $intereses = $int->getDecodedBody();

            if ($time == '?dia=dia&&page=1') {
                $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_increment=1");
                $response = $request->getDecodedBody();
                $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_increment=1");
                $resp = $camp->getDecodedBody();
            }

            if ($time == '?week=week&&page=1') {
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
            $costV[] = $ad['data'][0]['cost_per_action_type'][$i]['value'];
        }

        $hoy = getdate();
        $year = $hoy['year'];
        $md = $hoy['mday'];
        $wd = $hoy['mon'];

        $fecha = $md . "-" . $wd . "-" . $year;
        if ($time == '?dia=dia&&page=1') {
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
            return view('ads.ad-info1', compact('adId', 'i', 'ad', 'ca', 'imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'date1', 'date2', 'locations', 'interests', 'fecha', 'costA', 'costV'));
        }
        if ($time == '?week=week&&page=1') {
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
            return view('ads.ad-info1', compact('adId', 'i', 'ad', 'ca', 'imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'date1', 'date2', 'locations', 'interests', 'fecha', 'costA', 'costV'));
        }
    }

    private function filter($adId)
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

                    $lug = $fb->get("/$adId/insights?&breakdowns=region");
                    $lugares = $lug->getDecodedBody();

                    $int = $fb->get("/$adId?fields=targeting&");
                    $intereses = $int->getDecodedBody();
                } else {
                    $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_range[since]=$desde&time_range[until]=$hasta");
                    $response = $request->getDecodedBody();
                    $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_range[since]=$desde&time_range[until]=$hasta");
                    $resp = $camp->getDecodedBody();
                    $lug = $fb->get("/$adId/insights?&breakdowns=region");
                    $lugares = $lug->getDecodedBody();

                    $int = $fb->get("/$adId?fields=targeting&");
                    $intereses = $int->getDecodedBody();
                }
            } else {
                $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
                $response = $request->getDecodedBody();

                $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
                $resp = $camp->getDecodedBody();

                $lug = $fb->get("/$adId/insights?&breakdowns=region");
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
        $locations = [];
        for ($i = 0; $i < count($lu['data']); $i++) {
        $locations[] = $lu['data'][$i]['region'] ;
        }
        $costA = [];
        for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
            if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.post_save") {
                $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Publicación guardada";
            }
            if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "post_engagement") {
                $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Compromiso con la publicación";
            }
            if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "link_click") {
                $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Publicación guardada";
            }
            if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "page_engagement") {
                $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Interacción con la página";
            }
            if ($ad['data'][0]['cost_per_action_type'][$i]['action_type'] == "onsite_conversion.messaging_conversation_started_7d") {
                $ad['data'][0]['cost_per_action_type'][$i]['action_type'] = "Conversaciones de mensajería iniciadas";
            }
            $costA[] = $ad['data'][0]['cost_per_action_type'][$i]['action_type'];
        }
        $costV = [];
        for ($i = 0; $i < count($ad['data'][0]['cost_per_action_type']); $i++) {
            $costV[] = $ad['data'][0]['cost_per_action_type'][$i]['value'] / ($ca['campaign']['budget_remaining'] / 100);
        }
        date_default_timezone_set('America/Mexico_City');
        $hoy = getdate();
        $year = $hoy['year'];
        $md = $hoy['mday'];
        $wd = $hoy['mon'];
        $hora = $hoy['hours'];
        $min = $hoy['minutes'];

        $fecha = $md . "-" . $wd . "-" . $year;
        $hora = $md . "-" . $wd . "-" . $year . " " . "Hora:" . " " . $hora . ":" . $min;

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
            $endtime = date("d-m-y", $timestamp);
            //Formato de la fecha
            $puja = $ca['campaign']['bid_strategy'];
            if ($puja == "LOWEST_COST_WITHOUT_CAP") {
                $puja = "Costo más bajo";
            }
            $finicio = $ad['data'][0]['date_start'];
            // $finicio =date("d-m-Y", $datestart);
        }

        //$spend = $ad['data'][0]['spend'];
        // print_r($ad['data'][0]['impressions']);  impressions
        // print_r($ad['data'][0]['frequency']); frequency
        // print_r($ad['data'][0]['date_start']);
        // print_r($ad['data'][0]['date_stop']);
        return compact('imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'locations', 'interests', 'fecha', 'costA', 'costV', 'ca', 'hora', 'finicio');
    }



    private function desglose($adId)
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

            $request1 = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_increment=1");
            $response1 = $request1->getDecodedBody();

            $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
            $response = $request->getDecodedBody();

            $camp1 = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_increment=1");
            $resp1 = $camp1->getDecodedBody();

            $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
            $resp = $camp->getDecodedBody();

            $lug = $fb->get("/$adId/insights?&breakdowns=region");
            $lugares = $lug->getDecodedBody();

            $int = $fb->get("/$adId?fields=targeting&");
            $intereses = $int->getDecodedBody();

            $gr = $fb->get("/$adId/insights?fields=reach&breakdowns=age,gender&sort_ascending");
            $grK = $gr->getDecodedBody();
            if (isset($_GET['desde']) && isset($_GET['hasta'])) {
                $desde = $_GET['desde'];
                $hasta = $_GET['hasta'];
                if (empty($desde) && empty($hasta)) {
                    $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
                    $response = $request->getDecodedBody();

                    $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
                    $resp = $camp->getDecodedBody();

                    $lug = $fb->get("/$adId/insights?&breakdowns=region");
                    $lugares = $lug->getDecodedBody();

                    $int = $fb->get("/$adId?fields=targeting&");
                    $intereses = $int->getDecodedBody();
                } else {
                    $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name&time_range[since]=$desde&time_range[until]=$hasta");
                    $response = $request->getDecodedBody();
                    $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}&time_range[since]=$desde&time_range[until]=$hasta");
                    $resp = $camp->getDecodedBody();
                    $lug = $fb->get("/$adId/insights?&breakdowns=region");
                    $lugares = $lug->getDecodedBody();

                    $int = $fb->get("/$adId?fields=targeting&");
                    $intereses = $int->getDecodedBody();
                }
            } else {
                $request = $fb->get("$adId/insights?fields=updated_time,reach,impressions,cost_per_action_type,engagement_rate_ranking,quality_ranking,spend,ad_name");
                $response = $request->getDecodedBody();

                $camp = $fb->get("$adId?fields=id,name,campaign{name,bid_strategy,budget_remaining},adset{end_time}");
                $resp = $camp->getDecodedBody();

                $lug = $fb->get("/$adId/insights?&breakdowns=region");
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
        $n = json_encode($response1, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ad = json_decode($n, true);

        $n1 = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ad1 = json_decode($n1, true);

        $c = json_encode($resp1, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ca = json_decode($c, true);

        $c1 = json_encode($resp, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $ca1 = json_decode($c1, true);

        $l = json_encode($lugares, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $lu = json_decode($l, true);

        $in = json_encode($intereses, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $inte = json_decode($in, true);

        $d = json_encode($response1, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $dia = json_decode($d, true);

        $dc = json_encode($resp1, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $diac = json_decode($dc, true);

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

$locations = [];
for ($i = 0; $i < count($lu['data']); $i++) {
$locations[] = $lu['data'][$i]['region'] ;
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
                $ad1['data'][0]['cost_per_action_type'][$i]['action_type'] = "Interacción con la página";
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
        for ($i = 0; $i < count($ad1['data'][0]['cost_per_action_type']); $i++) {
            $costR[] = $ad1['data'][0]['cost_per_action_type'][$i]['value'];
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

        $fecha = $md . "-" . $wd . "-" . $year;
        $hora = $md . "-" . $wd . "-" . $year . " Hora:" . $hour . ":" . $m;
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
        $finicio = $ad1['data'][0]['date_start'];
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

        return  compact('adId', 'i', 'ad', 'ca', 'imp', 'name', 'time', 'alc', 'tasa', 'claf', 'gasto', 'pre', 'endtime', 'puja', 'date1', 'date2', 'locations', 'interests', 'fecha', 'costA', 'costV', 'edad', 'genero', 'graficaK', 'gen', 'costR','hora','finicio');
    }

}
