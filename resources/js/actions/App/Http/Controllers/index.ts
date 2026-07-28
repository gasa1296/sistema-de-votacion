import VotingController from './VotingController'
import Auth from './Auth'
import ResultsController from './ResultsController'
import ElectionExportController from './ElectionExportController'

const Controllers = {
    VotingController: Object.assign(VotingController, VotingController),
    Auth: Object.assign(Auth, Auth),
    ResultsController: Object.assign(ResultsController, ResultsController),
    ElectionExportController: Object.assign(ElectionExportController, ElectionExportController),
}

export default Controllers