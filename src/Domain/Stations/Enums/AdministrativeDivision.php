<?php

namespace Domain\Stations\Enums;

enum AdministrativeDivision: string
{
    case FEDERAL = 'FEDERAL';              // Bund
    case STATE = 'STATE';                  // Bundesland
    case GOVERNMENT_DISTRICT = 'GOVERNMENT_DISTRICT'; // Regierungsbezirk
    case DISTRICT = 'DISTRICT';            // Kreis
    case RURAL_DISTRICT = 'RURAL_DISTRICT'; // Landkreis
    case URBAN_DISTRICT = 'URBAN_DISTRICT'; // Kreisfreie Stadt
    case MUNICIPALITY = 'MUNICIPALITY';    // Gemeinde
    case CITY_DISTRICT = 'CITY_DISTRICT';  // Stadtteil/Ortsteil

}
