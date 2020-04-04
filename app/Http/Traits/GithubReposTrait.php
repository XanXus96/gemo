<?php
namespace App\Http\Traits;

trait GithubReposTrait {

    /**
     * method to group array results by specific key
     * 
     * @param String $key 
     * @param Array $data 
     * 
     * @return Array
     */
    private function groupBy($key, $data) {
        
        $result = array();

        foreach($data as $val) {
            if(array_key_exists($key, $val)) {
                $result[$val[$key]][] = $val;
            } else {
                $result[""][] = $val;
            }
        }

        return $result;
    }

    /**
     * method to sort array results by count of array values
     * 
     * @param Array $data
     * 
     * @return Array
     */
    private function sortByCountDesc($data) {
        
        uasort($data, function ($a, $b) {
            $a = count($a);
            $b = count($b);
            return ($a == $b) ? 0 : (($a < $b) ? 1 : -1);
        });

        return $data;
    }
}