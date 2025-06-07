<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    // Ini untuk semua halaman Main Menu
    public function main(Request $request)
    {
        return view('main');
    }


    public function index(Request $request)
    {
        $categories = [
            [
                'name' => 'Getting Started',
                'items' => [
                    [
                        'title' => 'Apa itu aplikasi ini?',
                        'content' => view('faqs.content.apaitu')->render(),
                        'subitems' => [
                            [
                                'title' => 'Detail Apa itu aplikasi',
                                'content' => view('faqs.content.apaitu')->render(),
                            ],
                            [
                                'title' => 'FAQ Terkait Apa itu aplikasi',
                                'content' => '<p>Jawaban untuk pertanyaan umum terkait aplikasi.</p>',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Cara registrasi',
                        'content' => view('faqs.content.cararegistrasi')->render(),
                    ],
                ],
            ],
            [
                'name' => 'Troubleshooting SAP',
                'items' => [
                    [
                        'title' => 'Troubeshooting SAP Teks',
                        'content' => view('faqs.content.apaitu')->render(),
                    ],
                    [
                        'title' => 'Troubeshooting SAP Gambar',
                        'content' => view('faqs.content.cararegistrasi')->render(),
                    ],
                    [
                        'title' => 'Troubeshooting PDF preview',
                        'content' => view('faqs.content.preview_pdf')->render(),
                    ],
                ],
            ],
            [
                'name' => 'Fitur',
                'items' => [
                    [
                        'title' => 'Fitur Utama',
                        'content' => '<h2 class="text-lg font-bold mb-2">Fitur Utama</h2><p>Aplikasi memiliki fitur manajemen user, artikel, dan kategori.</p>',
                    ],
                ],
            ],
        ];

        return view('faqs.index', compact('categories'));
    }
}
