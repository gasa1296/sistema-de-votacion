import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
import vote85807a from './vote'
import loginDf2c2a from './login'
/**
* @see \App\Http\Controllers\VotingController::vote
* @see app/Http/Controllers/VotingController.php:14
* @route '/'
*/
export const vote = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: vote.url(options),
    method: 'get',
})

vote.definition = {
    methods: ["get","head"],
    url: '/',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\VotingController::vote
* @see app/Http/Controllers/VotingController.php:14
* @route '/'
*/
vote.url = (options?: RouteQueryOptions) => {
    return vote.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\VotingController::vote
* @see app/Http/Controllers/VotingController.php:14
* @route '/'
*/
vote.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: vote.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\VotingController::vote
* @see app/Http/Controllers/VotingController.php:14
* @route '/'
*/
vote.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: vote.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\VotingController::vote
* @see app/Http/Controllers/VotingController.php:14
* @route '/'
*/
const voteForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: vote.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\VotingController::vote
* @see app/Http/Controllers/VotingController.php:14
* @route '/'
*/
voteForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: vote.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\VotingController::vote
* @see app/Http/Controllers/VotingController.php:14
* @route '/'
*/
voteForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: vote.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

vote.form = voteForm

/**
* @see [serialized-closure]:2
* @route '/login'
*/
export const login = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})

login.definition = {
    methods: ["get","head"],
    url: '/login',
} satisfies RouteDefinition<["get","head"]>

/**
* @see [serialized-closure]:2
* @route '/login'
*/
login.url = (options?: RouteQueryOptions) => {
    return login.definition.url + queryParams(options)
}

/**
* @see [serialized-closure]:2
* @route '/login'
*/
login.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: login.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/login'
*/
login.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: login.url(options),
    method: 'head',
})

/**
* @see [serialized-closure]:2
* @route '/login'
*/
const loginForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: login.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/login'
*/
loginForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: login.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/login'
*/
loginForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: login.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

login.form = loginForm

/**
* @see \App\Http\Controllers\ResultsController::results
* @see app/Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
export const results = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: results.url(options),
    method: 'get',
})

results.definition = {
    methods: ["get","head"],
    url: '/resultados',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\ResultsController::results
* @see app/Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
results.url = (options?: RouteQueryOptions) => {
    return results.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\ResultsController::results
* @see app/Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
results.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: results.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ResultsController::results
* @see app/Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
results.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: results.url(options),
    method: 'head',
})

/**
* @see \App\Http\Controllers\ResultsController::results
* @see app/Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
const resultsForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: results.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ResultsController::results
* @see app/Http/Controllers/ResultsController.php:12
* @route '/resultados'
*/
resultsForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: results.url(options),
    method: 'get',
})

/**
* @see \App\Http\Controllers\ResultsController::results
* @see app/Http/Controllers/ResultsController.php:12
* @route '/resultados'
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
* @see \App\Http\Controllers\Auth\VoterLoginController::logout
* @see app/Http/Controllers/Auth/VoterLoginController.php:36
* @route '/logout'
*/
export const logout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

logout.definition = {
    methods: ["post"],
    url: '/logout',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Auth\VoterLoginController::logout
* @see app/Http/Controllers/Auth/VoterLoginController.php:36
* @route '/logout'
*/
logout.url = (options?: RouteQueryOptions) => {
    return logout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Auth\VoterLoginController::logout
* @see app/Http/Controllers/Auth/VoterLoginController.php:36
* @route '/logout'
*/
logout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: logout.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterLoginController::logout
* @see app/Http/Controllers/Auth/VoterLoginController.php:36
* @route '/logout'
*/
const logoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: logout.url(options),
    method: 'post',
})

/**
* @see \App\Http\Controllers\Auth\VoterLoginController::logout
* @see app/Http/Controllers/Auth/VoterLoginController.php:36
* @route '/logout'
*/
logoutForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
    action: logout.url(options),
    method: 'post',
})

logout.form = logoutForm

/**
* @see [serialized-closure]:2
* @route '/gracias'
*/
export const thanks = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: thanks.url(options),
    method: 'get',
})

thanks.definition = {
    methods: ["get","head"],
    url: '/gracias',
} satisfies RouteDefinition<["get","head"]>

/**
* @see [serialized-closure]:2
* @route '/gracias'
*/
thanks.url = (options?: RouteQueryOptions) => {
    return thanks.definition.url + queryParams(options)
}

