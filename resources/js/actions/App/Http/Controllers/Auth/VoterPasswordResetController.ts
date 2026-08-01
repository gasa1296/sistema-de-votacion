import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgotPassword
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
export const forgotPassword = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: forgotPassword.url(options),
    method: 'get',
})

forgotPassword.definition = {
    methods: ["get","head"],
    url: '/olvide-contrasena',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgotPassword
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgotPassword.url = (options?: RouteQueryOptions) => {
    return forgotPassword.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgotPassword
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgotPassword.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: forgotPassword.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgotPassword
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgotPassword.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: forgotPassword.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgotPassword
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
const forgotPasswordForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: forgotPassword.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgotPassword
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgotPasswordForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: forgotPassword.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgotPassword
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgotPasswordForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: forgotPassword.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

forgotPassword.form = forgotPasswordForm

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::sendResetLink
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
export const sendResetLink = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: sendResetLink.url(options),
    method: 'post',
})

sendResetLink.definition = {
    methods: ["post"],
    url: '/olvide-contrasena',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::sendResetLink
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
sendResetLink.url = (options?: RouteQueryOptions) => {
    return sendResetLink.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::sendResetLink
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
sendResetLink.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: sendResetLink.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::sendResetLink
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
const sendResetLinkForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: sendResetLink.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::sendResetLink
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
sendResetLinkForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: sendResetLink.url(options),
    method: 'post',
})

sendResetLink.form = sendResetLinkForm

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::resetForm
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
* @route '/restablecer-contrasena/{token}'
*/
export const resetForm = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: resetForm.url(args, options),
    method: 'get',
})

resetForm.definition = {
    methods: ["get","head"],
    url: '/restablecer-contrasena/{token}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::resetForm
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
* @route '/restablecer-contrasena/{token}'
*/
resetForm.url = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions) => {
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

    return resetForm.definition.url
            .replace('{token}', parsedArgs.token.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::resetForm
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
* @route '/restablecer-contrasena/{token}'
*/
resetForm.get = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: resetForm.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::resetForm
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
* @route '/restablecer-contrasena/{token}'
*/
resetForm.head = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: resetForm.url(args, options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::resetForm
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
* @route '/restablecer-contrasena/{token}'
*/
const resetFormForm = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: resetForm.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::resetForm
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
* @route '/restablecer-contrasena/{token}'
*/
resetFormForm.get = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: resetForm.url(args, options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::resetForm
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:47
* @route '/restablecer-contrasena/{token}'
*/
resetFormForm.head = (args: { token: string | number } | [token: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: resetForm.url(args, {
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

resetForm.form = resetFormForm

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:54
* @route '/restablecer-contrasena'
*/
export const reset = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reset.url(options),
    method: 'post',
})

reset.definition = {
    methods: ["post"],
    url: '/restablecer-contrasena',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:54
* @route '/restablecer-contrasena'
*/
reset.url = (options?: RouteQueryOptions) => {
    return reset.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:54
* @route '/restablecer-contrasena'
*/
reset.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reset.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:54
* @route '/restablecer-contrasena'
*/
const resetForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: reset.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see app/Http/Controllers/Auth/VoterPasswordResetController.php:54
* @route '/restablecer-contrasena'
*/
resetForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: reset.url(options),
    method: 'post',
})

reset.form = resetForm

const VoterPasswordResetController = { forgotPassword, sendResetLink, resetForm, reset }

export default VoterPasswordResetController