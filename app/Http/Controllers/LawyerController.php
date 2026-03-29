<?php
namespace App\Http\Controllers;
class LawyerController extends Controller {
    public function index(){
        return view('lawyer.dashboard');
    }
}
