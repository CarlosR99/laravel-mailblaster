<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RecipientsImport implements ToCollection
{
    public $emails = [];

    public function collection(Collection $rows)
    {
        $first = true;
        foreach ($rows as $row) {
            if ($first) { // Saltar encabezado
                $first = false;
                continue;
            }
            $email = isset($row[1]) ? strtolower(trim($row[1])) : null;
            if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->emails[] = $email;
            }
        }
        $this->emails = array_unique($this->emails);
    }
}
