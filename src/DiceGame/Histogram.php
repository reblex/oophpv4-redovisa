<?php

namespace reblex\DiceGame;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The rolls stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;


    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }


    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        $histogram = [];
        $str = "";
        for ($i=0; $i < $this->max; $i++) {
            array_push($histogram, 0);
        }

        foreach ($this->serie as $rolls) {
                foreach ($rolls as $roll) {
                    $histogram[$roll - 1]++;
                }
        }

        for ($i=$this->min - 1; $i < $this->max; $i++) {
            $str .= $i + 1 . ": ";
            for ($j=0; $j < $histogram[$i]; $j++) {
                $str .= "*";
            }
            $str .= "<br>";
        }

        return $str;
    }
}
