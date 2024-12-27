<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Session;

class UpdateUserStatus
{
    /**
     * Crée le listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Gère les événements Login et Logout.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
       /*  if ($event instanceof Login) {
            // Lorsque l'utilisateur se connecte
            Session::put('user_status', 'online');
        } elseif ($event instanceof Logout) {
            // Lorsque l'utilisateur se déconnecte
            Session::put('user_status', 'offline');
        } */
    }
}
