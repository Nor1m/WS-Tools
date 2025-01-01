<?php


namespace App\Http\ViewComposers\Panel;

use Illuminate\View\View;

class SidebarViewComposer
{
    /**
     * @deprecated todo Избавиться от view композеров
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $toolsSettings = toolsSettings('tools', []);
        $path = request()->path();
        $menu = [];

        foreach ($toolsSettings as $id => $tool) {
            if ($tool['show_in_menu'] ?? null) {
                $menu[$tool['category']][$id]['icon'] = $tool['icon'];
                $menu[$tool['category']][$id]['title'] = $tool['title'];
                $menu[$tool['category']][$id]['is_active'] = ($path == $tool['category'] . "/{$id}");
            }
        };

        $view->with('menu', $menu);
    }
}
