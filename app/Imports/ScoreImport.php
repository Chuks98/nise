<?php

namespace App\Imports;

use App\Models\Score;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ScoreImport implements OnEachRow, WithMultipleSheets
{
    private $headerFound = false;
    private $headerMap = [];

    public function sheets(): array
    {
        // Import ONLY the first sheet (index 0)
        return [
            0 => $this
        ];
    }

    public function onRow(Row $row)
    {
        try {
        $delegateRow = $row->getDelegate();

            $data = [];
            foreach ($delegateRow->getCellIterator() as $cell) {
                $data[] = $cell->getCalculatedValue();
            }

            // Detect header row using S/NO
            if (!$this->headerFound) {
                $header = array_map(fn($h) => strtoupper(trim($h)), $data);

                if (in_array('S/NO', $header)) {
                    $this->headerFound = true;
                    $this->headerMap = $data;
                }
                return;
            }

            // Map row data
            $rowData = [];
            foreach ($this->headerMap as $colIndex => $headerText) {
                $clean = strtolower(str_replace([' ', '/', '.', '(', ')'], '_', trim($headerText)));
                $rowData[$clean] = $data[$colIndex] ?? null;
            }

            // Check for existing duplicate (all columns)
            $exists = Score::where('session',  $rowData['session'] ?? null)
                ->where('class',    $rowData['class'] ?? null)
                ->where('semester', $rowData['semester'] ?? null)
                ->where('s_no',     $rowData['s_no'] ?? null)
                ->where('name',     $rowData['name'] ?? null)
                ->where('reg_no',   $rowData['reg_no'] ?? null)
                ->where('total',    $rowData['g_total'] ?? null)
                ->where('average',  $rowData['average'] ?? null)
                ->where('position', $rowData['position'] ?? null)
                ->where('remarks',  $rowData['remarks'] ?? null)
                ->exists();

            if (!$exists) {
                Score::create([
                    'session'  => $rowData['session'] ?? null,
                    'class'    => $rowData['class'] ?? null,
                    'semester' => $rowData['semester'] ?? null,
                    's_no'     => $rowData['s_no'] ?? null,
                    'name'     => $rowData['name'] ?? null,
                    'reg_no'   => $rowData['reg_no'] ?? null,
                    'total'    => $rowData['g_total'] ?? null,
                    'average'  => $rowData['average'] ?? null,
                    'position' => $rowData['position'] ?? null,
                    'remarks'  => $rowData['remarks'] ?? null,
                ]);
            }

        } catch (\Exception $e) {
            info("❌ Import Row Failed", [
                'error' => $e->getMessage(),
                'row'   => $row->toArray(),
            ]);
        }
    }
}
