<?php

use NystronSolar\SolarGenerationBundle\Generation\Day;
use NystronSolar\SolarGenerationBundle\Generation\Month;
use PHPUnit\Framework\TestCase;

class MonthTest extends TestCase
{
    /**
     * Create an Array of Days with Random Daily Generation
     * @param int $days
     * @param int $month
     * @return Day[]
     */
    public function createDailyGeneration(int $days = 31, int $month = 1): array
    {
        $month = $month > 12 ? 12 : $month;

        $dailyGeneration = [];

        for ($i = 1; $i <= $days; $i++) {
            $day = $i > 31 ? 31 : $i;
            $randomGeneration = rand(0, 100) / 10;
            $date = new DateTime("$month/$day/2022");

            $dailyGeneration[] = new Day($randomGeneration, $date);
        }

        return $dailyGeneration;
    }

    /** @test */
    public function test_calc_total_generation()
    {
        // Arrange
        $dailyGeneration = $this->createDailyGeneration();
        $totalGeneration = '0.0';

        foreach ($dailyGeneration as $dayGeneration) {
            $dayGenerationString = strval($dayGeneration->getGeneration());

            $sum = bcadd($dayGenerationString, $totalGeneration, 1);
            $totalGeneration = $sum;
        }

        $expectedTotalGeneration = floatval($totalGeneration);

        $month = new Month(
            $dailyGeneration,
            new DateTime("01/01/2022")
        );

        // Act
        $response = $month->getTotalGeneration();

        // Assert
        $this->assertIsFloat($response);
        $this->assertEquals($expectedTotalGeneration, $response);
    }

    /** @test */
    public function test_create_with_less_days()
    {
        //Arrange
        $dailyGeneration = $this->createDailyGeneration(20);
        $this->expectExceptionMessage("The size of the Daily Generation Array isn't the total of days in the month");

        //Act
        new Month(
            $dailyGeneration,
            new DateTime("01/01/2022")
        );
    }

    /** @test */
    public function test_create_with_more_days()
    {
        //Arrange
        $dailyGeneration = $this->createDailyGeneration(40);
        $this->expectExceptionMessage("The size of the Daily Generation Array isn't the total of days in the month");

        //Act
        new Month(
            $dailyGeneration,
            new DateTime("01/01/2022")
        );
    }
}