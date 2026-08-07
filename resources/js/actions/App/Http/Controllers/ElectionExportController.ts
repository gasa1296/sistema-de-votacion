import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ElectionExportController::pdf
 * @see app/Http/Controllers/ElectionExportController.php:12
 * @route '/elecciones/{election}/exportar/pdf'
 */
export const pdf = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: pdf.url(args, options),
    method: 'get',
})

pdf.definition = {
    methods: ["get","head"],
    url: '/elecciones/{election}/exportar/pdf',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ElectionExportController::pdf
 * @see app/Http/Controllers/ElectionExportController.php:12
 * @route '/elecciones/{election}/exportar/pdf'
 */
pdf.url = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
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

    return pdf.definition.url
            .replace('{election}', parsedArgs.election.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\ElectionExportController::pdf
 * @see app/Http/Controllers/ElectionExportController.php:12
 * @route '/elecciones/{election}/exportar/pdf'
 */
pdf.get = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: pdf.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ElectionExportController::pdf
 * @see app/Http/Controllers/ElectionExportController.php:12
 * @route '/elecciones/{election}/exportar/pdf'
 */
pdf.head = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: pdf.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\ElectionExportController::pdf
 * @see app/Http/Controllers/ElectionExportController.php:12
 * @route '/elecciones/{election}/exportar/pdf'
 */
    const pdfForm = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: pdf.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\ElectionExportController::pdf
 * @see app/Http/Controllers/ElectionExportController.php:12
 * @route '/elecciones/{election}/exportar/pdf'
 */
        pdfForm.get = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: pdf.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\ElectionExportController::pdf
 * @see app/Http/Controllers/ElectionExportController.php:12
 * @route '/elecciones/{election}/exportar/pdf'
 */
        pdfForm.head = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: pdf.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    pdf.form = pdfForm
/**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:34
 * @route '/elecciones/{election}/exportar/excel'
 */
export const excel = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: excel.url(args, options),
    method: 'get',
})

excel.definition = {
    methods: ["get","head"],
    url: '/elecciones/{election}/exportar/excel',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:34
 * @route '/elecciones/{election}/exportar/excel'
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
 * @see app/Http/Controllers/ElectionExportController.php:34
 * @route '/elecciones/{election}/exportar/excel'
 */
excel.get = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: excel.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:34
 * @route '/elecciones/{election}/exportar/excel'
 */
excel.head = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: excel.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:34
 * @route '/elecciones/{election}/exportar/excel'
 */
    const excelForm = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: excel.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:34
 * @route '/elecciones/{election}/exportar/excel'
 */
        excelForm.get = (args: { election: number | { id: number } } | [election: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: excel.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\ElectionExportController::excel
 * @see app/Http/Controllers/ElectionExportController.php:34
 * @route '/elecciones/{election}/exportar/excel'
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
const ElectionExportController = { pdf, excel }

export default ElectionExportController