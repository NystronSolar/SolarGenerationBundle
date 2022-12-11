# Solar Generation Bundle
A Bundle of Classes to represent Solar Generation

## Day Class
> A Class to represent a Day of Solar Generation

[Source](src/Generation/Day.php) 

```php
$day = new Day(
  10.5, // The Generation (kWh) in the Day
  new DateTime("01/10/2022") // The Day of the Generation
);

$generation = $day->getGeneration();
$date = $day->getDate():
```

## Month Class
> A Class to represent a Month of Solar Generation

[Source](src/Generation/Month.php) 

```php
$dailyGeneration = [
  new Day(10.5, new DateTime("01/10/2022")),
  new Day(8.5, new DateTime("02/10/2022")),
  new Day(9.0, new DateTime("03/10/2022")),
  new Day(11.0, new DateTime("04/10/2022")),
 ];
 //This array SHOULD be with 31 Elements, because October have 31 Days. This array will throw an Exception, requesting for more elements (And fill the 31 Generation Days)

$month = new Month(
  $dailyGeneration, // Throwing Exception here!
  new DateTime("01/10/2022")
);

$dailyGeneration = $month->getDailyGeneration();
$date = $month->getDate();
$totalGeneration = $month->getTotalGeneration();
