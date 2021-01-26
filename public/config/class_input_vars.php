<?php 
if(!class_exists('Tpc_Input_Vars'))
{
    class Tpc_Input_Vars
    {

        public $address = [
            [
                'input_name' => 'tpc_street',
                'type' => 'string', 
                'validation' => [ 10, 70 ],
                'sanitize' => true
            ],
            [
                'input_name' => 'tpc_zip_code', 
                'type' => 'digit', 
                'validation' => [ 5 ],
                'sanitize' => true
            ],
            [
                'input_name' => 'tpc_colony', 
                'type' => 'string', 
                'validation' => [ 10, 150 ],
                'sanitize' => true
            ]
        ];

        public $personal_info = [
            [
                'input_name' => 'tpc_gender', 
                'type' => 'string', 
                'validation' => [ 'Hombre', 'Mujer' ]
            ],
            [
                'input_name' => 'tpc_marital_status',
                'type' => 'string',
                'validation' => [ 'Casado', 'Soltero', 'otro' ]
            ],
            [
                'input_name' => 'tpc_full_time_job',
                'type' => 'string',
                'validation' => [ 'Trabajo tiempo completo' ]
            ],
            [
                'input_name' => 'tpc_part_time_job',
                'type' => 'string',
                'validation' => [ 'Trabajo medio tiempo' ]
            ],
            [
                'input_name' => 'tpc_student',
                'type' => 'string',
                'validation' => [ 'Soy estudiante' ]
            ],
            [
                'input_name' => 'tpc_unemployed',
                'type' => 'string',
                'validation' => [ 'No trabajo' ]
            ],
            [
                'input_name' => 'tpc_home_office',
                'type' => 'string',
                'validation' => [ 'Trabajo desde casa' ]
            ],
            [
                'input_name' => 'tpc_birthdate', 
                'type' => 'date_time', 
                'validation' => [ 'd/m/Y' ]
            ],
            [
                'input_name' => 'tpc_home_phone', 
                'type' => 'digit', 
                'validation' => [ 10 ],
                'sanitize' => true
            ],
            [
                'input_name' => 'tpc_cellphone', 
                'type' => 'digit', 
                'validation' => [ 10 ],
                'sanitize' => true
            ]
        ];

        public $occupation_keys = [ 
            'tpc_full_time_job',
            'tpc_part_time_job',
            'tpc_student',
            'tpc_unemployed',
            'tpc_home_office' 
        ];

        public $house_info = [
            [
                'input_name' => 'tpc_attachments', 
                'type' => 'string', 
                'validation' => [ 1, 90 ],
                'sanitize' => true
            ],
            [
                'input_name' => 'tpc_home', 
                'type' => 'string', 
                'validation' => [ 'Casa', 'Apartamento' ]
            ],
            [
                'input_name' => 'tpc_front_yard', 
                'type' => 'string', 
                'validation' => [ 'Jardín frontal' ]
            ],
            [
                'input_name' => 'tpc_back_yard', 
                'type' => 'string', 
                'validation' => [ 'Jardín trasero' ]
            ],
            [
                'input_name' => 'tpc_garage', 
                'type' => 'string', 
                'validation' => [ 'Cochera' ]
            ],
            [
                'input_name' => 'tpc_balcony', 
                'type' => 'string', 
                'validation' => [ 'Balcón' ]
            ],
            [
                'input_name' => 'tpc_patio', 
                'type' => 'string', 
                'validation' => [ 'Patio' ]
            ],
            [
                'input_name' => 'tpc_hallways', 
                'type' => 'string', 
                'validation' => [ 'Pasillos laterales' ]
            ],
            /*[
                'input_name' => 'tpc_kids', 
                'type' => 'string', 
                'validation' => [ 'Niños' ]
            ],
            [
                'input_name' => 'tpc_pets', 
                'type' => 'string', 
                'validation' => [ 'Mascotas' ]
            ]*/
            /*[
                'input_name' => 'tpc_injection', 
                'type' => 'string', 
                'min' => 18
            ],
            [
                'input_name' => 'tpc_special_care', 
                'type' => 'string', 
                'min' => 19
            ]*/
        ];

        public $free_space_keys = [ 
            'tpc_front_yard',
            'tpc_back_yard',
            'tpc_garage',
            'tpc_balcony',
            'tpc_patio',
            'tpc_hallways'
        ];

    }
}
