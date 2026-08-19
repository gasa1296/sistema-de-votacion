import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\VotingController::store
 * @see app/Http/Controllers/VotingController.php:44
 * @route '/votar'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/votar',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\VotingController::store
 * @see app/Http/Controllers/VotingController.php:44
 * @route '/votar'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\VotingController::store
 * @see app/Http/Controllers/VotingController.php:44
 * @route '/votar'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\VotingController::store
 * @see app/Http/Controllers/VotingController.php:44
 * @route '/votar'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\VotingController::store
 * @see app/Http/Controllers/VotingController.php:44
 * @route '/votar'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
const vote = {
    store: Object.assign(store, store),
}

export default vote