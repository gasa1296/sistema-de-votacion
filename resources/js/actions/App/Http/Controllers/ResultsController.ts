import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\ResultsController::show
* @see Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
export const show = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/resultados',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ResultsController::show
* @see Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
show.url = (options?: RouteQueryOptions) => {
    return show.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ResultsController::show
* @see Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
show.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ResultsController::show
* @see Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
show.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ResultsController::show
* @see Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
const showForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ResultsController::show
* @see Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
showForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ResultsController::show
* @see Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
showForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: show.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

show.form = showForm

const ResultsController = { show }

export default ResultsController