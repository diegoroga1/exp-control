<?php

return [
    'username' => env('DRG_USER','DRG admin'),
    'categories'=>[
        [
            "name" => "Compras",
            "subcategories" => ["Tiendita", "Supermercado", "Ropa", "Otros"]
        ],
        [
            "name" => "Gastos fijos",
            "subcategories" => ["Luz", "Internet", "Móvil", "Financiación", "Alquiler", "Subscripciones", "Seguro móvil"]
        ],
        [
            "name" => "Formación",
            "subcategories" => ["Colegio", "Material escolar", "Libros", "Excursiones", "Cursos", "Otros"]
        ],
        [
            "name" => "Ocio",
            "subcategories" => ["Vacaciones", "Paseos", "Esquiar", "Fiesta", "Comer fuera", "Fútbol"]
        ],
        [
            "name" => "Transporte",
            "subcategories" => ["Bono", "Taxi/Uber", "Patineta", "Otros"]
        ], [
            "name" => "Vivienda",
            "subcategories" => ["Muebles", "Electrodoméstricos", "Reparaciones", "Decoración", "Limpieza", "Otros"]
        ],
        [
            "name" => "Salud",
            "subcategories" => ["Gimnasio", "Farmacia", "Medico", "Cuidado personal", "Otros"]
        ], [
            "name" => "Otros",
            "subcategories" => ["Apple", "Betfair", "Withdraw", "Ahorro"]
        ],

    ]
];
