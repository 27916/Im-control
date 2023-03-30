<?php

namespace App\Http\Controllers;

use JanuSoftware\Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;


class PruebaController extends Controller
{
    public function index()
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
            $request = $fb->get("/23853396924910372?fields=lifetime_budget%2Cbudget_remaining%2Cinsights.fields(spend)&");
            $response = $request->getDecodedBody();
        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        //dd($response);


        $n = json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $insights = json_decode($n, true);

        //dd($insights);
        // echo '<pre>';
       //print_r($insights);
       //echo '</pre>';


        $datet= $insights['insights']['data'][0][  'date_stop'  ];
        $dates=$insights['insights']['data'][0][  'date_start'  ];
        $imgast= $insights [ 'budget_remaining'    ];
        $pre= $insights['insights']['data'][0][  'spend'   ];
        //dd($date);

        return view ('ads.ad-info',compact('imgast','pre','datet','dates'));
    }
}
