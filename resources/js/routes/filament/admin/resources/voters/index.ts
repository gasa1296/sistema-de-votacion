import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see app/Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/voters',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see app/Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see app/Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see app/Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see app/Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see app/Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\ListVoters::__invoke
* @see app/Filament/Resources/VoterResource/Pages/ListVoters.php:7
* @route '/admin/voters'
*/
indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

index.form = indexForm

const voters = {
    index: Object.assign(index, index),
}

export default voters