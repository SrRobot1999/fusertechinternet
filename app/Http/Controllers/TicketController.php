<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['cliente', 'usuario'])->get();
        return view('tickets.showticket', compact('tickets'));
    }
}
