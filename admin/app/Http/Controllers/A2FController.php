<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use PragmaRX\Google2FA\Google2FA;
use App\Http\Controllers\BossController; 

class A2FController extends Controller{

    public function A2F(){
        return view('a2f');
    }


    public function generateQR(){

        $google2fa = new Google2FA();
        $name = session('name');

        //Creation du secret
        $secret = $google2fa->generateSecretKey();

        //Création de l’URL pour l’authenticator
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            'MonPortailCaptif',
            $name,
            $secret
        );

        // Génération du QR Code à afficher
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
            'scale' => 5,
        ]);
        $qrCode = (new QRCode($options))->render($qrCodeUrl);

        // Envoi du secret à l'API pour l'enregistrement
        $bossController = new BossController();

        if($bossController->setSecret($name, $secret)){
            return view('a2fActivation', compact('secret', 'qrCode'));
        }else{
            return back()->withErrors([
                'code' => 'Erreur lors de la génération du QR Code',
            ]);
        }
        
    }


    public function verifyA2F(Request $request){
        $google2fa = new Google2FA();

        $bossController = new BossController();
        $secret = trim($bossController->getSecret(session('name')));
        $code = trim($request->input('code'));

        if ($google2fa->verifyKey($secret, $code)) {
            return redirect()->route('home')->with('success', 'Authentification réussie !');
        } else {
            return back()->withErrors([
                'code' => 'Code incorrect',
            ]);
        }
    }
}
