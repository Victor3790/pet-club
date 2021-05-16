<?php 
if(!class_exists('Tpc_Input_Vars'))
{
    class Tpc_Input_Vars
    {
        public $address = [
            'street' => [
                'input_name' => 'tpc_street',
                'type' => 'string', 
                'validation' => [ 10, 70 ],
                'sanitize' => true
            ],
            'code' => [
                'input_name' => 'tpc_zip_code', 
                'type' => 'digit', 
                'validation' => [ 5 ],
                'sanitize' => true
            ],
            'colony' => [
                'input_name' => 'tpc_colony', 
                'type' => 'string'
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
                'input_name' => 'tpc_occupation', 
                'type' => 'array', 
                'validation' => [
                    'Trabajo tiempo completo',
                    'Trabajo medio tiempo',
                    'Soy estudiante',
                    'No trabajo',
                    'Trabajo desde casa'
                ]
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

        public $house_info = [
            [
                'input_name' => 'tpc_home', 
                'type' => 'string', 
                'validation' => [ 'Casa', 'Apartamento' ]
            ],
            [
                'input_name' => 'tpc_free_spaces',
                'type' => 'array',
                'validation' => [
                    'Jardín frontal',
                    'Jardín trasero',
                    'Cochera',
                    'Balcón',
                    'Patio',
                    'Pasillos laterales'
                ]
            ],
            [
                'input_name' => 'tpc_kids',
                'type' => 'string',
                'validation' => [ 'Sí', 'No' ]
            ],
            [
                'input_name' => 'tpc_pets',
                'type' => 'array',
                'validation' => [
                    'Tengo perros',
                    'Tengo gatos',
                    'No tengo mascotas'
                ]
            ],
            [
                'input_name' => 'tpc_furniture',
                'type' => 'string',
                'validation' => [ 'Sí', 'No' ]
            ],
            [
                'input_name' => 'tpc_smoking',
                'type' => 'string',
                'validation' => [ 'Sí', 'No' ]
            ],
            [
                'input_name' => 'tpc_attachments', 
                'type' => 'string', 
                'validation' => [ 1, 90 ],
                'sanitize' => true
            ],
        ];

        public $update_house_info = [
            [
                'input_name' => 'tpc_home', 
                'type' => 'string', 
                'validation' => [ 'Casa', 'Apartamento' ]
            ],
            [
                'input_name' => 'tpc_free_spaces',
                'type' => 'array',
                'validation' => [
                    'Jardín frontal',
                    'Jardín trasero',
                    'Cochera',
                    'Balcón',
                    'Patio',
                    'Pasillos laterales'
                ]
            ],
            [
                'input_name' => 'tpc_kids',
                'type' => 'string',
                'validation' => [ 'Sí', 'No' ]
            ],
            [
                'input_name' => 'tpc_pets',
                'type' => 'array',
                'validation' => [
                    'Tengo perros',
                    'Tengo gatos',
                    'No tengo mascotas'
                ]
            ],
            [
                'input_name' => 'tpc_furniture',
                'type' => 'string',
                'validation' => [ 'Sí', 'No' ]
            ],
            [
                'input_name' => 'tpc_smoking',
                'type' => 'string',
                'validation' => [ 'Sí', 'No' ]
            ]
        ];

        public $service_info = [
            [
                'input_name' => 'tpc_experience',
                'type' => 'numeric',
                'validation' => [ 0, 50 ]
            ],
            [
                'input_name' => 'tpc_abilities',
                'type' => 'array',
                'validation' => [
                    'Aplicación de inyecciones',
                    'Cuidados especiales',
                    'Cuidado de cachorros',
                    'Ninguna'
                ]
            ],
            [
                'input_name' => 'tpc_pet_client',
                'type' => 'array',
                'validation' => [
                    'tpc_dog',
                    'tpc_cat',
                    'tpc_other'
                ]
            ],
            [
                'input_name' => 'tpc_pet_size',
                'type' => 'array',
                'validation' => [
                    'tpc_small',
                    'tpc_medium_sized',
                    'tpc_big',
                    'tpc_extra_big'
                ]
            ],
            [
                'input_name' => 'tpc_service',
                'type' => 'array',
                'validation' => [
                    'tpc_lodging',
                    'tpc_day_care',
                    'tpc_walk'
                ]
            ],
            [
                'input_name' => 'tpc_lodging_qty',
                'type' => 'numeric',
                'validation' => [ 0, 10 ]
            ],
            [
                'input_name' => 'tpc_day_care_qty',
                'type' => 'numeric',
                'validation' => [ 0, 10 ]
            ],
            [
                'input_name' => 'tpc_walk_qty',
                'type' => 'numeric',
                'validation' => [ 0, 10 ]
            ],
            [
                'input_name' => 'tpc_description',
                'type' => 'string',
                'validation' => [ 10, 250 ],
                'sanitize' => true
            ],
            [
                'input_name' => 'tpc_thumbnail', 
                'type' => 'numeric', 
                'validation' => [ 0, 1000000 ]
            ]
        ];

        function __construct()
        {
            $colonias = include TPC_PLUGIN_PATH . 'public/config/colonias.php';
            $this->address['colony']['validation'] = $colonias;
        }

    }
}
