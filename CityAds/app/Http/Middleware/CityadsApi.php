<?php

namespace App\Http\Middleware;
/**
 * Created by PhpStorm.
 * User: xander
 * Date: 13.02.16
 * Time: 20:08
 */
class CityadsApi
{
    private $curl;

    private $auth_code = 'a8fe0830f5b71dee6fc5c29badbe407e';

    public function __construct()
    {
        if (empty($this->curl = curl_init()))
        {
            abort(500, 'Curl not found');
        }
    }

    /**
     * Parse offers
     *
     * @param array $params
     *
     * @return array
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function get_offers($params = array())
    {
        $params['remote_auth'] = $this->auth_code;

        $off = new \SimpleXMLElement($this->send_request('http://api.cityads.com/api/rest/webmaster/xml/offers/web', $params));

        $offers = array();

        foreach ($off->data->items->item as $offer) {
            $offers[] = array(
                'name'   => (string)$offer->name,
                'site'   => (string)$offer->site,
                'rating' => (string)$offer->rating
            );
        }

        return $offers;
    }

    /**
     * Parse offers
     *
     * @param array $params
     *
     * @return array
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function get_offers_categories($params = array())
    {
        $params['remote_auth'] = $this->auth_code;

        $off = new \SimpleXMLElement($this->send_request('http://api.cityads.com/api/rest/webmaster/xml/offers-categories-list/web', $params));

        $categories = array();

        foreach ($off->data->item as $cat) {
            $categories[(string)$cat->value] = (string)$cat->title;
        }

        return $categories;
    }

    public function send_request($url, $params, $method = 'GET', $format = 'application/x-www-form-urlencoded')
    {
        if ($method == 'GET')
        {
            $url = $url . '?' . http_build_query($params);
        }

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: ' . $format
            )
        );
        $out = curl_exec($this->curl);

        return $out;
    }
}