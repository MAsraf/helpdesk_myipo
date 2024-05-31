<?php

use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\TicketCategory;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

if (!function_exists('categories_list')) {
    /**
     * Return statuses list as an array of KEY (status id) => VALUE (status title)
     *
     * @return array
     */
    function categories_list(): array
    {
        return TicketCategory::whereNull('parent_id')->pluck('title','slug')->toArray();
    }
}

if (!function_exists('subcategories_list')) {
    /**
     * Return statuses list as an array of KEY (status id) => VALUE (status title)
     *
     * @return array
     */
    function subcategories_list(): array
    {
        return TicketCategory::whereNotNull('parent_id')->pluck('title', 'slug')->toArray();
    }
}

if (!function_exists('search_all_categories')) {
    /**
     * Return statuses list as an array of KEY (status id) => VALUE (status title)
     *
     * 
     */
    function search_all_categories()
    {
        $categories = TicketCategory::whereNull('parent_id')->get();
        $subCategories = TicketCategory::whereNotNull('parent_id')->get();
        $categoryData  = [];
        foreach ($categories as $category) {
            $subCategoryData = [];
            foreach ($subCategories as $subCategory) {
                if($subCategory->parent_id == $category->id){
                
                $subCategoryData[$subCategory->slug] = $subCategory->title; // Assuming sub-category has 'slug' and 'name' attributes
                }
            }
            $categoryData[$category->title] = $subCategoryData; // Assuming category has 'name' attribute
        }
        return $categoryData;
    }
}

if (!function_exists('statuses_list')) {
    /**
     * Return statuses list as an array of KEY (status id) => VALUE (status title)
     *
     * @return array
     */
    function statuses_list(): array
    {
        return TicketStatus::all()->pluck('title', 'slug')->toArray();
    }
}

if (!function_exists('statuses_list_for_kanban')) {
    /**
     * Return statuses list as an array for kanban board
     *
     * @return array
     */
    function statuses_list_for_kanban(): array
    {
        return TicketStatus::all()->map(fn($item) => [
            'id' => $item->slug,
            'title' => $item->title,
            'text-color' => $item->text_color,
            'bg-color' => $item->bg_color
        ])->toArray();
    }
}

if (!function_exists('priorities_list')) {
    /**
     * Return priorities list as an array of KEY (priority id) => VALUE (priority title)
     *
     * @return array
     */
    function priorities_list(): array
    {
        return TicketPriority::all()->pluck('title', 'slug')->toArray();
    }
}

if (!function_exists('default_ticket_status')) {
    /**
     * Return the default status configured on system configurations
     *
     * @return string|null
     */
    function default_ticket_status(): string|null
    {
        if ($default = TicketStatus::where('default', true)->first()) {
            return Str::slug($default->title);
        }
        return null;
    }
}

if (!function_exists('types_list')) {
    /**
     * Return types list as an array of KEY (type id) => VALUE (type title)
     *
     * @return array
     */
    function types_list(): array
    {
        return TicketType::all()->pluck('title', 'slug')->toArray();
    }
}

if (!function_exists('locales')) {
    /**
     * Return application locales as an array of KEY (locale id) => VALUE (locale title)
     *
     * @return array
     */
    function locales(): array
    {
        $locales = [];
        foreach (config('system.locales') as $key => $value) {
            $locales[$key] = __($value);
        }
        return $locales;
    }
}

if (!function_exists('can')) {
    /**
     * Return statuses list as an array of KEY (status id) => VALUE (status title)
     *
     * @return array
     */
    function can($permission)
    {
        
    }
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
