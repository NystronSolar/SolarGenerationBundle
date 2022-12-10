<?php

namespace NystronSolar\SolarGenerationBundle\Generation;

use DateTime;

/**
 * A Class to represent a Day of Solar Generation
 */
class Day
{
    /**
     * The Day of the Generation
     * @var DateTime
     */
    private DateTime $date;

    /**
     * The Generation (kWh) in the Day
     * @var float
     */
    private float $generation;

    public function __construct()
    {
    }

    /**
     * Get the Day of the Generation
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * Get the Generation (kWh) in the Day
     * @return float
     */
    public function getGeneration(): float
    {
        return $this->generation;
    }

    /**
     * Set the Day of the Generation
     * @return Day
     */
    public function setDate(DateTime $_date): Day
    {
        $this->date = $_date;

        return $this;
    }

    /**
     * Set the Generation (kWh) in the Day
     * @return Day
     */
    public function setGeneration(float $_generation): Day
    {
        $this->generation = $_generation;

        return $this;
    }
}