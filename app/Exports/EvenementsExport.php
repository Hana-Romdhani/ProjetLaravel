<?php

namespace App\Exports;

use App\Models\Evenement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EvenementsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Evenement::all();
    }

      /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Titre',
            'Date',
            'Lieu',
            'Description',
            'Classification',
            // Ajoutez d'autres colonnes selon vos besoins
        ];
    }
    public function map($evenement): array
    {
        return [
            $evenement->id,
            $evenement->adminUser->nameUser, 
            $evenement->title,
            $evenement->date instanceof \DateTime ? $evenement->date->format('d/m/Y') : $evenement->date,
            $evenement->location,
            $evenement->description,
            $evenement->classification->name, 
        ];
    }

     // Appliquer les styles aux en-têtes et aux cellules
     public function styles(Worksheet $sheet)
     {
         // Style pour l'en-tête
         $sheet->getStyle('A1:G1')->applyFromArray([
             'font' => [
                 'bold' => true,
                 'color' => ['rgb' => 'FFFFFF'],
             ],
             'fill' => [
                 'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                 'startColor' => ['rgb' => '4CAF50'], // Couleur de fond verte
             ],
             'alignment' => [
                 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
             ],
         ]);
 
         // Centrer le texte dans toutes les cellules
         $sheet->getStyle('A:F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
     }
}

