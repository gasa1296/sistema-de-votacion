import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
 * @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
 * @route '/admin/votes'
 */
const ListVotes = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListVotes.url(options),
    method: 'get',
})

ListVotes.definition = {
    methods: ["get","head"],
    url: '/admin/votes',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
 * @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
 * @route '/admin/votes'
 */
ListVotes.url = (options?: RouteQueryOptions) => {
    return ListVotes.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
 * @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
 * @route '/admin/votes'
 */
ListVotes.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListVotes.url(options),
    method: 'get',
})
/**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
 * @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
 * @route '/admin/votes'
 */
ListVotes.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListVotes.url(options),
    method: 'head',
})

    /**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
 * @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
 * @route '/admin/votes'
 */
    const ListVotesForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: ListVotes.url(options),
        method: 'get',
    })

            /**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
 * @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
 * @route '/admin/votes'
 */
        ListVotesForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: ListVotes.url(options),
            method: 'get',
        })
            /**
* @see \App\Filament\Resources\VoteResource\Pages\ListVotes::__invoke
 * @see app/Filament/Resources/VoteResource/Pages/ListVotes.php:7
 * @route '/admin/votes'
 */
        ListVotesForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: ListVotes.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    ListVotes.form = ListVotesForm
export default ListVotes