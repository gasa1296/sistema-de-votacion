import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\ElectionResource\Pages\CreateElection::__invoke
 * @see app/Filament/Resources/ElectionResource/Pages/CreateElection.php:7
 * @route '/admin/elections/create'
 */
const CreateElection = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateElection.url(options),
    method: 'get',
})

CreateElection.definition = {
    methods: ["get","head"],
    url: '/admin/elections/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\ElectionResource\Pages\CreateElection::__invoke
 * @see app/Filament/Resources/ElectionResource/Pages/CreateElection.php:7
 * @route '/admin/elections/create'
 */
CreateElection.url = (options?: RouteQueryOptions) => {
    return CreateElection.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\ElectionResource\Pages\CreateElection::__invoke
 * @see app/Filament/Resources/ElectionResource/Pages/CreateElection.php:7
 * @route '/admin/elections/create'
 */
CreateElection.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateElection.url(options),
    method: 'get',
})
/**
* @see \App\Filament\Resources\ElectionResource\Pages\CreateElection::__invoke
 * @see app/Filament/Resources/ElectionResource/Pages/CreateElection.php:7
 * @route '/admin/elections/create'
 */
CreateElection.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: CreateElection.url(options),
    method: 'head',
})

    /**
* @see \App\Filament\Resources\ElectionResource\Pages\CreateElection::__invoke
 * @see app/Filament/Resources/ElectionResource/Pages/CreateElection.php:7
 * @route '/admin/elections/create'
 */
    const CreateElectionForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: CreateElection.url(options),
        method: 'get',
    })

            /**
* @see \App\Filament\Resources\ElectionResource\Pages\CreateElection::__invoke
 * @see app/Filament/Resources/ElectionResource/Pages/CreateElection.php:7
 * @route '/admin/elections/create'
 */
        CreateElectionForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: CreateElection.url(options),
            method: 'get',
        })
            /**
* @see \App\Filament\Resources\ElectionResource\Pages\CreateElection::__invoke
 * @see app/Filament/Resources/ElectionResource/Pages/CreateElection.php:7
 * @route '/admin/elections/create'
 */
        CreateElectionForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: CreateElection.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    CreateElection.form = CreateElectionForm
export default CreateElection