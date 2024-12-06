<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LocationController extends BaseController
{
    public function index()
    {
        // Path to your location.json file
        $jsonFilePath = ROOTPATH . 'public/location.json';
        
        // Check if file exists
        if (!file_exists($jsonFilePath)) {
            return $this->response->setStatusCode(404, 'File not found');
        }

        // Read the JSON file
        $jsonData = file_get_contents($jsonFilePath);

        // Decode JSON data
        $locations = json_decode($jsonData, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->response->setStatusCode(500, 'Error parsing JSON');
        }

        // Set response type to JSON
        return $this->response->setJSON($locations);
    }
}
