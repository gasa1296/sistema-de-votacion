import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoterResource\Pages\CreateVoter::__invoke
* @see Filament/Resources/VoterResource/Pages/CreateVoter.php:7
* @route '/admin/voters/create'
*/
const CreateVoter = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateVoter.url(options),
    method: 'get',
})

CreateVoter.definition = {
    methods: ["get","head"],
    url: '/admin/voters/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoterResource\Pages\CreateVoter::__invoke
* @see Filament/Resources/VoterResource/Pages/CreateVoter.php:7
* @route '/admin/voters/create'
*/
CreateVoter.url = (options?: RouteQueryOptions) => {
    return CreateVoter.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoterResource\Pages\CreateVoter::__invoke
* @see Filament/Resources/VoterResource/Pages/CreateVoter.php:7
* @route '/admin/voters/create'
*/
CreateVoter.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateVoter.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\CreateVoter::__invoke
* @see Filament/Resources/VoterResource/Pages/CreateVoter.php:7
* @route '/admin/voters/create'
*/
CreateVoter.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: CreateVoter.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\CreateVoter::__invoke
* @see Filament/Resources/VoterResource/Pages/CreateVoter.php:7
* @route '/admin/voters/create'
*/
const CreateVoterForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: CreateVoter.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\CreateVoter::__invoke
* @see Filament/Resources/VoterResource/Pages/CreateVoter.php:7
* @route '/admin/voters/create'
*/
CreateVoterForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: CreateVoter.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\CreateVoter::__invoke
* @see Filament/Resources/VoterResource/Pages/CreateVoter.php:7
* @route '/admin/voters/create'
*/
CreateVoterForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: CreateVoter.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

CreateVoter.form = CreateVoterForm

export default CreateVoter