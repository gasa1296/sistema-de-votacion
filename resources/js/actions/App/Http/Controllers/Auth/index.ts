import VoterLoginController from './VoterLoginController'
import VoterPasswordResetController from './VoterPasswordResetController'

const Auth = {
    VoterLoginController: Object.assign(VoterLoginController, VoterLoginController),
    VoterPasswordResetController: Object.assign(VoterPasswordResetController, VoterPasswordResetController),
}

export default Auth