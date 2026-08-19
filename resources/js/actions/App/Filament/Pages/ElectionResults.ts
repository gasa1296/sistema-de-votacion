import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
const ElectionResults = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ElectionResults.url(options),
    method: 'get',
})

ElectionResults.definition = {
    methods: ["get","head"],
    url: '/admin/election-results',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
ElectionResults.url = (options?: RouteQueryOptions) => {
    return ElectionResults.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
ElectionResults.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ElectionResults.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
ElectionResults.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ElectionResults.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
const ElectionResultsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ElectionResults.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
ElectionResultsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ElectionResults.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
ElectionResultsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ElectionResults.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

ElectionResults.form = ElectionResultsForm

export default ElectionResults