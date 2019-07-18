<?php
/**
 * @param $lat Float latitude of inputted location
 * @param $lng Float longitude of inputted location
 * @param $radiusConstraintLower Float constraint on how far random location must be
 * @param $radiusConstraintUpper Float constraint on how far the random location may be
 * @return Object Returns JSON Object of random lat and lng within constraint parameters
 * @throws Exception Error when distance random Lat/Lng cannot be calculated for desired parameters
 */
function randomize_geoLocation($lat, $lng, $radiusConstraintLower, $radiusConstraintUpper)
{

//    Randomize Lat Lng
    $maxDegLat = ($radiusConstraintUpper / 69.172) * 1000;
    $maxDegLng = ($radiusConstraintUpper / getLngDegree($lat, $lng) ) * 1000;
    $rLat = $lat + rand(-$maxDegLat, $maxDegLat)/1000;
    $rLng = $lng + rand(-$maxDegLng, $maxDegLng)/1000;

    $obj = [
        'lat' => $rLat,
        'lng' => $rLng
    ];
    $jsonData = json_encode($obj);

    $dist = haversine($lat, $lng, $rLat, $rLng);


    if ($dist >= $radiusConstraintLower && $dist <= $radiusConstraintUpper) {
        return $jsonData;
    } else {
        $counter = 0;
        while ($dist < $radiusConstraintLower || $dist > $radiusConstraintUpper) {
            $maxDegLat = ($radiusConstraintUpper / 69.172) * 1000;
            $maxDegLng = ($radiusConstraintUpper / getLngDegree($lat) ) * 1000;
            $rLat = $lat + rand(-$maxDegLat, $maxDegLat)/1000;
            $rLng = $lng + rand(-$maxDegLng, $maxDegLng)/1000;

            $obj = [
                'lat' => $rLat,
                'lng' => $rLng
            ];
            $jsonData = json_encode($obj);

            $dist = haversine($lat, $lng, $rLat, $rLng);

            $counter++;
            if ($counter >= 10) {
                throw new Exception("Cannot Find Lat/Lng Within Boundaries");
            }
        }
        return $jsonData;
    }
    return $jsonData;
}

/**
 * @param $lat Float latitude of user inputted data
 * @return float Value of number of miles per degree of latitude
 */
function getLngDegree($lat)
{
    return cos(deg2rad($lat)) * 69.172;
}

/**
 * @param $lat1 Float latitude of first point
 * @param $lng1 Float longitude of first point
 * @param $lat2 Float latitude of second point
 * @param $lng2 Float longitude of second point
 * @return float|int Distance between two coordinates in Miles
 */
function haversine($lat1, $lng1, $lat2, $lng2)
{
    $earth_radius = 3961;

    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng/2) * sin($dLng/2);
    $c = 2 * asin(sqrt($a));
    $d = $earth_radius * $c;

    return $d;
}