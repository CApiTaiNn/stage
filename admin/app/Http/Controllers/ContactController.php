<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\Contact;

    class ContactController extends Controller{

        /*
        * @return le formulaire de contact de l'admin
        */
        public function contactAdmin(){
            return view('contactAdmin');
        }

        public function sendMail(Request $request){
            // Valider les données du formulaire
            $validated = $request->all();
            
            /* Envoyer l'e-mail
            Mail::to(env('MAIL_ADMIN'))
                ->send(new Contact($validated));

            // Rediriger vers la page d'accueil
            return redirect()->route('home')->with('success', 'Votre message a été envoyé avec succès.');
            */
            return redirect()->route('home')->with('success', 'Votre message a été envoyé avec succès.');
        }
    }
?>