<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass; // Import de l'attribut
use UPJV\MesDates;

#[CoversClass(MesDates::class)] // <--- AJOUTE CECI
final class MesDatesTest extends TestCase
{
    public function testDemain(): void
    {
        $mesDates = new MesDates();
        $resultatJson = $mesDates->demain();

        $this->assertJson($resultatJson);
        
        $data = json_decode($resultatJson, true);
        $this->assertArrayHasKey('demain', $data);

        $dateAttendue = (new \DateTime('tomorrow'))->format('d-m-Y');
        $this->assertEquals($dateAttendue, $data['demain']);
    }
}