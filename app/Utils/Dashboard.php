<?php

namespace App\Utils;

use App\Traits\General;
use App\Models\Consumer;
use App\Models\Inspector;
use App\Models\Installer;
use App\Models\Installation;
use App\Models\Inspection;
use App\Models\MaintenanceRegistry;

use Auth;

class Dashboard
{
    use General;
    public function __construct(){}

    public function getMNREDashboardData()
    {
        $response = [
            'consumer_interests' => 0,
            'systems_installed' => Installation::whereIn('installation_status', [4,5,6,7,8,9])->count(),
            'inspections_completed' => Installation::whereIn('installation_status', [8,9])->count(),
            'systems_approved' => Installation::where('installation_status', 10)->count()
        ];

        return $response;
    }
    public function getSIADashboardData()
    {
        $response = [
            'consumer_interests' => Consumer::where('state_id', Auth::user()->state_id)->count(),
            'systems_installed' => Installation::whereIn('installations.installation_status', [4,5,6,7,8,9])
                                                ->where('consumers.state_id', Auth::user()->state_id)
                                                ->join('consumers','consumers.id','installations.consumer_id')
                                                ->count(),
            'inspections_completed' => Installation::whereIn('installation_status', [8,9])
                                                    ->where('consumers.state_id', Auth::user()->state_id)
                                                    ->join('consumers','consumers.id','installations.consumer_id')
                                                    ->count(),
            'systems_approved' => Installation::where('installation_status', 10)
                                                ->where('consumers.state_id', Auth::user()->state_id)
                                                ->join('consumers','consumers.id','installations.consumer_id')
                                                ->count()
        ];

        return $response;
    }
    public function getLocalBodyDashboardData()
    {
        $response = [
            'consumer_interests' => Consumer::where('state_id', Auth::user()->state_id)->count(),
            'systems_installed' => Installation::whereIn('installations.installation_status', [4,5,6,7,8,9])
                                                ->where('consumers.state_id', Auth::user()->state_id)
                                                ->join('consumers','consumers.id','installations.consumer_id')
                                                ->count(),
            'inspections_completed' => Installation::whereIn('installation_status', [8,9])
                                                    ->where('consumers.state_id', Auth::user()->state_id)
                                                    ->join('consumers','consumers.id','installations.consumer_id')
                                                    ->count(),
            'systems_approved' => Installation::where('installation_status', 10)
                                                ->where('consumers.state_id', Auth::user()->state_id)
                                                ->join('consumers','consumers.id','installations.consumer_id')
                                                ->count()
        ];

        return $response;
    }
    public function getInspectorDashboardData()
    {
        $response = [
            'inspections_assigned' => 0,
            'inspections_complete' => Installation::whereIn('installation_status', [8,9,10])->where('inspector_id', Auth::id())->count(),
            'systems_approved' => Installation::where([['inspector_id', Auth::id()],['installation_status', 10]])->count()
        ];

        return $response;
    }
    public function getInstallerDashboardData()
    {
        $response = [
            'installations_assigned' => Installation::where('installer_id', Auth::id())->count(),
            'installations_complete' => Installation::where('installer_id', Auth::id())->whereIn('installation_status', [4,5,7,8,10])->count(),
            'maintenances_requests' => MaintenanceRegistry::where('installer_id', Auth::id())->count(),
            'maintenances_completed' => MaintenanceRegistry::where([['installer_id', Auth::id()],['status', 1]])->count()
        ];

        return $response;
    }
}
