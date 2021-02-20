<?php

/**
 * Class Thing: This is our piece of generic data
 */
class Thing {
    public $id;
    public $name;
    public $description;
    public $active;
    public $created;
    public $updated;
    public function __construct($id,$name,$description,$active)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->active = $active;
    }
}

/**
 * Class PDOconnection
 */
class PDOconnection extends DataManipulator
{
    public function __construct() {
        // Build some mock data
        $this->data = [
            0 => new Thing(1, "bob", "asdf", true),
            1 => new Thing(2, "tom", "fas", false),
            3 => new Thing(3, "sam", "asfdf", true)
        ];
    }

    //Implement the abstract function to return this type of DataManipulator
    public function getDataManipulator(): DataManipulator
    {
        return new PDOconnection();
    }
}

/**
 * Class RestApi
 */
class RestApi extends DataManipulator
{
    public function __construct() {
        // Build some mock data
        $this->data = [
            10 => new Thing(12, "mark", "asdfa", true),
            20 => new Thing(23, "larry", "fadsfa", false),
            30 => new Thing(34, "alex", "afdasdf", true)
        ];
    }

    //Implement the abstract function to return this type of DataManipulator
    public function getDataManipulator(): DataManipulator
    {
        return new RestApi();
    }
}

/**
 * Class DataManipulator
 */
abstract class DataManipulator
{
    public $data = [];
    abstract public function getDataManipulator(): DataManipulator;

    /**
     * Search function can act on the data regardless of type.
     *
     * @param $criteria
     * @return array
     */
    public function searchData(array  $criteria): array
    {
        $dataManipulator = $this->getDataManipulator();

        $found = [];
        // Mock a search
        foreach($dataManipulator->data as $key=>$thing) {
            $currentValue = $thing->{$criteria['field']};
            if ($currentValue == $criteria['value']) {
                $found[] = $thing;
            }
        }
        return $found;
    }

    /**
     * Fetch function can act on the data regardless of type.
     * @param $id
     * @return Thing|null
     */
    public function fetchDataById(int $id): ?Thing
    {
        $dataManipulator = $this->getDataManipulator();
        return  $dataManipulator->data[$id];
    }

    /**
     * Create Data function can act on the data regardless of type.
     * @param $data
     */
    public function createData(Thing $data)
    {
        $dataManipulator = $this->getDataManipulator();
        $dataManipulator->data[] = $data;
    }
}

function testFactoryFetchById(DataManipulator $data)
{
    echo print_r($data->fetchDataById(10), true);
}

function testFactorySearch(DataManipulator $data)
{
    echo print_r($data->searchData(["field"=>"name","value"=>"larry"]), true);
}

// Run out test function with two types of objects and let the factory give us what we want.
testFactoryFetchById(new PDOconnection());
testFactoryFetchById(new RestApi());

// Run out test function with two types of objects and let the factory give us what we want.
testFactorySearch(new PDOconnection());
testFactorySearch(new RestApi());