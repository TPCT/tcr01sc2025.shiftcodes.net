<?php

namespace App\Imports;

use App\Models\Models;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ModelsContentImport implements OnEachRow, WithStartRow
{
    private $data; 

    public function __construct()
    {
       
    }


    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        

        try {
            $item = Models::find($row[0]);
            if($item) {
                $page_description = [
                    'en' => $row[2] ?? '',
                    'ar' => $row[4] ?? '',
                ];
                $page_features = [
                    'en' => $row[3] ?? '',
                    'ar' => $row[5] ?? '',
                ];
                $item->update([
                    'page_description' => $page_description,
                    'page_features' => $page_features,
                ]);
                $seo = \App\Models\SEO::where("type","model")->where("resource_id",$item->id)->first();
                if($seo) {
                    $seo_description = [
                        'en' => $row[2] ?? '',
                        'ar' => $row[4] ?? '',
                    ];
                    $seo->update([
                        'description' => $seo_description,
                    ]);
                }
            }
        } catch (\Exception $e) {
            
        }

    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
