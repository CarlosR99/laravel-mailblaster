<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Imports\RecipientsImport;
use Illuminate\Support\Collection;

class RecipientsImportTest extends TestCase
{
    /** @test */
    public function filtra_emails_validos()
    {
        $import = new RecipientsImport();
        $rows = collect([
            ['email' => 'valido@email.com'],
            ['email' => 'no-valido'],
            ['email' => 'otro@email.com'],
        ]);

        $result = $import->filterValidEmails($rows);

        $this->assertTrue($result->contains('valido@email.com'));
        $this->assertTrue($result->contains('otro@email.com'));
        $this->assertFalse($result->contains('no-valido'));
    }

    /** @test */
    public function elimina_duplicados()
    {
        $import = new RecipientsImport();
        $rows = collect([
            ['email' => 'a@email.com'],
            ['email' => 'a@email.com'],
            ['email' => 'b@email.com'],
        ]);

        $result = $import->removeDuplicates($rows);

        $this->assertCount(2, $result);
        $this->assertTrue($result->contains('a@email.com'));
        $this->assertTrue($result->contains('b@email.com'));
    }

    /** @test */
    public function ignora_encabezados_y_filas_vacias()
    {
        $import = new RecipientsImport();
        $rows = collect([
            ['email' => 'Email'],
            ['email' => ''],
            ['email' => 'real@email.com'],
        ]);

        $result = $import->cleanRows($rows);

        $this->assertTrue($result->contains('real@email.com'));
        $this->assertFalse($result->contains('Email'));
        $this->assertFalse($result->contains(''));
    }
}
