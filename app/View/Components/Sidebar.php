<?php

namespace App\View\Components;

use Closure;
use App\Models\Questionmedia;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    // public function render(): View|Closure|string
    // {
    //     return view('components.sidebar');
    // }

    public function render(): View|Closure|string
    {
        $missingFiles = false;

        // Ambil semua questionmedias yang relevan (misalnya, yang terkait dengan sheetname tertentu)
        $questionMedias = Questionmedia::with('filemedias')->get(); // Sesuaikan query jika perlu

        foreach ($questionMedias as $questionMedia) {
            $trueFieldsCount = ($questionMedia->image ? 1 : 0) + ($questionMedia->audio ? 1 : 0);
            $fileMediasCount = $questionMedia->filemedias->count();

            if ($trueFieldsCount > $fileMediasCount) {
                $missingFiles = true;
                break; // Cukup temukan satu yang hilang
            }
        }

        return view('components.sidebar', compact('missingFiles'));
    }
}
