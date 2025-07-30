<?php
namespace App\Http\Composers;

use Illuminate\View\View;
use App\Models\{Page, Setting, Category};

class PageStatusComposer
{
    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $pageManager = [];

        $pages = Page::get();

        $setting = Setting::find(1);

        $categoryData = Category::where('status', '1')->orderby('type')->get()->groupBy('type');

        foreach($pages as $page){
            $pageManager[$page['slug']] = [
                'name' =>  $page['title'],
                'status' => $page['status'],
                'slug' => $page['slug']
            ]; 

            // if($page->type == 'about-us'){
            //     $aboutStatus = $page->status;
            // }
            // if($page->type == 'how-to'){
            //     $howToStatus = $page->status;
            // }
            // if($page->type == 'terms-of-use'){
            //     $termOfUseStatus = $page->status;
            // }
            // if($page->type == 'privacy-policy'){
            //     $privacyPolicyStatus = $page->status;
            // }
            // if($page->type == 'return-policy'){
            //     $returnPolicyStatus = $page->status;
            // }
            // if($page->type == 'shipping-policy'){
            //     $shippingPolicyStatus = $page->status;
            // }
            // if($page->type == 'how-it-works'){
            //     $howItWorksStatus = $page->status; 
            // }
        }
        return $view->with(
            [
                'pageManager' => $pageManager,
                'setting' => $setting,
                'categoryData' => $categoryData, 
            ]
        );
    }
}