<?php

namespace App\Controller;

use App\Model\TransactionKrakenFormModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function PHPUnit\Framework\isEmpty;

#[Route('/transaction_kraken')]
final class TransactionKrakenController extends AbstractController
{

    #[Route('', name: 'app_transaction_kraken')]
    public function index(Request $request): Response
    {
        $transactionForm = new TransactionKrakenFormModel();
        $form=$this->createForm(TransactionKrakenFormModel::class, $transactionForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération des données.
            $fichierKraken= $form->get('csvFile')->getData();


            if ($fichierKraken){
                $premiereTransaction=null;
                $derniereTransaction=null;
                $totalInvesti = 0;
                $totalVendu = 0;
                $benefice = 0;


                // Ouvrir le fichier en lecture
                $stream = fopen($fichierKraken->getPathname(), 'r');

                if ($stream !== false) {

                    // Lire et ignorer la première ligne
                    fgetcsv($stream);

                    while (($data = fgetcsv($stream, 1000, ',')) !== false) {

                        /**
                         * Information Sur le fichier CSV de Kraken
                         * $data[0]→ "txid" ID unique de la transaction
                         * $data[2]→ "pair" paire consituant la transaction. Ex : SOL/USDT
                         * $data[3]→ "time" heure UTC
                         * $data[4]→ "type" type de transaction : Sell / Buy
                         * $data[6]→ "price" prix de la monnaie achetée
                         * $data[7]→ "cost" cout de la monnaie vendue
                         * $data[8]→ "fee" cout de la transaction
                         * $data[9]→ "vol" volume de transaction
                         */

                        $IdTransaction=$data[0];

                        //Récupération des dates pour créer la période.

                        $dateTransaction=$data[3];
                        if (empty($premiereTransaction)||$dateTransaction<$premiereTransaction){
                            $premiereTransaction=$dateTransaction;
                        }
                        if (empty($derniereTransaction)||$dateTransaction>$derniereTransaction){
                            $derniereTransaction=$dateTransaction;
                        }


                        //récupération du total investi

                        //récupération du total vendu

                        //calcul du bénéfice

                    }

                    fclose($stream);
                } else {
                    throw new \Exception("Impossible d'ouvrir le fichier CSV.");
                }
            }




            // Vous pouvez ajouter une logique ici, comme l'envoi d'un email
//            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

//            return $this->redirectToRoute('');
        }

        return $this->render('transaction_kraken/index.html.twig', [
            'form'=> $form,
            'controller_name' => 'TransactionKrakenController',
        ]);
    }
}
