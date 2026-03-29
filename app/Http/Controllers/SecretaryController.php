<?php
namespace App\Http\Controllers;
class SecretaryController extends Controller {
    public function index() {
        return view('secretary.dashboard');
    }
}
