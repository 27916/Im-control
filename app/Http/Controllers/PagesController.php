<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
        public function index()
        {
        $idPaginaFB = env('FB_PAGE_ID'); //ID de CUENTA PUBLICITARIA
        $appId = env('FB_APP_ID');
        $appSecret = env('FB_APP_SECRET');
        $me = env('FB_ME');
        $graphVersion = env('FB_GRAPH_VERSION', 'v16.0');
        $accessToken = env('FB_ACCESS_TOKEN');

        /**
         * Extraer businesses
         */
        $url = "https://graph.facebook.com/$graphVersion/$me/businesses?fields=id&access_token=$accessToken";

        // Ejecutar la solicitud curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        // Decodificar la respuesta JSON, data['data'] es un arreglo con arreglos en su interior donde cada uno es una business
        $business = json_decode($result, true);

        if (isset($data['paging']['next'])) {
            $next_page = $business['paging']['next'];
          }

        //Bucle en caso de que existan más resultados en paginado
        while (isset($next_page)) {
            // Llamado a la API utilizando CURL con paginado
            $url = $business['paging']['next'];
            $response = file_get_contents($url);
            $response = json_decode($response, true);
            $business['data'] = array_merge($business['data'], $response['data']); //Agrega los resultados de los paginados al arreglo que contiene las del primer resultado
            // Si existe la siguiente página de resultados se guarda en variable, si no se quita su valor para salir del bucle
            if (isset($response['paging']['next'])) {
                $next_page = $response['paging']['next'];
            } else {
                $next_page = null;
            }
        }

        //var_dump($data['data']);
        $fbPages = array(); //Conunto de páginas por Business
        /**
         * Extraer todas las fbPages por business
         */
        foreach ($business['data'] as $key => $value) {
            $page = null;
            $aux = $value['id'];
            $url = "https://graph.facebook.com/$graphVersion/$aux/owned_pages?fields=name,id,link,picture&access_token=$accessToken";

            // Ejecutar la solicitud curl
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result2 = curl_exec($ch);
            curl_close($ch);

            $page = json_decode($result2, true);

            // echo json_encode($page, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            if (!count($page['data']) <= 0) {
                $fbPages[] = $page['data'];
                /**En fan pages se almacenan los page, cada page es un arreglo
                 * (cada arreglo es un conjunto a partir del business) con un arreglo en su interior, ese arreglo
                 * es una página, hay page que tienen 3 arreglos y otros que tienen sólo 1,
                 */
            }
        }
        /**
         * Extraer las fbPages de sus conjuntos por business en un arreglo común
         */
        $pagesTmp = array();
        foreach ($fbPages as $key => $aux) {
            //echo count($aux[0]) ; var_dump($aux);

            if (count($aux) > 1) {
                foreach ($aux as $key => $aux2) {
                    if (!str_contains($aux2['link'], 'instagram')) {
                        $aux2['picture'] = $aux2['picture']['data']['url'];
                        $pagesTmp[] = $aux2;
                    }
                }
            } else {
                if (!str_contains($aux[0]['link'], 'instagram')) {
                    $aux[0]['picture'] = $aux[0]['picture']['data']['url'];
                    $pagesTmp[] = $aux[0];
                }
            }
        }
        $pagesEnc = json_encode($pagesTmp, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        $pages = json_decode($pagesEnc, true);

        return view('pages', compact('pages'));
    }
}
