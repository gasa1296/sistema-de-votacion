import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
const ListVoters = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListVoters.url(options),
    method: 'get',
})

ListVoters.definition = {
    methods: ["get","head"],
    url: '/admin/voters',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
ListVoters.url = (options?: RouteQueryOptions) => {
    return ListVoters.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
ListVoters.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListVoters.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
ListVoters.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListVoters.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
const ListVotersForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListVoters.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
ListVotersForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListVoters.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
ListVotersForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListVoters.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

ListVoters.form = ListVotersForm

export default ListVoters