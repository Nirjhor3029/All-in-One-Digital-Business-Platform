<?php

namespace App\Http\Controllers;

class StaticController extends Controller
{
    public function proofcamPrivacyPolicy()
    {
        return view('app.proofcam.privacy-policy');
    }
}
