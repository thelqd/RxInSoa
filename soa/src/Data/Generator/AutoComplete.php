<?php
/**
 * Created by PhpStorm.
 * User: ds
 * Date: 29.05.15
 * Time: 20:08
 */

namespace Soa\Daemon\Data\Generator;


use Soa\Daemon\Data\DynamicKeyInterface;
use Soa\Daemon\Http\Request;

class AutoComplete implements GeneratorInterface {

    /**
     * @var DynamicKeyInterface
     */
    private $values;

    /**
     * @var array
     */
    private $mockedData = array();

    /**
     * @var Request
     */
    private $request;

    /**
     * @param DynamicKeyInterface $values
     */
    public function __construct(DynamicKeyInterface $values)
    {
        $this->values = $values;
        $this->request = new Request();
        $this->generate();
    }

    /**
     *
     */
    private function generate()
    {
        $keyword = $this->request->getGet('keyword', null);

        if(isset($keyword)) {
            $values = $this->values->getRandomValues();
            foreach($values as $value) {
                if(strpos($value, $keyword) === 0) {
                    $this->mockedData[] = $value;
                }
            }
        } else {
            $this->mockedData = $this->values->getRandomValues();
        }
        sort($this->mockedData);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->mockedData;
    }
}