<?php

namespace NystronSolar\SolarGenerationBundle\Generation;

use ArrayIterator;
use DateTime;
use Exception;
use IteratorAggregate;

/**
 * A Class to represent a Month of Solar Generation
 */
class Month implements IteratorAggregate
{
    /**
     * The Array of the Month Daily Generation
     * @var Day[]
     */
    private array $dailyGeneration;

    /**
     * The Month of the Generation
     * @var DateTime
     */
    private DateTime $date;

    /**
     * The Total Generation (kWh) in the Month
     * @var float
     */
    private float $totalGeneration;

    /**
     * @param Day[] $dailyGeneration
     * @param DateTime $date
     */
    public function __construct(
        array $dailyGeneration = null,
        DateTime $date = null
    )
    {
        if (!is_null($date)) {
            $this->setDate($date);
        }

        if (!is_null($dailyGeneration)) {
            $this->setDailyGeneration($dailyGeneration);
        }
    }

    /**
     * Get the Array of the Month Daily Generation
     * @return Day[]
     */
    function getDailyGeneration(): array
    {
        return $this->dailyGeneration;
    }

    /**
     * Get the Month of the Generation
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Get the Total Generation (kWh) in the Month
     * @return DateTime
     */
    public function getTotalGeneration(): float
    {
        return $this->totalGeneration;
    }

    /**
     * Set the Array of the Month Daily Generation
     * @param Day[] $_dailyGeneration
     * @throws Exception 
     * @return Month
     */
    function setDailyGeneration(array $_dailyGeneration): Month
    {
        $daysInMonth = intval(date_format($this->date, 't'));
        $elementsSize = sizeof($_dailyGeneration);

        if ($elementsSize !== $daysInMonth) {
            throw new Exception("The size of the Daily Generation Array isn't the total of days in the month");
        }

        $expectedMonth = date_format($this->date, 'm');
        $expectedYear = date_format($this->date, 'Y');

        foreach ($_dailyGeneration as $value) {
            if (!is_a($value, Day::class)) {
                $dayClass = Day::class;
                throw new Exception("All the elemens in the Daily Generation should be $dayClass objects.");
            }

            $actualMonth = $value->getDate()->format('m');
            if ($actualMonth !== $expectedMonth) {
                $monthClass = Month::class;
                throw new Exception("All the elements in the Daily Generation should have the same month as the $monthClass Object.");
            }

            $actualYear = $value->getDate()->format('Y');
            if ($actualYear !== $expectedYear) {
                $monthClass = Month::class;
                throw new Exception("All the elements in the Daily Generation should have the same year as the $monthClass Object.");
            }
        }

        $this->dailyGeneration = $_dailyGeneration;
        $this->totalGeneration = $this->setTotalGeneration();

        return $this;
    }

    /**
     * Set the Total Generation (kWh) in the Month
     * @return float
     */
    private function setTotalGeneration(): float
    {
        $total = '0.0';

        foreach ($this->dailyGeneration as $dayGeneration) {
            $dayGenerationString = strval($dayGeneration->getGeneration());

            $sum = bcadd($dayGenerationString, $total, 1);
            $total = $sum;
        }

        return floatval($total);
    }

    /**
     * Set the Month of the Generation
     * @param DateTime $_date
     * @return Month
     */
    public function setDate(DateTime $_date): Month
    {
        $this->date = $_date;

        return $this;
    }

    /**
     * Get the Iterator
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->dailyGeneration);
    }
}