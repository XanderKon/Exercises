<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class Home extends Controller
{
    private $sort = array(
        'name'   => 'name',
        'rating' => 'rating'
    );

    private $request;

    public function __construct()
    {
        $this->api = new \App\Http\Middleware\CityadsApi();
        $this->request = \Request::all();

        if (empty($this->request['start']))
        {
            $this->request['start'] = 0;
        }
    }

    public function index()
    {
        $data['offers'] = $this->api->get_offers($this->request);

        $data['categories'] = $this->api->get_offers_categories();

        $data['sort'] = $this->sort;

        $data['paginator'] = $this->render_pagination();

        $data['request'] = $this->request;

        return view('offers')->with('data', $data);
    }

    private function render_pagination()
    {
        $previous = NULL;

        $_request = $this->request;

        if ($_request['start'] >= 1)
        {
            $_request['start'] -= 1;
            $previous = '<a href="/?' . http_build_query($_request) .'" >< Previous<a>';
            $_request['start'] += 1;
        }

        $_request['start'] += 1;
        $next = '<a href="/?' . http_build_query($_request) .'" >Next ><a>';
        $_request['start'] -= 1;

        $paginator = $previous . "&nbsp;" . $next;

        return $paginator;

    }
}
