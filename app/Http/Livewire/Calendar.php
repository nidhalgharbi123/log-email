<?php

namespace App\Http\Livewire;

use App\Models\Intervention;
use Livewire\Component;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;

class Calendar extends Component
{
    public $interventions;
    private $client;

    public function mount()
    {
        // Initialiser le client Google Calendar
        $this->initGoogleCalendarClient();

        // Charger les interventions au montage du composant
        $this->loadInterventions();
    }

    private function initGoogleCalendarClient()
    {
        // Initialiser le client Google Calendar avec les identifiants OAuth
        $this->client = new Google_Client();
        $this->client->setAuthConfig(base_path('storage/app/google-calendar/service-account-cerdentials.json'));
        $this->client->addScope(Google_Service_Calendar::CALENDAR_READONLY);
    }

    public function loadInterventions()
    {
        // Charger les interventions depuis la base de données avec le nom du client
        $interventions = Intervention::select('id', 'client', 'start_time', 'end_time', 'recurrence', 'personne')->get();
        
        // Initialiser un tableau pour stocker les interventions à afficher sur chaque jour
        $interventionsToDisplay = [];

        // Pour chaque intervention, générer les dates en fonction de la récurrence et les ajouter à $interventionsToDisplay
        foreach ($interventions as $intervention) {
            $startDate = Carbon::parse($intervention->start_time);
            $endDate = Carbon::parse($intervention->end_time);

            // Ajouter l'intervention pour chaque jour dans la période
            while ($startDate->lte($endDate)) {
                // Vérifier si le jour est un jour férié
                if ($this->isHoliday($startDate)) {
                    // Afficher un message si c'est un jour férié
                    $interventionsToDisplay[] = [
                        'id' => $intervention->id,
                        'title' => 'Jour férié: ' . $startDate->format('Y-m-d'),
                        'start' => $startDate->format('Y-m-d'),
                        'personne' => 'N/A'
                    ];
                } else {
                    // Ajouter l'intervention normale
                    $interventionsToDisplay[] = [
                        'id' => $intervention->id,
                        'title' => $intervention->client,
                        'start' => $startDate->format('Y-m-d'),
                        'personne' => $intervention->personne
                    ];
                }

                // Passer au jour suivant
                $startDate->addDay();
            }
        }
    
        // Convertir le tableau d'interventions à afficher en JSON
        return json_encode($interventionsToDisplay);
    }

    private function isHoliday($date)
    {
        // Initialiser le service Google Calendar
        $service = new Google_Service_Calendar($this->client);

        // Définir les paramètres de la requête pour obtenir les événements du calendrier
        $calendarId = 'votre-id-de-calendrier@group.calendar.google.com';
        $params = [
            'timeMin' => $date->format('Y-m-d') . 'T00:00:00Z',
            'timeMax' => $date->format('Y-m-d') . 'T23:59:59Z',
            'singleEvents' => true,
            'orderBy' => 'startTime',
        ];

        // Récupérer les événements du calendrier
        $results = $service->events->listEvents($calendarId, $params);

        // Parcourir les événements pour vérifier s'il y a un jour férié
        foreach ($results->getItems() as $event) {
            // Vous devez définir la condition pour identifier un jour férié en fonction de la structure de vos événements Google Calendar
            // Par exemple, si le titre de l'événement indique que c'est un jour férié
            if ($this->isHolidayEvent($event)) {
                return true; // C'est un jour férié
            }
        }

        return false; // Pas de jour férié
    }

    private function isHolidayEvent($event)
    {
        // Vous devez définir la condition pour identifier un jour férié en fonction de la structure de vos événements Google Calendar
        // Par exemple, si le titre de l'événement indique que c'est un jour férié
        // Par exemple, si le titre contient "Holiday" ou si la description contient "Vacances"
        return false; // Remplacez cette condition par votre propre logique
    }

    // Autres fonctions du composant...

    public function render()
    {
        return view('livewire.calendar');
    }
}
