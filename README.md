# Random Lat/Lng Generator

Given a min and max Radius constraint, get a JSON object returned of a random <br>
Latitude and Longitude centered around a given Latitude and Longitude.

## Getting Started

Download the Source Code and put into a text editor of your choice.

### Prerequisites

-PHP

### Using the Function

Add this function to a script, or program to receive your data.

#####Example 1:
```
$res = [];

for($i = 0; $i < 20; $i++) {
    array_push($res, randomize_geoLocation(-38.71035, 20.95537, 5, 20));
}

print_r($res);
```
#####Output (Results will vary):
```
Array
(
    [0] => {"lat":-38.43635,"lng":20.86937}
    [1] => {"lat":-38.702349999999996,"lng":20.846369999999997}
    [2] => {"lat":-38.73735,"lng":21.044369999999997}
    [3] => {"lat":-38.48435,"lng":20.786369999999998}
    [4] => {"lat":-38.595349999999996,"lng":21.24637}
    [5] => {"lat":-38.87135,"lng":21.02237}
    [6] => {"lat":-38.57835,"lng":21.13637}
    [7] => {"lat":-38.684349999999995,"lng":20.71837}
    [8] => {"lat":-38.75035,"lng":20.65737}
    [9] => {"lat":-38.42835,"lng":20.97337}
    [10] => {"lat":-38.92735,"lng":21.05537}
    [11] => {"lat":-38.62735,"lng":20.74937}
    [12] => {"lat":-38.91335,"lng":20.86937}
    [13] => {"lat":-38.513349999999996,"lng":20.90137}
    [14] => {"lat":-38.77335,"lng":20.83337}
    [15] => {"lat":-38.876349999999995,"lng":20.660369999999997}
    [16] => {"lat":-38.85435,"lng":20.88037}
    [17] => {"lat":-38.711349999999996,"lng":21.18937}
    [18] => {"lat":-38.623349999999995,"lng":20.975369999999998}
    [19] => {"lat":-38.48135,"lng":21.04037}
)

```
#####Example 2:
```
$lat = readline('Enter Starting Latitude: ');
$lng = readline('Enter Starting Longitude: ');
$radiusConstraintLower = readline('Enter Min Distance (in Miles): ');
$radiusConstraintUpper = readLine('Enter Max Distance (in Miles): ');
$iterations = readLine('Enter number of locations to be generated: ');

$res = [];

for($i = 0; $i < $iterations; $i++) {
    array_push($res, randomize_geoLocation($lat, $lng, 5, 20));
}

print_r($res);
```
#####Output:
```
Enter Starting Latitude: -38.71035
Enter Starting Longitude: 20.95537
Enter Min Distance (in Miles): 5
Enter Max Distance (in Miles): 20
Enter number of locations to be generated: 20
Array
(
    [0] => {"lat":-38.47135,"lng":20.855369999999997}
    [1] => {"lat":-38.955349999999996,"lng":21.05737}
    [2] => {"lat":-38.55235,"lng":21.01437}
    [3] => {"lat":-38.72535,"lng":20.61637}
    [4] => {"lat":-38.85835,"lng":20.90637}
    [5] => {"lat":-38.638349999999996,"lng":20.74637}
    [6] => {"lat":-38.641349999999996,"lng":21.04837}
    [7] => {"lat":-38.97235,"lng":20.85137}
    [8] => {"lat":-38.69135,"lng":20.760369999999998}
    [9] => {"lat":-38.95135,"lng":20.989369999999997}
    [10] => {"lat":-38.77435,"lng":20.64537}
    [11] => {"lat":-38.598349999999996,"lng":21.24637}
    [12] => {"lat":-38.757349999999995,"lng":21.23737}
    [13] => {"lat":-38.51435,"lng":21.196369999999998}
    [14] => {"lat":-38.57935,"lng":21.038369999999997}
    [15] => {"lat":-38.57835,"lng":21.14737}
    [16] => {"lat":-38.57235,"lng":20.780369999999998}
    [17] => {"lat":-38.78035,"lng":20.59837}
    [18] => {"lat":-38.96635,"lng":20.81937}
    [19] => {"lat":-38.47935,"lng":20.815369999999998}
)
```
####Troubleshooting:

If given parameters that cannot produce a location, the program will try 10 times to find a random set <br>
of Latitude and Longitude that satisfies the conditions. If if is not able to produce a random set for those <br>
conditions, an Exception will be thrown. Check that your inputs are valid, and check the constraints.