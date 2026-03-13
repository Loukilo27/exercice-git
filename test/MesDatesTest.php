<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use UPJV\MesDates;

#[CoversClass(MesDates::class)] // Important pour éviter le "R"
final class MesDatesTest extends TestCase {
    public function testDemain(): void {
        $mesDates = new MesDates();
        $res = $mesDates->demain();
        
        $this->assertJson($res);
        $data = json_decode($res, true);
        $dateAttendue = (new \DateTime('tomorrow'))->format('d-m-Y');
        $this->assertEquals($dateAttendue, $data['demain']);
    }
}