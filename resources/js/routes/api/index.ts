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
/**
 * @see routes/web.php:87
 * @route '/api/election-status'
 */
export const electionStatus = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: electionStatus.url(options),
    method: 'get',
})

electionStatus.definition = {
    methods: ["get","head"],
    url: '/api/election-status',
} satisfies RouteDefinition<["get","head"]>

/**
 * @see routes/web.php:87
 * @route '/api/election-status'
 */
electionStatus.url = (options?: RouteQueryOptions) => {
    return electionStatus.definition.url + queryParams(options)
}

/**
 * @see routes/web.php:87
 * @route '/api/election-status'
 */
electionStatus.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: electionStatus.url(options),
    method: 'get',
})
/**
 * @see routes/web.php:87
 * @route '/api/election-status'
 */
electionStatus.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: electionStatus.url(options),
    method: 'head',
})

    /**
 * @see routes/web.php:87
 * @route '/api/election-status'
 */
    const electionStatusForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: electionStatus.url(options),
        method: 'get',
    })

            /**
 * @see routes/web.php:87
 * @route '/api/election-status'
 */
        electionStatusForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: electionStatus.url(options),
            method: 'get',
        })
            /**
 * @see routes/web.php:87
 * @route '/api/election-status'
 */
        electionStatusForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: electionStatus.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    electionStatus.form = electionStatusForm
const api = {
    results: Object.assign(results, results),
electionStatus: Object.assign(electionStatus, electionStatus),
}

export default api