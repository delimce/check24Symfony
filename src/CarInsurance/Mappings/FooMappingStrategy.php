<?php

declare(strict_types=1);

namespace App\CarInsurance\Mappings;

class FooMappingStrategy extends AbstractMappingStrategy
{
    const MAIN_DRIVER_OPTION = 'CONDUCTOR_PRINCIPAL';

    public function doMapping(array $originalData): array
    {
        $mappedData = [];
        $mappedData["CondPpalEsTomador"] = $this->isHolder($originalData);
        $mappedData["ConductorUnico"] = $this->isUniqueDriver($originalData);
        $mappedData["FecCot"] = $this->getCurrentDateIso($originalData);
        $mappedData["FecEfecto"] = $this->getInsuranceSeniority($originalData);
        $mappedData["NroCondOca"] = $this->getTotalAdditionalDrivers($originalData);
        $mappedData["SeguroEnVigor"] = $this->isAlreadyInsureDriver($originalData);
        return $mappedData;
    }

    protected function isHolder(array $data): string
    {
        return ($data['holder']['holder'] === self::MAIN_DRIVER_OPTION) ? 'YES' : 'NO';
    }

    protected function isUniqueDriver(array $data): string
    {
        return (count($data['occasional_driver']) === 0) ? 'YES' : 'NO';
    }

    protected function getTotalAdditionalDrivers(array $data): int
    {
        return count($data['occasional_driver']);
    }

    protected function isAlreadyInsureDriver(array $data): string
    {
        $result = false;
        $insuranceExpiration = $data["prevInsurance"]["prevInsurance_expirationDate"] ?? null;

        if ($insuranceExpiration) {
            $endDate = strtotime($insuranceExpiration);
            $currentDate = strtotime(date('Y-m-d'));
            $result = $endDate >= $currentDate;
        }
        return ($result) ? 'YES' : 'NO';
    }

    protected function getInsuranceSeniority(array $data): int
    {
        return intval($data["prevInsurance"]["prevInsurance_years"]);
    }
}
