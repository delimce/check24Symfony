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
        $mappedData["SeguroEnVigor"] = $this->isAlreadyInsuredDriver($originalData);
        return $mappedData;
    }

    public function isHolder(array $data): string
    {
        $isHolder = $data['holder']['holder'] ?? "";
        return ($isHolder === self::MAIN_DRIVER_OPTION) ? 'YES' : 'NO';
    }

    public function isUniqueDriver(array $data): string
    {
        $isUnique = $data['occasional_driver'] ?? [];
        return (count($isUnique) === 0) ? 'YES' : 'NO';
    }

    public function getTotalAdditionalDrivers(array $data): int
    {
        $total = $data['occasional_driver'] ?? [];
        return count($total);
    }

    public function isAlreadyInsuredDriver(array $data): string
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

    public function getInsuranceSeniority(array $data): int
    {
        $result = $data["prevInsurance"]["prevInsurance_years"] ?? 0;
        return intval($result);

    }
}
