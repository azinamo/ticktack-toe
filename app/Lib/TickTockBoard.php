<?php
namespace App\Lib;

class TickTockBoard
{


    private $rows = 3;

    private $cols = 3;

    private $tick = 'X';

    private $tock = 'O';

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getTick()
    {
        return $this->tick;
    }

    /**
     * @param string $tick
     */
    public function setTick($tick)
    {
        $this->tick = $tick;
    }

    /**
     * @return string
     */
    public function getTock()
    {
        return $this->tock;
    }

    /**
     * @param string $tock
     */
    public function setTock($tock)
    {
        $this->tock = $tock;
    }


    /**
     * @return int
     */
    public function getRows()
    {
        return $this->rows;
    }

    /**
     * @param int $rows
     */
    public function setRows($rows)
    {
        $this->rows = $rows;
    }

    /**
     * @return int
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * @param int $cols
     */
    public function setCols($cols)
    {
        $this->cols = $cols;
    }

    protected function getWinningLines()
    {
        $winningLines = [
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],

            [0, 3, 6],
            [1, 4, 7],
            [2, 5, 8],

            [0, 4, 8],
            [2, 4, 6]
        ];
        return $winningLines;
    }

    public function calculateGameWinner($playerLines)
    {
        foreach ($playerLines as $player => $playerLine) {
            foreach($this->getWinningLines() as $winningLine) {
                $intersection = array_intersect($playerLine, $winningLine);
                if (count($intersection) == 3) {
                    return $player;
                }
            }
        }
        return false;
    }


}