<?php

require_once '../../vendor/autoload.php';
require_once '../../models/RecursoModel.php';

class FactoryRecurso{

    public $faker;
    /* private $recurso_model; */

    public function __construct()
    {
        $faker = $this->faker = Faker\Factory::create();
        /* $this->recurso_model = new RecursoModel; */
    }

    public function crearRecurso(){

        /* $this->recurso_model->guardar($this->faker->name); */

    }
}
