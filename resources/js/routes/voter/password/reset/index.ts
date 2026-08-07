import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::form
 * @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
 * @route '/restablecer-contrasena/{token}'
 */
export const form = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: form.url(args, options),
    method: 'get',
})

form.definition = {
    methods: ["get","head"],
    url: '/restablecer-contrasena/{token}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::form
 * @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
 * @route '/restablecer-contrasena/{token}'
 */
form.url = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { token: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    token: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        token: args.token,
                }

    return form.definition.url
            .replace('{token}', parsedArgs.token.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::form
 * @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
 * @route '/restablecer-contrasena/{token}'
 */
form.get = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: form.url(args, options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::form
 * @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
 * @route '/restablecer-contrasena/{token}'
 */
form.head = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: form.url(args, options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::form
 * @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
 * @route '/restablecer-contrasena/{token}'
 */
    const formForm = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: form.url(args, options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::form
 * @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
 * @route '/restablecer-contrasena/{token}'
 */
        formForm.get = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: form.url(args, options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::form
 * @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
 * @route '/restablecer-contrasena/{token}'
 */
        formForm.head = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: form.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    form.form = formForm