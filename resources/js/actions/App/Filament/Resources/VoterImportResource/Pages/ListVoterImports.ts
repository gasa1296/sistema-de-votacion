import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
const ListVoterImports = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListVoterImports.url(options),
    method: 'get',
})

ListVoterImports.definition = {
    methods: ["get","head"],
    url: '/admin/voter-imports',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
ListVoterImports.url = (options?: RouteQueryOptions) => {
    return ListVoterImports.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
ListVoterImports.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: ListVoterImports.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
ListVoterImports.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: ListVoterImports.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
const ListVoterImportsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListVoterImports.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
ListVoterImportsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListVoterImports.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterImportResource\Pages\ListVoterImports::__invoke
* @see app/Filament/Resources/VoterImportResource/Pages/ListVoterImports.php:7
* @route '/admin/voter-imports'
*/
ListVoterImportsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: ListVoterImports.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

ListVoterImports.form = ListVoterImportsForm

export default ListVoterImports