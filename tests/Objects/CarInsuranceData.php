<?php

namespace App\Tests\Objects;

trait CarInsuranceData
{
    private array $data = [
        "car_information" => [
            "car_brand" => "SEAT",
            "car_fuel" => "GASOLINA",
            "car_model" => "IBIZA",
        ],
        "car_use" => [
            "use_carUse" => "OCASIONAL",
            "use_kmsYear" => 6000,
            "use_nightParking" => "CALLE"
        ],
        "main_driver" => [
            "driver_birthDate" => "2002-06-05",
            "driver_birthPlace" => "ESP",
            "driver_id" => "36714791Y"
        ],
        "occasional_driver" => [],
        "holder" => [
            "holder" > "CONDUCTOR_PRINCIPAL",
        ],
        "prevInsurance" => [
            "prevInsurance_company" => "ALLIANZ",
            "prevInsurance_companyYear" => "8",
            "prevInsurance_contractDate" => "+30 days",
            "prevInsurance_expirationDate" => "2021-03-02",
            "prevInsurance_years" => "5"
        ]
    ];

    public function getData(): array
    {
        return $this->data;
    }
}