import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\ElectionResource\Pages\ListElections::__invoke
* @see Filament/Resources/ElectionResource/Pages/ListElections.php:7
* @route '/admin/elections'
*/
const ListElections = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListElections.url(options),
    method: 'get',
})

ListElections.definition = {
    methods: ["get","head"],
    url: '/admin/elections',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\ElectionResource\Pages\ListElections::__invoke
* @see Filament/Resources/ElectionResource/Pages/ListElections.php:7
* @route '/admin/elections'
*/
ListElections.url = (options?: RouteQueryOptions) => {
    return ListElections.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\ElectionResource\Pages\ListElections::__invoke
* @see Filament/Resources/ElectionResource/Pages/ListElections.php:7
* @route '/admin/elections'
*/
ListElections.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListElections.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\ElectionResource\Pages\ListElections::__invoke
* @see Filament/Resources/ElectionResource/Pages/ListElections.php:7
* @route '/admin/elections'
*/
ListElections.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListElections.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\ElectionResource\Pages\ListElections::__invoke
* @see Filament/Resources/ElectionResource/Pages/ListElections.php:7
* @route '/admin/elections'
*/
const ListElectionsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListElections.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\ElectionResource\Pages\ListElections::__invoke
* @see Filament/Resources/ElectionResource/Pages/ListElections.php:7
* @route '/admin/elections'
*/
ListElectionsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListElections.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\ElectionResource\Pages\ListElections::__invoke
* @see Filament/Resources/ElectionResource/Pages/ListElections.php:7
* @route '/admin/elections'
*/
ListElectionsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListElections.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

ListElections.form = ListElectionsForm

export default ListElections