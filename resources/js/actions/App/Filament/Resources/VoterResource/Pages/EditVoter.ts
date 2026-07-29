import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../../wayfinder'
/**
* @see \App\Filament\Resources\VoterResource\Pages\EditVoter::__invoke
* @see app/Filament/Resources/VoterResource/Pages/EditVoter.php:7
* @route '/admin/voters/{record}/edit'
*/
const EditVoter = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditVoter.url(args, options),
    method: 'get',
})

EditVoter.definition = {
    methods: ["get","head"],
    url: '/admin/voters/{record}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Resources\VoterResource\Pages\EditVoter::__invoke
* @see app/Filament/Resources/VoterResource/Pages/EditVoter.php:7
* @route '/admin/voters/{record}/edit'
*/
EditVoter.url = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return EditVoter.definition.url
            .replace('{record}', parsedArgs.record.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Filament\Resources\VoterResource\Pages\EditVoter::__invoke
* @see app/Filament/Resources/VoterResource/Pages/EditVoter.php:7
* @route '/admin/voters/{record}/edit'
*/
EditVoter.get = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: EditVoter.url(args, options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\EditVoter::__invoke
* @see app/Filament/Resources/VoterResource/Pages/EditVoter.php:7
* @route '/admin/voters/{record}/edit'
*/
EditVoter.head = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: EditVoter.url(args, options),
    method: 'head',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\EditVoter::__invoke
* @see app/Filament/Resources/VoterResource/Pages/EditVoter.php:7
* @route '/admin/voters/{record}/edit'
*/
const EditVoterForm = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: EditVoter.url(args, options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\EditVoter::__invoke
* @see app/Filament/Resources/VoterResource/Pages/EditVoter.php:7
* @route '/admin/voters/{record}/edit'
*/
EditVoterForm.get = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: EditVoter.url(args, options),
    method: 'get',
})

/**
* @see \App\Filament\Resources\VoterResource\Pages\EditVoter::__invoke
* @see app/Filament/Resources/VoterResource/Pages/EditVoter.php:7
* @route '/admin/voters/{record}/edit'
*/
EditVoterForm.head = (args: { record: string | number } | [record: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: EditVoter.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

EditVoter.form = EditVoterForm

export default EditVoter