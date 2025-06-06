<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqCOntroller extends Controller
{
    public function index(Request $request)
    {
        return view('faqs.index');
    }

    // public function main(Request $request)
    // {
    //     return view('main');
    // }

    public function main()
    {
        $categories = [
            [
                'name' => 'Getting Started',
                'items' => [
                    [
                        'title' => 'Apa itu aplikasi ini?',
                        'image' => 'https://th.bing.com/th/id/OIP.pJ7lwj1hE9yN9KRAGR2yZAHaEI?w=290&h=180&c=7&r=0&o=7&pid=1.7&rm=3',
                        'content' => view('faqs.content.apaitu')->render(),
                    ],
                    [
                        'title' => 'Cara registrasi',
                        'image' => 'https://th.bing.com/th/id/OIP.pJ7lwj1hE9yN9KRAGR2yZAHaEI?w=290&h=180&c=7&r=0&o=7&pid=1.7&rm=3',
                        'content' => view('faqs.content.cararegistrasi')->render(),
                    ],
                ],
            ],
            [
                'name' => 'Troubleshooting SAP',
                'items' => [
                    [
                        'title' => 'Troubeshooting SAP Teks',
                        'image' => 'https://th.bing.com/th/id/OIP.pJ7lwj1hE9yN9KRAGR2yZAHaEI?w=290&h=180&c=7&r=0&o=7&pid=1.7&rm=3',
                        'content' => view('faqs.content.apaitu')->render(),
                    ],
                    [
                        'title' => 'Troubeshooting SAP Gambar',
                        'image' => 'https://th.bing.com/th/id/OIP.pJ7lwj1hE9yN9KRAGR2yZAHaEI?w=290&h=180&c=7&r=0&o=7&pid=1.7&rm=3',
                        'content' => view('faqs.content.cararegistrasi')->render(),
                    ],
                    [
                        'title' => 'Troubeshooting PDF preview ',
                        'image' => 'https://th.bing.com/th/id/OIP.pJ7lwj1hE9yN9KRAGR2yZAHaEI?w=290&h=180&c=7&r=0&o=7&pid=1.7&rm=3',
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

        return view('main', compact('categories'));
    }
}
