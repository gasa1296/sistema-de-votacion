import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
const CreateVoterImport = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateVoterImport.url(options),
    method: 'get',
})

CreateVoterImport.definition = {
    methods: ["get","head"],
    url: '/admin/voter-imports/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
CreateVoterImport.url = (options?: RouteQueryOptions) => {
    return CreateVoterImport.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
CreateVoterImport.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: CreateVoterImport.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
CreateVoterImport.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: CreateVoterImport.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
const CreateVoterImportForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: CreateVoterImport.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
CreateVoterImportForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: CreateVoterImport.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
CreateVoterImportForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: CreateVoterImport.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

CreateVoterImport.form = CreateVoterImportForm

export default CreateVoterImport