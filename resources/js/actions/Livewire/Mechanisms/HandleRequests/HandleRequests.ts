import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \Livewire\Mechanisms\HandleRequests\HandleRequests::handleUpdate
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRequests/HandleRequests.php:138
 * @route '/livewire-09654e7b/update'
 */
export const handleUpdate = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: handleUpdate.url(options),
    method: 'post',
})

handleUpdate.definition = {
    methods: ["post"],
    url: '/livewire-09654e7b/update',
} satisfies RouteDefinition<["post"]>

/**
* @see \Livewire\Mechanisms\HandleRequests\HandleRequests::handleUpdate
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRequests/HandleRequests.php:138
 * @route '/livewire-09654e7b/update'
 */
handleUpdate.url = (options?: RouteQueryOptions) => {
    return handleUpdate.definition.url + queryParams(options)
}

/**
* @see \Livewire\Mechanisms\HandleRequests\HandleRequests::handleUpdate
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRequests/HandleRequests.php:138
 * @route '/livewire-09654e7b/update'
 */
handleUpdate.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: handleUpdate.url(options),
    method: 'post',
})

    /**
* @see \Livewire\Mechanisms\HandleRequests\HandleRequests::handleUpdate
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRequests/HandleRequests.php:138
 * @route '/livewire-09654e7b/update'
 */
    const handleUpdateForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: handleUpdate.url(options),
        method: 'post',
    })

            /**
* @see \Livewire\Mechanisms\HandleRequests\HandleRequests::handleUpdate
 * @see vendor/livewire/livewire/src/Mechanisms/HandleRequests/HandleRequests.php:138
 * @route '/livewire-09654e7b/update'
 */
        handleUpdateForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: handleUpdate.url(options),
            method: 'post',
        })
    
    handleUpdate.form = handleUpdateForm
const HandleRequests = { handleUpdate }

export default HandleRequests