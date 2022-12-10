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
}