import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
* @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
* @route '/admin/votes'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/votes',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
* @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
* @route '/admin/votes'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
* @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
* @route '/admin/votes'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
* @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
* @route '/admin/votes'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
* @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
* @route '/admin/votes'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
* @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
* @route '/admin/votes'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
* @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
* @route '/admin/votes'
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

const votes = {
    index: Object.assign(index, index),
}

export default votes