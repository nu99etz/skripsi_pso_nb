<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class NaiveBayesController
{

    protected $data = [];
    protected $attr = [];
    protected $prob = [];
    protected $labels = [];

    public function __construct(array $data, array $attr, array $labels)
    {
        // parent::__construct();
        $this->data = $data; // Data Latih
        $this->attr = $attr; // Attribut
        $this->labels = $labels; // Label Attribut (Kelas) (Eg: bsc => ada , tidak ada)
    }

    /**
     * Target Attribut (Eg: persalinan)
     * @return array $targetValues
     */
    protected function getTargetValues()
    {
        $targetValues = [];
        foreach ($this->data as $item) {
            $targetValues[] = $item[count($this->attr)];
        }
        return $targetValues;
    }

    /**
     * Label Target Attribut (Eg: persalinan => sc, normal)
     * @return array
     */
    public function getLabelClass()
    {
        return array_unique($this->getTargetValues());
    }

    /**
     * Proses Naive Bayes
     * 
     */
    protected function process()
    {

        $statClass = array_count_values($this->getTargetValues()); // Menjumlah Target Data Sesuai attribut kelas masing2
        // echo "<pre>";
        // print_r($this->labels);
        // echo "</pre>";
        // die();
        
        // Mangalikan 2 Kali Jumlah Atribut yang digunakan
        foreach ($statClass as $class => $stat) {
            $statClass[$class] = $stat + (count($this->attr) * 2);
        }

        // Menghitung Probababilitas target attribut
        $probClass = [];
        foreach ($statClass as $class => $stat) {
            // $probClass[$class]['prob'] = $stat / count($this->data);
            $probClass[$class]['prob'] = $stat / array_sum($statClass);
        }

        // Mencari dan menghitung probabilitas sesuai masing2 attribut
        foreach ($this->attr as $idxAttr => $attrib) {
            $classAttr = [];
            foreach ($this->getLabelClass() as $labelClass) {
                $p = $this->getDataByAttrAndClassLabel($idxAttr, $labelClass);
                $statCaseByAttr = array_count_values($p);

                // foreach ($statCaseByAttr as $cases => $val) {

                //     foreach ($this->labels[$attrib] as $value) {
                //         if ($cases == $value) {
                //             $ratio = $val / (count($p) + (count($this->attr) * 2));
                //             $probClass[$labelClass][$attrib][$cases] = $ratio;
                //         } else {
                //             $ratio = 1 / (count($p) + (count($this->attr) * 2));
                //             $probClass[$labelClass][$attrib][$value] = $ratio;
                //         }
                //     }
                // }

                foreach ($this->labels[$attrib] as $value) {
                    if (!empty($statCaseByAttr[$value])) {
                        $ratio = (1 + $statCaseByAttr[$value]) / (count($p) + (count($this->attr) * 2));
                        $probClass[$labelClass][$attrib][$value] = $ratio;
                    } else {
                        $ratio = 1 / (count($p) + (count($this->attr) * 2));
                        $probClass[$labelClass][$attrib][$value] = $ratio;
                    }
                }
            }
        }

        $this->prob = $probClass;

        // echo "<pre>";
        // print_r($this->prob);
        // echo "</pre>";
        // die();
    }

    protected function getDataByAttrAndClassLabel(int $idxAttr, string $labelClass)
    {
        $data = [];

        foreach ($this->data as $item) {
            if ($item[count($this->attr)] == $labelClass) {
                $data[] = $item[$idxAttr];
            }
        }

        return $data;
    }

    public function run()
    {
        $this->process();
        return $this;
    }

    public function predict(array $data)
    {
        $prediction = [];
        foreach ($this->getLabelClass() as $labelClass) {
            $probabilistik = $this->prob[$labelClass]['prob'];
            foreach ($data as $idxAttr => $av) {
                $probabilistik = $probabilistik * @$this->prob[$labelClass][$this->attr[$idxAttr]][$av];
            }
            $prediction[$labelClass] = $probabilistik;
        }
        arsort($prediction);

        // print_r($prediction);
        return $prediction;
    }
}
