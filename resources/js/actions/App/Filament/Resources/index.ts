import ElectionResource from './ElectionResource'
import VoteResource from './VoteResource'
import VoterImportResource from './VoterImportResource'
import VoterResource from './VoterResource'
const Resources = {
    ElectionResource: Object.assign(ElectionResource, ElectionResource),
VoteResource: Object.assign(VoteResource, VoteResource),
VoterImportResource: Object.assign(VoterImportResource, VoterImportResource),
VoterResource: Object.assign(VoterResource, VoterResource),
}

export default Resources