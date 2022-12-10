<?php

namespace NystronSolar\SolarGenerationBundle\Generation;

use DateTime;

/**
 * A Class to represent a Day of Solar Generation
 */
class Day
{
    /**
     * The Generation (kWh) in the Day
     * @var float
     */
    private float $generation;

    /**
     * The Day of the Generation
     * @var DateTime
     */
    private DateTime $date;

    /**
     * @param float $generation
     * @param DateTime $date
     */
    public function __construct(
        float $generation = null,
        DateTime $date = null
    )
    {
        if (!is_null($generation)) {
            $this->setGeneration($generation);
        }

        if (!is_null($date)) {
            $this->setDate($date);
        }
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
     * @param DateTime $_date
     * @return Day
     */
    public function setDate(DateTime $_date): Day
    {
        $this->date = $_date;

        return $this;
    }

    /**
     * Set the Generation (kWh) in the Day
     * @param float $_generation
     * @return Day
     */
    public function setGeneration(float $_generation): Day
    {
        $this->generation = $_generation;

        return $this;
    }
}