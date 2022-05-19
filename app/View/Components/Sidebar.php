<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $links = [
            "Dashboard" => [
                "icon"      => "bx bx-home-circle",
                "url"       => "/dashboard",
                "sublinks"  => false
            ],
            "Inventaris Lab" => [
                "icon" => "bx bx-layout",
                "url"  => false,
                "sublinks"  => [
                    "Table" => [
                        "icon"  => "bx bx-table",
                        "url"   => "/inventories/table"
                    ],
                    "Tambah Inventaris" => [
                        "icon"  => "bx bx-plus",
                        "url"   => "/inventories/create"
                    ]
                ]
            ]
        ];

        return view('components.sidebar', ['links' => $links]);
    }
}
