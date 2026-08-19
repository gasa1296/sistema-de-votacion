import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/voter-imports',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: index.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
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

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/admin/voter-imports/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\CreateVoterImport::__invoke
* @see Filament/Resources/VoterImportResource/Pages/CreateVoterImport.php:7
* @route '/admin/voter-imports/create'
*/
createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: create.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

create.form = createForm

const voterImports = {
    index: Object.assign(index, index),
    create: Object.assign(create, create),
}

export default voterImports