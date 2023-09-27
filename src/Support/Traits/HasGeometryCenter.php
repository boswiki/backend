<?php

namespace Support\Traits;

trait HasGeometryCenter
{
    protected function determinePolygonCenter($polygonCoordinates): array
    {
        $centroidCalculation = $polygonCoordinates
            ->push($polygonCoordinates->first())
            ->zip($polygonCoordinates->slice(1)->push($polygonCoordinates->first()))
            ->reduce(function ($accumulatedValues, $coordinatePair) {
                [$currentCoordinate, $nextCoordinate] = $coordinatePair;
                [$currentX, $currentY] = $currentCoordinate;
                [$nextX, $nextY] = $nextCoordinate;

                $tempArea = $currentX * $nextY - $nextX * $currentY;

                return [
                    'accumulatedArea' => $accumulatedValues['accumulatedArea'] + $tempArea,
                    'accumulatedCentroidX' => $accumulatedValues['accumulatedCentroidX'] + ($currentX + $nextX) * $tempArea,
                    'accumulatedCentroidY' => $accumulatedValues['accumulatedCentroidY'] + ($currentY + $nextY) * $tempArea,
                ];
            }, ['accumulatedArea' => 0, 'accumulatedCentroidX' => 0, 'accumulatedCentroidY' => 0]);

        $totalArea = $centroidCalculation['accumulatedArea'] * 0.5;
        $finalCentroidX = $centroidCalculation['accumulatedCentroidX'] / (6 * $totalArea);
        $finalCentroidY = $centroidCalculation['accumulatedCentroidY'] / (6 * $totalArea);

        return [$finalCentroidY, $finalCentroidX];
    }
}
