<?php

namespace reblex\DiceGame;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];



    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }



    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        return 1;
    }



    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        $max = 1;
        foreach ($this->serie as $rolls) {
            if (max($rolls) > $max) {
                $max = max($rolls);
            }
        }
        return $max;
    }
}
