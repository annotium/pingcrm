<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;
use Binance\Spot;

class TicketsController extends Controller
{
    protected $client;

    public function __construct() {
        $this->client = new Spot();
    }

    public function index()
    {
        // $response = $this->client->time();
        
        return Inertia::render('Tickets/Index', [
            'time' => '123',
            'tickets' => [],
            // 'tickets' => Auth::user()->account->organizations()
            //     ->orderBy('name')
            //     ->filter(Request::only('search', 'trashed'))
            //     ->paginate(10)
            //     ->withQueryString()
            //     ->through(fn ($organization) => [
            //         'id' => $organization->id,
            //         'name' => $organization->name,
            //         'phone' => $organization->phone,
            //         'city' => $organization->city,
            //         'deleted_at' => $organization->deleted_at,
            //     ]),
        ]);
    }
}
