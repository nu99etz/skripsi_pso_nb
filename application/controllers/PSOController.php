<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class PSOController extends MainController
{
    protected $swarm;
    protected $gBest;
    protected $pBest;
    protected $fitness;
    protected $maxiteration;
    protected $sumParticle;
    protected $c1;
    protected $c2;
    // protected $bestFitness;

    public function __construct($data, $c1 = null, $c2 = null, $maxiteration = null)
    {
        // Deafult Nilai Batas Iterasi Jika Inputan Kosong
        if (empty($maxiteration)) {
            $maxiteration = 30;
        }

        // Default Nilai C1 Jika C1 Dalam Inputan Kosong
        if (empty($c1)) {
            $c1 = 2;
        }

        // Default Nilai C2 Jika C2 Dalam Inputan Kosong
        if (empty($c2)) {
            $c2 = 2;
        }

        // Inisialisasi Swarm Particle Mengambil Data Dari Mapping Yang Sudah Dibuat
        for ($i = 0; $i < count($data); $i++) {
            for ($j = 1; $j <= 14; $j++) {
                $this->swarm[$i]['POSITION'][$j] = $data[$i][$j];
                $this->swarm[$i]['VELOCITY'][$j] = 0;
            }
            $this->swarm[$i]['FITNESS'] = $this->calculateFitness($data[$i]);
            $this->swarm[$i]['P_BEST'] = $this->swarm[$i];
            $this->swarm[$i]['SUM'] = $this->calculateParticle($this->swarm[$i]['P_BEST']['POSITION']);
            $this->sumParticle[$i] = $this->swarm[$i]['SUM'];
            $this->fitness[$i] = $this->swarm[$i]['FITNESS'];
        }

        $this->maxiteration = $maxiteration;
        $this->c1 = $c1;
        $this->c2 = $c2;
    }

    /**
     * 
     * Generate Weight Number
     * @param int $iteration
     * @return int $weighted
     * 
     */
    protected function generateRandomWeightNumber($iteration)
    {
        // $number = [];
        // $number[0] = 0.9;
        // $number[1] = 1;
        // $number[2] = 1.1;
        // $number[3] = 1.2;
        // return $number[$id_number];

        $max_w = 0.9;
        $min_w = 0.4;

        $weighted = $max_w  - (($max_w - $min_w) / ($this->maxiteration  * ($iteration + 1)));

        return $weighted;
    }

    /**
     * 
     * Generate C1, C2 Number (Optional)
     * @param int $id_number
     * @return int $number
     * 
     */
    protected function generateRandomCNumber($id_number)
    {
        $number = [];
        for ($i = 0; $i < 9; $i++) {
            $number[$i + 1] = "0." . $i + 1;
        }
        $number[10] = 1;
        return $number[$id_number];

        // return 0.1;
    }

    /**
     * 
     * Generate R1, R2 Number
     * @param int $id_number
     * @return int $number
     * 
     */
    protected function generateRandomNumber($id_number)
    {
        $number = [];
        for ($i = 0; $i < 9; $i++) {
            $number[$i + 1] = "0." . $i + 1;
        }
        $number[10] = 1;
        return $number[$id_number];

        // return 0.2;
    }

    /**
     * 
     * Calculate Fitness
     * @param array $dimension
     * @return double $fitness
     * 
     */
    protected function calculateFitness($dimension)
    {
        $flag = 0;
        for ($i = 1; $i <= count($dimension); $i++) {
            if ($dimension[$i] < 0.5) {
                $flag++;
            }
        }
        $fitness = (14 - $flag) / 14;
        return $fitness;
        // $this->maintence->Debug($particle);
    }

    /**
     * 
     * Calculate Total Particle
     * @param array $dimension
     * @return double $sum
     * 
     */
    protected function calculateParticle($dimension)
    {
        $sum = array_sum($dimension);
        return $sum;
    }

    /**
     * 
     * Find PBest or GBest Fitness
     * @param array $fitness
     * @param array $sumParticle
     * @return key $key_particle
     * 
     */
    protected function getBestFitness($fitness, $sumParticle)
    {
        arsort($fitness);
        $best_fitness = key($fitness);
        $key_random = [];
        foreach ($fitness as $key => $value) {
            if ($value >= $fitness[$best_fitness]) {
                $key_random[] = [
                    'value' => $value,
                    'key' => $key
                ];
            }
        }

        arsort($sumParticle);
        $best_particle = key($sumParticle);
        $key_particle = [];
        foreach ($sumParticle as $key => $value) {
            foreach ($key_random as $key2 => $value2) {
                if ($key == $value2['key']) {
                    $key_particle[$key] = $value;
                }
            }
        }

        return key($key_particle);
    }

    /**
     * 
     * Calculate Velocity
     * @param int $index
     * @param array $dimention
     * @param int $gbest
     * @return double $velocity
     * 
     */
    protected function calculateVelocity($index, $dimention, $gbest)
    {
        $velocity = $this->generateRandomWeightNumber($index) * $this->swarm[$index]['VELOCITY'][$dimention] +
            $this->c1 * $this->generateRandomNumber(rand(1, 10)) * ($this->swarm[$index]['P_BEST']['POSITION'][$dimention] -
                $this->swarm[$index]['POSITION'][$dimention]) + $this->c2 * $this->generateRandomNumber(rand(1, 10)) * ($this->swarm[$gbest]['POSITION'][$dimention] -
                $this->swarm[$index]['POSITION'][$dimention]);
        return $velocity;
    }

    /**
     * 
     * Calculate PBest or GBest
     * @param int $index
     * @param array $dimention
     * @return double $p_best
     * 
     */
    protected function calculatePBest($index, $dimention)
    {
        $p_best = $this->swarm[$index]['POSITION'][$dimention] + $this->swarm[$index]['VELOCITY'][$dimention];
        return $p_best;
    }

    /**
     * 
     * Generate Particle
     * @return array 
     * 
     */
    public function generateParticle()
    {
        $iteration = 0;
        while ($iteration != $this->maxiteration) {
            usleep(5000);
            $best_fitness = $this->getBestFitness($this->fitness, $this->sumParticle);
            for ($i = 0; $i < count($this->swarm); $i++) {
                for ($j = 1; $j <= 14; $j++) {
                    if ($this->swarm[$best_fitness]['P_BEST']['POSITION'][$j] < $this->swarm[$i]['P_BEST']['POSITION'][$j]) {
                        $this->swarm[$i]['P_BEST']['POSITION'][$j] = $this->swarm[$best_fitness]['P_BEST']['POSITION'][$j];
                    } else {
                        $this->swarm[$i]['P_BEST']['POSITION'][$j] = $this->swarm[$i]['P_BEST']['POSITION'][$j];
                    }
                    $this->swarm[$i]['P_BEST']['POSITION'][$j] = $this->calculatePBest($i, $j);
                    $this->swarm[$i]['P_BEST']['VELOCITY'][$j] = $this->calculateVelocity($i, $j, $best_fitness);
                }
                $this->swarm[$i]['P_BEST']['FITNESS'] = $this->calculateFitness($this->swarm[$i]['P_BEST']['POSITION']);
                $this->swarm[$i]['POSITION'] = $this->swarm[$i]['P_BEST']['POSITION'];
                $this->swarm[$i]['VELOCITY'] = $this->swarm[$i]['P_BEST']['VELOCITY'];
                $this->swarm[$i]['FITNESS'] = $this->swarm[$i]['P_BEST']['FITNESS'];
                $this->swarm[$i]['SUM'] = $this->calculateParticle($this->swarm[$i]['P_BEST']['POSITION']);
                $this->sumParticle[$i] = $this->swarm[$i]['SUM'];
                $this->fitness[$i] = $this->swarm[$i]['FITNESS'];
            }
            $iteration++;
        }

        return [
            'Swarm' => $this->swarm,
            'bestParticle' => $this->swarm[$best_fitness],
            'bestFitness' => $best_fitness,
        ];
    }
}
