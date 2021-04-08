<?php

namespace Lucmas\Reservations\Controller\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    public function index()
    {
        return \view('Lucmas\Reservations\Views::admin.index');
    }

    public function settings()
    {
        return \view('Lucmas\Reservations\Views::admin.setting.index');

    }

    /**
     * @param $route
     * @return mixed
     * @throws \Exception
     */
    protected function apiRequest($route)
    {
        // Create request
        $request = Request::create($route, 'GET', [], [], [], [
            'HTTP_Accept' => 'application/json',
        ]);
        // Get response
        /** @var Response $response */
        $response = app()->handle($request);
        if ($response->getStatusCode() >= 400) {
            throw new \Exception($response);
        }

        return json_decode($response->getContent());
    }

}