/**
* @see [serialized-closure]:2
* @route '/gracias'
*/
thanks.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: thanks.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/gracias'
*/
thanks.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: thanks.url(options),
    method: 'head',
})

/**
* @see [serialized-closure]:2
* @route '/gracias'
*/
const thanksForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: thanks.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/gracias'
*/
thanksForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: thanks.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/gracias'
*/
thanksForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: thanks.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

thanks.form = thanksForm

/**
* @see [serialized-closure]:2
* @route '/ya-votaste'
*/
export const alreadyVoted = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: alreadyVoted.url(options),
    method: 'get',
})

alreadyVoted.definition = {
    methods: ["get","head"],
    url: '/ya-votaste',
} satisfies RouteDefinition<["get","head"]>

/**
* @see [serialized-closure]:2
* @route '/ya-votaste'
*/
alreadyVoted.url = (options?: RouteQueryOptions) => {
    return alreadyVoted.definition.url + queryParams(options)
}

/**
* @see [serialized-closure]:2
* @route '/ya-votaste'
*/
alreadyVoted.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: alreadyVoted.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/ya-votaste'
*/
alreadyVoted.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: alreadyVoted.url(options),
    method: 'head',
})

/**
* @see [serialized-closure]:2
* @route '/ya-votaste'
*/
const alreadyVotedForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: alreadyVoted.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/ya-votaste'
*/
alreadyVotedForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: alreadyVoted.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/ya-votaste'
*/
alreadyVotedForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: alreadyVoted.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

alreadyVoted.form = alreadyVotedForm

/**
* @see [serialized-closure]:2
* @route '/eleccion-cerrada'
*/
export const electionClosed = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: electionClosed.url(options),
    method: 'get',
})

electionClosed.definition = {
    methods: ["get","head"],
    url: '/eleccion-cerrada',
} satisfies RouteDefinition<["get","head"]>

/**
* @see [serialized-closure]:2
* @route '/eleccion-cerrada'
*/
electionClosed.url = (options?: RouteQueryOptions) => {
    return electionClosed.definition.url + queryParams(options)
}

/**
* @see [serialized-closure]:2
* @route '/eleccion-cerrada'
*/
electionClosed.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: electionClosed.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/eleccion-cerrada'
*/
electionClosed.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: electionClosed.url(options),
    method: 'head',
})

/**
* @see [serialized-closure]:2
* @route '/eleccion-cerrada'
*/
const electionClosedForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionClosed.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/eleccion-cerrada'
*/
electionClosedForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionClosed.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/eleccion-cerrada'
*/
electionClosedForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionClosed.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

electionClosed.form = electionClosedForm

/**
* @see [serialized-closure]:2
* @route '/eleccion-no-abierta'
*/
export const electionNotOpen = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: electionNotOpen.url(options),
    method: 'get',
})

electionNotOpen.definition = {
    methods: ["get","head"],
    url: '/eleccion-no-abierta',
} satisfies RouteDefinition<["get","head"]>

/**
* @see [serialized-closure]:2
* @route '/eleccion-no-abierta'
*/
electionNotOpen.url = (options?: RouteQueryOptions) => {
    return electionNotOpen.definition.url + queryParams(options)
}

/**
* @see [serialized-closure]:2
* @route '/eleccion-no-abierta'
*/
electionNotOpen.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: electionNotOpen.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/eleccion-no-abierta'
*/
electionNotOpen.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: electionNotOpen.url(options),
    method: 'head',
})

/**
* @see [serialized-closure]:2
* @route '/eleccion-no-abierta'
*/
const electionNotOpenForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionNotOpen.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/eleccion-no-abierta'
*/
electionNotOpenForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionNotOpen.url(options),
    method: 'get',
})

/**
* @see [serialized-closure]:2
* @route '/eleccion-no-abierta'
*/
electionNotOpenForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
    action: electionNotOpen.url({
        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
            _method: 'HEAD',
            ...(options?.query ?? options?.mergeQuery ?? {}),
        }
    }),
    method: 'get',
})

electionNotOpen.form = electionNotOpenForm

const voter = {
    vote: Object.assign(vote, vote85807a),
    login: Object.assign(login, loginDf2c2a),
    results: Object.assign(results, results),
    logout: Object.assign(logout, logout),
    thanks: Object.assign(thanks, thanks),
    alreadyVoted: Object.assign(alreadyVoted, alreadyVoted),
    electionClosed: Object.assign(electionClosed, electionClosed),
    electionNotOpen: Object.assign(electionNotOpen, electionNotOpen),
}

export default voter