<?php

namespace App\Console\Commands;

use App\Models\Activity;
use App\Models\Client;
use App\Models\Project;
use App\Models\Timesheet;
use Illuminate\Console\Command;

class ImportManelDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:import-manel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports Manel\'s old database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {



//        $projects = [
//            'HVPS-SFT' => 'NexTRACKER',
//            'Hirrus PV' => 'IMT',
//            'Tablete' => 'STS',
//            'Autodotare' => 'AFT',
//            'Hirrus L' => 'AFT',
//            'VRT- NCU 2.0' => 'NexTRACKER',
//            'Motor Tool Box' => 'NexTRACKER',
//            'Aprojects-Soft' => 'AutodotareAFT',
//            'INVINITY' => 'NexTRACKER',
//            'Personale' => 'AFT',
//            'Run4Fun' => 'HobbyRC',
//            'Hobby' => 'AFT',
//            'Quarrus3' => 'AFT',
//            'Signus 150' => 'AFT',
//            'RFoFo' => 'STS',
//            'Signus 35V' => 'AFT',
//            'Instalatii' => 'AutodotareAFT',
//            'ULF-1' => 'AutodotareAFT',
//            'HVPS' => 'NexTRACKER',
//            'Mobilier' => 'AutodotareAFT',
//            'MOPOS' => 'ATM',
//            'FCSB' => '',
//            'Hirrus XL' => 'UAVAFT',
//            'CNC-uri' => 'AutodotareAFT',
//            'Quarrus1' => 'UAVAFT',
//            'HVPS-Support' => 'NexTRACKER',
//            'HVPS-BFT' => 'NexTRACKER',
//            'HVPS-EMI' => 'NexTRACKER',
//            'CSB V1.0' => 'NexTRACKER',
//            'Stand Rotativ' => 'Aeroclubul Ro',
//            'Router Tactic' => 'Interactive',
//            'SCU' => 'NexTRACKER',
//            'Velier-Optimist' => 'HobbyAFT',
//            'GRT' => 'NexTRACKER',
//            'HVPS-BURNIN' => 'NexTRACKER',
//            'MUWI' => 'Politehnica',
//            'WindshieldP5' => 'TehnoPro',
//            'CORF' => 'HPS',
//            'Centrala Peleti' => 'HobbyAFT',
//            'Mounting Plate' => 'Interactive',
//            'derivor   "' => 'scaun pupa',
//            'GreenHouse' => 'ENTEN',
//            'Common' => 'ENTEN',
//            'Agriculture' => 'ENTEN',
//            'LAB935' => 'ALLIO',
//            'Refact' => 'ENTEN',
//            'NCU2.0' => 'NexTRACKER',
//            'Signus1000' => 'UAVAFT',
//            'ETH-Station' => 'ENTEN',
//            'SPC 250' => 'NexTRACKER',
//            'RhTP SDI' => 'ENTEN',
//            'Motocoasa' => 'Makita',
//            'Mentenanta' => 'ENTEN',
//            'Core Upgrade' => 'ENTEN',
//            'Excellence' => 'IMT',
//            'Supercap' => 'IMT',
//            'Adaptor SDI' => 'ENTEN',
//            'Camera upgrade' => 'ENTEN',
//            'ALT' => 'HPS',
//            'Strung' => 'GlobalEngineering',
//            'Dev1' => 'EHydrogen',
//            'Enforcing' => 'COMOTI',
//            'Sauron' => 'StartAFT',
//            'XRT' => 'NexTRACKER',
//            'Comanda15' => 'ALLIO',
//            'Antidrona' => 'PublicMoneyAFT',
//            'PolistirenS' => 'DIVCO',
//            'Solar Energy' => 'AFT',
//            'SMART Acces' => 'ECO solutii online',
//            'Add' => 'AdminAFT',
//            'Luneta' => 'ACTTM',
//            'ODIN' => 'ACTTM',
//            'Comanda 18 MDF' => 'ALLIO',
//            'Test' => 'ACTTM',
//            'Extender A-I' => 'ENTEN',
//            'Control A-I' => 'ENTEN',
//            'Zigbee temp' => 'AFT',
//            'Comanda 19' => 'ALLIO',
//            'Synoptes' => 'InspaceRo',
//            'TermostatWiFi' => 'AFT',
//            'Carene Extra' => 'Aeroclubul Ro',
//            ' sedinta mane si ionel' => ' supravegheat CNC',
//            'Carena' => 'INCAS',
//            'Hirrus' => 'STS',
//            'Comanda 20' => 'ALLIO',
//            'Comanda 21' => 'ALLIO',
//            'VoIP Gateway' => 'Solhard',
//            'Unaccounted' => 'ENTEN',
//            'Suport tableta' => 'Teo Trandafir',
//            'Suport servo' => 'Teo Trandafir',
//            'HeadLight' => 'Solhard',
//            'Diuza oxigen' => 'Aeroclubul Ro',
//            'Comanda 22' => 'ALLIO',
//            'Solhard' => 'Solhard',
//            'Comanda 24' => 'ALLIO',
//            'Canopy' => 'Nordluft Automation',
//            'distantiere Sticlo' => 'IFIN',
//            'DLG fab' => 'AFT',
//            'ST0903' => 'Interactive',
//            'Componente satelit V' => 'ROMspace',
//            'Ombilidrona' => 'InspaceRo',
//            'VTC' => 'TehnoBolide',
//            'Statie Meteo' => 'AFT',
//            'Robot 2022-2023' => 'Ro2D2 Team',
//            'Tug carena' => 'Infinity tug',
//            'Comanda 27 - MDF' => 'ALLIO',
//            'TRD' => 'IFIN',
//            'UAV-USV' => 'Marina',
//            'Masina Tensiune Fire' => 'IFIN',
//            'Spirulina' => 'TehnoPro',
//            'M0' => 'IFIN',
//            'M0 Sticlo 4mm' => 'IFIN',
//            'Duster' => 'Solhard',
//            ' BNC' => ' RJ45 IP67 connectors',
//            'Carbon 4mm' => 'INCAS',
//            'Carcasa' => 'COMOTI',
//            'Folie Mylar-Carbon' => 'IFIN',
//            'Lumini in varf de ba' => 'AFT',
//            'Comanda 28' => 'ALLIO',
//            ' facturare' => ' documente',
//            'Con compozit' => 'Straero',
//            'LAB 670' => 'ALLIO',
//            'Comanda 29' => 'ALLIO',
//            'BMS 12S RevEng.' => 'PRIME',
//            'Comanda 30' => 'ALLIO',
//            'Comanda 31' => 'ALLIO',
//            'Comanda 33' => 'ALLIO',
//            'Comanda 34' => 'ALLIO',
//            'UPS-STS' => 'PRIME',
//        ];
//
////        foreach ($projects as $project => $client) {
////            $client = Client::where('name', $client)->first();
////            if ($client) {
////
////                Project::create([
////                    'name' => $project,
////                    'client_id' => $client->id,
////                    'company_id' => 2
////                ]);
////            }
////        }
//
//        $activities = [
//            'Fabricatie',
//            'Proiectare',
//            'Documentare',
//            'Deplasare',
//            'Testare',
//            'Ofertare',
//            'Dezvoltare',
//            'Administrative',
//            'Management',
//            'Service',
//            'Hobby',
//            'IT',
//            'BrainStorming',
//            'Liber',
//            'Frecat Duda',
//            'Achizitii',
//            'Concediu',
//            'Personale',
//            'Instruire',
//            'GN 3axe',
//            'GN 5axe',
//            'Hurco 5axe',
//        ];
//
//        foreach ($activities as $activity) {
//
//            Activity::create([
//                'name' => $activity,
//                'company_id' => 2
//            ]);
//        }

        $imports = json_decode(file_get_contents('manel_import.json'), true);
        foreach ($imports as $row) {
            $client = Client::where('name', $row[2])->first();
            $project = Project::where('name', $row[3])->first();
            $day = $row[1];
            $hours = $row[5];
            $observations = $row[6] . ' - ' . $row[7];
            $activity = Activity::where('name', $row[4])->first();
            $userMap = [
                'Emanuel.Popp' => 8, // emanuel.popp@aft.ro;
                'Emilian.Vlasceanu' => 9, // emilian.vlasceanu@aft.ro;
                'Victoras.Anghel' => 10, // victoras.anghel@aft.ro;
                'Marius.Dima' => 11, // marius.dima@aft.ro;
                'Mihai.Racheru' => 12, // mihai.racheru@aft.ro;
                'Andrei.Vicol' => 13, // andrei.vicol@aft.ro
            ];

            $user = isset($userMap[$row[0]]) ? $userMap[$row[0]] : null;

            if ($client && $project && $activity && $user) {
                Timesheet::create([
                   'client_id' => $client->id,
                   'project_id' => $project->id,
                   'activity_id' => $activity->id,
                   'company_id' => 2,
                   'hours' => $hours,
                   'day' => $day,
                   'observations' => $observations,
                   'user_id' => $user,
                ]);
            }
        }
    }
}
