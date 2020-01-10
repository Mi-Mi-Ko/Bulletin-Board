<?php

namespace App\Exports;

use App\Post;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class PostsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Post::leftjoin('users', function ($leftjoin) {
            $leftjoin->on('posts.create_user_id', '=', 'users.id');
        })
            ->select('posts.title', 'posts.description', 'posts.created_at', 'users.name')
            ->get();

    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'タイトル',
            'デスクリプション',
            '投稿したユーザー',
            '投稿した日',
        ];
    }
    /**
     * @return array
     */
    public function map($posts): array
    {
        return [
            $posts->title,
            $posts->description,
            $posts->name,
            Carbon::parse($posts->created_at)->format('Y-m-d'),
        ];
    }
    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $posts) {
                $posts->sheet->wrapText('A1:A800');
                $posts->sheet->wrapText('B1:B800');
                $posts->sheet->getDelegate()->getColumnDimension('A')->setWidth(50);
                $posts->sheet->getDelegate()->getColumnDimension('B')->setWidth(100);
                $posts->sheet->getDelegate()->getColumnDimension('C')->setWidth(23);
                $posts->sheet->getDelegate()->getColumnDimension('D')->setWidth(15);
                $posts->sheet->getStyle('A1:F1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 13,
                    ],
                ]);
            },
        ];
    }
}
