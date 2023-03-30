<?php

namespace App\Http\Controllers;

use JanuSoftware\Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;


use Illuminate\Http\Request;

class FinancialStatusController extends Controller
{
    public function index($adId){
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
            $request = $fb->get("/$adId/insights?fields=spend%2Cupdated_time%2Cobjective%2Caccount_name%2Cad_name%2Creach%2Cactions%2Ccost_per_action_type%2Ccreated_time.time_increment(5)&");
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

        $name= $insights['data'][0][  'ad_name'  ];
        $creats= $insights['data'][0][  'date_start'  ];
        $creatst= $insights['data'][0][  'date_stop'  ];
        $obj=$insights['data'][0][  'objective'  ];
        $Aname=$insights['data'][0][  'account_name'  ];
        $Alc=$insights['data'][0][  'reach'  ];
        //$Clp=$insights['data'][0]['actions'][1][  'value'  ];


        return view('client-profile', compact('name','obj','Aname','Alc','creats','creatst'));
        //return view('client-profile',compact('Clp'));
    }
}
