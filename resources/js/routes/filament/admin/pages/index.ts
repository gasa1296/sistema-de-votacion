import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
export const electionResults = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: electionResults.url(options),
    method: 'get',
})

electionResults.definition = {
    methods: ["get","head"],
    url: '/admin/election-results',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
electionResults.url = (options?: RouteQueryOptions) => {
    return electionResults.definition.url + queryParams(options)
}

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
electionResults.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: electionResults.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
electionResults.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: electionResults.url(options),
    method: 'head',
})

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
const electionResultsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionResults.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
electionResultsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionResults.url(options),
    method: 'get',
})

/**
* @see \App\Filament\Pages\ElectionResults::__invoke
* @see Filament/Pages/ElectionResults.php:7
* @route '/admin/election-results'
*/
electionResultsForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionResults.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

electionResults.form = electionResultsForm

/**
* @see \Filament\Pages\Dashboard::__invoke
* @see vendor/filament/filament/src/Pages/Dashboard.php:7
* @route '/admin'
*/
export const dashboard = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

dashboard.definition = {
    methods: ["get","head"],
    url: '/admin',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Filament\Pages\Dashboard::__invoke
* @see vendor/filament/filament/src/Pages/Dashboard.php:7
* @route '/admin'
*/
dashboard.url = (options?: RouteQueryOptions) => {
    return dashboard.definition.url + queryParams(options)
}

/**
* @see \Filament\Pages\Dashboard::__invoke
* @see vendor/filament/filament/src/Pages/Dashboard.php:7
* @route '/admin'
*/
dashboard.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: dashboard.url(options),
    method: 'get',
})

/**
* @see \Filament\Pages\Dashboard::__invoke
* @see vendor/filament/filament/src/Pages/Dashboard.php:7
* @route '/admin'
*/
dashboard.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: dashboard.url(options),
    method: 'head',
})

/**
* @see \Filament\Pages\Dashboard::__invoke
* @see vendor/filament/filament/src/Pages/Dashboard.php:7
* @route '/admin'
*/
const dashboardForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: dashboard.url(options),
    method: 'get',
})

/**
* @see \Filament\Pages\Dashboard::__invoke
* @see vendor/filament/filament/src/Pages/Dashboard.php:7
* @route '/admin'
*/
dashboardForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: dashboard.url(options),
    method: 'get',
})

/**
* @see \Filament\Pages\Dashboard::__invoke
* @see vendor/filament/filament/src/Pages/Dashboard.php:7
* @route '/admin'
*/
dashboardForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: dashboard.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

dashboard.form = dashboardForm

const pages = {
    electionResults: Object.assign(electionResults, electionResults),
    dashboard: Object.assign(dashboard, dashboard),
}

export default pages