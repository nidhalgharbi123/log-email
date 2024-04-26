<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class ActivityLogController extends Controller
{
    public function showLogs()
    {
        // Obtenez le contenu du fichier de log
        $logContent = File::get(storage_path('logs/laravel.log'));

        // Parsez les logs
        $logs = $this->parseLogs($logContent);
    // Paginer les logs
    $perPage = 10; // Nombre d'éléments par page
    $currentPage = Paginator::resolveCurrentPage() ?? 1;
    $currentLogs = collect($logs)->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $logs = new LengthAwarePaginator($currentLogs, count($logs), $perPage, $currentPage, [
        'path' => Paginator::resolveCurrentPath(),
        'pageName' => 'page',
    ]);
        // Affichez la vue avec les logs
        return view('activity_logs.index', compact('logs'));
    }
    private function parseLogs($logContent)
    {
        $logs = [];
    
        // Utilisez une expression régulière pour extraire les informations d'adresse IP, d'utilisateur, d'email et d'ID de chaque ligne de log
        preg_match_all('/\[(.*?)\] ([^\s]+) (.*?)user (.*?) logged (in|out) from (.*?) {"id":(\d+),"email":"(.*?)"}/', $logContent, $matches, PREG_SET_ORDER);
    
        foreach ($matches as $match) {
            $logs[] = [
                'timestamp' => $match[1],
                'level' => $match[2],
                'event' => $match[3],
                'user' => $match[4],
                'action' => $match[5],
                'ip' => $match[6],
                'id' => $match[7],
                'email' => $match[8],
            ];
        }
    
        return $logs;
    }
    
}
