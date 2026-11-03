import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:45
 * @route '/elecciones/{election}/exportar/votantes-excel'
 */
export const excel = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: excel.url(args, options),
    method: 'get',
})

excel.definition = {
    methods: ["get","head"],
    url: '/elecciones/{election}/exportar/votantes-excel',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:45
 * @route '/elecciones/{election}/exportar/votantes-excel'
 */
excel.url = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { election: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { election: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    election: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        election: typeof args.election === 'object'
                ? args.election.id
                : args.election,
                }

    return excel.definition.url
            .replace('{election}', parsedArgs.election.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:45
 * @route '/elecciones/{election}/exportar/votantes-excel'
 */
excel.get = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: excel.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:45
 * @route '/elecciones/{election}/exportar/votantes-excel'
 */
excel.head = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: excel.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:45
 * @route '/elecciones/{election}/exportar/votantes-excel'
 */
    const excelForm = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: excel.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:45
 * @route '/elecciones/{election}/exportar/votantes-excel'
 */
        excelForm.get = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: excel.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:45
 * @route '/elecciones/{election}/exportar/votantes-excel'
 */
        excelForm.head = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: excel.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    excel.form = excelForm
const voters = {
    excel: Object.assign(excel, excel),
}

export default voters