<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public static function getLocations()
    {
        return [
            'buildings' => [
                'Gedung A' => [
                    'floors' => ['1', '2', '3', '4', '5'],
                    'rooms' => [
                        '1' => ['101', '102', '103', '104', '105'],
                        '2' => ['201', '202', '203', '204', '205'],
                        '3' => ['301', '302', '303', '304', '305'],
                        '4' => ['401', '402', '403', '404', '405'],
                        '5' => ['501', '502', '503', '504', '505'],
                    ]
                ],
                'Gedung B' => [
                    'floors' => ['1', '2', '3'],
                    'rooms' => [
                        '1' => ['101', '102', '103'],
                        '2' => ['201', '202', '203'],
                        '3' => ['301', '302', '303'],
                    ]
                ],
                'Gedung C' => [
                    'floors' => ['1', '2'],
                    'rooms' => [
                        '1' => ['101', '102', '103', '104'],
                        '2' => ['201', '202', '203', '204'],
                    ]
                ],
            ]
        ];
    }
} 