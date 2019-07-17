<?php
/**
 * @param $lat Float latitude of inputted location
 * @param $lon Float longitude of inputted location
 * @param $radiusConstraintLower Float constraint on how far random location must be
 * @param $radiusConstraintUpper Float constraint on how far the random location may be
 * @return float|int Returns random lat and lon within constraint parameters
 * @throws Exception Error when distance random Lat/Lon cannot be calculated for desired parameters
 */
function randomize_geoLocation($lat, $lon, $radiusConstraintLower, $radiusConstraintUpper)
{

//    Randomize Lat Lon
    $maxDegLat = ($radiusConstraintUpper / 69.172) * 1000;
    $maxDegLon = ($radiusConstraintUpper / getLonDegree($lat, $lon) ) * 1000;
    $rLat = $lat + rand(-$maxDegLat, $maxDegLat)/1000;
    $rLon = $lon + rand(-$maxDegLon, $maxDegLon)/1000;


    $dist = haversine($lat, $lon, $rLat, $rLon);

    if ($dist >= $radiusConstraintLower && $dist <= $radiusConstraintUpper) {
        return $dist;
    } else {
        $counter = 0;
        while ($dist < $radiusConstraintLower || $dist > $radiusConstraintUpper) {
            $maxDegLat = ($radiusConstraintUpper / 69.172) * 1000;
            $maxDegLon = ($radiusConstraintUpper / getLonDegree($lat) ) * 1000;
            $rLat = $lat + rand(-$maxDegLat, $maxDegLat)/1000;
            $rLon = $lon + rand(-$maxDegLon, $maxDegLon)/1000;

            $dist = haversine($lat, $lon, $rLat, $rLon);

            $counter++;
            if ($counter >= 10) {
                throw new Exception("Cannot Find Lat/Lon Within Boundaries");
            }
        }
        return $dist;
    }
    return $dist;
}

/**
 * @param $lat Float latitude of user inputted data
 * @return float Value of number of miles per degree of latitude
 */
function getLonDegree($lat)
{
    return cos(deg2rad($lat)) * 69.172;
}

/**
 * @param $lat1 Float latitude of first point
 * @param $lon1 Float longitude of first point
 * @param $lat2 Float latitude of second point
 * @param $lon2 Float longitude of second point
 * @return float|int Distance between two coordinates in Miles
 */
function haversine($lat1, $lon1, $lat2, $lon2)
{
    $earth_radius = 3961;

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
    $c = 2 * asin(sqrt($a));
    $d = $earth_radius * $c;

    return $d;
}


echo(randomize_geoLocation(-38.71035, 20.95537, 5, 20));
