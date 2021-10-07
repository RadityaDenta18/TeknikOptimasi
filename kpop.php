<?php

class catalogue
{
    function createProductColumn($columns, $listOfRawProduct){
        foreach (array_keys($listOfRawProduct) as $listOfRawProductkey){
            $listOfRawProduct[$columns[$listOfRawProductkey]] = $listOfRawProduct[$listOfRawProductkey];
            unset($listOfRawProduct[$listOfRawProductkey]);
        }
        return $listOfRawProduct;
    }

    function product($parameters){
        $collectionOflistProduct = [];

        $raw_data = file($parameters['file_name']);
        foreach ($raw_data as $listOfRawProduct){
            $collectionOfListProduct[] = $this->createProductColumn($parameters['columns'], explode(",", $listOfRawProduct));
        }

        
        return [
            'product' => $collectionOfListProduct,
            'gen_length' => count($collectionOfListProduct)
        ];
        
    }
}
class populationGenerator{
    function createIndividu($parameters)
    {
        $catalogue = new Catalogue;
        $lengthOfGen = $catalogue->product($parameters)['gen_length'];
        for ($i = 0; $i <= $lengthOfGen-1; $i++){
            $ret[] = rand(0,1);
        }
        return $ret;
    }
    function createPopulation($parameters)
    {
        for ($i = 0; $i <= $parameters['population_size']; $i++){
           $ret[] = $this->createIndividu($parameters);

        }
        foreach ($ret as $key => $val){
            print_r($val);
            echo '<br>';
        }
    }
}

$parameters = [
    'file_name' => 'product.txt',
    'columns' => ['item', 'price'],
    'population_size' => 10 
];

$katalog = new catalogue;
print_r($katalog->product($parameters));

$initalPopulation = new PopulationGenerator;
$initalPopulation->createPopulation($parameters);