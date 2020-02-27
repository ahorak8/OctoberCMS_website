<?php namespace Ahorak\Movies;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [       // Return an array of components that we have
            'Ahorak\Movies\Components\Actors' => 'actors', // Assign the component an alias
            'Ahorak\Movies\Components\ActorForm' => 'actorform' // Assign the component an alias
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'Ahorak\Movies\FormWidgets\Actorbox' => [
                'label' => 'Actorbox field',
                'code' => 'actorbox'
                ]
            ];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        \Event::listen('offline.sitesearch.query', function ($query) {

            // The controller is used to generate page URLs.
            $controller = \Cms\Classes\Controller::getController() ?? new \Cms\Classes\Controller();

            // Search your plugin's contents
            $items = Models\Movie
                ::where('name', 'like', "%${query}%")
                ->orWhere('description', 'like', "%${query}%")
                ->get();

            // Now build a results array
            $results = $items->map(function ($item) use ($query) {

                // If the query is found in the title, set a relevance of 2
                $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;
            
                // Optional: Add an age penalty to older results. This makes sure that
                // newer results are listed first.
                // if ($relevance > 1 && $item->created_at) {
                //    $ageInDays = $item->created_at->diffInDays(\Illuminate\Support\Carbon::now());
                //    $relevance -= \OFFLINE\SiteSearch\Classes\Providers\ResultsProvider::agePenaltyForDays($ageInDays);
                // }

                return [
                    'title'     => $item->name,
                    'text'      => $item->description,
                    // 'url'       => $controller->pageUrl('cms-page-file-name', ['slug' => $item->slug]),
                    'url'       => '/movie/' . $item->slug,
                    'thumb'     => optional($item->poster)->first(), // Instance of System\Models\File
                    // optional allows it to return the array without a thumbnail if the movie doesn't have it
                    
                    'relevance' => $relevance, // higher relevance results in a higher
                                               // position in the results listing
                    // 'meta' => 'data',       // optional, any other information you want
                                               // to associate with this result
                    // 'model' => $item,       // optional, pass along the original model
                ];
            });

            return [
                'provider' => 'Movie', // The badge to display for this result
                'results'  => $results,
            ];
        });
    }

}
