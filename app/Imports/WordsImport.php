<?php

namespace App\Imports;

use App\Models\Word;
use Maatwebsite\Excel\Concerns\ToModel;

class WordsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Word([
            'word_ar'     => $row[0],
            'word_lt'     => $row[1],
            'ar'          => $row[2],
            'fr'          => $row[3],
            'en'          => $row[4],
            'description' => $row[5],
            'origin'      => $row[6],
            'region'      => $row[7],
            'vocal'       => $row[8],
            'user_id'     => $row[9],
        ]);
    }
}
