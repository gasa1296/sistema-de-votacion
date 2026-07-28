import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\ElectionResource\Pages\EditElection::__invoke
* @see app/Filament/Resources/ElectionResource/Pages/EditElection.php:7
* @route '/admin/elections/{record}/edit'
*/
const EditElection = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditElection.url(args, options),
    method: 'get',
})

EditElection.definition = {
    methods: ["get","head"],
    url: '/admin/elections/{record}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\ElectionResource\Pages\EditElection::__invoke
* @see app/Filament/Resources/ElectionResource/Pages/EditElection.php:7
* @route '/admin/elections/{record}/edit'
*/
EditElection.url = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { record: args }
    }

    if (Array.isArray(args)) {
        args = {
            record: args[0],
        }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
        record: args.record,
    }

    return EditElection.definition.url
            .replace('{record}', parsedArgs.record.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Filament\Resources\ElectionResource\Pages\EditElection::__invoke
* @see app/Filament/Resources/ElectionResource/Pages/EditElection.php:7
* @route '/admin/elections/{record}/edit'
*/
EditElection.get = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditElection.url(args, options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\ElectionResource\Pages\EditElection::__invoke
* @see app/Filament/Resources/ElectionResource/Pages/EditElection.php:7
* @route '/admin/elections/{record}/edit'
*/
EditElection.head = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: EditElection.url(args, options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\ElectionResource\Pages\EditElection::__invoke
* @see app/Filament/Resources/ElectionResource/Pages/EditElection.php:7
* @route '/admin/elections/{record}/edit'
*/
const EditElectionForm = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: EditElection.url(args, options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\ElectionResource\Pages\EditElection::__invoke
* @see app/Filament/Resources/ElectionResource/Pages/EditElection.php:7
* @route '/admin/elections/{record}/edit'
*/
EditElectionForm.get = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: EditElection.url(args, options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\ElectionResource\Pages\EditElection::__invoke
* @see app/Filament/Resources/ElectionResource/Pages/EditElection.php:7
* @route '/admin/elections/{record}/edit'
*/
EditElectionForm.head = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: EditElection.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

EditElection.form = EditElectionForm

export default EditElection