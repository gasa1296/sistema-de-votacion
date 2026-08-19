import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
 * @see routes/web.php:75
 * @route '/api/results'
 */
export const results = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: results.url(options),
    method: 'get',
})

results.definition = {
    methods: ["get","head"],
    url: '/api/results',
} satisfies RouteDefinition<["get","head"]>

/**
 * @see routes/web.php:75
 * @route '/api/results'
 */
results.url = (options?: RouteQueryOptions) => {
    return results.definition.url + queryParams(options)
}

/**
 * @see routes/web.php:75
 * @route '/api/results'
 */
results.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: results.url(options),
    method: 'get',
})
/**
 * @see routes/web.php:75
 * @route '/api/results'
 */
results.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: results.url(options),
    method: 'head',
})

    /**
 * @see routes/web.php:75
 * @route '/api/results'
 */
    const resultsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: results.url(options),
        method: 'get',
    })

            /**
 * @see routes/web.php:75
 * @route '/api/results'
 */
        resultsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: results.url(options),
            method: 'get',
        })
            /**
 * @see routes/web.php:75
 * @route '/api/results'
 */
        resultsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: results.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    results.form = resultsForm
const api = {
    results: Object.assign(results, results),
}

export default api