<?php

namespace App\Http\Controllers;

use App\Mail\ReportCampaignsEmail;
use App\Models\User;
use App\Traits\ReportTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use JanuSoftware\Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Mail;

class CampaignsController extends Controller
{
    use ReportTrait;

    public function index(int $account_id, string $account_name)
    {
        // $idPaginaFB = 'act_322548194581565'; //ID de CUENTA PUBLICITARIA
        $idPaginaFB = env('FB_PAGE_ID'); //ID de CUENTA PUBLICITARIA
        $appId = env('FB_APP_ID');
        $appSecret = env('FB_APP_SECRET');
        $graphVersion = env('FB_GRAPH_VERSION', 'v16.0');
        $accessToken = env('FB_ACCESS_TOKEN');

        $fb = new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => $graphVersion,
            'default_access_token' => $accessToken, // optional
        ]);

        try {
            $request = $fb->get("/" . $idPaginaFB . "/campaigns?fields=id,name,adsets{id,name,promoted_object{page_id}}");
            $campaignsData = $request->getDecodedBody();
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $arreglito = [];
        for ($i = 0; $i < count($campaignsData['data']); $i++) {
            if ($campaignsData['data'][$i]['adsets']['data'][0]['promoted_object']['page_id'] == $account_id) {
                $arreglito[] = $campaignsData['data'][$i];
            }
        }

        $n = json_encode($arreglito, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $campaigns = json_decode($n, true);

        return view('campaigns.campaigns', compact('campaigns', 'account_id', 'account_name'));
    }

    public function sendReportCampaigns(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $msg = 'Hola ' . $user->name . ' ' . $user->last_name . ', te enviamos el reporte de tus campañas de Facebook.';

        $pdf = Pdf::loadView('pdf.campaign-report');
        $report2 = $pdf->output();

        Mail::to($user->email)->send(new ReportCampaignsEmail($msg, $report2));
        return redirect()->route('campaign_info')->with('success', 'Reporte enviado correctamente.');
    }

    public function viewReport()
    {
        return $this->generateReport('pdf.campaign-report');
    }

    public function details($campaignId)
    {
        $graphVersion = env('FB_GRAPH_VERSION', 'v16.0');
        $accessToken = env('FB_ACCESS_TOKEN');

        $url = "https://graph.facebook.com/$graphVersion/$campaignId/?fields=name,start_time,stop_time,objective,budget_remaining&access_token=$accessToken";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $dtails = json_decode($result, true);

        $start_time = $dtails['start_time'];
        $start_time = substr($start_time, 0, strpos($start_time, 'T'));

        $stop_time = $dtails['stop_time'];
        $stop_time = substr($stop_time, 0, strpos($stop_time, 'T'));

        $url2 = "https://graph.facebook.com/$graphVersion/$campaignId/insights?fields=impressions,reach,spend,cost_per_action_type&filtering=[{'field':'action_type','operator':'IN','value':['lead']}]&time_range={'since':'$start_time','until':'$stop_time'}&access_token=$accessToken";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result2 = curl_exec($ch);
        curl_close($ch);
        $insights = json_decode($result2, true);
        $insights = $insights['data'][0];

        $detailsData = [
            "id" => $dtails['id'],
            'name' => $dtails['name'],
            "budget_remaining" => "$" . $dtails['budget_remaining'] / 100,
            'result' => $insights['spend'] / $insights['cost_per_action_type'][0]['value'],
            'reach' => $insights['reach'],
            'impressions' => $insights['impressions'],
            'cost_per_result' => $insights['cost_per_action_type'][0]['value'],
            'spend' => $insights['spend'],
            "stop_time" => $dtails['stop_time'],
        ];

        $dTemp = json_encode($detailsData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $details = json_decode($dTemp, true);

        return view('campaigns.campaign-info', compact('details'));
    }

    public function campaignInfo1()
    {
        return view('campaigns.campaign-info1');
    }
}


