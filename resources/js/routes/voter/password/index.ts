import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../wayfinder'
/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgot
* @see Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
export const forgot = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: forgot.url(options),
    method: 'get',
})

forgot.definition = {
    methods: ["get","head"],
    url: '/olvide-contrasena',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgot
* @see Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgot.url = (options?: RouteQueryOptions) => {
    return forgot.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgot
* @see Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgot.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: forgot.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgot
* @see Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgot.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: forgot.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgot
* @see Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
const forgotForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: forgot.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgot
* @see Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgotForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: forgot.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::forgot
* @see Http/Controllers/Auth/VoterPasswordResetController.php:18
* @route '/olvide-contrasena'
*/
forgotForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: forgot.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

forgot.form = forgotForm

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::email
* @see Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
export const email = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: email.url(options),
    method: 'post',
})

email.definition = {
    methods: ["post"],
    url: '/olvide-contrasena',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::email
* @see Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
email.url = (options?: RouteQueryOptions) => {
    return email.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::email
* @see Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
email.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: email.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::email
* @see Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
const emailForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: email.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::email
* @see Http/Controllers/Auth/VoterPasswordResetController.php:23
* @route '/olvide-contrasena'
*/
emailForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: email.url(options),
    method: 'post',
})

email.form = emailForm

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see Http/Controllers/Auth/VoterPasswordResetController.php:50
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
* @see Http/Controllers/Auth/VoterPasswordResetController.php:50
* @route '/restablecer-contrasena'
*/
reset.url = (options?: RouteQueryOptions) => {
    return reset.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see Http/Controllers/Auth/VoterPasswordResetController.php:50
* @route '/restablecer-contrasena'
*/
reset.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reset.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see Http/Controllers/Auth/VoterPasswordResetController.php:50
* @route '/restablecer-contrasena'
*/
const resetForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: reset.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterPasswordResetController::reset
* @see Http/Controllers/Auth/VoterPasswordResetController.php:50
* @route '/restablecer-contrasena'
*/
resetForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: reset.url(options),
    method: 'post',
})

reset.form = resetForm

const password = {
    forgot: Object.assign(forgot, forgot),
    email: Object.assign(email, email),
    reset: Object.assign(reset, reset),
}

export default password