<?php

namespace NystronSolar\SolarGenerationBundle\Generation;

use DateTime;
use Exception;

/**
 * A Class to represent a Month of Solar Generation
 */
class Month
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

    public function __construct()
    {
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
     * Set the Month of the Generation
     * @return Month
     */
    public function setDate(DateTime $_date): Month
    {
        $this->date = $_date;

        return $this;
    }
}